<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dataInfaq = Infaq::get();
        return view("admin", compact("dataInfaq"));
    }
}
