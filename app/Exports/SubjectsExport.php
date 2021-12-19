<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubjectsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subject::with('lecture', 'campus')->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->campus->name,
            $row->generation,
            $row->semester,
            $row->sks,
            $row->day,
            $row->start_at,
            $row->end_at,
            $row->lecture->name
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Kode Matakuliah',
            'MataKuliah',
            'Kampus',
            'Tahun Ajaran',
            'Semester',
            'SKS',
            'Hari',
            'Jam Mulai',
            'Jam Berakhir',
            'Dosen'
        ];
    }
}
