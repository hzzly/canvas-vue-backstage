<?php
namespace Home\Controller;
use Think\Controller;
class BuyhouseController extends Controller {

    public function showlist(){

        $Buyhouse = M("Buyhouse");
        // $result = $Renthouse->select();
        $result = $Buyhouse->join('cd_user ON cd_buyhouse.uid = cd_user.uid')->order('id desc')->select();
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


    public function add(){

        $data['uid'] = $_POST['uid'];
        $data['htype'] = $_POST['htype'];
        $data['bprice'] = $_POST['bprice'];
        $data['jarea'] = $_POST['jarea'];
        $data['decoratetype'] = $_POST['decoratetype'];
        $data['haddress'] = $_POST['haddress'];
        $data['isbuy'] = $_POST['isbuy'];

        $Buyhouse = M('Buyhouse');
        $result = $Buyhouse->add($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '添加成功'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '添加失败'
            );
            $this->ajaxReturn($arr);
        }

    }

    public function search(){

        header("Content-type: text/html; charset=utf-8");

        $keyword = $_GET['keyword'];
        // $keyword = '两室一厅';

        if (is_numeric($keyword)) {
          $where['rprice|jarea']=array('like',"%".$keyword."%");
        } else {
          $where['htype|hadress']=array('like',"%".$keyword."%");
        }

        $Buyhouse = M('Buyhouse');
        $result = $Buyhouse->where($where)->join('cd_user ON cd_buyhouse.uid = cd_user.uid')->select();
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

    public function buy(){

        $where['id'] = $_GET['id'];

        $data['isbuy'] = 1;

        $Buyhouse = M('Buyhouse');
        $result = $Buyhouse->where($where)->save($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '已通知房主'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '购买失败'
            );
            $this->ajaxReturn($arr);
        }

    }

    public function delete(){

        $where['id'] = $_GET['id'];

        $Buyhouse = M('Buyhouse');
        $result = $Buyhouse->where($where)->delete();
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '删除成功'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '删除失败'
            );
            $this->ajaxReturn($arr);
        }

    }
}
