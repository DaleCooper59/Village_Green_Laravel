<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;

class CitiesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //csv src = https://sql.sh/736-base-donnees-villes-francaises
        $france = Country::where('name', 'France')->first();
        return new City([
            'id' => $row[0],
            'country_id' => $france->id,
            'name'     => $row[3],
            'postal_code'    => substr($row[8], 0, 6), 
        ]);
    }
}
