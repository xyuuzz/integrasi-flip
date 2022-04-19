<?php

namespace App\Http\Controllers;

use App\Http\Traits\FlipPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    use FlipPayment;

    public function index()
    {
        return view("user");
    }

    public function history()
    {
//        $data = Infaq
        return view("history");
    }

    public function createPayment(Request $request)
    {
        $credential = [
            "apiKey" => "JDJ5JDEzJHVVWWhRR1dRMjFtMERuNG5WLnJ2V3VvR1dMRG42VGhYS3IyMTNXMU93YkoudlpmOEU1VzBl"
        ];

        $payment = FlipPayment::postTransaction($credential, $request);
        if($payment)
        {
            session()->flash("payment", $payment);
            return redirect("/");
        }

        session()->flash("failed", "Terjadi error pada saat pembayaran!");
        return redirect("/");
    }

    public function confirmPayment($id)
    {
        $credential = [
            "apiKey" => "JDJ5JDEzJHVVWWhRR1dRMjFtMERuNG5WLnJ2V3VvR1dMRG42VGhYS3IyMTNXMU93YkoudlpmOEU1VzBl"
        ];

        FlipPayment::confirmTransaction($credential, $id);
    }

    public function getPayment($id)
    {
        $credential = [
            "apiKey" => "JDJ5JDEzJHVVWWhRR1dRMjFtMERuNG5WLnJ2V3VvR1dMRG42VGhYS3IyMTNXMU93YkoudlpmOEU1VzBl"
        ];

        FlipPayment::getPayment($credential, $id);
    }

    public function getAllPayments()
    {
        $credential = [
            "apiKey" => "JDJ5JDEzJHVVWWhRR1dRMjFtMERuNG5WLnJ2V3VvR1dMRG42VGhYS3IyMTNXMU93YkoudlpmOEU1VzBl"
        ];

        FlipPayment::getAllPayments($credential);
    }
}
