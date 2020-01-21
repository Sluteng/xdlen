<?php
namespace app\common\validate;

use think\Validate;

class Navber extends Validate
{
    protected $rule = [
        "name|导航名称" => "require",
        "href|链接" => "require",
    ];
}
