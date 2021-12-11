<?php

namespace App\Http\Controllers\API;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Attendance::where('meet_id', $request->meet_id)->paginate());
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
        $attendance->update([
            'is_read' => 1
        ]);

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
        $request->validate([
            'meet_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',

        ]);

        $attendance->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $attendance
        ], 201);
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
}
