<?php

namespace App\Imports;

use App\materia_import;
use Maatwebsite\Excel\Concerns\ToModel;

class MaterialPriceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new materia_import([
            //
        ]);
    }
}
