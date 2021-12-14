<?php

namespace App\Http\Controllers\API;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Classroom::where('major_id', $request->major_id)->paginate());
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
            'code' => 'required',
            'major_id' => 'required'

        ]);

        $data = Classroom::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        $classroom->update([
            'is_read' => 1
        ]);

        $classroom->load('major');

        return response()->json([
            'data' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'major_id' => 'required'

        ]);

        $classroom->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $classroom
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
