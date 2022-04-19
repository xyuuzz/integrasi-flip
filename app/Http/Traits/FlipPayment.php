<?php

namespace App\Http\Traits;

use App\Models\Infaq;
use Illuminate\Support\Facades\Http;

Trait FlipPayment
{

    /*Mendapatkan URL dari API flip, bergantung pada APP_ENV, jika value nya local maka url yang digunakan adalah url sandbox dari flip, namun jika production maka gunakan url production dari flip*/
    private static function url()
    {
        $localUrl = "https://bigflip.id/big_sandbox_api/v2/";
        $productionUrl = "https://bigflip.id/api/v2/";
        return env("APP_ENV") == "local" ? $localUrl : $productionUrl;
    }

    private static function encodeAuth($token)
    {
        return base64_encode($token . ":");
    }

    public  static function postTransaction($credential = [], $data = null, $campaign = null)
    {
        $path = "pwf/bill";
        $url = self::url() . $path;
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

        $payloads = [
//            Judul dari pembayaran
            "title" => "Infaq Digital",
            "amount" => $data->amount,
            "type" => "SINGLE",
            "expired_date" => "2022-12-30 15:50",
            "redirect_url" => "http://www.youtube.com",
            "step" => 2,
            "is_address_required" => 1,
            "is_phone_number_required" => 1,
            "sender_name" => $data->name,
            "sender_email" => $data->email,
            "sender_phone_number" => $data->phone_number,
            "sender_address" => $data->address,
//            "sender_bank" => $data->bank,
//            "sender_bank_type" => "bank_account"
        ];

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic $encoded_auth",
            ])
            ->post($url, $payloads);

        $result = json_decode($response);
//        dd($result);
        Infaq::create([
            "project" => $result->title,
            "nominal" => $result->amount,
            "status" => "pending",
            "time_limit" => $result->expired_date
        ]);

        return $response->successful() ? $result : null;
    }

    public static function confirmTransaction($credential, $id)
    {
        $path = "pwf/bill-payment/{$id}/confirm";
        $url = self::url() . $path;
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encoded_auth}"
            ])
            ->put($url);

        $result = json_decode($response);

        return $response->successful() ? $result : null;
    }

    public static function getAllPayments($credential)
    {
        $path = "pwf/payment";
        $url = self::url() . $path;
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encoded_auth}"
            ])
            ->get($url);

        $result = json_decode($response);

        return $response->successful() ? $result : null;
    }

    public static function getPayment($credential, $id)
    {
        $path = "pwf/{$id}/payment";
        $url = self::url() . $path;
        $encodeAuth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encodeAuth}"
            ])
            ->get($url);

        $result = json_decode($response);
        return $response->successful() ? $result : null;
    }
}
