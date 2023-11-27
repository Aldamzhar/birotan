<?php

namespace App\Imports;

use App\Models\Baskat;
use Maatwebsite\Excel\Concerns\ToModel;

class BaskatsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Baskat([
            'word' => $row[0]
        ]);
    }
}
