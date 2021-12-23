<?php

namespace App\Http\Controllers\API;

use App\Models\Attendance;
use App\Models\Meet;
use Error;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Meet::where('subject_id', $request->subject_id)->paginate(14));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $request->validate([
                'title' => 'required',
                'subject_id' => 'required',
                'is_can_comment' => 'required',
                'is_submitted_attendance' => 'required',
            ]);

            $meet = Meet::create($request->all());
            foreach($meet->subject->participants as $participant){
                Attendance::create([
                    'meet_id' => $meet->id,
                    'status' => 'tidak hadir',
                    'user_id' => $participant->id
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Tambah data berhasil',
                'data' => $meet
            ], 201);
        }catch(Error $error){
            DB::rollBack();
            return response()->json([
                'message' => 'Tambah data berhasil',
                'data' => $error
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        $meet->load(['subject.lecture']);

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

        $meet->update([
            'title' => $request->title,
            'is_can_comment' => $request->is_can_comment,
            'is_submitted_attendance' => $request->is_submitted_attendance
        ]);

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
