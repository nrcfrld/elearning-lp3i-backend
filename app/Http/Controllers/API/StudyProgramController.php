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
     * @param  StudyProgram  $studyprogram
     * @return \Illuminate\Http\Response
     */
    public function show(StudyProgram $study_program)
    {
        return response()->json([
            'data' => $study_program
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  StudyProgram  $studyprogram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudyProgram $study_program)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $study_program->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $study_program
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StudyProgram  $studyprogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyProgram $study_program)
    {
        $study_program->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
