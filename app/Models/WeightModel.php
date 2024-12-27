<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WeightModel extends Model
{
    //
    public static function get_data_po($po_no){
        $data = DB::selectResultSets("
            EXEC GET_PO_INFORMATION @PO = '$po_no'
        ");
        return $data;
    }


}
