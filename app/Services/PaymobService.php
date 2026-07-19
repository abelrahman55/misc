<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PaymobService
{
    protected string $baseUrl = 'https://accept.paymob.com/api';

    protected function authToken(): string
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => config('services.paymob.api_key'),
        ]);

        if (! $response->successful() || ! $response->json('token')) {
            throw new RuntimeException('Paymob auth failed: ' . $response->body());
        }

        return $response->json('token');
    }

    protected function createOrder(string $authToken, int $amountCents, string $merchantOrderId): int
    {
        $response = Http::withToken($authToken)->post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token'        => $authToken,
            'delivery_needed'   => false,
            'amount_cents'      => $amountCents,
            'currency'          => 'EGP',
            'merchant_order_id' => $merchantOrderId,
            'items'             => [],
        ]);

        if (! $response->successful() || ! $response->json('id')) {
            throw new RuntimeException('Paymob order creation failed: ' . $response->body());
        }

        return $response->json('id');
    }

    protected function paymentKey(string $authToken, int $orderId, int $amountCents, array $billingData): string
    {
        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token'     => $authToken,
            'amount_cents'   => $amountCents,
            'expiration'     => 3600,
            'order_id'       => $orderId,
            'billing_data'   => $billingData,
            'currency'       => 'EGP',
            'integration_id' => config('services.paymob.integration_id'),
        ]);

        if (! $response->successful() || ! $response->json('token')) {
            throw new RuntimeException('Paymob payment key request failed: ' . $response->body());
        }

        return $response->json('token');
    }

    /**
     * Run the auth -> order -> payment key flow and return the iframe URL to redirect the patient to.
     */
    public function getIframeUrl(float $amount, array $billingData, string $merchantOrderId): string
    {
        $amountCents = (int) round($amount * 100);

        $authToken   = $this->authToken();
        $orderId     = $this->createOrder($authToken, $amountCents, $merchantOrderId);
        $paymentKey  = $this->paymentKey($authToken, $orderId, $amountCents, $billingData);

        $iframeId = config('services.paymob.iframe_id');

        return "{$this->baseUrl}/acceptance/iframes/{$iframeId}?payment_token={$paymentKey}";
    }

    /**
     * Verify the HMAC Paymob attaches to the transaction callback.
     * Returns true when no secret is configured yet (verification skipped).
     */
    public function verifyHmac(array $obj, ?string $hmac): bool
    {
        $secret = config('services.paymob.hmac_secret');

        if (! $secret) {
            return true;
        }

        if (! $hmac) {
            return false;
        }

        $orderedKeys = [
            'amount_cents', 'created_at', 'currency', 'error_occured',
            'has_parent_transaction', 'id', 'integration_id', 'is_3d_secure',
            'is_auth', 'is_capture', 'is_refunded', 'is_standalone_payment',
            'is_voided', 'order.id', 'owner', 'pending', 'source_data.pan',
            'source_data.sub_type', 'source_data.type', 'success',
        ];

        $concatenated = '';
        foreach ($orderedKeys as $key) {
            $value = data_get($obj, $key);
            $concatenated .= is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
        }

        $calculated = hash_hmac('sha512', $concatenated, $secret);

        return hash_equals($calculated, strtolower($hmac));
    }
}
