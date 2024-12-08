<?php

namespace App\Http\Controllers\simptl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObrikController extends Controller
{
    //
    public function index()
    {
        return view('simptl.index');
    }
    public function datadukung()
    {
        return view('simptl.datadukung');
    }
    public function datadukungcreate()
    {
        return view('simptl.datadukung_create');
    }
    public function datadukungedit()
    {
        return view('simptl.datadukung_edit');
    }
    public function datadukungHapus()
    {
        return view('simptl.datadukung_create');
    }
}
