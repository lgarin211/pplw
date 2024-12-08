<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
      public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        // dd($request->all());
        $username = $request->username;
        $password = $request->password;

        $request->validate([
            'username' => "required",
            'password' => "required",
        ]);

        $cekuser = User::select("id","name","password","level")->where("username", $username)->first();

        if (empty($cekuser)) {
            return redirect("/");
        } else {

             if (Hash::check($password, $cekuser->password)) {

                $request->session()->put("id", $cekuser->id);
                $request->session()->put("name", $cekuser->name);
                $request->session()->put("username", $username);
                $request->session()->put("tahun", date('Y'));
                $request->session()->put("level", $cekuser->level);
                // dd($cekuser);

                if ($cekuser->level == 'admin') {
                    return redirect('index');
                }elseif ($cekuser->level == 'admin2') {
                    return redirect('simptl/pkpt');
                }
            } else {
                return redirect('/');
            }


        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['id', 'name', 'username', 'level']);
        $request->session()->flush();

        return redirect('/');
    }

    public function ubahtahun(Request $request)
    {
    $request->session()->put("tahun", $request->input('tahun'));

    return redirect('index');

    }
}
