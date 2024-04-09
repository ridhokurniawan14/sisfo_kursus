<?php

namespace App\Exports;

use App\Models\AngketPesertaDidikBaru;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AngketPesertaDidikBaru::all();
    }
}
