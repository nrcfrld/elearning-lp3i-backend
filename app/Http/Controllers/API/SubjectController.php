<?php

namespace App\Http\Controllers\API;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return response()->json(Subject::paginate());
        return response()->json(Subject::where('campus_id', $request->campus_id)->paginate());
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
            'generation' => 'required',
            'campus_id' => 'required',
            'semester' => 'required',
            'lecture_id' => 'required',
            'sks' => 'required',
            'day' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'

        ]);

        $data = Subject::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load('campus');

        return response()->json([
            'data' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'generation' => 'required',
            'campus_id' => 'required',
            'semester' => 'required',
            'lecture_id' => 'required',
            'sks' => 'required',
            'day' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'

        ]);

        $subject->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $subject
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
