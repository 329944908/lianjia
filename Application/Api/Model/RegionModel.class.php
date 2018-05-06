<?php
namespace Api\Model;
class RegionModel extends BaseModel{
	public function getLists($where){
			$data = $this->where("{$where}")->select();
			return $data;
	}
	public function format($info){
		$data = array(
			'id'=>$info['id'],
			'name'=>$info['name']
			);
		return $data;
	}
}