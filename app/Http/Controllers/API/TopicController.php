<?php

namespace App\Http\Controllers\API;

use App\Models\Topic;
use Database\Seeders\TopicSeeder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Topic::where('meet_id', $request->meet_id)->paginate());
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
            'content' => 'required',
            'type' => 'required',
            'meet_id' => 'required',
            'descriptions' => 'required'

        ]);

        $data = Topic::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $topic->update([
            'is_read' => 1
        ]);

        $topic->load('meet');

        return response()->json([
            'data' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'type' => 'required',
            'meet_id' => 'required',
            'descriptions' => 'required'

        ]);

        $topic->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $topic
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
