<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WeightModel extends Model
{
    //
    public static function get_data_po($lotid){
        $data = DB::selectResultSets("
            EXEC GET_PO_INFORMATION_V2 @LOTID = '$lotid'
        ");
        return $data;
    }

    public static function view_data_result($lotid){
        $data = DB::select("
            EXEC VIEW_PRODUCTION_RESULT_V2 @LOTID = '$lotid'
        ");
        return $data;
    }


    public static function search_po($po_no){
        $data = collect(DB::select("
            SELECT PO_NO FROM [10.10.100.20].[MEShs].[dbo].[THPRODHISPO] with(nolock) WHERE PO_NO like '%$po_no' 
        "));
        return $data;
    }


    public static function delete_data_log($id_log, $user, $current_date){
        $delete = DB::statement("
            UPDATE LOG_WEIGHT SET use_data = 'N', deleted_at = '$current_date', deleted_by = '$user' WHERE id_log = '$id_log'
        ");
        return $delete;
    }


}
