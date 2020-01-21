<?php
namespace app\admin\controller\honor;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Patent extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("titles")) {
            $map['titles'] = ["like", "%" . $this->request->param("titles") . "%"];
        }
    }
}
