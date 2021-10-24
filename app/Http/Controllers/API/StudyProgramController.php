<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(StudyProgram::paginate());
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
        ]);

        $data = StudyProgram::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StudyProgram $studyprogram)
    {
        return $studyprogram;
        return response()->json([
            'data' => $studyprogram
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studyprogram $studyprogram)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $studyprogram->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $studyprogram
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyProgram $studyprogram)
    {
        $studyprogram->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
