<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Cookie;

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
            return view('event.dashboard');
        } else {
            return view("auth.login", ['failed' => true]);
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

        return view('event.dashboard',);



    }
}
