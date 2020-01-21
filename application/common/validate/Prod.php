<?php
namespace app\common\validate;

use think\Validate;

class Prod extends Validate
{
    protected $rule = [
        "content|产品简介" => "require",
    ];
}
