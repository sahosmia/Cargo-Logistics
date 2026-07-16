<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        // Get the phone number from the notifiable model
        $to = $notifiable->routeNotificationFor('sms', $notification) ?: ($notifiable->phone_number ?? null);

        if (empty($to)) {
            Log::warning('No phone number found for SMS notification on ' . get_class($notifiable));
            return;
        }

        // Get the SMS message content
        if (! method_exists($notification, 'toSms')) {
            Log::error('Notification ' . get_class($notification) . ' does not have toSms method');
            return;
        }

        $message = $notification->toSms($notifiable);

        if (empty($message)) {
            return;
        }

        // Call our SMS sending logic (which uses dynamic settings)
        $this->sendSms($to, $message);
    }

    /**
     * Send SMS using settings.
     */
    protected function sendSms(string $to, string $message): bool
    {
        $enabled = settings('sms_enabled');
        if (!$enabled || $enabled === '0' || $enabled === 'false' || $enabled === false) {
            Log::info("SMS sending is disabled.");
            return false;
        }

        $apiUrl = settings('sms_api_url');
        $apiKey = settings('sms_api_key');
        $senderId = settings('sms_sender_id');

        if (empty($apiUrl) || empty($apiKey)) {
            Log::warning('SMS settings are incomplete (missing api_url or api_key).');
            return false;
        }

        // Support flexible placeholders in the API URL:
        // {API_KEY}, {TO}, {MESSAGE}, {SENDER_ID}
        if (str_contains($apiUrl, '{TO}') || str_contains($apiUrl, '{MESSAGE}')) {
            $url = str_replace(
                ['{API_KEY}', '{TO}', '{MESSAGE}', '{SENDER_ID}'],
                [$apiKey, urlencode($to), urlencode($message), urlencode($senderId ?? '')],
                $apiUrl
            );

            try {
                $response = Http::get($url);
                Log::info("SMS sent via placeholder URL to {$to}. Status: " . $response->status() . " Body: " . $response->body());
                return $response->successful();
            } catch (\Exception $e) {
                Log::error('SMS sending failed via placeholder URL to ' . $to . ': ' . $e->getMessage());
                return false;
            }
        }

        // Fallback: If no placeholders are used, detect common gateways or send standard query parameters.
        $parsedUrl = parse_url($apiUrl);
        $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';

        $params = [];
        if (str_contains($host, 'greenweb.com.bd')) {
            $params = [
                'token' => $apiKey,
                'to' => $to,
                'message' => $message,
            ];
        } elseif (str_contains($host, 'bulksmsbd.net')) {
            $params = [
                'api_key' => $apiKey,
                'number' => $to,
                'message' => $message,
                'type' => 'text',
            ];
            if (!empty($senderId)) {
                $params['senderid'] = $senderId;
            }
        } elseif (str_contains($host, 'mimisms.com') || str_contains($host, 'elitbuzz-bd.com') || str_contains($host, 'smsq.com.bd')) {
            $params = [
                'api_key' => $apiKey,
                'contacts' => $to,
                'msg' => $message,
                'type' => 'text',
            ];
            if (!empty($senderId)) {
                $params['senderid'] = $senderId;
            }
        } else {
            // Generic gateway: send all standard params
            $params = [
                'api_key' => $apiKey,
                'token' => $apiKey,
                'to' => $to,
                'number' => $to,
                'contacts' => $to,
                'message' => $message,
                'msg' => $message,
            ];
            if (!empty($senderId)) {
                $params['senderid'] = $senderId;
                $params['sender_id'] = $senderId;
            }
        }

        try {
            $response = Http::get($apiUrl, $params);
            Log::info("SMS sent to {$to}. Response: " . $response->body());
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('SMS sending failed to ' . $to . ': ' . $e->getMessage());
            return false;
        }
    }
}
