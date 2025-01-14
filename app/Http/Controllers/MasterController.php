<?php

namespace App\Http\Controllers;

use App\Models\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    function input_weight(){
        
    }

    function index(){
        $products = MasterModel::get_all();
        return view('admin.view_master_data', compact('products'));
    }

    function upload_data(){
        $products = MasterModel::get_all();
        return view('admin.upload_data', compact('products'));
    }

    public function import(Request $request){
        $request->validate([
            'file'=> 'required|mimes:xlsx, xls'
        ]);

        try{
            Excel::import(new WeightImport, $request->file('file'));
            MasterModel::syncData_master();
            return redirect()->back()->with('success', 'Data Berhasil Di Import');
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Import Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    private function generateOptions($resultSet)
    {
        $options = '';
        $options .="<option value=''>Choose option..</option>";

        foreach ($resultSet as $record) {
            $data = (array)$record;
            $options .= "<option value='{$data['NAME']}'>{$data['NAME']}</option>";
        }
        return $options;
    }
    public function list_search()
    {
        try {
            $results = DB::selectResultSets("EXEC selection_list");
            
            // Mapping hasil query ke array yang sesuai
            $response = [
                'dc' => $this->generateOptions($results[0]),
                'season' => $this->generateOptions($results[1]),
                'model_name' => $this->generateOptions($results[2]),
                'model_number' => $this->generateOptions($results[3]),
                'article' => $this->generateOptions($results[4]),
                'development_type' => $this->generateOptions($results[5]),
                'article_status' => $this->generateOptions($results[6]),
                'stage' => $this->generateOptions($results[7])
            ];

            return response()->json([
                'status' => 'success',
                'data' => $response
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function search(Request $request){
        $data = [
            'development_center' => $request->input('development_center'),
            'season' => $request->input('season'),
            'development_type'=> $request->input('development_type'),
            'model_name' => $request->input('model_name'),
            'model_number' => $request->input('model_number'),
            'article_number' => $request->input('article_number'),
            'article_status' => $request->input('article_status'),
            'stage' => $request->input('stage'),
        ];

        try{
            $results = MasterModel::searchData($data);
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $results
                ]
            );
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // public function show($article){
    //     $prod
    // }
}
