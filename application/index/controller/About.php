<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
use baidu;

class About extends controller
{
    public function about()
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>2
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
    // return json($headResult); 
    $aboutModel=Loader::model('About');
    $aboutResult=$aboutModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->select(); 
    $patentModel=Loader::model('HonorPatent');
    $patentResult=$patentModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();
    $showModel=Loader::model('LanShow');
    $showResult=$showModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();
    return $this->view->fetch('',[
      'abouthResult'=>$abouthResult,
      'aboutResult'=>$aboutResult,
      'headResult'=>$headResult,
      'patentResult'=>$patentResult,
      'showResult'=>$showResult,
           ]);
    }
    public function honor()
    {   
    require_once('Base.php');
    $honortdkModel=Loader::model('honor_tdk');
    $honortdkResult=$honortdkModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select(); 
    // return json($honortdkResult);
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>2
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
      // return json($headResult); 
    $aboutModel=Loader::model('About');
    $aboutResult=$aboutModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->select();    
    $patentModel=Loader::model('HonorPatent');
    $patentResult=$patentModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->paginate(6,false,[
                                      'path'=>'/honor1/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
    $showModel=Loader::model('LanShow');
    $showResult=$showModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();
     $page = $patentResult->render(); 
    return $this->view->fetch('',[
      'honortdkResult'=>$honortdkResult,
      'abouthResult'=>$abouthResult,
      'headResult'=>$headResult,
      'aboutResult'=>$aboutResult,
      'patentResult'=>$patentResult,
      'showResult'=>$showResult,
      'page'=>$page,
           ]);
    } 
   public function show()
    {   
    require_once('Base.php');
    $tdkwModel=Loader::model('Lan_tdks');
    $tdkwResult=$tdkwModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select(); 
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>2
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
      // return json($headResult); 
    $aboutModel=Loader::model('About');
    $aboutResult=$aboutModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->select();    
    $patentModel=Loader::model('HonorPatent');
    $patentResult=$patentModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->limit(1)->select();  
    $showModel=Loader::model('LanShow');
    $showResult=$showModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select();
    return $this->view->fetch('',[
      'tdkwResult'=>$tdkwResult,
      'abouthResult'=>$abouthResult,
      'headResult'=>$headResult,
      'aboutResult'=>$aboutResult,
      'patentResult'=>$patentResult,
      'showResult'=>$showResult,
           ]);
    }
}       