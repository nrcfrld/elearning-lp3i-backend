<?php

namespace App\Http\Controllers\API;

use App\Models\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Help::where('is_faq', $request->is_faq)->paginate());
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
            'content' => 'required'

        ]);

        $data = Help::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(Help $help)
    {
        $help->load('helpcategory');

        return response()->json([
            'data' => $help
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Help $help)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $help->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $help
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(Help $help)
    {
        $help->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
