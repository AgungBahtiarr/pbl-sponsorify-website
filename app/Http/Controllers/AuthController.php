<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function indexRegister()
    {

        $response = Http::get("http://localhost:8080/api/roles");
        return view('auth.register', [
            'data' => json_decode($response),
        ]);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        try {
            $response = Http::post("http://localhost:8080/api/login", $data);
        } catch (Exception $e) {
            echo $e;
        }

        if ($response->getStatusCode() == 200) {
            $token = $response["token"];
            Cookie::queue(Cookie::make('token', $token));

            $res = json_decode($response);
            Cookie::queue(Cookie::make('authUser', $res->user->id));
            Cookie::queue(Cookie::make('roleUser', $res->user->id_role));

            if ($res->user->id_role == 1) {
                return redirect('/event/dashboard');
            }elseif ($res->user->id_role == 2) {
                return redirect('/auth/sponsor');
            }elseif ($res->user->id_role == 3) {
                return redirect('/admin/dashboard');
            }
        } else {
            return redirect('/auth/login')->with('error','Email atau password salah, silahkan login kembali');
        }
    }


    public function storeRegister(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $id_role = $request->id_role;
        $password = $request->password;

        $parameter = [
            'name' => $name,
            'email' => $email,
            'id_role' => $id_role,
            'password' => $password,
        ];

        $response = Http::post("http://localhost:8080/api/register", $parameter);

        $res = json_decode($response);

        if ($res->success == false) {
            if ($res->data->email) {
                return redirect('/auth/register')->with('warning', 'Email telah terdaftar');
            }
        }

        return redirect('/auth/login');
    }

    public function logout(Request $request){
        $token = Cookie::get('token');

        $response = Http::withToken($token)->delete('http://localhost:8080/api/logout');

        Cookie::queue(Cookie::make('token', null));

        return redirect('/auth/login');
    }
}
