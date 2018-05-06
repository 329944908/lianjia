<?php
namespace Api\Model;
class OrientationModel extends BaseModel{
	public function format($info){
		$data = array(
			'id'=>$info['id'],
			'name'=>$info['name']
			);
		return $data;
	}
}