<?php
namespace app\common\validate;

use think\Validate;

class Message extends Validate
{
    protected $rule = [
        "name|姓名" => "require",
        "email|邮箱" => "require",
    ];
}
