<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymobService
{
    protected $baseUrl = 'https://accept.paymob.com/api';
    protected $apiKey;
    protected $integrationId;
    protected $iframeId;
    protected $hmac;

    public function __construct()
    {
        $this->apiKey = config('services.paymob.api_key');
        $this->integrationId = config('services.paymob.integration_id');
        $this->iframeId = config('services.paymob.iframe_id');
        $this->hmac = config('services.paymob.hmac');
    }

    public function getAuthenticationToken()
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        Log::error('Paymob Auth Failed: ' . $response->body());
        return null;
    }

    public function registerOrder($authToken, $amountCents, $merchantOrderId, $items = [])
    {
        $response = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token' => $authToken,
            'delivery_needed' => 'false',
            'amount_cents' => $amountCents,
            'currency' => 'EGP', // Or configured currency
            'merchant_order_id' => $merchantOrderId,
            'items' => $items,
        ]);

        if ($response->successful()) {
            return $response->json()['id']; // Paymob Order ID
        }

        Log::error('Paymob Order Registration Failed: ' . $response->body());
        return null;
    }

    public function getPaymentKey($authToken, $paymobOrderId, $amountCents, $billingData)
    {
        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token' => $authToken,
            'amount_cents' => $amountCents,
            'expiration' => 3600,
            'order_id' => $paymobOrderId,
            'billing_data' => $billingData,
            'currency' => 'EGP',
            'integration_id' => $this->integrationId,
            'lock_order_when_paid' => 'false',
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        Log::error('Paymob Payment Key Failed: ' . $response->body());
        return null;
    }

    // Standard billing data structure required by Paymob
    public function formatBillingData($user)
    {
        $names = explode(' ', $user->name ?? $user->full_name ?? 'Guest User', 2);
        $firstName = $names[0];
        $lastName = $names[1] ?? 'User';

        return [
            "apartment" => "NA",
            "email" => $user->email ?? 'no-email@example.com',
            "floor" => "NA",
            "first_name" => $firstName,
            "street" => "NA",
            "building" => "NA",
            "phone_number" => $user->phone ?? '01000000000',
            "shipping_method" => "NA",
            "postal_code" => "NA",
            "city" => "Cairo",
            "country" => "EG",
            "last_name" => $lastName,
            "state" => "NA"
        ];
    }

    public function verifyHmac($data)
    {
        $hmacKeys = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data.pan',
            'source_data.sub_type',
            'source_data.type',
            'success',
        ];

        $concatenatedString = '';
        foreach ($hmacKeys as $key) {
            $value = $data;
            foreach (explode('.', $key) as $segment) {
                if (is_array($value) && isset($value[$segment])) {
                    $value = $value[$segment];
                } else {
                    $value = '';
                }
            }
            $concatenatedString .= $value;
        }

        $calculatedHmac = hash_hmac('sha512', $concatenatedString, $this->hmac);

        return $calculatedHmac === ($data['hmac'] ?? '');
    }
}
