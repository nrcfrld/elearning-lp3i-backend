<?php

namespace App\Http\Controllers\API;


use App\Models\SubjectParticipant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(SubjectParticipant::where('user_id', auth()->user()->id)->paginate());
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
            'subject_id' => 'required',

        ]);

        $data = SubjectParticipant::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectParticipant  $subjectParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectParticipant $subjectParticipant)
    {


        $subjectParticipant->load(['user', 'subject']);

        return response()->json([
            'data' => $subjectParticipant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectParticipant  $subjectParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectParticipant $subjectParticipant)
    {
        $request->validate([
            'user_id' => 'required',
            'subject_id' => 'required',

        ]);

        $subjectParticipant->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $subjectParticipant
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectParticipant  $subjectParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectParticipant $subjectParticipant)
    {
        $subjectParticipant->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
