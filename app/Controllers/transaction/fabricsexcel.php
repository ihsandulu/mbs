<?php

namespace App\Controllers\transaction;


use App\Controllers\baseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;

class fabricsexcel extends BaseController
{

    protected $sesi_user;
    protected $db;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
        $this->db = \Config\Database::connect(); // Inisialisasi koneksi database
    }


    public function simulasi()
    {
        $data[""] = 1;
        return view('transaction/fabricsexcel_v', $data);
    }



    public function exportExcel()
    {


        $dari = date("Y-m-d");
        $ke = date("Y-m-d");
        if (isset($_GET["dari"])) {
            $dari = $_GET["dari"];
        }
        if (isset($_GET["ke"])) {
            $ke = $_GET["ke"];
        }

        $build = $this->db
            ->table("fabricsd")
            ->join("fabrics", "fabricsd.fabrics_id=fabrics.fabrics_id", "left");
        if (isset($_GET["buyer_id"])) {
            $build->where("buyer_id", $_GET["buyer_id"]);
        }
        if (isset($_GET["fileno"])) {
            $build->where("fabrics_fileno", $_GET["fileno"]);
        }
        if (isset($_GET["dari"]) && isset($_GET["ke"])) {
            $build->where("fabrics_date >=", $dari)
                ->where("fabrics_date <=", $ke);
        }
        $usr = $build
            ->groupBy("fabricsd_date")
            ->orderBy("fabricsd_date ASC")
            ->get();
        // echo $this->db->getLastquery();
        // die;
        $no = 1;
        $ardate = array();
        foreach ($usr->getResult() as $usr) {
            $ardate[] = $usr->fabricsd_date;
        }

        $build = $this->db->table("fabricsd");
        if (isset($_GET["buyer_id"])) {
            $build->where("buyer_id", $_GET["buyer_id"]);
        }
        if (isset($_GET["fileno"])) {
            $build->where("fabrics_fileno", $_GET["fileno"]);
        }
        if (isset($_GET["dari"]) && isset($_GET["ke"])) {
            $build->where("fabrics_date >=", $dari)
                ->where("fabrics_date <=", $ke);
        }
        $fabricsd = $build->get();
        $totalinyard = 0;
        $totalinbale = 0;
        $totaloutyard = 0;
        $totaloutbale = 0;
        $arinyard = array();
        $arinbale = array();
        $aroutyard = array();
        $aroutbale = array();
        $artinyard = array();
        $artinbale = array();
        $artoutyard = array();
        $artoutbale = array();
        foreach ($fabricsd->getResult() as $fabricsd) {
            if ($fabricsd->fabricsd_type == "IN") {
                $arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_yard;
                $arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_bale;
                if (!isset($aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                    $aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                }
                if (!isset($aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                    $aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                }

                $totalinyard += $fabricsd->fabricsd_yard;
                $totalinbale += $fabricsd->fabricsd_bale;
            } else {
                if (!isset($arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                    $arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                }
                if (!isset($arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                    $arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                }
                $aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_yard;
                $aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_bale;

                $totaloutyard += $fabricsd->fabricsd_yard;
                $totaloutbale += $fabricsd->fabricsd_bale;
            }

            $artinyard[$fabricsd->fabrics_id] = $totalinyard;
            $artinbale[$fabricsd->fabrics_id] = $totalinbale;
            $artoutyard[$fabricsd->fabrics_id] = $totaloutyard;
            $artoutbale[$fabricsd->fabrics_id] = $totaloutbale;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header


        // Set header dengan merge (colspan/rowspan)
        $sheet->setCellValue('A1', 'File No.');
        $sheet->mergeCells('A1:A3');
        $sheet->setCellValue('B1', 'Fabrication');
        $sheet->mergeCells('B1:B3');

        $sheet->setCellValue('C1', 'Cad');
        $sheet->mergeCells('C1:C3');
        $sheet->getColumnDimension('C')->setWidth(25);

        $sheet->setCellValue('D1', 'Color');
        $sheet->mergeCells('D1:D3');
        $sheet->setCellValue('E1', 'Part');
        $sheet->mergeCells('E1:E3');
        $sheet->setCellValue('F1', 'Qty');
        $sheet->mergeCells('F1:F3');
        $sheet->setCellValue('G1', 'YDS');
        $sheet->mergeCells('G1:G3');
        $sheet->setCellValue('H1', 'LBS');
        $sheet->mergeCells('H1:H3');
        $sheet->setCellValue('I1', 'Remark');
        $sheet->mergeCells('I1:I3');

        $startColumnIndex = 10; // J = kolom ke-10
        foreach ($ardate as $ardat) {
            // Konversi index angka ke huruf kolom
            $colStart = Coordinate::stringFromColumnIndex($startColumnIndex);
            $colEnd = Coordinate::stringFromColumnIndex($startColumnIndex + 3); // 4 kolom

            // Set dan merge cell
            $sheet->setCellValue($colStart . '1', $ardat);
            $sheet->mergeCells($colStart . '1:' . $colEnd . '1');

            //in
            $sheet->setCellValue($colStart . '2', "IN");
            $colEndIn = Coordinate::stringFromColumnIndex($startColumnIndex + 1);
            $sheet->mergeCells($colStart . '2:' . $colEndIn . '2');

            //out
            $colStartOut = Coordinate::stringFromColumnIndex($startColumnIndex + 2);
            $sheet->setCellValue($colStartOut . '2', "OUT");
            $colEndOut = Coordinate::stringFromColumnIndex($startColumnIndex + 3);
            $sheet->mergeCells($colStartOut . '2:' . $colEndOut . '2');

            //yardbale            
            $colyardbale1 = Coordinate::stringFromColumnIndex($startColumnIndex);
            $colyardbale2 = Coordinate::stringFromColumnIndex($startColumnIndex + 1);
            $colyardbale3 = Coordinate::stringFromColumnIndex($startColumnIndex + 2);
            $colyardbale4 = Coordinate::stringFromColumnIndex($startColumnIndex + 3);

            $sheet->setCellValue($colyardbale1 . '3', "YARD");
            $sheet->setCellValue($colyardbale2 . '3', "BALE");
            $sheet->setCellValue($colyardbale3 . '3', "YARD");
            $sheet->setCellValue($colyardbale4 . '3', "BALE");

            // Geser ke 4 kolom berikutnya
            $startColumnIndex += 4;
        }

        $totalDynamicColumns = count($ardate) * 4;
        $currentStockStartIndex = 10 + $totalDynamicColumns;

        $currentstockStart = Coordinate::stringFromColumnIndex($currentStockStartIndex);
        //currentstock
        $currentstockEnd = Coordinate::stringFromColumnIndex($currentStockStartIndex + 5);
        $sheet->setCellValue($currentstockStart . '1', "Current Stock");
        $sheet->mergeCells($currentstockStart . '1:' . $currentstockEnd . '1');


        //inout
        $currentstockEnd = Coordinate::stringFromColumnIndex($currentStockStartIndex + 5);
        $sheet->setCellValue($currentstockStart . '1', "Current Stock");
        $sheet->mergeCells($currentstockStart . '1:' . $currentstockEnd . '1');


        //TOTAL IN
        $sheet->setCellValue($currentstockStart . '2', "TOTAL IN");
        $totalInEnd = Coordinate::stringFromColumnIndex($currentStockStartIndex + 1);
        $sheet->mergeCells($currentstockStart . '2:' . $totalInEnd . '2');

        //BALANCE RECEIVE
        $receive = Coordinate::stringFromColumnIndex($currentStockStartIndex + 2);
        $sheet->setCellValue($receive . '2', "BALANCE RECEIVE");
        $sheet->mergeCells($receive . '2:' . $receive . '3');

        //TOTAL OUT
        $totalOutStart = Coordinate::stringFromColumnIndex($currentStockStartIndex + 3);
        $totalOutEnd = Coordinate::stringFromColumnIndex($currentStockStartIndex + 4);
        $sheet->setCellValue($totalOutStart . '2', "TOTAL OUT");
        $sheet->mergeCells($totalOutStart . '2:' . $totalOutEnd . '2');

        //BALANCE LOADING
        $bloading = Coordinate::stringFromColumnIndex($currentStockStartIndex + 5);
        $sheet->setCellValue($bloading . '2', "BALANCE LOADING");
        $sheet->mergeCells($bloading . '2:' . $bloading . '3');


        //yard bale current stock
        $yb2 = Coordinate::stringFromColumnIndex($currentStockStartIndex + 1);
        $yb3 = Coordinate::stringFromColumnIndex($currentStockStartIndex + 3);
        $yb4 = Coordinate::stringFromColumnIndex($currentStockStartIndex + 4);
        $sheet->setCellValue($currentstockStart . '3', "YARD");
        $sheet->setCellValue($yb2 . '3', "BALE");
        $sheet->setCellValue($yb3 . '3', "YARD");
        $sheet->setCellValue($yb4 . '3', "BALE");



        // Ambil data dari database
        $build = $this->db
            ->table("fabrics");
        if (isset($_GET["buyer_id"])) {
            $build->where("buyer_id", $_GET["buyer_id"]);
        }
        if (isset($_GET["fileno"])) {
            $build->where("fabrics_fileno", $_GET["fileno"]);
        }
        if (isset($_GET["dari"]) && isset($_GET["ke"])) {
            $build->where("fabrics_date >=", $dari)
                ->where("fabrics_date <=", $ke);
        }
        $usr = $build->orderBy("fabrics_date DESC")
            ->get();
        //echo $this->db->getLastquery();
        $no = 1;


        $row = 4; // Start from row 2
        foreach ($usr->getResult() as $usr) {
            $imagePath = FCPATH . ($usr->fabrics_cad ? "images/fabrics_cad/" . $usr->fabrics_cad : "images/fabrics_cad/no_image.png");

            // Data tanpa gambar
            $sheet->setCellValue('A' . $row, $usr->fabrics_fileno);
            $sheet->setCellValue('B' . $row, $usr->fabrics_name);
            $sheet->setCellValue('D' . $row, $usr->fabrics_color);
            $sheet->setCellValue('E' . $row, $usr->fabrics_part);
            $sheet->setCellValue('F' . $row, $usr->fabrics_qty);
            $sheet->setCellValue('G' . $row, $usr->fabrics_yds);
            $sheet->setCellValue('H' . $row, $usr->fabrics_lbs);
            $sheet->setCellValue('I' . $row, $usr->fabrics_remark);

            // Tambahkan gambar di kolom C
            if (file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setPath($imagePath);
                $drawing->setHeight(80);
                $drawing->setCoordinates('C' . $row);
                $drawing->setWorksheet($sheet);
                $sheet->getRowDimension($row)->setRowHeight(100);
            }

            $tp = 10;
            foreach ($ardate as $ardat) {
                if (isset($arinyard[$usr->fabrics_id][$ardat])) {
                    $arinyard1 = $arinyard[$usr->fabrics_id][$ardat];
                } else {
                    $arinyard1 = "";
                }
                $fabricsdin_yard = Coordinate::stringFromColumnIndex($tp);
                $sheet->setCellValue($fabricsdin_yard . $row, $arinyard1);

                if (isset($arinbale[$usr->fabrics_id][$ardat])) {
                    $arinbale1 = $arinbale[$usr->fabrics_id][$ardat];
                } else {
                    $arinbale1 = "";
                }
                $fabricsdin_bale = Coordinate::stringFromColumnIndex($tp + 1);
                $sheet->setCellValue($fabricsdin_bale . $row,  $arinbale1);

                if (isset($aroutyard[$usr->fabrics_id][$ardat])) {
                    $aroutyard1 = $aroutyard[$usr->fabrics_id][$ardat];
                } else {
                    $aroutyard1 = "";
                }
                $fabricsdout_yard = Coordinate::stringFromColumnIndex($tp + 2);
                $sheet->setCellValue($fabricsdout_yard . $row, $aroutyard1);

                if (isset($aroutbale[$usr->fabrics_id][$ardat])) {
                    $aroutbale1 = $aroutbale[$usr->fabrics_id][$ardat];
                } else {
                    $aroutbale1 = "";
                }
                $fabricsdout_bale = Coordinate::stringFromColumnIndex($tp + 3);
                $sheet->setCellValue($fabricsdout_bale . $row, $aroutbale1);
                $tp += 4;
            }

            if (isset($artinyard[$usr->fabrics_id])) {
                $artinyard1 = $artinyard[$usr->fabrics_id];
            } else {
                $artinyard1 = "";
            }
            $totalinyardd = Coordinate::stringFromColumnIndex($tp);
            $sheet->setCellValue($totalinyardd . $row, $artinyard1);

            if (isset($artinbale[$usr->fabrics_id])) {
                $artinbale1 = $artinbale[$usr->fabrics_id];
            } else {
                $artinbale1 = "";
            }
            $totalinbaled = Coordinate::stringFromColumnIndex($tp + 1);
            $sheet->setCellValue($totalinbaled . $row, $artinbale1);

            $breceive = $artinyard1 - $usr->fabrics_yds;
            $breceived = Coordinate::stringFromColumnIndex($tp + 2);
            $sheet->setCellValue($breceived . $row, $breceive);

            if (isset($artoutyard[$usr->fabrics_id])) {
                $artoutyard1 = $artoutyard[$usr->fabrics_id];
            } else {
                $artoutyard1 = "";
            }
            $totaloutyardd = Coordinate::stringFromColumnIndex($tp + 3);
            $sheet->setCellValue($totaloutyardd . $row, $artoutyard1);

            if (isset($artoutbale[$usr->fabrics_id])) {
                $artoutbale1 = $artoutbale[$usr->fabrics_id];
            } else {
                $artoutbale1 = "";
            }
            $totaloutbaled = Coordinate::stringFromColumnIndex($tp + 4);
            $sheet->setCellValue($totaloutbaled . $row, $artoutbale1);

            $bload = $artoutyard1 - $artinyard1;
            $bloadd = Coordinate::stringFromColumnIndex($tp + 5);
            $sheet->setCellValue($bloadd . $row, $bload);


            $row++;
        }
        // die;
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getAlignment()
            ->setWrapText(true);

        // Tentukan area range dari cell yang akan diberi border
        $lastColumn = Coordinate::stringFromColumnIndex($tp + 5); // pastikan ini adalah kolom terakhir
        $lastRow = $row; // baris terakhir setelah semua data ditulis
        $range = 'A1:' . $lastColumn . $lastRow;

        // Terapkan border ke seluruh cell dalam range
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN, // Bisa diganti ke BORDER_MEDIUM, dsb.
                    'color' => ['argb' => 'FF000000'], // Warna hitam
                ],
            ],
        ]);

        // Simpan ke file
        $filename = 'fabric_export_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
