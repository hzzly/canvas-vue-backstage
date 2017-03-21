<?php
namespace Home\Controller;
use Think\Controller;
class RenthouseController extends Controller {

    public function showlist(){

        $Renthouse = M("Renthouse"); //实例化Renthouse
        // $result = $Renthouse->select();
        $result = $Renthouse->join('cd_user ON cd_renthouse.uid = cd_user.uid')->order('id desc')->select();
        if ($result) {
          $arr = array(
              'success'=> true,
              'data'=> $result
          );
          $this->ajaxReturn($arr);  //返回json数据
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
        $data['rprice'] = $_POST['rprice'];
        $data['jarea'] = $_POST['jarea'];
        $data['decoratetype'] = $_POST['decoratetype'];
        $data['hadress'] = $_POST['hadress'];
        $data['isrent'] = $_POST['isrent'];

        $Renthouse = M('Renthouse');
        $result = $Renthouse->add($data);
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

    public function delete(){

        $where['id'] = $_GET['id'];

        $Renthouse = M('Renthouse');
        $result = $Renthouse->where($where)->delete();
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

    public function search(){

        header("Content-type: text/html; charset=utf-8");

        $keyword = $_GET['keyword'];
        // $keyword = '两室一厅';

        if (is_numeric($keyword)) {
          $where['rprice|jarea']=array('like',"%".$keyword."%");
        } else {
          $where['htype|hadress']=array('like',"%".$keyword."%");
        }

        $Renthouse = M('Renthouse');
        $result = $Renthouse->where($where)->join('cd_user ON cd_renthouse.uid = cd_user.uid')->select();
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

    public function rent(){

        $where['id'] = $_GET['id'];

        $data['isrent'] = 1;

        $Renthouse = M('Renthouse');
        $result = $Renthouse->where($where)->save($data);
        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> '已通知房主'
            );
            $this->ajaxReturn($arr);
        } else {
            $arr = array(
                'success'=> false,
                'data'=> '求租失败'
            );
            $this->ajaxReturn($arr);
        }

    }
}
