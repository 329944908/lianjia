<?php
namespace Api\Model;
use Think\Model\RelationModel;
class BaseModel extends RelationModel{
	public function getInfoById($id){
			$info = $this->where("id= {$id}")->find();
			return $info;
	}
	public function getLists($where= array(),$offset=0,$pageSize=20,$order ='id asc'){
			$where['status'] =1;
			$data = $this->where($where)->order("{$order}")->relation(true)->limit($offset,$pageSize)->select();
			return $data;
	}
}
