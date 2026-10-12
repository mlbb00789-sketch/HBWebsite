<?php

/**
 * Bakong Payment Gateway Integration
 * Helper functions for Bakong API communication
 */

class BakongPayment {
    
    /**
     * Generate payment QR code and transaction reference
     * @param array $payment_data - Contains order_id, amount, description, etc.
     * @return array - Returns transaction data with QR code or error
     */
    public static function generatePaymentQR($payment_data) {
        
        // If in DEMO mode, return simulated response
        if (defined('BAKONG_DEMO_MODE') && BAKONG_DEMO_MODE === true) {
            return self::generateDemoPaymentQR($payment_data);
        }
        
        $merchant_id = BAKONG_MERCHANT_ID;
        $merchant_secret = BAKONG_MERCHANT_SECRET;
        
        // Prepare the request payload
        $payload = [
            'merchantId' => $merchant_id,
            'amount' => $payment_data['amount'],
            'transactionId' => $payment_data['order_id'],
            'description' => $payment_data['description'] ?? 'Hotel Room Booking',
            'returnUrl' => BAKONG_CALLBACK_URL,
            'returnMethod' => 'POST'
        ];
        
        // Generate signature
        $signature = self::generateSignature($payload, $merchant_secret);
        $payload['signature'] = $signature;
        
        // Make the API request
        $response = self::makeApiRequest(
            BAKONG_PAYMENT_URL,
            'POST',
            $payload
        );
        
        return $response;
    }
    
    /**
     * Verify transaction status from Bakong
     * @param string $transaction_id - Bakong transaction ID
     * @return array - Transaction details
     */
    public static function verifyTransaction($transaction_id) {
        
        $merchant_id = BAKONG_MERCHANT_ID;
        $merchant_secret = BAKONG_MERCHANT_SECRET;
        
        $payload = [
            'merchantId' => $merchant_id,
            'transactionId' => $transaction_id
        ];
        
        $signature = self::generateSignature($payload, $merchant_secret);
        $payload['signature'] = $signature;
        
        $response = self::makeApiRequest(
            BAKONG_TRANSACTION_STATUS_URL,
            'GET',
            $payload
        );
        
        return $response;
    }
    
    /**
     * Generate HMAC signature for Bakong requests
     * @param array $data - Data to sign
     * @param string $secret - Merchant secret key
     * @return string - Base64 encoded signature
     */
    private static function generateSignature($data, $secret) {
        // Sort the array by keys
        ksort($data);
        
        // Create signature string
        $signature_str = '';
        foreach ($data as $key => $value) {
            if ($value !== '') {
                $signature_str .= $key . '=' . $value . '&';
            }
        }
        
        // Remove trailing &
        $signature_str = rtrim($signature_str, '&');
        
        // Generate HMAC-SHA512 hash
        $signature = hash_hmac('sha512', $signature_str, $secret, true);
        
        // Return base64 encoded signature
        return base64_encode($signature);
    }
    
    /**
     * Validate incoming Bakong callback
     * @param array $post_data - POST data from Bakong
     * @return bool - True if signature is valid
     */
    public static function validateCallback($post_data) {
        
        if (!isset($post_data['signature'])) {
            return false;
        }
        
        $received_signature = $post_data['signature'];
        
        // Unset the signature from data before validating
        unset($post_data['signature']);
        
        // Generate expected signature
        $expected_signature = self::generateSignature(
            $post_data,
            BAKONG_MERCHANT_SECRET
        );
        
        // Compare signatures
        return hash_equals($expected_signature, $received_signature);
    }
    
    /**
     * Make API request to Bakong
     * @param string $url - API endpoint
     * @param string $method - HTTP method (GET, POST, etc)
     * @param array $data - Request data
     * @return array - API response
     */
    private static function makeApiRequest($url, $method = 'POST', $data = []) {
        
        $ch = curl_init();
        
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => BAKONG_TIMEOUT,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . BAKONG_API_KEY
            ]
        ];
        
        if ($method === 'POST' || $method === 'PUT') {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        } else if ($method === 'GET' && !empty($data)) {
            // Append query parameters for GET requests
            $url .= '?' . http_build_query($data);
            $options[CURLOPT_URL] = $url;
        }
        
        curl_setopt_array($ch, $options);
        
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if ($error) {
            return [
                'success' => false,
                'error' => $error,
                'message' => 'Bakong API connection error'
            ];
        }
        
        $decoded_response = json_decode($response, true);
        
        // Append HTTP status code to response
        $decoded_response['http_code'] = $http_code;
        
        return $decoded_response;
    }
    
    /**
     * Generate demo/simulated payment QR for local testing
     * @param array $payment_data - Payment information
     * @return array - Simulated successful response
     */
    private static function generateDemoPaymentQR($payment_data) {
        // Generate a simple QR code (demo purposes - showing payment info as base64 data URL)
        $qr_text = "DEMO PAYMENT\n";
        $qr_text .= "Order: " . $payment_data['order_id'] . "\n";
        $qr_text .= "Amount: " . number_format($payment_data['amount']) . " KHR\n";
        $qr_text .= "Desc: " . ($payment_data['description'] ?? 'Hotel Booking') . "\n";
        $qr_text .= "\nThis is a DEMO payment.\nNo real transaction will occur.";
        
        // Create a simple SVG QR code placeholder
        $svg_qr = '<svg width="300" height="300" xmlns="http://www.w3.org/2000/svg">';
        $svg_qr .= '<rect width="300" height="300" fill="white"/>';
        $svg_qr .= '<rect x="20" y="20" width="260" height="260" fill="none" stroke="#333" stroke-width="2"/>';
        
        // Add some random QR-like squares
        $positions = [
            [30, 30, 60, 60], [210, 30, 60, 60], [30, 210, 60, 60],
            [120, 120, 40, 40], [150, 80, 30, 30], [80, 150, 30, 30]
        ];
        
        foreach ($positions as $pos) {
            $svg_qr .= sprintf('<rect x="%d" y="%d" width="%d" height="%d" fill="black"/>', 
                $pos[0], $pos[1], $pos[2], $pos[3]);
        }
        
        $svg_qr .= '<text x="150" y="160" font-family="Arial" font-size="14" text-anchor="middle" fill="#666">DEMO</text>';
        $svg_qr .= '<text x="150" y="180" font-family="Arial" font-size="12" text-anchor="middle" fill="#666">Test Payment</text>';
        $svg_qr .= '</svg>';
        
        $qr_data_url = 'data:image/svg+xml;base64,' . base64_encode($svg_qr);
        
        // Return simulated successful response
        return [
            'success' => true,
            'message' => 'Demo payment QR generated (no real API call)',
            'transactionId' => $payment_data['order_id'],
            'qrData' => $qr_data_url,
            'amount' => $payment_data['amount'],
            'currency' => CURRENCY_CODE,
            'status' => 'pending',
            'demo_mode' => true,
            'data' => [
                'orderId' => $payment_data['order_id'],
                'amount' => $payment_data['amount'],
                'qrCode' => base64_encode($svg_qr)
            ]
        ];
    }
}

?>
