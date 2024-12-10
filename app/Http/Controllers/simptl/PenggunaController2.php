<?php

namespace App\Http\Controllers\simptl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengawasan;

class PenggunaController2 extends Controller
{
    //
    public function index()
    {
        return view('simptl.index');
    }
    public function pengguna()
    {
        $data     = User::all();
        return view('simptl.pengguna',compact('data'));
    }
    public function penggunacreate()
    {
        return view('simptl.pengguna_create');
    }
    public function penggunastore(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->password);
        $user->level    ="obrik";
        $user->save();

        return redirect('user')->with('success','Data berhasil di simpan');
    }
    public function penggunaHapus()
    {
        return view('simptl.pengguna_create');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $username = $request->username;
        $password = $request->password;

        $cekuser = User::where("username", $username)->first();

        if (empty($cekuser)) {
            return redirect("/");
        } else {
            if (Hash::check($password, $cekuser->password)) {

                $request->session()->put("id", $cekuser->id);
                $request->session()->put("username", $cekuser->username);
                $request->session()->put("level", $cekuser->level);
                $request->session()->put("tahun", date('Y'));
                // dd($cekuser);

                if ($cekuser->level == 'admin2') {
                    return redirect('simptl/pkpt');
                } elseif ($cekuser->level == 'obrik') {
                    return redirect('simptl/user');
                }  else {
                return redirect('/');
            }
        }
    }
        // if (empty($cekuser)) {
        //     return redirect("/");
        // } else {
        //     // if (Hash::check($password, $cekuser->password)) {

        //     //     $request->session()->put("id", $cekuser->id);
        //     //     $request->session()->put("name", $cekuser->name);
        //     //     $request->session()->put("username ", $cekuser->username );
        //     //     $request->session()->put("tahun", date('Y'));
        //     //     // dd($cekuser);

        //     //     return redirect('index');



        //     // }

        //      if (Hash::check($password, $cekuser->password)) {

        //         $request->session()->put("id", $cekuser->id);
        //         // $request->session()->put("name", $cekuser->name);
        //         $request->session()->put("username", $cekuser->username);
        //         // $request->session()->put("tahun", date('Y'));
        //         $request->session()->put("level", $cekuser->level);
        //         // dd($cekuser);

        //         if ($cekuser->level == 'obrik') {
        //             return redirect('simptl/user');
        //         } elseif ($cekuser->level == 'admin2') {
        //             return redirect('simptl/admin');
        //         }
        //     } else {
        //         return redirect('/');
        //     }


        // }
    }

    public function admincreate()
    {
        return view('simptl.pengguna_create');
    }
    public function adminstore(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->password);
        $user->level ="admin2";
        $user->save();

        return redirect('user')->with('success','Data berhasil di simpan');
    }

    public function ubahtahun(Request $request)
    {
    $request->session()->put("tahun", $request->input('tahun'));

    return redirect('simptl/pkpt');

    }

        public function logout(Request $request)
        {
            $request->session()->forget(['id', 'name', 'username', 'level']);
            $request->session()->flush();

            return redirect('/simptl');
        }

}
