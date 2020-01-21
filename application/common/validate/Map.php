<?php
namespace app\common\validate;

use think\Validate;

class Map extends Validate
{
    protected $rule = [
        "url|地址" => "require",
    ];
}
