<?php
namespace app\common\validate;

use think\Validate;

class Head extends Validate
{
    protected $rule = [
        "title|导航名称" => "require",
        "img|页面Banner" => "require",
    ];
}
