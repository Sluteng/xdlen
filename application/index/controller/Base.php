<?php
use think\Request;  
use think\Loader;
        $navberModel=Loader::model('Navber');
        $tdkResult=$navberModel->where([
                'isdelete'=>0,
                'status'=>1,
                'id'=>1
            ])->limit(1)->select();
        $navberResult=$navberModel->where([
                'isdelete'=>0,
                'status'=>1
            ])->order('sort=0 asc,sort asc,id asc')->select();
        $cont=request()->controller(); //获取控制器名称
        $foo=lcfirst($cont);  //首字母变小写
        // // 右侧边栏

        $newshomeModel=Loader::model('Newsa');
        $newsHome=$newshomeModel->where([
                'isdelete'=>0,
                'status'=>1,
                'home'=>1
            ])->order('sort=0 asc,sort asc,id desc')->select();
        $news= i_array_column($newsHome,'name','id');
        $news= str_replace(' ', '-', $news);
        $arrhome= str_replace('?', '_', $news);
        $companyModel=Loader::model('Company');
        $companyResult=$companyModel->where([
                'isdelete'=>0,
                'status'=>1
            ])->select(); 
        $linksModel=Loader::model('Links');
        $linksResult=$linksModel->where([
                'isdelete'=>0,
                'status'=>1
            ])->select();
        $logoModel=Loader::model('Logo');
        $logoResult=$logoModel->where([
                'isdelete'=>0,
                'status'=>1
            ])->select(); 
        $MapModel=Loader::model('Map');
        $MapResult=$MapModel->where([
                'isdelete'=>0,
                'status'=>1,
            ])->order('id','desc')->limit(1)->select();
       $Mapd= i_array_column($MapResult,'url');
       $Map=reset($Mapd);
       $this->assign([
        'tdkResult'=>$tdkResult,
        'navberResult'=>$navberResult,
        'foo'=>$foo,
        'companyResult'=>$companyResult,
        'newsHome'=>$newsHome,
        'arrhome'=>$arrhome,
        'linksResult'=>$linksResult,
        'logoResult'=>$logoResult,
        'Map'=>$Map,
       ]);