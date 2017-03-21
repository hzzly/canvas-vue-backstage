<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

    public function showlist(){

      $User = M("User"); // 实例化User对象
      $result = $User->select();
      if ($result) {
        $arr = array(
            'success'=> true,
            'data'=> $result
        );
        $this->ajaxReturn($arr);
      } else {
        $arr = array(
            'success'=> false,
            'data'=> '查询失败'
        );
        $this->ajaxReturn($arr);
      }
    }

    public function updatauser(){

        $where['uid'] = $_POST['id'];

        $data['username'] = $_POST['username'];
        $data['idcard'] = $_POST['idcard'];
        $data['bdate'] = $_POST['bdate'];
        $data['sex'] = $_POST['sex'];
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['address'] = $_POST['address'];

        $User = M("User"); // 实例化User对象
        $result = $User->where($where)->save($data);
        if ($result) {
          $arr = array(
              'success'=> true,
              'data'=> $result
          );
          $this->ajaxReturn($arr);
        } else {
          $arr = array(
              'success'=> false,
              'data'=> '修改失败'
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


    // public function updatauser(){
    //
    //     $where['id'] = $_POST['id'];
    //
    //     $data['username'] = $_POST['username'];
    //     $data['idcard'] = $_POST['idcard'];
    //     $data['bdate'] = $_POST['bdate'];
    //     $data['sex'] = $_POST['sex'];
    //     $data['email'] = $_POST['email'];
    //     $data['phone'] = $_POST['phone'];
    //     $data['address'] = $_POST['address'];
    //
    //     $User = M("User"); // 实例化User对象
    //     $result = $User->where($where)->save($data);
    //     if ($result) {
    //       $arr = array(
    //           'success'=> true,
    //           'data'=> $result
    //       );
    //       $this->ajaxReturn($arr);
    //     } else {
    //       $arr = array(
    //           'success'=> false,
    //           'data'=> '修改失败'
    //       );
    //       $this->ajaxReturn($arr);
    //     }
    // }


    public function updatapassword(){

        $where['id'] = $_POST['id'];

        $data['password'] = md5($_POST['password']);

        $User = M('User');
        $result = $User->where($where)->save($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> $result
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '修改失败'
            );
            $this->ajaxReturn($arr);
        }

    }
}
