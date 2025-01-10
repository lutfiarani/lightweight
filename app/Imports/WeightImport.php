<?php

namespace App\Imports;

use App\Models\WeightModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WeightImport implements ToModel, WithHeadingRow
{
    //menentukan baris dimulainya header
    public function startRow():int{
        return 3; //header dimulai dari baris ketiga
    }

    public function headingRow():int{
        return 3; //header dimulai dari baris ketiga
    }
    
    public function model(array $row)
    {
        return new WeightModel([
            'development_center' => $row['development_center'] ?? '',
            'season' => $row['season_m'] ?? '',
            'model_name' => $row['model_name_short_m'] ?? '',
            'model_number' => $row['model_number_m'] ?? '',
            'article' => $row['article_number_a'] ?? '',
            'development_type' => $row['development_type_a'] ?? '',
            'weight_status' => $row['weight_status'] ?? '',
            'stage' => $row['stage'] ?? '',
            'target' => $row['target'] ?? 0,
            'AS' => $row['as_g'] ?? 0,
            'UP' => $row['up_g'] ?? 0,
            'SF' => $row['sf_g'] ?? 0,
            'OS' => $row['os_g'] ?? 0,
            'MS' => $row['ms_g'] ?? 0,
            'sockliner' => $row['sockliner_g'] ?? 0,
            'article_status' => $row['article_status_a'] ?? '',
            'sports_category' => $row['sports_category_m'] ?? '',
            'business_segment' => $row['business_segment_m'] ?? '',
            'gender' => $row['gender_m'] ?? '',
            'age_group' => $row['age_group_m'] ?? '',
            'sample_size' => $row['sample_size_m'] ?? '',
            'article_latest' => $row['article_latest_key'] ?? '',
            'article_master' => $row['article_maseter_no'] ?? '',
        ]);
    }
}