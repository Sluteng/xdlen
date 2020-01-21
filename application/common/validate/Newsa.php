<?php
namespace app\common\validate;

use think\Validate;

class Newsa extends Validate
{
    protected $rule = [
        "titles|标题" => "require",
    ];
}
