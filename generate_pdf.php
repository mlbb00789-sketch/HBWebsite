<?php 

require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
require('admin/inc/mpdf/vendor/autoload.php');

session_start();

if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
  redirect('index.php');
}

if(isset($_GET['gen_pdf']) && isset($_GET['id']))
{
  $frm_data = filteration($_GET);

  $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    INNER JOIN `user_cred` uc ON bo.user_id = uc.id
    WHERE ((bo.booking_status='booked' AND bo.arrival=1) 
    OR (bo.booking_status='cancelled' AND bo.refund=1)
    OR (bo.booking_status='payment failed')) 
    AND bo.booking_id = '$frm_data[id]'";

  $res = mysqli_query($con,$query);
  if(mysqli_num_rows($res)==0){
    header('location: index.php');
    exit;
  }

  $data = mysqli_fetch_assoc($res);

  $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
  $checkin = date("d-m-Y",strtotime($data['check_in']));
  $checkout = date("d-m-Y",strtotime($data['check_out']));

  // Status Badge Color
  $status_color = '#28a745'; // default green
  if($data['booking_status']=='cancelled') $status_color = '#dc3545';
  if($data['booking_status']=='payment failed') $status_color = '#ffc107';

  $html = "
  <style>
    body{
      font-family: sans-serif;
      color:#333;
    }
    .header{
      text-align:center;
      border-bottom:2px solid #000;
      padding-bottom:10px;
      margin-bottom:20px;
    }
    .hotel-name{
      font-size:26px;
      font-weight:bold;
      letter-spacing:1px;
    }
    .receipt-title{
      font-size:18px;
      margin-top:5px;
    }
    .status{
      background:$status_color;
      color:white;
      padding:5px 12px;
      border-radius:4px;
      font-size:12px;
    }
    table{
      width:100%;
      border-collapse:collapse;
      margin-top:10px;
    }
    td{
      padding:10px;
      border-bottom:1px solid #ddd;
    }
    .section-title{
      font-weight:bold;
      background:#f8f9fa;
    }
    .total{
      font-size:16px;
      font-weight:bold;
    }
    .footer{
      margin-top:30px;
      font-size:12px;
      text-align:center;
      color:#777;
    }
  </style>

  <div class='header'>
    <div class='hotel-name'>BOPHA SR</div>
    <div>Siemreap, Cambodia</div>
    <div class='receipt-title'>BOOKING RECEIPT</div>
  </div>

  <table>
    <tr>
      <td><strong>Order ID:</strong> {$data['order_id']}</td>
      <td><strong>Booking Date:</strong> $date</td>
    </tr>
    <tr>
      <td colspan='2'>
        <strong>Status:</strong> 
        <span class='status'>{$data['booking_status']}</span>
      </td>
    </tr>

    <tr class='section-title'>
      <td colspan='2'>Guest Information</td>
    </tr>
    <tr>
      <td><strong>Name:</strong> {$data['user_name']}</td>
      <td><strong>Email:</strong> {$data['email']}</td>
    </tr>
    <tr>
      <td><strong>Phone:</strong> {$data['phonenum']}</td>
      <td><strong>Address:</strong> {$data['address']}</td>
    </tr>

    <tr class='section-title'>
      <td colspan='2'>Booking Details</td>
    </tr>
    <tr>
      <td><strong>Room:</strong> {$data['room_name']}</td>
      <td><strong>Room No:</strong> {$data['room_no']}</td>
    </tr>
    <tr>
      <td><strong>Check-in:</strong> $checkin</td>
      <td><strong>Check-out:</strong> $checkout</td>
    </tr>
    <tr>
      <td><strong>Price per Night:</strong> \$ {$data['price']}</td>
      <td class='total'><strong>Total Paid:</strong> \$ {$data['trans_amt']}</td>
    </tr>
  </table>

  <div class='footer'>
    Thank you for choosing our hotel. <br>
    We look forward to welcoming you again.
  </div>
  ";

  $mpdf = new \Mpdf\Mpdf([
    'margin_top' => 15,
    'margin_bottom' => 15
  ]);

  $mpdf->WriteHTML($html);
  $mpdf->Output($data['order_id'].'.pdf','D');

}
else{
  header('location: index.php');
}
?>