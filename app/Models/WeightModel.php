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


    public static function get_data_model_name($model_name){
        $data = collect(DB::select("
            select top 1 * from master_data where model_name = '$model_name' and sf <> 0 and os <> 0 and ms <> 0  order by created_at asc
        "))->first();
        return $data;
    }


    public static function get_data($lotid){
        $data = DB::selectResultSets("
            EXEC GET_DATA @LOTID = '$lotid'
        ");
        return $data;
    }

    public static function view_data_result($lotid){
        $data = DB::select("
            EXEC VIEW_PRODUCTION_RESULT_V2 @LOTID = '$lotid'
        ");
        return $data;
    }



    public static function view_data_result_outsole($model_name){
        $data = DB::select("
            EXEC VIEW_PRODUCTION_RESULT_OUTSOLE @MODEL_NAME = '$model_name'
        ");
        return $data;
    }


    public static function search_po($po_no){
        $data = collect(DB::select("
            SELECT PO_NO FROM [10.10.100.20].[MEShs].[dbo].[THPRODHISPO] with(nolock) WHERE PO_NO like '%$po_no' 
        "));
        return $data;
    }


    public static function search_model_name($model_name){
        $data = collect(DB::select("
            SELECT model_name FROM MASTER_DATA WHERE MODEL_NAME like '%$model_name%'  group by model_name
        "));
        return $data;
    }


    public static function delete_data_log($id_log, $user, $current_date){
        $delete = DB::statement("
            UPDATE LOG_WEIGHT SET use_data = 'N', deleted_at = '$current_date', deleted_by = '$user' WHERE id_log = '$id_log'
        ");
        return $delete;
    }


    public static function cek_balance($po_no, $name, $size){
        $data = collect(DB::select("
            EXEC CEK_BALANCE_PO @PO_NO = '$po_no', @TYPE = '$name', @SIZE = '$size'
        "));
        return $data;
    }


}
