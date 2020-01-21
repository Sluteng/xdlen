<?php
namespace app\common\validate;

use think\Validate;

class Main extends Validate
{
    protected $rule = [
        "name|产品标题" => "require",
    ];
}
