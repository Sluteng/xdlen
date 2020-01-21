<?php
namespace app\common\validate;

use think\Validate;

class Show extends Validate
{
    protected $rule = [
        "img|缩略图" => "require",
        "titles|主题" => "require",
    ];
}
