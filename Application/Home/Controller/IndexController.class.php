<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //http://localhost/thinkphp/index.php/home/index/text
    public function index(){

        $where['uid'] = $_POST['uid'];
        $User = M("User"); // 实例化User对象
        $data = $User->where($where)->find();
        $this->ajaxReturn($data);
    }
    //
    // public function text() {
    // 	$arr = array(
    // 		'name'=> 'hzzly',
    // 		'age'=> 21
    // 	);
    // 	echo json_encode($arr);
    // }
}
