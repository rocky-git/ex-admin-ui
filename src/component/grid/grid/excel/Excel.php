<?php
namespace ExAdmin\ui\component\grid\grid\excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Excel extends AbstractExporter
{
    protected $maxRow = 1048576;
    protected $spreadsheet;
    protected $sheet;
    public function __construct()
    {
       $this->spreadsheet =  new Spreadsheet();
       $this->sheet = $spreadsheet->getActiveSheet();
    }

    public function export()
    {
        
    }
}
