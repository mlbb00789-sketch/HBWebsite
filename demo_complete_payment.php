<?php
/**
 * Demo Payment Completion Simulator
 * Simulates Bakong payment callback for testing
 */

require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');
require_once('inc/bakong/config_bakong.php');

if(!isset($_SESSION)) { session_start(); }

// Check if in demo mode
if (!defined('BAKONG_DEMO_MODE') || BAKONG_DEMO_MODE !== true) {
    die('Demo mode is not enabled. This page is only for testing.');
}

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? filteration($_GET)['order_id'] : null;

if (!$order_id) {
    die('No order ID provided.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Payment Simulator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .simulator-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        .demo-badge {
            background: #ffc107;
            color: #333;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .label {
            font-weight: 600;
            color: #555;
        }
        .value {
            color: #333;
            font-family: monospace;
        }
        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-success {
            background: #28a745;
            color: white;
        }
        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .note {
            background: #d1ecf1;
            border-left: 4px solid #0c5460;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 14px;
            color: #0c5460;
        }
    </style>
</head>
<body>
    <div class="simulator-container">
        <div style="text-align: center;">
            <span class="demo-badge"> DEMO MODE</span>
        </div>
        
        <h2>Payment Simulator</h2>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">
            Simulate Bakong payment completion
        </p>
        
        <div class="info-box">
            <div class="info-row">
                <span class="label">Order ID:</span>
                <span class="value"><?php echo htmlspecialchars($order_id); ?></span>
            </div>
            <div class="info-row">
                <span class="label">Status:</span>
                <span class="value" style="color: #ffc107;">Pending Payment</span>
            </div>
            <div class="info-row">
                <span class="label">Method:</span>
                <span class="value">Bakong (Demo)</span>
            </div>
        </div>
        
        <div class="note">
            <strong> Demo Mode Active</strong><br>
            This is a simulated payment. No real money will be transferred.
        </div>
        
        <form action="pay_response.php" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
            <input type="hidden" name="demo_mode" value="true">
            <input type="hidden" name="status" id="payment_status" value="">
            
            <button type="submit" class="btn btn-success" onclick="setStatus('success')">
                ✓ Simulate Successful Payment
            </button>
            
            <button type="submit" class="btn btn-danger" onclick="setStatus('failed')">
                ✗ Simulate Failed Payment
            </button>
            
            <button type="button" class="btn btn-secondary" onclick="window.close()">
                Cancel
            </button>
        </form>
    </div>
    
    <script>
        function setStatus(status) {
            document.getElementById('payment_status').value = status;
        }
    </script>
</body>
</html>
