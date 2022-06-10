<?php

namespace App\Http\Services;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Illuminate\Support\Facades\Storage;
class ExportService
{
    const EXCEL_EXT = '.xlsx';
    const CSV_EXT = '.csv';
    const TEMP_DIR = '/excelTemp';

    // [rowTitles(['title 1', 'title 2', ...])]
    // [sheets(['name' => 'name', 'data' => [[1,2,3,4,5,6], [1,2,3,4,5,6], [...]] ])]
    // [fileName('name')]
    public static function exportExcelFile($rowTitles, $sheets, $fileName, $extension = self::EXCEL_EXT) {
        $writer = WriterEntityFactory::createXLSXWriter();
        $customTempFolderPath = __DIR__ . self::TEMP_DIR;
        if (!file_exists( $customTempFolderPath)) {
            mkdir( $customTempFolderPath, 0777, true);
        }
        $writer->setTempFolder($customTempFolderPath);
        // stream data directly to the browser
        $writer->openToBrowser($fileName.$extension); 
        
        // Styles
        $border = (new BorderBuilder())
            ->setBorderBottom(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderTop(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderLeft(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderRight(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->build();
        $rowTitleStyle = (new StyleBuilder())
                ->setFontBold()
                ->setFontSize(13)
                ->setBorder($border)
                ->setFontColor(Color::BLACK)
                ->setShouldWrapText(true)
                ->setCellAlignment(CellAlignment::CENTER)
                ->build();
    
        $rowDataStyle = (new StyleBuilder())
                ->setShouldWrapText(true)
                ->setFontSize(11)
                ->setBorder($border)
                ->setFontColor(Color::BLACK)
                ->setCellAlignment(CellAlignment::CENTER)
                ->build();
        
        $cellsTitle = [];
        foreach ($rowTitles as $key => $title) {
            $cellsTitle[] = WriterEntityFactory::createCell($title, $rowTitleStyle);
        }
    
        $rowTitle = WriterEntityFactory::createRow($cellsTitle);
        // Write data
        foreach ($sheets as $key => $sheet) {
            if ($key > 0) {
                $writer->addNewSheetAndMakeItCurrent();
            }
            $thisSheet = $writer->getCurrentSheet();
            $thisSheet->setName($sheet['name']);
            $writer->addRow($rowTitle);
            $multipleRows = [];
            foreach ($sheet['data'] as $subkey => $data) {
                $cellData = [];
                foreach ($data as $subkey2 => $cell) {
                    $cellData[] = WriterEntityFactory::createCell($cell, $rowDataStyle);
                }
                $multipleRows = [
                    WriterEntityFactory::createRow($cellData),
                ];
                $writer->addRows($multipleRows);
            }
        }
        $writer->close();
        return ;
    }
}