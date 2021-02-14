<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function sendMail(Request $request) {
        $data = $request -> validate([
            'text' => 'required|min:5' //a cosa corrisponde questo 'text'?
        ]);
        // dd($data);
        Mail::to(Auth::user() -> email) //associo utente a email
        -> send(new TestMail($data['text']));
        return redirect() ->back(); //ritorna sulla pagina su cui lavoravo
        // dd($request -> all());
    }

    public function sendEmptyMail() {
        Mail::to(Auth::user() -> email) //associo utente a email
        -> send(new TestMail());
        return redirect() ->back();
    }

    public function updateUserIcon(Request $request) {
        // $data = $request -> validate([
        //     'icon' => 'required|file' 
        // ]);
        // $image = $request -> file('icon');
        dd($data, $image);
    }
}
