<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use App\Models\MasterModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProductWeightModel;
use Illuminate\Support\Facades\DB;

class ProductWeightController extends Controller
{
   
    
    public function detail($id){
        $product = DB::table('master_data')
                    ->where('article', $id)->first();

        $weightData         = $this->getWeightData($id); // You'll need to implement this method based on your data structure
        $availableStages    = $this->getAvailableStages($id); // Implement this method
        $countLeftRight     = $this->getLeftRight($id);
        $listLeftRight      = $this->getDataList($id);
        $imagenya           = $this->getProductImages($id); // Implement this method
        $images = [];
        foreach(['IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4'] as $view) {
            $images[$view] = $this->getImageBase64($imagenya->$view ?? null);
        }
        

        return view('admin.product-weight.detail', compact('product', 'weightData', 'availableStages', 'imagenya', 'countLeftRight', 'listLeftRight'));
    }

    public function exportPDF($id)
    {
        // Get the product and related data
        $product = DB::table('master_data')
                    ->where('article', $id)->first();

        $weightData         = $this->getWeightData($id); // You'll need to implement this method based on your data structure
        $availableStages    = $this->getAvailableStages($id); // Implement this method
        $countLeftRight     = $this->getLeftRight($id);
        $listLeftRight      = $this->getDataList($id);
        $imagenya           = $this->getProductImages($id); // Implement this method
        $images = [];
        foreach(['IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4'] as $view) {
            $images[$view] = $this->getImageBase64($imagenya->$view ?? null);
        }
        
        // Generate the PDF
        $pdf = Pdf::loadView('admin.product-weight.detail_pdf', compact(
            'product',
            'weightData',
            'availableStages',
            'imagenya',
            'images',
            'countLeftRight', 
            'listLeftRight'
        ));
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
        
        // Download the PDF
        return $pdf->download('product-weight-' . $product->model_number . '.pdf');
    }

    public function previewPDF($id)
    {
        $data = $this->getProductData($id);
        
        // Return view langsung untuk preview
        return view('admin.product-weight.detail_pdf', $data);
    }

    private function getProductData($id)
    {
        // Mengumpulkan semua data yang diperlukan
        $product            = DB::table('master_data')
                                ->where('article', $id)->first();
        $weightData         = $this->getWeightData($id);
        $availableStages    = $this->getAvailableStages($id);
        $imagenya           = $this->getProductImages($id);
        $countLeftRight     = $this->getLeftRight($id);
        $listLeftRight      = $this->getDataList($id);

        $images = [];
        foreach(['IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4'] as $view) {
            $images[$view] = $this->getImageBase64($imagenya->$view ?? null);
        }

        return compact(
            'product',
            'weightData',
            'availableStages',
            'imagenya',
            'images',
            'countLeftRight', 
            'listLeftRight'
        );
    }

    // function untuk mendapatkan berat produk
    private function getWeightData($id)
    {
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
            return $weightData;
    }
    
    // function untuk mendapatkan stage
    private function getAvailableStages($id)
    {
        $availableStages = DB::table('master_data')
                    ->where('article', $id)
                    ->pluck('stage')
                    ->toArray();
        return $availableStages;
    }
    
    // mendapatkan data gambar
    private function getProductImages($id)
    {
        return MasterModel::get_image($id);
    }

    private function getImageBase64($imageUrl)
    {
        if (empty($imageUrl)) {
            // Return path gambar default jika tidak ada gambar
            $imageUrl = 'http://10.10.100.23/development/assets/foto_mcs/no_image_available.jpg';
        } else {
            // Ubah URL relatif menjadi path absolut
            $imageUrl = 'http://10.10.100.23/development/assets/foto_mcs/' . $imageUrl;
        }

        // Baca konten gambar
        $imageData = file_get_contents($imageUrl);
        
        if ($imageData === false) {
            // Jika gagal membaca gambar, gunakan gambar default
            $imageData ='http://10.10.100.23/development/assets/foto_mcs/no_image_available.jpg';
        }

        // Deteksi tipe MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $imageData);
        finfo_close($finfo);

        // Konversi ke base64
        return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
    }

    private function getLeftRight($id){
        $left = ProductWeightModel::where('article', $id)
                ->where('position', 'L')
                ->where('type', 'up')
                ->count();

        $right = ProductWeightModel::where('article', $id)
                ->where('position', 'R')
                ->where('type', 'up')
                ->count();

        $data = array([$left, $right]);
        return $data;
    }

    private function getDataList($id)
    {
        return ProductWeightModel::where('article', $id)->paginate(7);
    }
}
