<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PercentageWeightModel;

class PercentageController extends Controller
{
    public function index(){
        $weightloss = PercentageWeightModel::all();
        return view('admin.percentage', compact('weightloss'));
    }

    public function update(Request $request, $id){
        $weightloss = PercentageWeightModel::find($id);


        $weightloss->perc_value = $request->value;
        $weightloss->save();

        return response()->json([
            'success' => true,
            'updated_at' => $weightloss->updated_at->timezone('Asia/Phnom_Penh')->toDateTimeString()
            ]);
    }
}
