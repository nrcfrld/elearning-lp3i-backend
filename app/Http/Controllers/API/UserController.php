<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::paginate(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'name' => 'required',
         'email' => 'required|email|unique:users,email',
         'identity_number' => 'required|unique:users,identity_number',
         'role' => 'required',
         'phone_number' => 'required|min:11|max:15|unique:users,phone_number'
        ]);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('lp3ipsm'),
            'identity_number' => $request->identity_number,
            'birthplace' => $request->birthplace,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'avatar' => $request->avatar,
            'major_id' => $request->major_id
        ]);

        return response()->json([
            'message' => 'Tambah Data Berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email",
            'identity_number' => "required",
            'role' => 'required',
            'phone_number' => "required|min:11|max:15"
           ]);

        $user->fill([
            'name' => $request->name,
            'birthplace' => $request->birthplace,
            'gender' => $request->gender,
            'role' => $request->role,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'avatar' => $request->avatar,
            'major_id' => $request->major_id
        ]);

        $user->save();

        return response()->json([
            'message' => 'Ubah data Berhasil',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
