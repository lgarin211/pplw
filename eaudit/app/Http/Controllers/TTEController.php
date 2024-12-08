<?php

namespace App\Http\Controllers;

use App\Models\PDF;
use App\Models\TTE;
use App\Models\Penugasan;
use App\Models\suratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Stroage;
use Illuminate\Support\Facades\Response;

class TTEController extends Controller
{
    //
    public function index()
    {
       $ee = array();
       $tte = TTE::all();
       foreach ($tte as $key => $tiap_tte) {
        # code...
        $id_tte = $tiap_tte["id"];
        $tiap_tte->rowspan = PDF::where("id_tte",$id_tte)->where('created_at','like','%'.session('tahun').'%')->count();
        $tiap_tte->pdf     = PDF::where("id_tte",$id_tte)->where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->get();
        $ee[] = $tiap_tte;
       }
       return view('admin.tte')->with('Ts',$ee);
    }

    public function create()
    {
        return view('admin.tte_create');
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'nama' => 'required'
        ]);

        $tte = TTE::create($data);

        if ($request->has('pdf')) {
            # code...
            foreach ($request->file('pdf') as $name) {
                # code...
                 $filename = $name->getClientOriginalName();
                 $name->move(public_path('files'),$filename);
                 PDF::create([
                    'id_tte' => $tte->id,
                    'pdf'=>$filename
                 ]);
            }
        }

        return redirect('tte');

    }

    public function view($id){
        // $st = TTE::find($id);
        $data=PDF::find($id);
        // return view('admin.tte_viewPDF',compact('data'));

        return Response::make(file_get_contents('files/'.$data->pdf), 200, [
                        'content-type'=>'application/pdf',
                    ]);
        //or
        return response()->file(public_path('files/'.$data->pdf),['content-type'=>'application/pdf']);
    }

    public function download($id)
    {
        //PDF file is stored under project/public/download/info.pdf

          $data=PDF::find($id);
          $file=public_path('files/'.$data->pdf);
          return Response::download($file);

    }

    public function suratBaru($id)
    {
        $suratBaru = TTE::where('id',$id)->first();
        return view('admin.surat_baru',compact('suratBaru'));
    }

    public function suratStore(Request $request,$id)
    {

        if ($request->has('pdf')) {
            # code...
            foreach ($request->file('pdf') as $name) {
                # code...
                 $filename = $name->getClientOriginalName();
                 $name->move(public_path('files'),$filename);
                 PDF::create([
                    'id_tte' => $id,
                    'pdf'=>$filename
                 ]);
            }
        }


    }

    public function hapusSurat($id)
    {
        //PDF file is stored under project/public/download/info.pdf

          $data=PDF::find($id);
          File::delete(public_path('files/'.$data->pdf));
          $data->delete();


          return redirect('tte');
    }

    public function tte_trial()
    {



       $ee = array();
       $surat = suratTugas::all();
       $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->orderBy('Tanggalsurat','DESC')->paginate(5);
       foreach ($penugasan as $key => $tiap_penugasan) {
        # code...
        $id_penugasan = $tiap_penugasan["id"];
        $tiap_penugasan->rowspan = Penugasan::where("id",$id_penugasan)->where('created_at','like','%'.session('tahun').'%')->count();
        $tiap_penugasan->pdf     = Penugasan::where("id",$id_penugasan)->where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->get();
        $ee[] = $tiap_penugasan;
    }
       return view('admin.tte_trial')->with('Ts',$ee);;
    }
}
