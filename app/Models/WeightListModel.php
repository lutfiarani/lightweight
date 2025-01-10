<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class WeightListModel extends Model
{
    protected $table = 'log_weight';

    public static function list_factory(){
        $option = '';
        $query = DB::connection('sqlsrv20')
                    ->table('TMCELL')
                    ->select('FACTORY2')
                    ->groupBy('FACTORY2')
                    ->get();
                  
                    
        $option .= "<option value=''>All Factory...</option>";

        foreach($query as $p){
            $option .= "<option value='$p->FACTORY2'>Factory $p->FACTORY2 </option>";
        }

        return $option;
    }

    public static function list_cell($id){
        $cell = '';
        $query = DB::connection('sqlsrv20')
                ->table('TMCELL')
                ->select('CELL_CODE');

        if  (!empty($id) && strtolower($id) !== 'null')   {
            $query->where('FACTORY2', $id);
        }

        $cells = $query->orderBy('CELL_CODE')->get();
        // dd($cells);
        $cell .= "<option value=''>All Cell...</option>";

        foreach($cells as $c){
            $cell .= "<option value='$c->CELL_CODE'> Cell $c->CELL_CODE</option>";
        }

        return $cell;
    }

    public static function list_model(){
        $option = '';
        $query = DB::table('master_data')
                ->select('model_name')
                ->whereNot('model_name', '')
                ->groupBy('model_name')
                ->get();
        $option .= "<option value=''> All Model...</option>";

        foreach($query as $m){
            $option .= "<option value='$m->model_name'> $m->model_name</option";
        }

        return $option;
    }

    public static function list_article($id){
        $option = '';
        $query = DB::table('master_data')
                ->select('article')
                ->whereNot('article', '')
                ->groupBy('article');

        if  (!empty($id) && strtolower($id) !== 'null')   {
            $query->where('model_name', $id);
        }

        $art = $query->orderBy('article')->get();
        // dd($cells);
        $option .= "<option value=''>All Article...</option>";

        foreach($art as $c){
            $option .= "<option value='$c->article'>$c->article</option>";
        }

        return $option;
    }
}
