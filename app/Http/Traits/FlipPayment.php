<?php

namespace App\Http\Traits;

use App\Models\Infaq;
use Illuminate\Support\Facades\Http;

Trait FlipPayment
{

    /*method asFrom digunakan untuk membuat request ke flip dengan content type => x-url-form-encoded*/

    /*Mendapatkan URL dari API flip, bergantung pada APP_ENV, jika value nya local maka url yang digunakan adalah url sandbox dari flip, namun jika production maka gunakan url production dari flip*/
    private static function url($path)
    {
        $localUrl = "https://bigflip.id/big_sandbox_api/v2/";
        $productionUrl = "https://bigflip.id/api/v2/";

        $url = env("APP_ENV") == "local" ? $localUrl : $productionUrl;
        return $url . $path;
    }

    /*Berguna untuk meng-encode token api yang dimiliki yang nantinya akan digunakan untuk authorization api flip */
    private static function encodeAuth($token)
    {
        return base64_encode($token . ":");
    }

    /*digunakan untuk create payment / transaksi */
    public  static function postTransaction($credential = [], $data = null, $campaign = null)
    {
        $path = "pwf/bill";
        $url = self::url($path);
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

//        data yang akan dikirimkan ke api flip, semuanya bisa bersifat dinamis, tingal di sesuaikan saja
        $payloads = [
            "title" => "Infaq Digital",
            "amount" => $data->amount,
            "type" => "SINGLE",
            "expired_date" => "2022-12-30 15:50",
            "redirect_url" => "http://www.youtube.com",
            "step" => 3,
            "is_address_required" => 1,
            "is_phone_number_required" => 0,
            "sender_name" => $data->name,
            "sender_email" => $data->email,
//            "sender_phone_number" => $data->phone_number,
            "sender_address" => $data->address,
            "sender_bank" => $data->bank,
            "sender_bank_type" => $data->bank_type
        ];

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic $encoded_auth",
            ])
            ->post($url, $payloads);

        $result = json_decode($response);

        Infaq::create([
            "project" => $result->title,
            "nominal" => $result->amount,
            "status" => "pending",
            "time_limit" => $result->expired_date
        ]);

        return $response->successful() ? $result : null;
    }

    /*digunakan untuk mengkonfirmasi transaksi yang dibuat secara manual*/
    public static function confirmTransaction($credential, $id)
    {
        $path = "pwf/bill-payment/{$id}/confirm";
        $url = self::url($path);
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encoded_auth}"
            ])
            ->put($url);

        $result = json_decode($response);

        return $response->successful() ? $result : null;
    }

    /*untuk mendapatkan semua pembayaran yang pernah dibuat oleh donatur*/
    public static function getAllPayments($credential)
    {
        $path = "pwf/payment";
        $url = self::url($path);
        $encoded_auth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encoded_auth}"
            ])
            ->get($url);

        $result = json_decode($response);

        return $response->successful() ? $result : null;
    }

    /*untuk mendapatkan detail pembayaran sesuai dengan link_id yang diberikan oleh pihak flip*/
    public static function getTransactionDetail($credential, $id)
    {
        $path = "pwf/{$id}/payment";
        $url = self::url($path);
        $encodeAuth = self::encodeAuth($credential["apiKey"]);

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Basic {$encodeAuth}"
            ])
            ->get($url);

        $result = json_decode($response);
        return $response->successful() ? $result : null;
    }

    public static function paymentCallback($credential = [], Request $request)
    {
//        Belum diisi
    }
}
