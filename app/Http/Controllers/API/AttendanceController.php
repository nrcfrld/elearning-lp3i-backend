<?php

namespace App\Http\Controllers\API;

use App\Models\Attendance;
use App\Models\Meet;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpParser\Node\Expr\Throw_;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Attendance::with(['user'])->where('meet_id', $request->meet_id)->paginate());
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
            'meet_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        $data = Attendance::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $attendance->load('meet');
        $attendance->load('user');

        return response()->json([
            'data' => $attendance
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->all();

        if($request->has('document')){
            $data['document'] = $request->file('document')->store('/file');
        }
        $attendance->update($data);

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $attendance
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }

    public function submitAttendance(Request $request){
        try{
            $data = $request->all();
            $attendance = Attendance::where([
                ['meet_id', $request->meet_id],
                ['user_id', auth()->user()->id]
            ])->first();

            if(!$attendance || $attendance == null){
                throw new Exception('Data Attendance Tidak Ditemukan.');
            }

            if($request->has('document')){
                $data['document'] = $request->file('document')->store('/public/files');
            }

            $attendance->update($data);

            return response()->json([
                'message' => 'Berhasil absensi',
                'data' => $attendance
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'data' => $error
            ], 500);
        }
    }
}
