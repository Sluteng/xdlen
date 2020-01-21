<?php
namespace app\common\validate;

use think\Validate;

class About extends Validate
{
    protected $rule = [
        "title|标题" => "require",
        "editorValue|内容" => "require",
    ];
}
