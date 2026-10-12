<?php 

  require_once('admin/inc/db_config.php');
  require_once('admin/inc/essentials.php');

  require_once('inc/bakong/config_bakong.php');
  require_once('inc/bakong/BakongPayment.php');

  date_default_timezone_set("Asia/Phnom_Penh");

  if(!isset($_SESSION)) { session_start(); }

  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }

  if(isset($_POST['pay_now']))
  {
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);    
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];

    // Insert payment data into database
    $frm_data = filteration($_POST);

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`, `trans_amt`, `booking_status`) 
      VALUES (?,?,?,?,?,?,?)";

    insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],
      $frm_data['checkout'],$ORDER_ID,$TXN_AMOUNT,'pending'],'issssss');
    
    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],
      $TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$frm_data['address']],'issssss');

    // Generate Bakong payment QR
    $payment_data = [
        'order_id' => $ORDER_ID,
        'amount' => $TXN_AMOUNT,
        'description' => 'Booking: ' . $_SESSION['room']['name'] . ' - ' . $frm_data['name']
    ];

    $bakong_response = BakongPayment::generatePaymentQR($payment_data);

    // Store the booking ID in session for reference
    $_SESSION['current_booking_id'] = $booking_id;
    $_SESSION['bakong_response'] = $bakong_response;
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Bakong Payment</title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .payment-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }
        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .payment-header h2 {
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .bakong-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
        }
        .bakong-logo img {
            max-width: 200px;
            height: auto;
        }
        .qr-code-container {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .qr-code-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .amount-display {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .amount-display .label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .amount-display .amount {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
        }
        .amount-display .currency {
            font-size: 14px;
            color: #999;
        }
        .instructions {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
        }
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .status-message {
            text-align: center;
            margin: 20px 0;
            font-weight: 500;
        }
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .error-message {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
  </head>
  <body>
    <div class="payment-container">
        <div class="payment-header">
            <h2>Bakong Payment Gateway</h2>
            <p>Complete your booking payment</p>
        </div>

        <?php
          if(isset($_SESSION['bakong_response']) && isset($_SESSION['current_booking_id'])) {
            $response = $_SESSION['bakong_response'];
            $booking_id = $_SESSION['current_booking_id'];
            
            if(isset($response['success']) && $response['success'] == true) {
                ?>
                <div class="status-message">
                    <div class="loading-spinner"></div>
                    Processing your payment...
                </div>

                <div class="amount-display">
                    <div class="label">Total Amount to Pay</div>
                    <div class="amount">
                        <?php echo number_format($TXN_AMOUNT, 2); ?>
                        <span class="currency fs-2 ">$</span>
                    </div>
                </div>

                <?php if(isset($response['qrData'])) { ?>
                <div class="qr-code-container">
                    <img src="<?php echo htmlspecialchars($response['qrData']); ?>" alt="Bakong QR Code">
                    <?php if(isset($response['demo_mode']) && $response['demo_mode'] === true) { ?>
                        <div style="margin-top: 15px; padding: 10px; background: #fff3cd; border-radius: 5px;">
                            <strong> DEMO MODE</strong><br>
                            <span style="font-size: 13px;">This is a simulated QR code for testing purposes.</span>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if(isset($response['demo_mode']) && $response['demo_mode'] === true) { ?>
                <div class="instructions">
                    <strong> Demo Payment Mode Active</strong>
                    <br><br>
                    This is a <strong>simulated payment</strong> for testing purposes. No real money will be transferred.
                    <br><br>
                    Click the button below to simulate payment completion:
                    <br><br>
                    <a href="demo_complete_payment.php?order_id=<?php echo urlencode($ORDER_ID); ?>" 
                       class="btn btn-primary" 
                       target="_blank"
                       style="display: inline-block; text-decoration: none; text-align: center;">
                         Complete Demo Payment
                    </a>
                    <br><br>
                </div>
                <?php } else { ?>
                <div class="instructions">
                    <strong>Payment Instructions:</strong>
                    <br><br>
                    1. Open your Bakong-enabled mobile banking app<br>
                    2. Scan the QR code above or use direct payment transfer<br>
                    3. Confirm the transaction<br>
                    4. You will be redirected automatically after payment
                </div>
                <?php } ?>

                <div class="amount-display">
                    <div class="label">Order ID</div>
                    <div style="font-size: 16px; color: #333; font-family: monospace;">
                        <?php echo htmlspecialchars($ORDER_ID); ?>
                    </div>
                </div>

                <div class="btn-container">
                    <button class="btn btn-danger" onclick="window.history.back();">Cancel Payment</button>
                </div>

                <?php
            } else {
                ?>
                <div class="error-message">
                    <strong>Payment Error:</strong><br>
                    <?php 
                    echo htmlspecialchars($response['message'] ?? 'Failed to initialize Bakong payment');
                    ?>
                    <br><br>
                    <a href="rooms.php" class="btn btn-primary" style="display: inline-block; margin-top: 10px;">Return to Booking</a>
                </div>
                <?php
            }
            
            // Clear session data
            unset($_SESSION['bakong_response']);
            unset($_SESSION['current_booking_id']);
          } else {
            ?>
            <div class="error-message">
                <strong>Error:</strong><br>
                No payment session found. Please try again.
                <br><br>
                <a href="rooms.php" class="btn btn-primary" style="display: inline-block; margin-top: 10px;">Return to Booking</a>
            </div>
            <?php
          }
        ?>
    </div>

  </body>
</html>