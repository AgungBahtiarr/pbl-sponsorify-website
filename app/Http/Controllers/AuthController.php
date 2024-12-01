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
        return view("auth.login");
    }

    public function indexRegister()
    {
        $response = Http::get(env("API_URL") . "/api/roles");
        return view("auth.register", [
            "data" => json_decode($response),
        ]);
    }

    public function login(Request $request)
    {
        $data = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        try {
            $response = Http::post(env("API_URL") . "/api/login", $data);
        } catch (Exception $e) {
            echo $e;
        }
        // return $response;
        if ($response->getStatusCode() == 200) {
            $token = $response["token"];
            Cookie::queue(Cookie::make("token", $token));

            $res = json_decode($response);
            Cookie::queue(Cookie::make("authUser", $res->user->id));
            Cookie::queue(Cookie::make("roleUser", $res->user->id_role));

            if ($res->user->id_role == 1) {
                return redirect("/event/dashboard");
            } elseif ($res->user->id_role == 2) {
                return redirect("/auth/sponsor");
            } elseif ($res->user->id_role == 3) {
                return redirect("/admin/payment");
            }
        } else {
            $errMessage = "";
            $res = json_decode($response);
            foreach ($res->data as $e) {
                $errMessage = $errMessage . $e[0] . " ";
            }

            return redirect("/auth/login")->withErrors([
                "message" => $errMessage,
            ]);
        }
    }

    public function storeRegister(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $id_role = $request->id_role;
        $password = $request->password;

        $parameter = [
            "name" => $name,
            "email" => $email,
            "id_role" => $id_role,
            "password" => $password,
        ];

        $response = Http::post(env("API_URL") . "/api/register", $parameter);

        $res = json_decode($response);

        if ($res->success == false) {
            $errMessage = "";

            foreach ($res->data as $e) {
                $errMessage = $errMessage . $e[0] . " ";
            }

            return redirect("/auth/register")->withErrors([
                "message" => $errMessage,
            ]);
        }

        return redirect("/auth/login");
    }

    public function logout(Request $request)
    {
        $token = Cookie::get("token");

        $response = Http::withToken($token)->delete(
            env("API_URL") . "/api/logout"
        );

        Cookie::queue(Cookie::make("token", null));

        return redirect("/auth/login");
    }
}
