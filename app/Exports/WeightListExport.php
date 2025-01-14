<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeightListExport implements FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles, 
    WithTitle, 
    WithCustomStartCell,
    WithEvents
{
    protected $filters;
    protected $rowCount = 0;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $params = [
            'article' => $this->filters['article'] ?? null,
            'start_date' => $this->filters['start_date'] ?? null,
            'end_date' => $this->filters['end_date'] ?? null,
            'factory' => $this->filters['factory'] ?? null,
            'cell' => $this->filters['line'] ?? null,
            'po_no' => $this->filters['po_no'] ?? null,
            'model' => $this->filters['model'] ?? null,
        ];

        $data = DB::select('EXEC WEIGHT_LIST @article = ?, @start_date = ?, @end_date = ?, @factory = ?, @cell = ?, @po_no = ?, @model = ?', array_values($params));
        $this->rowCount = count($data);
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Factory',
            'Line',
            'Season',
            'PO',
            'Model',
            'Article',
            'Size',
            'Size Qty',
            'Process',
            'Target Count',
            'Target Weight',
            'Actual Weight',
            'Weight Time',
            'Weight By'
        ];
    }

    public function map($row): array
    {
        return [
            $row->FACTORY2 ?? '',
            $row->CELL_CODE ?? '',
            $row->season ?? '',
            $row->po_no,
            $row->model_name,
            $row->article,
            $row->size,
            $row->size_qty,
            $row->type ?? '',
            $row->target_qty,
            $row->metric_value,
            $row->weight,
            $row->created_at ? Carbon::parse($row->created_at)->format('Y-m-d H:i:s') : '',
            $row->fullname
        ];
    }

    // Menentukan cell awal untuk data (untuk memberikan ruang untuk judul)
    public function startCell(): string
    {
        return 'A3';
    }

    // Memberikan judul pada worksheet
    public function title(): string
    {
        return 'Weight List Report';
    }

    // Mengatur style untuk worksheet
    public function styles(Worksheet $sheet)
    {
        // Mengatur lebar kolom
        foreach(range('A', 'N') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [
            // Style untuk judul
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            // Style untuk header
            3 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }

    // Menambahkan events setelah sheet dibuat
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Menambahkan judul
                $sheet->mergeCells('A1:N1');
                $sheet->setCellValue('A1', 'WEIGHT LIST REPORT');
                
                // Menambahkan periode di baris kedua jika ada filter tanggal
                if (!empty($this->filters['start_date']) && !empty($this->filters['end_date'])) {
                    $sheet->mergeCells('A2:N2');
                    $sheet->setCellValue('A2', 'Period: ' . $this->filters['start_date'] . ' to ' . $this->filters['end_date']);
                    $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Menambahkan border untuk seluruh data
                $lastRow = $this->rowCount + 3; // 3 adalah baris mulai data (setelah judul dan header)
                $range = 'A3:N' . $lastRow;
                
                $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                
                // Mengatur tinggi baris header
                $sheet->getRowDimension(3)->setRowHeight(30);
                
                // Mengatur word wrap untuk header
                $sheet->getStyle('A3:N3')->getAlignment()->setWrapText(true);
                
                // Menambahkan filter
                $sheet->setAutoFilter($range);
            }
        ];
    }
}