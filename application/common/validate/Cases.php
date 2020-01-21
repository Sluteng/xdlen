<?php
namespace app\common\validate;

use think\Validate;

class Cases extends Validate
{
    protected $rule = [
        "name|案例名称" => "require",
    ];
}
