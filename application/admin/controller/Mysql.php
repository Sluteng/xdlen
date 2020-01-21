<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);


use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use app\admin\extra\Baksql; 

class Mysql extends Controller
{
     public function code_export()
     {
         $ids = input('ids');
         if (!$ids) {
             $this->error('数据异常');
         }
         $ids = explode(',', $ids);
         $activate = Db::name('activate');
         $list = $activate->where('id', 'in', $ids)->select();
         return json($list);  
         foreach ($list as $index => $item) {
             if ($item['student_id']) {
                 $list[$index]['used'] = '已使用';
             } else {
                 $list[$index]['used'] = '未使用';
             }
         }
         vendor("PHPExcel.PHPExcel");
         $objPHPExcel = new \PHPExcel();
         // 设置sheet
         $objPHPExcel->setActiveSheetIndex(0);
         // 设置列的宽度
         $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
         // 设置表头
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', '激活码');
         $objPHPExcel->getActiveSheet()->SetCellValue('B1', '学段');
         $objPHPExcel->getActiveSheet()->SetCellValue('C1', '使用情况');
         //存取数据
         $num = 2;
         foreach ($list as $k => $v) {
             $objPHPExcel->getActiveSheet()->SetCellValue('A' . $num, $v['code']);
             $objPHPExcel->getActiveSheet()->SetCellValue('B' . $num, $v['stage']);
             $objPHPExcel->getActiveSheet()->SetCellValue('C' . $num, $v['used']);
             $num++;
         }
         // 文件名称
         $fileName = "激活码" . date('Y-m-d', time()) . rand(1, 1000);
         $xlsName = iconv('utf-8', 'gb2312', $fileName);
         // 设置工作表名
         $objPHPExcel->getActiveSheet()->setTitle('sheet');
         //下载 excel5与excel2007
         $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
         ob_end_clean();     // 清除缓冲区,避免乱码
         header("Pragma: public");
         header("Expires: 0");
         header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
         header("Content-Type:application/force-download");
         header("Content-Type:application/vnd.ms-execl;charset=UTF-8");
         header("Content-Type:application/octet-stream");
         header("Content-Type:application/download");
         header("Content-Disposition:attachment;filename=" . $xlsName . ".xls");
         header("Content-Transfer-Encoding:binary");
         $objWriter->save("php://output");
     }
}