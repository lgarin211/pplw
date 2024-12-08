<?php

namespace App\Http\Controllers;

use App\Models\LHP;
use App\Models\MasterLHP;
use Illuminate\Http\Request;

class LHPController extends Controller
{
    //
     public function index()
    {
        // $MasterLHP = MasterLHP::with('surat')->where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->groupBy('nama')->get();
        // return view('admin.masterLHP',compact('MasterLHP'));

       $ee = array();
       $lhp = MasterLHP::all();
       foreach ($lhp as $key => $tiap_lhp) {
        # code...
        $id_lhp = $tiap_lhp["id"];
        $tiap_lhp->rowspan = LHP::where("id_lhp",$id_lhp)->where('created_at','like','%'.session('tahun').'%')->count();
        $tiap_lhp->lhp     = LHP::where("id_lhp",$id_lhp)->where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->get();
        $ee[] = $tiap_lhp;
       }
       return view('admin.masterLHP')->with('lh',$ee);
    }

    public function create()
    {
        return view('admin.masterLHP_create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required'
        ]);

        $tte = MasterLHP::create($data);

        if ($request->has('lhp')) {
            # code...
            foreach ($request->file('lhp') as $name) {
                # code...
                 $filename = $name->getClientOriginalName();
                 $name->move(public_path('LHP'),$filename);
                 LHP::create([
                    'id_lhp' => $tte->id,
                    'lhp'=>$filename
                 ]);
            }
        }

        return redirect('berkasLHP');
    }

     public function view($id){
        // $st = TTE::find($id);
        $surat = LHP::find($id);
        print_r($surat);
        return view('admin.lhp_viewPDF',compact('surat'));
    }

    public function download(Request $request,$pdf)
    {
        return response()->download(public_path('downloadTTE'.$pdf));
    }
}
