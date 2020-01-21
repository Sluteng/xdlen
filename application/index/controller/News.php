<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;

class News extends controller
{
    public function news()
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>3
        ])->limit(1)->select();
    $newshResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>3
        ])->limit(1)->select();
    $title= i_array_column($newshResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $newsModel=Loader::model('News');
    $newsResult=$newsModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $name= i_array_column($newsResult,'name','id');
    $array = str_replace(' ', '-', $name);
    // return json($array);
    $first = current($name); //获取数组中的第一个值
    $titlen = str_replace(' ', '-', $first);
     // return json($titlen);
    $newsaModel=Loader::model('Newsa');
    $newsaResult=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$first
        ])->order('sort=0 asc,sort asc,id desc')->paginate(6,false,[
                                      'path'=>'/newsy/'.$titlen.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]); 
    $newsa=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$first
        ])->order('sort=0 asc,sort asc,id desc')->select();
    $arrn= i_array_column($newsa,'name','id');
     $arrn= str_replace(' ', '-', $arrn);
    $array2= str_replace('?', '_', $arrn);
    $page = $newsaResult->render(); 
    //尾页
    $count=$newsaModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'titles'=>$first
                ])->count();
    $max = ceil($count / 6); 
    return $this->view->fetch('',[
      'abouthResult'=>$abouthResult,
      'newshResult'=>$newshResult,
      'headResult'=>$headResult,
      'first'=>$first,
      'newsResult'=>$newsResult,
      'array'=>$array,  
      'newsaResult'=>$newsaResult,
      'array2'=>$array2,
      'page'=>$page,
      'max'=>$max,
           ]);
    }
    public function newsn($id)
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>3
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $first = str_replace('-', ' ', $id);
    $newsModel=Loader::model('News');
    $newsResult=$newsModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $newsModel=Loader::model('News');
    $newshResult=$newsModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$first
        ])->limit(1)->select(); 
    $titles= i_array_column($newsResult,'name','id');
    $array = str_replace(' ', '-', $titles);
    $newsaModel=Loader::model('Newsa');
    $newsaResult=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$first  
        ])->order('sort=0 asc,sort asc,id desc')->paginate(6,false,[
                                      'path'=>'/newsy/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]); 
      $newsa=$newsaModel->where([
              'isdelete'=>0,
              'status'=>1,
              'titles'=>$first
          ])->order('sort=0 asc,sort asc,id desc')->select();
      $arrn= i_array_column($newsa,'name','id');
      $arrn= str_replace(' ', '-', $arrn);
      $array2= str_replace('?', '_', $arrn);
      $page = $newsaResult->render(); 
          //尾页
      $count=$newsaModel->where([
                  'isdelete'=>0,
                  'status'=>1,
                  'titles'=>$first
                ])->count();
        $max = ceil($count / 6); 
    // return json($newsaResult);
    return $this->view->fetch('news',[
      'newshResult'=>$newshResult,
      'headResult'=>$headResult,
      'abouthResult'=>$abouthResult,
      'first'=>$first,
      'newsResult'=>$newsResult,
      'array'=>$array,
      'newsaResult'=>$newsaResult,  
      'array2'=>$array2,  
      'page'=>$page,
      'max'=>$max,
           ]);
    }
    public function newsa($id)
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>3
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    $id = str_replace('-', ' ', $id);
    $first = str_replace('_', '?', $id);
    // return json($first);
    $newsModel=Loader::model('News');
    $newsResult=$newsModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select(); 
    $name= i_array_column($newsResult,'name','id');
    $array = str_replace(' ', '-', $name);
    $newsaModel=Loader::model('Newsa');
    $newsaResult=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'name'=>$first
        ])->limit(1)->select();
   $arr2=i_array_column($newsaResult,'num');
   $num=reset($arr2);
   $numResult=$newsaModel->where([
           'isdelete'=>0,
           'status'=>1,
           'name'=>$first
       ])->update(['num' => $num+1]);
   $arr3=i_array_column($newsaResult,'id'); 
   $tid=reset($arr3);
   $arr4=i_array_column($newsaResult,'titles'); 
   $titles=reset($arr4);  
   // return json($tid);
   // //上一页
   $prev=$newsaModel->where([
           'isdelete'=>0,
           'status'=>1,
           'titles'=>$titles,
           'id' => ['<',$tid]
       ])->order('id','desc')->limit(1)->select();
   $arrn= i_array_column($prev,'name');
   $arrn= str_replace(' ', '-', $arrn); 
   $arrn= str_replace('?', '_', $arrn);
   $pname=reset($arrn); 
   //下一页
   $next=$newsaModel->where([
       'isdelete'=>0,
       'status'=>1,
       'titles'=>$titles,
       'id' => ['>',$tid]
       ])->order('id','asc')->limit(1)->select(); 
   $arrt= i_array_column($next,'name');
   $arrt= str_replace(' ', '-', $arrt); 
   $arrt= str_replace('?', '_', $arrt);
   $tname=reset($arrt);
    // return json($newsaResult);
    return $this->view->fetch('',[
      'headResult'=>$headResult,
      'abouthResult'=>$abouthResult,
      'first'=>$first,
      'newsResult'=>$newsResult,
      'array'=>$array,
      'newsaResult'=>$newsaResult,
      'prev'=>$prev,
      'pname'=>$pname,
      'next'=>$next,
      'tname'=>$tname,
           ]);
    }
}       