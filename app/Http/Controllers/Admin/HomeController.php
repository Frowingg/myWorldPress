<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        //attravero il metodo user della classe auth mi prendo le credenziali dell'admin che ha fatto il login
        $user = auth::user();

        // mi torno la view home nella cartella admin e gli passo $user come $data
        return view('admin.home', compact('user'));
    }
}
