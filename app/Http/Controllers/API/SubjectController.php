<?php

namespace App\Http\Controllers\API;

use App\Exports\SubjectsExport;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subject = Subject::query();

        $subject->with(['lecture', 'campus', 'participants']);


        if(auth()->user()->hasRole('dosen')){
            $subject->where('lecture_id', auth()->user()->id);
        }

        if(auth()->user()->hasRole('mahasiswa')){
            $subject->whereHas('participants', function($q) {
                return $q->where('user_id', auth()->user()->id);
            });
        }

        if($request->lecture_id){
            $subject->where('lecture_id', $request->lecture_id);
        }

        if($request->campus_id){
            $subject->where('campus_id', $request->lecture_id);
        }

        return response()->json($subject->paginate());
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
        $subject->load(['campus', 'lecture']);

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

    public function export(){
        Excel::store(new SubjectsExport, 'public/Matakuliah.xlsx', 'local', null, [
            'visibility' => 'private'
        ]);

        return asset(Storage::url('Matakuliah.xlsx'));
    }
}
