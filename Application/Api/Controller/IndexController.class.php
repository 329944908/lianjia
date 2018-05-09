<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
      public function findCondition(){
            $houseModel =D('House');
            $findConditionModel = D('Findcondition');
            $houses =  $houseModel->where(array('status'=>1))->select();
            $arr= array();
            foreach ($houses as $key => $value) {
             	$tabs = explode(',', $value['tab_id']);
                  $types = $value['house_type_id'];
                  $orientations = $value['orientation_id'];
                  $tabs = array_merge(array('all'), $tabs);
                  $types = array('all', $types);
                  $orientations = array('all', $orientations);
                  foreach ($types as $type) {
                        foreach ($orientations as $orientation) {
                              foreach ($tabs as $tab) {
                                    $str = 'type-'.$type.'orientation-'.$orientation.'tab-'.$tab;
                                    $id = $value['id'];
                                    $arr[$str][] =  $id;
                              }
                        }
                  }
            }
            $oldKeys = $findConditionModel->select();
            foreach ($oldKeys as $key => $value) {
                  $oldKeysTmp[$value['key']] = $value['ids'];
            }
            //var_dump($oldKeysTmp);
            foreach ($arr as $key => $value) {
                  $data['key'] = $key;
                  $data['ids'] = implode(',', $value);
                  if(!empty($oldKeysTmp[$key])){
                        if($oldKeysTmp[$key]==$data['ids']){
                              continue;
                        }else{
                           $res = $findConditionModel->where(array('key'=>$key))->setField('ids',$data['ids']); 
                        }
                        //从数组中删除已经更新的索引
                        unset($oldKeysTmp[$key]);  
                  }else{
                        $res = $findConditionModel->add($data);
                  }
            }
                       // var_dump($oldKeysTmp);
            // foreach ($oldKeysTmp as $k1 => $v1) {
            //       $res = $findConditionModel->where(array('key'=>$k1))->delete();
            // }
            //遍历剩下的无用索引 进行删除操作

      }
}