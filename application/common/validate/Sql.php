<?php
namespace app\common\validate;

use think\Validate;

class Sql extends Validate
{
    protected $rule = [
        "title|数据库名称" => "require",
        "url|备份地址" => "require",
    ];
}
