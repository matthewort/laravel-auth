<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
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
        Mail::to(Auth::user() -> email) //associo utente a email, ma "user" ed "email" da dove li prendo? user appartiene all'auth user standard, email è il campo che c'è nelle migration
        -> send(new TestMail($data['text']));
        return redirect() ->back(); //ritorna sulla pagina su cui lavoravo
        // dd($request -> all());
        // dd(Auth::user());
    }

    public function sendEmptyMail() {
        Mail::to(Auth::user() -> email) //associo utente a email, email è il campo che è presente nella string della migration che andiamo a recuperare qui
        -> send(new TestMail());
        return redirect() ->back(); //cosa succederebbe se non mettessimo il back?
    }

    public function updateUserIcon(Request $request) {
        $data = $request -> validate([
            'icon' => 'required|file' 
        ]);

        $this -> deleteUserIcon(); //in questo modo cancello la prossima immagine che vado a salvare facendo in modo che l'icon si "aggiorni" invece di aggiungersi una sull'altra

        $image = $request -> file('icon'); //"file" a cosa si riferisce?
        $ext = $image -> getClientOriginalExtension(); //si riferisce all'estensione, ma è un linguaggio proprio di Laravel?
        $name = rand(100000, 999999) . '_' . time(); //time() è un dato temporale
        $destFile = $name . '.' . $ext;
        $file = $image -> storeAs('icon', $destFile, 'public'); //salvo il file

        $user = Auth::user();
        $user -> icon = $destFile;
        $user -> save(); //salvo il file nell'icon dello user nel db
        // dd($image, $ext, $name, $destFile);
        // dd($request -> all());
        return redirect() -> back();
    }

    public function clearUserIcon() {

        $this -> deleteUserIcon();

        $user = Auth::user();
        $user -> icon = null;
        $user -> save();

        return redirect() -> back();
    }

    private function deleteUserIcon() { 
        $user = Auth::user();

        try { //non capisco il try catch
        $fileName = $user -> icon;

        $file = storage_path('app/public/icon/' . $fileName);
        $res = File::delete($file);
        // dd($file, $res);
        } catch(\Exception $e) {} //vuol dire "entrami nel catch se si verifica un errore nel try", il backslash modo di dire di PHP per riferirsi a tutte le eccezioni
    }
}
