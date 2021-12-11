<?php

namespace App\Http\Controllers\API;

use App\Models\Meet;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(meet::where('subject_id', $request->subject_id)->paginate());
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
            'title' => 'required',
            'subject_id' => 'required',
            'is_can_comment' => 'required',
            'is_submitted_attendance' => 'required',

        ]);

        $data = Meet::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        $meet->load(['subject']);

        return response()->json([
            'data' => $meet
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meet $meet)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'is_can_comment' => 'required',
            'is_submitted_attendance' => 'required',

        ]);

        $meet->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $meet
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        $meet->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
