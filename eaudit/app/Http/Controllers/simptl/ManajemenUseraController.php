<?php

namespace App\Http\Controllers\simptl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenUseraController extends Controller
{
    //
    public function index()
    {
        return view('simptl.index');
    }
    public function pengguna()
    {
        return view('simptl.pengguna');
    }
    public function penggunacreate()
    {
        return view('simptl.pengguna_create');
    }
    public function penggunaedit()
    {
        return view('simptl.pengguna_edit');
    }
    public function penggunaHapus()
    {
        return view('simptl.pengguna_create');
    }
}
