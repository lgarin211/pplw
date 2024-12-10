<?php

namespace App\Http\Controllers;

use App\Models\SKPerbub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SKController extends Controller
{
    //
    public function index()
    {
        $sk = SKPerbub::all();
        return view('admin.sk',compact('sk'));
    }
    public function create()
    {
        return view('admin.sk_create');
    }
    public function Store(Request $request)
{

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $file->move(public_path('SK'),$fileName);

    SKPerbub::create([
        'original_name' => $file->getClientOriginalName(),
        'generated_name' => $fileName
    ]);

    return redirect('SK_Perbub');
}


    public function view($id){
        // $st = TTE::find($id);
        $data=SKPerbub::find($id);
        // return view('admin.tte_viewPDF',compact('data'));

        return Response::make(file_get_contents('SK/'.$data->original_name), 200, [
                        'content-type'=>'application/pdf',
                    ]);
        //or
        return response()->file(public_path('SK/'.$data->original_name),['content-type'=>'application/pdf']);
    }
}
