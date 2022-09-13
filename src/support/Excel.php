<?php

namespace ExAdmin\ui\support;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Excel
{
    /**
     * Excel导入数据库
     * @Author: rocky
     * 2019/9/6 18:49
     * @param string $filename 文件路径
     * @param array $columnFields 字段 ['title',2 =>'content'] 索引对应列
     * @param \Closure $closure 每行回调
     * @param int $rowIndex 第几行开始 默认第二行
     * @param null $rowCount 导入第几行 默认全部 如果是数组指定第哪几行 [3,5]
     * @param int $sheet 第几个工作表 默认第一个l
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public static function import($filename, $columnFields, \Closure $closure, $rowIndex = 2, $rowCount = null, $sheet = 0)
    {
        $Excel = IOFactory::load($filename);
        $excel_array = $Excel->getSheet($sheet)->toArray();
        $excel_data = [];
        if (is_array($rowCount)) {
            $excel_array = array_slice($excel_array, $rowIndex - 1, null);
            foreach ($rowCount as $key => $value) {
                array_push($excel_data, $excel_array[$value - 1]);
            }
            $excel_array = $excel_data;
        } else {
            $excel_array = array_slice($excel_array, $rowIndex - 1, $rowCount);
        }
        foreach ($excel_array as $key => $value) {
            $rowData = [];
            foreach ($columnFields as $cell => $field) {
                $rowData[$field] = $value[$cell];
            }
            call_user_func($closure, $rowData);
        }
    }

    /**
     * 导出excel表格
     * @Author: rocky
     * 2019/7/18 15:02
     * @param string $title 标题
     * @param array $columnTitle 表头标题-格式['test'=>'测试']
     * @param array $data 二维数组
     * @param \Closure $callback 回调方法-行转换的数据
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public static function export($title, $columnTitle, $data, $callback = null)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $PHPExcel = new Spreadsheet();
        $worksheet = $PHPExcel->getActiveSheet();
        $worksheet->setTitle($title);
        $i = 0;
        foreach ($columnTitle as $field => $val) {
            $i++;
            $worksheet->setCellValueExplicitByColumnAndRow($i, 1, $val,DataType::TYPE_STRING);
        }
        $i = 1;
        foreach ($data as $key => &$val) {
            $row = $key + 2;
            if ($callback instanceof \Closure) {
                $val = call_user_func_array($callback, [$val,$worksheet,$row]);
            }
            foreach ($columnTitle as $fkey => $fval) {
                $worksheet->setCellValueExplicitByColumnAndRow($i, $row, $val[$fkey],DataType::TYPE_STRING);
                $i++;
            }
            $i = 1;
        }
        $filename = $title . '.xlsx';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($PHPExcel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
