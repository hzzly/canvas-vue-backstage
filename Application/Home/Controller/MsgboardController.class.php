<?php
namespace Home\Controller;
use Think\Controller;
class MsgboardController extends Controller {

  public function showlist(){
      $Msgboard = M("Msgboard");

      $result = $Msgboard->join('cd_user ON cd_msgboard.uid = cd_user.uid')->order('id desc')->select();

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

    public function addmsgboard(){
        $Msgboard = M("Msgboard");

        $data['uid'] = $_POST['uid'];
        $data['content'] = $_POST['content'];
        $data['time'] = time();

        $result = $Msgboard->add($data);

        if ($result) {
            $arr = array(
                'success'=> true,
                'data'=> $result
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

        $Msgboard = M("Msgboard");
        $result = $Msgboard->where($where)->delete();
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
