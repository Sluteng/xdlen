<?php
namespace app\common\validate;

use think\Validate;

class Aboutus extends Validate
{
    protected $rule = [
        "img|缩略图" => "require",
        "editorValue|内容" => "require",
    ];
}
