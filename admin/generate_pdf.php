<?php 

require('inc/essentials.php');
require('inc/db_config.php');
require('inc/mpdf/vendor/autoload.php');

adminLogin();

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
    $total_rows = mysqli_num_rows($res);

    if($total_rows == 0){
        header('location: dashboard.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
    $checkin = date("d-m-Y",strtotime($data['check_in']));
    $checkout = date("d-m-Y",strtotime($data['check_out']));

    /* =========================
       UPDATED PROFESSIONAL PDF
       ========================= */

    $table_data = "
    <style>
    body { 
        font-family: DejaVu Sans, sans-serif; 
    }

    .container {
        border: 1px solid #333;
        padding: 20px;
    }

    .title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 8px;
        font-size: 13px;
    }

    .label {
        font-weight: bold;
        width: 25%;
    }

    .line {
        border-bottom: 1px solid #ccc;
    }

    .status-box {
        padding: 6px;
        background-color: #f2f2f2;
        text-align: center;
        font-weight: bold;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 11px;
    }
    </style>

    <div class='container'>
        <div class='title'>BOOKING RECEIPT</div>

        <table>
            <tr class='line'>
                <td class='label'>Order ID:</td>
                <td>$data[order_id]</td>
                <td class='label'>Booking Date:</td>
                <td>$date</td>
            </tr>

            <tr class='line'>
                <td class='label'>Status:</td>
                <td colspan='3'>
                    <div class='status-box'>$data[booking_status]</div>
                </td>
            </tr>

            <tr class='line'>
                <td class='label'>Name:</td>
                <td>$data[user_name]</td>
                <td class='label'>Email:</td>
                <td>$data[email]</td>
            </tr>

            <tr class='line'>
                <td class='label'>Phone:</td>
                <td>$data[phonenum]</td>
                <td class='label'>Address:</td>
                <td>$data[address]</td>
            </tr>

            <tr class='line'>
                <td class='label'>Room:</td>
                <td>$data[room_name]</td>
                <td class='label'>Price:</td>
                <td>$".$data['price']." / night</td>
            </tr>

            <tr class='line'>
                <td class='label'>Check-in:</td>
                <td>$checkin</td>
                <td class='label'>Check-out:</td>
                <td>$checkout</td>
            </tr>
    ";

    if($data['booking_status']=='cancelled')
    {
        $refund = ($data['refund']) ? "Refunded" : "Pending";

        $table_data .= "
            <tr>
                <td class='label'>Amount Paid:</td>
                <td>$".$data['trans_amt']."</td>
                <td class='label'>Refund:</td>
                <td>$refund</td>
            </tr>";
    }
    else if($data['booking_status']=='payment failed')
    {
        $table_data .= "
            <tr>
                <td class='label'>Transaction:</td>
                <td>$".$data['trans_amt']."</td>
                <td class='label'>Failure:</td>
                <td>$data[trans_resp_msg]</td>
            </tr>";
    }
    else
    {
        $table_data .= "
            <tr>
                <td class='label'>Room Number:</td>
                <td>$data[room_no]</td>
                <td class='label'>Amount Paid:</td>
                <td>$".$data['trans_amt']."</td>
            </tr>";
    }

    $table_data .= "
        </table>


    </div>
    ";

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['order_id'].'.pdf','D');
}
else{
    header('location: dashboard.php');
}
?>
