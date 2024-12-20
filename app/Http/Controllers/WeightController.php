<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
