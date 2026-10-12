<?php 

  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  require('inc/bakong/config_bakong.php');
  require('inc/bakong/BakongPayment.php');

  date_default_timezone_set("Asia/Phnom_Penh");

  session_start();



  function regenerate_session($uid) {
    global $con;
    $user_q = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$uid],'i');
    $user_fetch = mysqli_fetch_assoc($user_q);

    $_SESSION['login'] = true;
    $_SESSION['uId'] = $user_fetch['id'];
    $_SESSION['uName'] = $user_fetch['name'];
    $_SESSION['uPic'] = $user_fetch['profile'];
    $_SESSION['uPhone'] = $user_fetch['phonenum'];
  }

  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");

  // Log the callback for debugging
  $callback_log = [
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD'],
    'post_data' => $_POST,
    'get_data' => $_GET
  ];

  // Check if this is a demo mode callback
  $is_demo = (isset($_POST['demo_mode']) && $_POST['demo_mode'] == 'true' && 
              defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE === true);

  // Verify the callback signature
  $is_valid = false;
  $transaction_data = [
    'status' => 'error',
    'message' => 'Invalid callback signature'
  ];

  // Handle demo mode callback
  if ($is_demo) {
    $is_valid = true;
    
    // Get demo data
    $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : 'failed';
    
    // Find the booking by order ID
    $slct_query = "SELECT bo.`booking_id`, bo.`user_id`, bo.`trans_amt` FROM `booking_order` bo
      WHERE bo.`order_id`=?";

    $slct_res = select($slct_query, [$order_id], 's');

    if(mysqli_num_rows($slct_res) == 0) {
      redirect('index.php');
      exit;
    }

    $slct_fetch = mysqli_fetch_assoc($slct_res);
    $booking_id = $slct_fetch['booking_id'];
    $user_id = $slct_fetch['user_id'];
    $amount = $slct_fetch['trans_amt'];

    // Restore user session if needed
    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
      regenerate_session($user_id);
    }

    // Update booking status based on demo payment
    if ($status == 'success') {
      $transaction_id = 'DEMO_TXN_' . time();
      
      $upd_query = "UPDATE `booking_order` SET `booking_status`='booked',
        `trans_id`=?, `trans_amt`=?,
        `trans_status`=?, `trans_resp_msg`=? 
        WHERE `booking_id`=?";

      update($upd_query, 
        [$transaction_id, $amount, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', $booking_id],
        'sissi'
      );
      
      redirect('pay_status.php?order=' . $order_id);
      exit;
    } else {
      $transaction_id = 'DEMO_FAIL_' . time();
      
      $upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',
        `trans_id`=?, `trans_amt`=?,
        `trans_status`=?, `trans_resp_msg`=? 
        WHERE `booking_id`=?";

      update($upd_query,
        [$transaction_id, $amount, 'TXN_FAILURE', 'Demo payment failed (simulated)', $booking_id],
        'sissi'
      );
      
      redirect('pay_status.php?order=' . $order_id);
      exit;
    }
  }
  // Try to validate the callback from real Bakong API
  else if (BakongPayment::validateCallback($_POST)) {
    $is_valid = true;

    // Get transaction details from the callback
    $transaction_id = isset($_POST['transactionId']) ? $_POST['transactionId'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : 0;
    
    // Find the booking by order ID
    $order_id = isset($_POST['merchantReferenceId']) ? $_POST['merchantReferenceId'] : $transaction_id;

    $slct_query = "SELECT bo.`booking_id`, bo.`user_id` FROM `booking_order` bo
      WHERE bo.`order_id`=?";

    $slct_res = select($slct_query, [$order_id], 's');

    if(mysqli_num_rows($slct_res) == 0) {
      // Booking order not found
      header("HTTP/1.1 404 Not Found");
      exit;
    }

    $slct_fetch = mysqli_fetch_assoc($slct_res);
    $booking_id = $slct_fetch['booking_id'];
    $user_id = $slct_fetch['user_id'];

    // Restore user session if needed
    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
      regenerate_session($user_id);
    }

    // Update booking status based on payment status
    if ($status == 'SUCCESS' || $status == '00' || $status == 1) {
      // Payment successful
      $upd_query = "UPDATE `booking_order` SET `booking_status`='booked',
        `trans_id`=?, `trans_amt`=?,
        `trans_status`=?, `trans_resp_msg`=? 
        WHERE `booking_id`=?";

      update($upd_query, 
        [
          htmlspecialchars($transaction_id),
          (int)$amount,
          'TXN_SUCCESS',
          'Payment completed by Bakong',
          $booking_id
        ],
        'sissi'
      );

      $transaction_data = [
        'status' => 'success',
        'message' => 'Payment verified successfully',
        'booking_id' => $booking_id
      ];
    } 
    else if ($status == 'FAILED' || $status == '01' || $status == 0) {
      // Payment failed
      $upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',
        `trans_id`=?, `trans_amt`=?,
        `trans_status`=?, `trans_resp_msg`=? 
        WHERE `booking_id`=?";

      update($upd_query,
        [
          htmlspecialchars($transaction_id),
          (int)$amount,
          'TXN_FAILURE',
          'Payment declined or cancelled',
          $booking_id
        ],
        'sissi'
      );

      $transaction_data = [
        'status' => 'failed',
        'message' => 'Payment failed'
      ];
    }
    else {
      // Pending or unknown status
      $upd_query = "UPDATE `booking_order` SET `booking_status`='pending',
        `trans_id`=?, `trans_amt`=?,
        `trans_status`=?, `trans_resp_msg`=? 
        WHERE `booking_id`=?";

      update($upd_query,
        [
          htmlspecialchars($transaction_id),
          (int)$amount,
          'PENDING',
          'Payment status: ' . htmlspecialchars($status),
          $booking_id
        ],
        'sissi'
      );

      $transaction_data = [
        'status' => 'pending',
        'message' => 'Payment is pending'
      ];
    }

    // Send confirmation response
    header('Content-Type: application/json');
    echo json_encode([
      'httpCode' => 200,
      'status' => true,
      'message' => 'Webhook received and processed'
    ]);
  } 
  else {
    // Invalid signature - respond with error
    header('Content-Type: application/json');
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode([
      'httpCode' => 401,
      'status' => false,
      'message' => 'Invalid signature'
    ]);
  }

  exit;

?>


?>