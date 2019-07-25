<?php

namespace App\Imports;

use App\bom;
use Maatwebsite\Excel\Concerns\ToModel;

class BomImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new bom([
            //
        ]);
    }
}
