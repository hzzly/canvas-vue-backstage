<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function login(){

        $where['username'] = $_POST['username'];

        $User = M("User"); // 实例化User对象
        $result = $User->where($where)->find();
        if ($result && $result['password'] == md5($_POST['password'])) {
          session('username', $result['username']);
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


    public function register(){

        $data['username'] = $_POST['username'];
        $data['phone'] = $_POST['phone'];
        $data['password'] = md5($_POST['password']);

        $User = M('User');
        $result = $User->add($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '注册成功'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '注册失败'
            );
            $this->ajaxReturn($arr);
        }

    }
}
