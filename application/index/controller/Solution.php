<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
use baidu;

class Solution extends controller
{
    public function solution()
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>5
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $caseModel=Loader::model('Cases');
    $caseResult=$caseModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id desc')->paginate(16,false,[
                                      'path'=>'/solutions/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
    $page = $caseResult->render();
    $cases=$caseModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->select();
    $count=count($cases);
    $max = ceil($count / 16); 
    $name= i_array_column($cases,'name','id');
    $array = str_replace(' ', '-', $name);
    //return json($array);
    return $this->view->fetch('',[
      'abouthResult'=>$abouthResult,
      'headResult'=>$headResult,
      'caseResult'=>$caseResult,
      'array'=>$array,
      'page'=>$page,
      'max'=>$max,
           ]);
    }
  public function solutiona($id)
    {   
    $names = str_replace('-', ' ', $id);
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>5
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $caseModel=Loader::model('Cases');
    $caseResult=$caseModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$names
        ])->limit(1)->select(); 
    $arr2=i_array_column($caseResult,'num');
    $num=reset($arr2);
    $numResult=$caseModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$names
        ])->update(['num' => $num+1]);
    // return json($caseResult);
    $name= i_array_column($caseResult,'name','id');
    $array = str_replace(' ', '-', $name);
    $arr3=i_array_column($caseResult,'id'); 
    $tid=reset($arr3);
    // //上一页
    $prev=$caseModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id' => ['<',$tid]
        ])->order('id','desc')->limit(1)->select();
    $arrn= i_array_column($prev,'name');
    $arrn= str_replace(' ', '-', $arrn); 
    $arrn= str_replace('?', '_', $arrn);
    $pname=reset($arrn); 
    //下一页
    $next=$caseModel->where([
        'isdelete'=>0,
        'status'=>1,
        'id' => ['>',$tid]
        ])->order('id','asc')->limit(1)->select(); 
    $arrt= i_array_column($next,'name');
    $arrt= str_replace(' ', '-', $arrt); 
    $arrt= str_replace('?', '_', $arrt);
    $tname=reset($arrt);
    //return json($array);
    return $this->view->fetch('',[
      'headResult'=>$headResult,
      'caseResult'=>$caseResult,
      'array'=>$array,
      'prev'=>$prev,
      'pname'=>$pname,
      'next'=>$next,
      'tname'=>$tname,
           ]);
    }
}       