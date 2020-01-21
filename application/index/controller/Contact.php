<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
/**
     * tp5邮件
     * @param
     * @author staitc7 <static7@qq.com>
     * @return mixed
     */
class Contact extends Controller
{
    public function contact()
    {   
    require_once('Base.php');
    $abouthResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>6
        ])->limit(1)->select();
    $title= i_array_column($abouthResult,'name');
    $head = reset($title);
    $hewdModel=Loader::model('Head');
    $headResult=$hewdModel->where([
            'isdelete'=>0,
            'status'=>1,
            'title'=>$head
        ])->limit(1)->select();
      if (request()->isPost()){
       $data = input('post.');
       $validate = validate('Message');
       if (!$validate->batch()->check($data)) {
         $error = $validate->getError();
         $this->error(implode(',',$error));
       }else{
        $center = model('Message');
        $center->data($data,true);
        $result = $center->allowField(true)->save();
        $name=$data['name'];
        $email=$data['email'];
        $content='<p><span style="font-weight:bold; font-size:14px; padding-right:10px;">Tel:</span>'.$data['tel'].'</p>'.'<p><span style="font-weight:bold; font-size:14px;padding-right:10px;">Add:</span>'.$data['url'].'</p>'.'<p><span style="font-weight:bold; font-size:14px;padding-right:10px;">Message Content:</span>'.$data['content'].'</p>';
        $res = $this->SendMail($email,$name,$content);
        if(!$res && !$result){
            echo "<script>alert('Message submission failed');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";exit;
        }else{
            echo "<script>alert('Message submitted successfully');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";exit;
        }
       }   
    }
    return $this->view->fetch('',[
      'abouthResult'=>$abouthResult,
      'headResult'=>$headResult,
           ]);
    }
    function SendMail($address,$name,$message){
        vendor ('phpmailer.phpmailer.src.PHPMailer'); 
        require_once('PHPMailer/PHPMailer.php');
        require_once('PHPMailer/SMTP.php');
        $mail = new PHPMailer\PHPMailer();
         // 设置PHPMailer使用SMTP服务器发送Email
        $mail->IsSMTP(); // 启用SMTP
        // 设置邮件的字符编码，若不指定，则为'UTF-8'
        $mail->CharSet='UTF-8';
       //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
        $mail->Port=465;//----  -----qq邮箱需要的------
        //---------qq邮箱需要的------//设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure='ssl';
        // 添加收件人地址，可以多次使用来添加多个收件人
        $mail->AddAddress('hbxdl@hbxinpower.com');
        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);
        // 设置邮件正文
        $mail->Body=$message;
        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From='hbxdl@hbxinpower.com';
        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName=$name;
        // 设置邮件标题
        $mail->Subject=$address;
        // 设置SMTP服务器。
        $mail->Host='ssl://smtp.exmail.qq.com';
        // 设置为"需要验证"
        $mail->SMTPAuth=true;
        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username='hbxdl@hbxinpower.com';
        //smtp登录的密码 使用生成的授权码 你的最新的授权码
        $mail->Password='Hb*6783109';
        // 发送邮件。    成功返回true或false
       return($mail->Send());
    }
}  