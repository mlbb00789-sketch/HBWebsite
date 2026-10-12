<?php

/**
 * Bakong API Configuration
 * Bakong is Cambodia's National Payment Gateway
 */

// Bakong Environment: TEST, PROD, or DEMO
// DEMO = Local testing without real API (simulated payments)
// TEST = Bakong test API with real test credentials
// PROD = Live production API
define('BAKONG_ENVIRONMENT', 'DEMO'); // Change to TEST (with real credentials) or PROD for production

// Demo Mode: Set to true for local testing without real API credentials
// When true, payments are simulated locally (no actual API calls)
define('BAKONG_DEMO_MODE', (BAKONG_ENVIRONMENT === 'DEMO'));

// Merchant Credentials (Get these from Bakong Merchant Portal)
// TEST CREDENTIALS - Replace with real credentials from Bakong
define('BAKONG_MERCHANT_ID', 'MERCHANT_TEST_001');
define('BAKONG_MERCHANT_SECRET', 'test_secret_key_12345678');
define('BAKONG_API_KEY', 'test_api_key_87654321');

// Bakong API Endpoints
$BAKONG_BASE_URL_TEST = 'https://api-test.bakong.dev';
$BAKONG_BASE_URL_PROD = 'https://api.bakong.dev';

// Set the base URL based on environment
$BAKONG_BASE_URL = (BAKONG_ENVIRONMENT == 'PROD') ? $BAKONG_BASE_URL_PROD : $BAKONG_BASE_URL_TEST;

// Define API endpoints
define('BAKONG_BASE_URL', $BAKONG_BASE_URL);
define('BAKONG_PAYMENT_URL', $BAKONG_BASE_URL . '/v1/payment_gateway/merchant/qr/generate');
define('BAKONG_VERIFY_URL', $BAKONG_BASE_URL . '/v1/payment_gateway/merchant/transaction/confirm');
define('BAKONG_TRANSACTION_STATUS_URL', $BAKONG_BASE_URL . '/v1/payment_gateway/merchant/transaction/getDetails');

// Callback URL - Update if your project folder name is different
define('BAKONG_CALLBACK_URL', 'http://localhost/hbwebsite/pay_response.php');

// Currency (KHR - Cambodian Riel)
define('CURRENCY_CODE', 'KHR');

// Timeout for API calls
define('BAKONG_TIMEOUT', 30);

?>
