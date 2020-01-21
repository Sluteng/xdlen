<?php
namespace app\common\model;

use think\Model;

class LanShow extends Model
{
    // 指定表名,不含前缀
    protected $name = 'Lan_show';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
}
