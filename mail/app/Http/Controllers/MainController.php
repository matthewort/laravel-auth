<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function sendMail(Request $request) {
        dd($request -> all());
    }
}
