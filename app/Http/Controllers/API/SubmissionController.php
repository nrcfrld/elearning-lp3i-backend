<?php

namespace App\Http\Controllers\API;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Submission::paginate());
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
            'assignment_id' => 'required',
            'name' => 'required',
            'content' => 'required',
            'file_url' => 'required',
            'created_by' => 'required'

        ]);

        $data = Submission::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        return response()->json([
            'data' => $submission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'assignment_id' => 'required',
            'name' => 'required',
            'content' => 'required',
            'file_url' => 'required',
            'created_by' => 'required'

        ]);

        $submission->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $submission
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
