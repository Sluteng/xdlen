<?php
 function SendMail($address,$name,$message){
        vendor ('phpmailer.phpmailer.src.PHPMailer');
        // require_once("PHPMailer.php");
         require_once('PHPMailer.php');
         require_once('SMTP.php');
        // require_once("SMTP.php");
        $mail = new PHPMailer();
         // 设置PHPMailer使用SMTP服务器发送Email
        $mail->IsSMTP();
        // 设置邮件的字符编码，若不指定，则为'UTF-8'
        $mail->CharSet='UTF-8';
        // 添加收件人地址，可以多次使用来添加多个收件人
        $mail->AddAddress($address);
        // 设置邮件正文
        $mail->Body=$message;
        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From='2389193245@qq.com';
        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName=$name;
        // 设置邮件标题
        $mail->Subject=$address;
        // 设置SMTP服务器。
        $mail->Host='smtp.qq.com';
        // 设置为"需要验证"
        $mail->SMTPAuth=true;
        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username='2389193245';
        //smtp登录的密码 使用生成的授权码 你的最新的授权码
        $mail->Password='xqiyvdvqfeiyecia';
        // 发送邮件。    成功返回true或false
       return($mail->Send());
    }