<?php

namespace App\Http\Controllers\API;

use App\Models\HelpCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(HelpCategory::paginate());
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
            'name' => 'required'
        ]);

        $data = HelpCategory::create($request->all());

        return response()->json([
            'message' => 'Tambah data berhasil',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HelpCategory  $helpCategory
     * @return \Illuminate\Http\Response
     */
    public function show(HelpCategory $helpCategory)
    {
        return response()->json([
            'data' => $helpCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HelpCategory  $helpCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpCategory $helpCategory)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $helpCategory->update($request->all());

        return response()->json([
            'message' => 'Ubah data berhasil',
            'data' => $helpCategory
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HelpCategory  $helpCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpCategory $helpCategory)
    {
        $helpCategory->delete();

        return response()->json([
            'message' => 'Hapus data Berhasil'
        ], 200);
    }
}
