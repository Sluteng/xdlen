<?php
namespace app\common\validate;

use think\Validate;

class Company extends Validate
{
    protected $rule = [
        "email|邮箱" => "require",
        "url|联系地址" => "require",
    ];
}
