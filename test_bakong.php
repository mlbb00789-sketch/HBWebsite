<?php
/**
 * Bakong Integration Test Script
 * This script tests the Bakong payment gateway integration
 */

// Include required files
require_once('inc/bakong/config_bakong.php');
require_once('inc/bakong/BakongPayment.php');

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakong API Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 14px;
        }
        
        .test-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        
        .test-section h2 {
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
        }
        
        .info-value {
            color: #333;
            word-break: break-all;
        }
        
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }
        
        .status.success {
            background: #d4edda;
            color: #155724;
        }
        
        .status.error {
            background: #f8d7da;
            color: #721c24;
        }
        
        .status.warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .status.info {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #5568d3;
        }
        
        .code-block {
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            margin-top: 10px;
        }
        
        .code-block pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }
        
        .test-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏦 Bakong Payment Gateway Test</h1>
            <p>Testing Bakong API Integration - <?php echo date('F d, Y H:i:s'); ?></p>
        </div>
        
        <!-- Configuration Test -->
        <div class="test-section">
            <h2>📋 Configuration Status</h2>
            <div class="info-grid">
                <div class="info-label">Environment:</div>
                <div class="info-value">
                    <span class="status <?php 
                        if (BAKONG_ENVIRONMENT == 'DEMO') echo 'warning';
                        else if (BAKONG_ENVIRONMENT == 'TEST') echo 'info';
                        else echo 'error';
                    ?>">
                        <?php echo BAKONG_ENVIRONMENT; ?>
                    </span>
                    <?php if (defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE): ?>
                        <br><small style="color: #856404;">🧪 Demo mode active - simulated payments</small>
                    <?php endif; ?>
                </div>
                
                <div class="info-label">Merchant ID:</div>
                <div class="info-value"><?php echo BAKONG_MERCHANT_ID; ?></div>
                
                <div class="info-label">API Key:</div>
                <div class="info-value"><?php echo substr(BAKONG_API_KEY, 0, 20) . '...'; ?></div>
                
                <div class="info-label">Base URL:</div>
                <div class="info-value"><?php echo BAKONG_BASE_URL; ?></div>
                
                <div class="info-label">Payment URL:</div>
                <div class="info-value"><?php echo BAKONG_PAYMENT_URL; ?></div>
                
                <div class="info-label">Callback URL:</div>
                <div class="info-value"><?php echo BAKONG_CALLBACK_URL; ?></div>
                
                <div class="info-label">Currency:</div>
                <div class="info-value"><?php echo CURRENCY_CODE; ?></div>
            </div>
            
            <?php if (BAKONG_ENVIRONMENT == 'TEST'): ?>
                <div style="margin-top: 15px;">
                    <span class="status success">✓ TEST MODE - Safe to test</span>
                </div>
            <?php else: ?>
                <div style="margin-top: 15px;">
                    <span class="status warning">⚠ PRODUCTION MODE - Real transactions!</span>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- PHP Extensions Check -->
        <div class="test-section">
            <h2>🔧 PHP Environment Check</h2>
            <div class="info-grid">
                <div class="info-label">PHP Version:</div>
                <div class="info-value">
                    <?php echo phpversion(); ?>
                    <span class="status <?php echo version_compare(phpversion(), '7.0', '>=') ? 'success' : 'error'; ?>">
                        <?php echo version_compare(phpversion(), '7.0', '>=') ? '✓ OK' : '✗ Too Old'; ?>
                    </span>
                </div>
                
                <div class="info-label">cURL Extension:</div>
                <div class="info-value">
                    <span class="status <?php echo extension_loaded('curl') ? 'success' : 'error'; ?>">
                        <?php echo extension_loaded('curl') ? '✓ Enabled' : '✗ Not Found'; ?>
                    </span>
                </div>
                
                <div class="info-label">JSON Extension:</div>
                <div class="info-value">
                    <span class="status <?php echo extension_loaded('json') ? 'success' : 'error'; ?>">
                        <?php echo extension_loaded('json') ? '✓ Enabled' : '✗ Not Found'; ?>
                    </span>
                </div>
                
                <div class="info-label">OpenSSL Extension:</div>
                <div class="info-value">
                    <span class="status <?php echo extension_loaded('openssl') ? 'success' : 'error'; ?>">
                        <?php echo extension_loaded('openssl') ? '✓ Enabled' : '✗ Not Found'; ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- API Connection Test -->
        <div class="test-section">
            <h2>🌐 API Connection Test</h2>
            
            <?php
            // Test if cURL can connect to Bakong
            if (extension_loaded('curl')) {
                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL => BAKONG_BASE_URL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_NOBODY => true
                ]);
                
                $result = curl_exec($ch);
                $error = curl_error($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                echo '<div class="info-grid">';
                echo '<div class="info-label">API Host:</div>';
                echo '<div class="info-value">' . BAKONG_BASE_URL . '</div>';
                
                echo '<div class="info-label">Connection:</div>';
                if ($error) {
                    echo '<div class="info-value">';
                    echo '<span class="status error">✗ Connection Failed</span>';
                    echo '<div class="code-block"><pre>' . htmlspecialchars($error) . '</pre></div>';
                    echo '</div>';
                } else {
                    echo '<div class="info-value">';
                    echo '<span class="status success">✓ Connection Successful</span>';
                    echo '<p style="margin-top: 10px;">HTTP Code: ' . $http_code . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<span class="status error">✗ cURL extension not available</span>';
            }
            ?>
        </div>
        
        <!-- Test Payment QR Generation -->
        <div class="test-section">
            <h2>💳 Payment QR Generation Test</h2>
            
            <?php
            // Generate a test payment
            $test_order_id = 'TEST_' . time();
            $test_amount = 50000; // 50,000 KHR (about $12.50 USD)
            
            echo '<p style="margin-bottom: 15px;">Generating test payment QR code...</p>';
            echo '<div class="info-grid">';
            echo '<div class="info-label">Test Order ID:</div>';
            echo '<div class="info-value">' . $test_order_id . '</div>';
            
            echo '<div class="info-label">Amount:</div>';
            echo '<div class="info-value">' . number_format($test_amount) . ' ' . CURRENCY_CODE . '</div>';
            echo '</div>';
            
            $payment_data = [
                'order_id' => $test_order_id,
                'amount' => $test_amount,
                'description' => 'Test Hotel Booking Payment'
            ];
            
            $response = BakongPayment::generatePaymentQR($payment_data);
            
            echo '<div style="margin-top: 20px;">';
            echo '<h3 style="margin-bottom: 10px;">API Response:</h3>';
            
            if (isset($response['success']) && $response['success'] === false) {
                echo '<span class="status error">✗ Payment Generation Failed</span>';
                echo '<div class="code-block"><pre>' . print_r($response, true) . '</pre></div>';
                
                if (BAKONG_MERCHANT_ID == 'MERCHANT_TEST_001') {
                    echo '<div style="margin-top: 15px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">';
                    echo '<strong>⚠ Notice:</strong> You are using placeholder credentials. ';
                    echo 'To test with real Bakong API, please:<br><br>';
                    echo '1. Sign up at <a href="https://www.bakong.gov.kh/" target="_blank">https://www.bakong.gov.kh/</a><br>';
                    echo '2. Get your TEST merchant credentials<br>';
                    echo '3. Update them in <code>inc/bakong/config_bakong.php</code>';
                    echo '</div>';
                }
            } else {
                echo '<span class="status success">✓ Payment Generated Successfully</span>';
                echo '<div class="code-block"><pre>' . print_r($response, true) . '</pre></div>';
                
                // If QR code is present, display it
                if (isset($response['qrCode']) || isset($response['data']['qrCode'])) {
                    $qr_code = $response['qrCode'] ?? $response['data']['qrCode'];
                    echo '<div style="margin-top: 20px; text-align: center;">';
                    echo '<h3>QR Code:</h3>';
                    echo '<img src="data:image/png;base64,' . $qr_code . '" alt="Bakong QR Code" style="max-width: 300px; margin-top: 10px;">';
                    echo '</div>';
                }
            }
            echo '</div>';
            ?>
        </div>
        
        <!-- Summary -->
        <div class="test-section">
            <h2>📊 Test Summary</h2>
            
            <?php
            $all_tests_passed = true;
            $issues = [];
            $warnings = [];
            
            // Check environment
            if (BAKONG_ENVIRONMENT == 'DEMO') {
                $warnings[] = 'Running in DEMO mode - payments are simulated locally (no real API calls)';
            } else if (BAKONG_ENVIRONMENT != 'TEST') {
                $issues[] = 'Not in TEST mode - switch to TEST or DEMO for safe testing';
                $all_tests_passed = false;
            }
            
            // Check PHP version
            if (!version_compare(phpversion(), '7.0', '>=')) {
                $issues[] = 'PHP version too old (need 7.0+)';
                $all_tests_passed = false;
            }
            
            // Check required extensions
            if (!extension_loaded('curl')) {
                $issues[] = 'cURL extension not loaded';
                $all_tests_passed = false;
            }
            
            if (!extension_loaded('json')) {
                $issues[] = 'JSON extension not loaded';
                $all_tests_passed = false;
            }
            
            // Check credentials (only if not in demo mode)
            if (!defined('BAKONG_DEMO_MODE') || !BAKONG_DEMO_MODE) {
                if (BAKONG_MERCHANT_ID == 'MERCHANT_TEST_001') {
                    $issues[] = 'Using placeholder credentials - update with real Bakong TEST credentials or switch to DEMO mode';
                    $all_tests_passed = false;
                }
            }
            
            if ($all_tests_passed && empty($issues)) {
                echo '<div style="padding: 20px; background: #d4edda; border-left: 4px solid #28a745; border-radius: 5px;">';
                echo '<h3 style="color: #155724; margin-bottom: 10px;">✓ All Tests Passed!</h3>';
                
                if (defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE) {
                    echo '<p style="color: #155724;">Your Bakong integration is in <strong>DEMO mode</strong>. You can test the complete payment flow locally without real API credentials.</p>';
                } else {
                    echo '<p style="color: #155724;">Your Bakong integration is configured correctly and ready for testing.</p>';
                }
                
                if (!empty($warnings)) {
                    echo '<div style="margin-top: 15px; padding: 10px; background: #fff3cd; border-radius: 5px;">';
                    echo '<ul style="margin: 5px 0 0 20px; color: #856404;">';
                    foreach ($warnings as $warning) {
                        echo '<li>' . htmlspecialchars($warning) . '</li>';
                    }
                    echo '</ul></div>';
                }
                
                echo '</div>';
            } else {
                echo '<div style="padding: 20px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">';
                echo '<h3 style="color: #856404; margin-bottom: 10px;">⚠ Issues Found</h3>';
                echo '<ul style="margin-left: 20px; color: #856404;">';
                foreach ($issues as $issue) {
                    echo '<li>' . htmlspecialchars($issue) . '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            ?>
            
            <div class="test-actions">
                <h3 style="margin-bottom: 15px;">Next Steps:</h3>
                
                <?php if (defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE): ?>
                <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <strong style="color: #155724;">✓ Demo Mode is Active</strong>
                    <p style="color: #155724; margin: 10px 0 0 0;">
                        You can now test the complete payment flow:<br>
                        1. Go to the <a href="index.php" style="color: #155724; text-decoration: underline;">homepage</a><br>
                        2. Book a room and proceed to payment<br>
                        3. Click "Complete Demo Payment" to simulate payment<br>
                        4. Choose success or failure to test different scenarios
                    </p>
                </div>
                <?php endif; ?>
                
                <ul style="margin-left: 20px; color: #555; line-height: 1.8;">
                    <li>Review the test results above</li>
                    <?php if (defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE): ?>
                    <li><strong>Demo Mode</strong>: Test locally without API credentials</li>
                    <li>To use real Bakong TEST API: Get credentials and change BAKONG_ENVIRONMENT to 'TEST'</li>
                    <?php else: ?>
                    <li>If using placeholder credentials, get real TEST credentials from Bakong</li>
                    <li>Update credentials in <code>inc/bakong/config_bakong.php</code></li>
                    <li>Or switch to DEMO mode for local testing without credentials</li>
                    <?php endif; ?>
                    <li>Test the complete payment flow by making a test booking</li>
                    <li>Check the callback URL is accessible (use ngrok for real API testing)</li>
                </ul>
                
                <div style="margin-top: 20px;">
                    <button onclick="location.reload()" class="btn">🔄 Refresh Test</button>
                    <a href="index.php" class="btn" style="margin-left: 10px;">🏠 Go to Homepage</a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div style="text-align: center; color: white; margin-top: 30px; opacity: 0.8;">
            <p>Bakong Payment Gateway Testing Tool</p>
            <p style="font-size: 12px; margin-top: 5px;">For development and testing purposes only</p>
        </div>
    </div>
</body>
</html>
