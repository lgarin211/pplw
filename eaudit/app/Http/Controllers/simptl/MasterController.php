<?php

namespace App\Http\Controllers\simptl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class masterController extends Controller
{
    //
    public function index()
    {
        return view('simptl.index');
    }
    public function jenisTemuan()
    {
        return view('simptl.jenisTemuan');
    }
    public function jenisTemuancreate()
    {
        return view('simptl.jenisTemuan_create');
    }
    public function jenisTemuanedit()
    {
        return view('simptl.jenisTemuan_edit');
    }
    public function jenisTemuanHapus()
    {
        return view('simptl.jenisTemuan_create');
    }
    public function rekomendasi()
    {
        return view('simptl.rekomendasi');
    }
    public function rekomendasicreate()
    {
        return view('simptl.rekomendasi_create');
    }
    public function rekomendasiedit()
    {
        return view('simptl.rekomendasi_edit');
    }
    public function rekomendasiHapus()
    {
        return view('simptl.rekomendasi_create');
    }
    public function obrik()
    {
        return view('simptl.obrik');
    }
    public function obrikcreate()
    {
        return view('simptl.obrik_create');
    }
    public function obrikedit()
    {
        return view('simptl.obrik_edit');
    }
    public function obrikHapus()
    {
        return view('simptl.obrik_create');
    }
}
