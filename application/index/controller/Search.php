<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
class Search extends Controller
{
 public function search()
    {
        $title=request()->param();
        $name=urldecode($title['name']);
        // return json($name);
        // return json($name);
        if($name!=null){
         $aboutModel=Loader::model('About');
         $aboutResult=$aboutModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'title'=>['like', "%".$name."%"]
             ])->limit(1)->select(); 
         if($aboutResult!=null){
            $this->redirect('/about.html');
            exit;
         }
         $honorModel=Loader::model('HonorPatent');
         $honorResult=$honorModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>['like', "%".$name."%"]
             ])->limit(1)->select();       
         if($honorResult!=null){
            $this->redirect('/honor.html');
            exit;
         }
         $showModel=Loader::model('LanShow');
         $showResult=$showModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select();
         if($showResult!=null){
            $this->redirect('/show.html');
            exit;
         }
         $newsModel=Loader::model('News');
         $newsResult=$newsModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select(); 
         if($newsResult!=null){
            $arr1=i_array_column($newsResult,'name');
            $name = str_replace(' ', '-', $arr1);
            $id=reset($name);
            $this->redirect('/newsn/'.$id.'.html');
            exit;
         } 
         $newsaModel=Loader::model('Newsa');
         $newsaResult=$newsaModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select(); 
         // return json($newsaResult);
         if($newsaResult!=null){
            $arr1=i_array_column($newsaResult,'name');
            $name = str_replace(' ', '-', $arr1);
            $name = str_replace('?', '_', $name);
           
            $this->redirect('/newsa/'.$id.'.html');
            exit;
         }
         $mainModel=Loader::model('Main');
         $mainResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select();  
         if($mainResult!=null){
            $arr1=i_array_column($mainResult,'name');
            $name = str_replace(' ', '-', $arr1);
            $name = str_replace('?', '_', $name);
            $id=reset($name);
            $this->redirect('/productl/'.$id.'.html');
            exit;
         }
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select();
         if($productResult!=null){
            $arr1=i_array_column($productResult,'name');
            $name = str_replace('/', '-l-', $arr1);
            $name = str_replace(' ', '-', $name);
            $name = str_replace('?', '_', $name);
            $id=reset($name);
            $this->redirect('/producta/'.$id.'.html');
            exit;
         }  
         $CasesModel=Loader::model('Cases');
         $CasesResult=$CasesModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select();
         if($CasesResult!=null){
            $arr1=i_array_column($CasesResult,'name');
            $name = str_replace(' ', '-', $arr1);
            $name = str_replace('?', '_', $name);
            $id=reset($name);
            // return json($id);
            $this->redirect('/solutiona/'.$id.'.html');
            exit;
         }else{
         echo "<script>alert('No relevant information');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";exit;
        }
     }else{  
         echo "<script>alert('Please input keywords.');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";exit;
     }
    }
}