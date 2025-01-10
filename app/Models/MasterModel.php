<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    protected $table = 'master_temp';

    protected $fillable = [
        'development_center',
        'season',
        'model_name',
        'model_number',
        'article',
        'development_type',
        'weight_status',
        'stage',
        'target',
        'AS',
        'UP',
        'SF',
        'OS',
        'MS',
        'sockliner',
        'article_status',
        'sports_category',
        'business_segment',
        'gender',
        'age_group',
        'sample_size',
        'article_latest',
        'article_master'
    ];


    public static function syncData_master(){
        $query = DB::select("EXEC COMPARE_MASTER_DATA");
        return $query;
    }

    public static function get_all(){
        $query = DB::table('master_data')
                    ->where('development_center', '!=', '')
                    ->get();

        return $query;
    }

    public static function get_data($id){
        $query = DB::table('master_data')
                    ->where('article', $id)
                    ->first();
        return $query;
    }

  
    public static function get_lists()
    {
        // Eksekusi stored procedure dengan selectResultSets
        $results = DB::selectResultSets("EXEC selection_list");
        
        // Inisialisasi array untuk menyimpan semua list
        $lists = [];
        
        // Proses setiap result set
        foreach ($results as $resultSetIndex => $resultSet) {
            $options = '';
            
            // Loop through records dalam setiap result set
            foreach ($resultSet as $record) {
                // Convert object ke array untuk memudahkan akses property
                $data = (array)$record;
                
                // Asumsikan setiap record memiliki id dan name
                // Sesuaikan key berdasarkan nama kolom di stored procedure
                $options .= "<option value='{$data['name']}'>{$data['name']}</option>";
            }
            
            // Simpan options ke array dengan key sesuai urutan
            $lists["list_" . ($resultSetIndex + 1)] = $options;
        }
        
        return $lists;
    }
    
    // Method helper untuk mengakses list spesifik
    public static function get_list_by_index($index)
    {
        $lists = self::get_lists();
        return $lists["list_" . $index] ?? '';
    }

    public static function searchData($data){
        $query = DB::table('master_data');

        if(!empty($data['development_center'])){
            $query->where('development_center', $data['development_center']);
        }

        if(!empty($data['season'])){
            $query->where('season', $data['season']);
        }

        if(!empty($data['development_type'])){
            $query->where('development_type', $data['development_type']);
        }

        if(!empty($data['model_name'])){
            $query->where('model_name', $data['model_name']);
        }

        if(!empty($data['model_number'])){
            $query->where('model_number', $data['model_number']);
        }

        if(!empty($data['article_number'])){
            $query->where('article', $data['article_number']);
        }

        if(!empty($data['article_status'])){
            $query->where('article_status', $data['article_status']);
        }

        if(!empty($data['stage'])){
            $query->where('stage', $data['stage']);
        }

        $query->where('article', 'IH0798');
        return $query->get();
    }

    public static function get_image($id)
    {
        $query = DB::table('MCS.dbo.MCS_DATA')
                ->select('IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4')
                ->where('ARTICLE', $id)
                ->first();
        return $query;
    }
}