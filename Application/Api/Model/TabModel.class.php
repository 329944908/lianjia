<?php
namespace Api\Model;
class TabModel extends BaseModel{
	public function format($info){
		$data = array(
			'id'=>$info['id'],
			'name'=>$info['name']
			);
		return $data;
	}
}