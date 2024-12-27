<?php

namespace App\Http\Controllers;

use App\Models\WeightModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WeightController extends Controller
{
    // fungsi untuk menampilkan form input data timbangan
    function input_weight(){
        
    }

    // fungsi untuk input data timbangan dari produksi
    function input_data_production(){
        $judul = 'Production';
        $subJudul = 'Input Data';
        $auth = Auth::user()->id;

        $data = array(
            'judul'         => $judul,
            'subJudul'      => $subJudul,
        );

        return view('prod.input_data', $data);
    }

    function get_data_po($po_no){
        $data = WeightModel::get_data_po($po_no);

        return response()->json(array(
            'po_information'            => $data[0], 
            'midas_information'         => $data[1],
            'size_information'          => $data[2],
        ));
    }


    function get_data_log(Request $request){
        if ($request->ajax()) {
            $user = Auth::user()->fullname;

            $data = DB::select("
                select top 10 *, convert(varchar(20), time, 120) as timetime from log_weight where fullname = '$user' and use_data = 'Y' order by created_at desc
            ");

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }


    function saving_data(Request $request){
        $po_no          = $request->input('po_no');
        $model_name     = $request->input('model_name');
        $article        = $request->input('article');
        $po_qty         = $request->input('po_qty');
        $destination    = $request->input('destination');
        $crd            = $request->input('crd');
        $season         = $request->input('season');
        $size           = $request->input('size');
        $size_qty       = $request->input('size_qty');
        $target_qty     = $request->input('target_qty');
        $weight         = $request->input('weight');
        $type           = Auth::user()->name;
        $time           = date('Y-m-d H:i:s');
        $fullname       = Auth::user()->fullname;
        $use_data       = 'Y';

        $save_data = DB::table('log_weight')->insert([
            'po_no'     => $po_no, 
            'season'    => $season, 
            'article'   => $article, 
            'model_name'=> $model_name, 
            'po_qty'    => $po_qty, 
            'destination' => $destination, 
            'crd'       => $crd, 
            'size'      => $size, 
            'size_qty'  => $size_qty, 
            'target_qty'=> $target_qty, 
            'type'      => $type, 
            'weight'    => $weight, 
            'time'      => $time, 
            'fullname'  => $fullname, 
            'use_data'  => $use_data, 
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        if($save_data){
            $status = true;
            $message = 'Success to save data';
        }else{
            $status = false;
            $message = 'Failed to save data';
        }

        return response()->json(array(
            'status'    => $status,
            'message'   => $message
        ));

        
    }


}
