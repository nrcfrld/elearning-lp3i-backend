<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            User::with('roles')->orderBy('created_at', 'desc')->paginate()
            ,200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'identity_number' => 'required|unique:users,identity_number',
                'role_id' => 'required',
                'phone_number' => 'required|min:11|max:15|unique:users,phone_number'
            ]);

            if($request->role_id == 3){
                $request->validate([
                    'classroom_id' => 'required'
                ]);
            }

            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('lp3ipsm'),
                'identity_number' => $request->identity_number,
                'birthplace' => $request->birthplace,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
                'avatar' => $request->avatar,
                'classroom_id' => $request->classroom_id
            ]);

            $data->assignRole($request->role_id);

            DB::commit();
            return response()->json([
                'message' => 'Tambah Data Berhasil',
                'data' => $data
            ], 201);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => 'Tambah Data Gagal',
                'data' => $e
            ], 500);
        }
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

    public function import(Request $request){
        Excel::import(new UsersImport, $request->file('file'));

        return response()->json([
            'message' => 'Berhasil Import Data'
        ], 200);
    }
}
