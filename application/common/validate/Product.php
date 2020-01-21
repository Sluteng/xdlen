<?php
namespace app\common\validate;

use think\Validate;

class Product extends Validate
{
    protected $rule = [
        "titles|产品标题" => "require",
        "name|产品名称" => "require",
    ];
}
