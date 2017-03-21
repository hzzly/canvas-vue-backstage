<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function login(){

        $where['username'] = $_POST['username'];
        $where['unumber'] = $_POST['userid'];

        $Admin = M("Admin");
        $result = $Admin->where($where)->find();
        if ($result && $result['password'] == md5($_POST['password'])) {
          session('username', $result['username']);
          session('unumber', $result['unumber']);
          $arr = array(
              'success'=> true,
              'data'=> $result
          );
          $this->ajaxReturn($arr);
        } else {
          $arr = array(
              'success'=> false,
              'data'=> '登录失败'
          );
          $this->ajaxReturn($arr);
        }

    }


    public function addadmin(){

        $data['username'] = $_POST['username'];
        $data['unumber'] = $_POST['unumber'];
        $data['password'] = md5($_POST['password']);

        $Admin = M('Admin');
        $result = $Admin->add($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '添加管理员成功'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '添加管理员失败'
            );
            $this->ajaxReturn($arr);
        }

    }
}
