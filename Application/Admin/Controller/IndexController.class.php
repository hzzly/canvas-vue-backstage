<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	//http://localhost/thinkphp/index.php/admin/index/index
  public function index(){

      $where['id'] = $_POST['id'];
      $Admin = M("Admin"); // 实例化User对象
      $data = $Admin->where($where)->find();
      $this->ajaxReturn($data);
  }
}
