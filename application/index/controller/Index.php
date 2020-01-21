<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;

class Index extends controller
{
    public function index()
    {   
    require_once('Base.php');
    $bannerModel=Loader::model('Banner');
    $bannerResult=$bannerModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select();
    $prodModel=Loader::model('Prod');
    $prodResult=$prodModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();
    $ProductModel=Loader::model('Product');
    $ProductResult=$ProductModel->where([
            'isdelete'=>0,
            'status'=>1,
            'home'=>1
        ])->order('sort=0 asc,sort asc,id desc')->limit(8)->select();
    // return json($ProductResult);
    $Pro= i_array_column($ProductResult,'name','id');
    $Pro= str_replace(' ', '-', $Pro); 
    $Pro= str_replace('/', '-l-', $Pro); 
    $array= str_replace('?', '_', $Pro);
    $AboutusModel=Loader::model('Aboutus');
    $AboutusResult=$AboutusModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();
    $newModel=Loader::model('News');
    $newResult=$newModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $titlen= i_array_column($newResult,'name','id');
    $arrnew = str_replace(' ', '-', $titlen);
    $nums = i_array_column($newsHome,'num');
    $num=max($nums);
    $numHome=$newshomeModel->where([
            'isdelete'=>0,
            'status'=>1,
            'num'=>$num
        ])->limit(1)->select();
    $newh= i_array_column($numHome,'name');
    $newh = str_replace(' ', '-', $newh);
    $newh = str_replace('?', '_', $newh);
    $arrh = reset($newh);
    // return json($arrh);
    $CasesModel=Loader::model('Cases');
    $CasesResult=$CasesModel->where([
            'isdelete'=>0,
            'status'=>1,
            'home'=>1
        ])->order('sort=0 asc,sort asc,id asc')->limit(4)->select(); 
    $cases= i_array_column($CasesResult,'name','id');
    $arrcas= str_replace(' ', '-', $cases);
    return $this->view->fetch('',[
      'bannerResult'=>$bannerResult,
      'prodResult'=>$prodResult,
      'ProductResult'=>$ProductResult,
      'array'=>$array,
      'AboutusResult'=>$AboutusResult,
      'newResult'=>$newResult,
      'arrnew'=>$arrnew,
      'numHome'=>$numHome,
      'arrh'=>$arrh,
      'CasesResult'=>$CasesResult,
      'arrcas'=>$arrcas,
           ]);
    }
}       