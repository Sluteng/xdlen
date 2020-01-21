<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
use baidu;

class Product extends controller
{
    public function product()
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>4
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $mainModel=Loader::model('Main');
    $mainResult=$mainModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
   $name= i_array_column($mainResult,'name','id');
   $array = str_replace(' ', '-', $name);
   $productModel=Loader::model('Product');
   $productResult=$productModel->where([
           'isdelete'=>0,
           'status'=>1
       ])->order('sort=0 asc,sort asc,id desc')->paginate(9,false,[
                                      'path'=>'/products/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]); 
   $page = $productResult->render(); 
   $product=$productModel->where([
           'isdelete'=>0,
           'status'=>1
       ])->select();
   $arrp= i_array_column($product,'name','id');
   // $array = array_map('urlencode', $arrp);
  // $aa=eval('return '.iconv( 'GB2312','UTF-8',var_export($arrp,true).';'));
   // $result = urlencode(iconv($arrp));
   // $aar1=unserialize(iconv('gbk','utf-8',serialize($arrp)));
   // return json($array);  
   // urldecode()
   $array2 = str_replace(' ', '-', $arrp);
   $array2 = str_replace('/', '-l-', $array2);
   //尾页
   $count=count($product);
   $max = ceil($count / 9); 
    return $this->view->fetch('',[
      'abouthResult'=>$abouthResult,
      'headResult'=>$headResult,
      'mainResult'=>$mainResult,
      'array'=>$array,
      'productResult'=>$productResult,
      'array2'=>$array2,
      'page'=>$page,
      'max'=>$max,
           ]);
    }
    public function productl($id)
    {   
    $names = str_replace('-l-', '/', $id); 
    $main = str_replace('-', ' ', $names);
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>4
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $mainModel=Loader::model('Main');
    $mainResult=$mainModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $name= i_array_column($mainResult,'name','id');
    $array = str_replace(' ', '-', $name);
    $maintdkResult=$mainModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$main
        ])->limit(1)->select(); 
    // return json($maintdkResult);
    $productModel=Loader::model('Product');
    $productResult=$productModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$main
        ])->order('sort=0 asc,sort asc,id desc')->paginate(9,false,[
                                      'path'=>'/productz/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]); 
    $page = $productResult->render(); 
    $product=$productModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$main
        ])->select();
    $count=count($product);
    $max = ceil($count / 9); 
    $arrp= i_array_column($product,'name','id');
    $array2 = str_replace(' ', '-', $arrp);
    $array2 = str_replace('/', '-l-', $array2);
    return $this->view->fetch('',[
      'maintdkResult'=>$maintdkResult,
      'headResult'=>$headResult,
      'mainResult'=>$mainResult,
      'array'=>$array,
      'productResult'=>$productResult,
      'array2'=>$array2,
      'page'=>$page,
      'max'=>$max,
           ]);
    } 
   public function producta($id)
    {   
      
    $names = str_replace('-l-', '/', $id); 
    $names = str_replace('-', ' ', $names);
    // return json($names);
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>4
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $mainModel=Loader::model('Main');
    $mainResult=$mainModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $name= i_array_column($mainResult,'name','id');
    $array = str_replace(' ', '-', $name);
    $productModel=Loader::model('Product');
    $productResult=$productModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$names
        ])->limit(1)->select();
    $arr3=i_array_column($productResult,'id'); 
    $tid=reset($arr3);
    $arr4=i_array_column($productResult,'titles'); 
    $titles=reset($arr4);  
    // return json($tid);
    // //上一页
    $prev=$productModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$titles,
            'id' => ['<',$tid]
        ])->order('id','desc')->limit(1)->select();
    $arrn= i_array_column($prev,'name');
    $arrn= str_replace(' ', '-', $arrn);
    $arrn= str_replace('/', '-l-', $arrn); 
    $arrn= str_replace('?', '_', $arrn);
    $pname=reset($arrn); 
    //下一页
    $next=$productModel->where([
        'isdelete'=>0,
        'status'=>1,
        'titles'=>$titles,
        'id' => ['>',$tid]
        ])->order('id','asc')->limit(1)->select(); 
    $arrt= i_array_column($next,'name');
    $arrt= str_replace(' ', '-', $arrt); 
    $arrt= str_replace('/', '-l-', $arrt); 
    $arrt= str_replace('?', '_', $arrt);
    $tname=reset($arrt);
    // return json($productResult);
    return $this->view->fetch('',[
      'headResult'=>$headResult,
      'mainResult'=>$mainResult,
      'array'=>$array,
      'productResult'=>$productResult,
      'prev'=>$prev,
      'pname'=>$pname,
      'next'=>$next,
      'tname'=>$tname,
           ]);
    }
}       