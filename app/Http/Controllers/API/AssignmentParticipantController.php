<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignmentParticipant;

class AssignmentParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(AssignmentParticipant::where('assignment_id', $request->assignment_id)->paginate());
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
            'user_id' => 'required',
            'assignment_id' => 'required',
            'is_submitted' => 'required',
            'is_viewed' => 'required',

        ]);

        $data = AssignmentParticipant::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentParticipant  $assignmentParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentParticipant $assignmentParticipant)
    {
        $assignmentParticipant->load(['user', 'assignment']);

        return response()->json([
            'data' => $assignmentParticipant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignmentParticipant  $assignmentParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentParticipant $assignmentParticipant)
    {
        $request->validate([
            'user_id' => 'required',
            'assignment_id' => 'required',
            'is_submitted' => 'required',
            'is_viewed' => 'required',

        ]);

        $assignmentParticipant->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $assignmentParticipant
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentParticipant  $assignmentParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentParticipant $assignmentParticipant)
    {
        $assignmentParticipant->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
