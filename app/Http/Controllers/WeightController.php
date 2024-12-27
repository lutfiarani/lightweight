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
                select top 15 * from log_weight where fullname = '$user' and use_data = 'Y' order by created_at desc
            ");

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" class="delete btn btn-primary btn-sm"><i class="fa-solid fa-trash-can-xmark"></i></a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }


}
