<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightListModel;
use App\Exports\WeightListExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PercentageWeightModel;

class WeightListController extends Controller
{
    public function index(){
        $getPercentage = PercentageWeightModel::first();
        return view('admin.weight-list.weight_list', compact('getPercentage'));
    }

    public function getData(Request $request){
        
        $params = [
            'article' => $request->article ?? null,
            'start_date' => $request->start_date ?? null,
            'end_date' => $request->end_date ?? null,
            'factory' => $request->factory ?? null,
            'cell' => $request->cell ?? null,
            'po_no' => $request->po_no ?? null,
            'model' => $request->model ?? null,
        ];

        $data = DB::select('EXEC WEIGHT_LIST @article = ?, @start_date = ?, @end_date = ?, @factory = ?, @cell = ?, @po_no = ?, @model = ?', array_values($params));

        if($request->group_po){
            $data = collect($data)->groupBy('po_no');
        }

        return response()->json($data);
        // dd(['data'=>$data[0], 'base'=>$data[1]]);
    }

    public function listFactory(){
        $data = WeightListModel::list_factory();
        return response()->json($data);
    }

    public function listCell($id){
        $data = WeightListModel::list_cell($id);
        return response()->json($data);
    }

    public function listModel(){
        $data = WeightListModel::list_model();
        return response()->json($data);
    }

    public function listArticle($id){
        $data = WeightListModel::list_article($id);
        return response()->json($data);
    }

    public function export(Request $request){
        $filters = $request->only([
            'start_date',
            'end_date',
            'factory',
            'line',
            'po_no',
            'model',
            'article'
        ]);

        $filename = 'weight-list-'.now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(new WeightListExport($filters), $filename);
    }
}
