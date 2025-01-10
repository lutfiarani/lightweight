<?php

namespace App\Http\Controllers;

use App\Models\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
    public function detail($id){
        $product = DB::table('master_data')
                    ->where('article', $id)->first();

        $types = [
            'as' => 'assembly',
            'up' => 'upper',
            'sf' => 'stock_fit',
            'os' => 'outsole',
            'ms' => 'midsole',
            'sockliner' => 'sockliner'
        ];

        $weightStats = [];
        foreach ($types as $key => $value) {
            $stats = DB::table('log_weight')
                        ->selectRaw('
                            AVG(weight) as average,
                            MIN(weight) as minimum,
                            MAX(weight) as maximum
                        ')
                        ->where('article', $id)
                        ->where('use_data', 'Y')
                        ->where('type', $key)
                        ->first();
            
            $weightStats[$value] = [
                'average' => $stats->average,
                'minimum' => $stats->minimum,
                'maximum' => $stats->maximum
            ];
        }

        $weightData = DB::table('master_data')
                        ->where('article', $id) 
                        ->get()
                        ->groupBy('stage')
                        ->map(function($stageData) use ($weightStats) {
                            return [
                                'brand_target'=> [
                                    'previous' => $stageData->first()->target,
                                    'confirm' => $stageData->first()->target,
                                    'average' => null,
                                    'min' => null,
                                    'max' => null,
                                ],
                                'assembly' => [
                                    'previous' => $stageData->first()->AS,
                                    'confirm' => $stageData->first()->AS,
                                    'average' => $weightStats['assembly']['average'],
                                    'min' => $weightStats['assembly']['minimum'],
                                    'max' => $weightStats['assembly']['maximum']
                                ], 
                                'upper' => [
                                    'previous' => $stageData->first()->UP,
                                    'confirm' => $stageData->first()->UP,
                                    'average' => $weightStats['upper']['average'],
                                    'min' => $weightStats['upper']['minimum'],
                                    'max' => $weightStats['upper']['maximum']
                                ],
                                'stockfit' => [
                                    'previous' => $stageData->first()->SF,
                                    'confirm' => $stageData->first()->SF,
                                    'average' => $weightStats['stock_fit']['average'],
                                    'min' => $weightStats['stock_fit']['minimum'],
                                    'max' => $weightStats['stock_fit']['maximum']
                                ],
                                'outsole' => [
                                    'previous' => $stageData->first()->OS,
                                    'confirm' => $stageData->first()->OS,
                                    'average' => $weightStats['outsole']['average'],
                                    'min' => $weightStats['outsole']['minimum'],
                                    'max' => $weightStats['outsole']['maximum']
                                ], 
                                'sockliner' => [
                                    'previous' => $stageData->first()->sockliner,
                                    'confirm' => $stageData->first()->sockliner,
                                    'average' => $weightStats['sockliner']['average'],
                                    'min' => $weightStats['sockliner']['minimum'],
                                    'max' => $weightStats['sockliner']['maximum']
                                ],
                                'midsole' => [
                                    'previous' => $stageData->first()->MS,
                                    'confirm' => $stageData->first()->MS,
                                    'average' => $weightStats['midsole']['average'],
                                    'min' => $weightStats['midsole']['minimum'],
                                    'max' => $weightStats['midsole']['maximum']
                                ]
                                ];
                        })->toArray();
        
        $availableStages = DB::table('master_data')
                            ->where('article', $id)
                            ->pluck('stage')
                            ->toArray();

        $imagenya   = MasterModel::get_image($id);

        return view('admin.view_detail_v01', compact('product', 'weightData', 'availableStages', 'imagenya'));
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
