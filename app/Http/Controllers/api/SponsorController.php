<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::with('category')->get();
        // $sponsors = Sponsor::with('category')->paginate(1);

        return response()->json($sponsors);
    }

    public function currentSponsor(Request $request)
    {
        $sponsors = Sponsor::with('category')->where('id_user', $request->id)->first();
        return response()->json($sponsors);
    }

    public function indexCategory(Request $request)
    {
        $id_category = $request->id_category;

        $sponsors = Sponsor::with('category')->where('id_category', $id_category)->get();

        return response()->json($sponsors);
    }

    public function search(Request $request)
    {
        $str = $request->str;
        $data = Sponsor::with('category')->where('name', 'ilike', '%' . $str . '%')->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = [
    //         "name" => $request->name,
    //         "email" => $request->email,
    //         "description"=> $request->description,
    //         "address" => $request->address,
    //         "id_category" => $request->id_category,
    //         "max_submission_date" => $request->max_submission_date,
    //         "image"=> $reques            // 'name' => 'required|string|max:255',
    // 'email' => 'required|email:rfc,dns,regex:/(.+)@(.+)\.(.+)/i',
    // 'description' => 'required|string',
    // 'address' => 'required|string',
    // 'id_category' => 'required|exists:categories,id',
    // 'max_submission_date' => 'required|integer|min:0|max:90',
    // 'image' => 'required|string',
    // 'id_user' => 'required|exists:users,id't->image,
    //         "id_user" => $request->id_user
    //     ];

    //     try {
    //         $sponsor = Sponsor::create($data);
    //     } catch (QueryException $e) {
    //         return response()->json($e,400);
    //     }
    //     return response()->json($sponsor,201);
    // }


    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama sponsor harus diisi',
            'name.string' => 'Nama sponsor harus berupa teks',
            'name.max' => 'Nama sponsor maksimal 255 karakter',

            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',

            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa teks',

            'address.required' => 'Alamat harus diisi',
            'address.string' => 'Alamat harus berupa teks',

            'id_category.required' => 'Kategori harus dipilih',
            'id_category.exists' => 'Kategori yang dipilih tidak valid',

            'max_submission_date.required' => 'Batas waktu pengajuan harus diisi',
            'max_submission_date.integer' => 'Batas waktu pengajuan harus berupa angka',
            'max_submission_date.min' => 'Batas waktu pengajuan minimal 0 hari',
            'max_submission_date.max' => 'Batas waktu pengajuan maksimal 90 hari',

            'image.required' => 'Gambar harus diisi',
            'image.string' => 'Format gambar tidak valid',

            'id_user.required' => 'ID pengguna harus diisi',
            'id_user.exists' => 'ID pengguna tidak valid'
        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns,regex:/(.+)@(.+)\.(.+)/i',
            'description' => 'required|string',
            'address' => 'required|string',
            'id_category' => 'required|exists:categories,id',
            'max_submission_date' => 'required|integer|min:0|max:90',
            'image' => 'required|string',
            'id_user' => 'required|exists:users,id'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = User::findOrFail($request->id_user);

        if ($user->id_role !== 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => 'Kesalahan pada role user'
            ], 422);
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description,
            "address" => $request->address,
            "id_category" => $request->id_category,
            "max_submission_date" => $request->max_submission_date,
            "image" => $request->image,
            "id_user" => $request->id_user
        ];

        try {
            $sponsor = Sponsor::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Sponsor created successfully',
                'data' => $sponsor
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create sponsor',
                'data' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sponsor = Sponsor::with('category')->findOrFail($id);

        return response()->json($sponsor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
