<?php
namespace Api\Model;
class HousetypeModel extends BaseModel{
	protected $tableName = 'house_type';
	public function format($info){
		$data = array(
			'id'=>$info['id'],
			'name'=>$info['type']
			);
		return $data;
	}
}