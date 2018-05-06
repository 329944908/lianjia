<?php
namespace Api\Model;
use Think\Model\RelationModel;
class HouseModel extends BaseModel{
	protected $_link = array(
		'Orientation' => array(
			    'mapping_type'  => self::BELONGS_TO,
			    'class_name'    => 'Orientation',
			    'foreign_key'   => 'orientation_id',
			    'as_fields' => 'name:orientation',
			    'mapping_name'  => 'orientation',
		),
		'Type' => array(
			    'mapping_type'  => self::BELONGS_TO,
			    'class_name'    => 'Housetype',
			    'foreign_key'   => 'house_type_id',
			    'as_fields' => 'type:type',
			    'mapping_name'  => 'type',
		),
	);
	public function format($info){
		$data = array(
			'id'=>$info['id'],
			'title'=>$info['title'],
			'type'=>$info['type'],
			'area'=>$info['area'],
			'orientation'=>$info['orientation'],
			'xiaoqu'=>$info['xiaoqu'],
			'unit_price'=>$info['unit_price'],
			);
		return $data;
	}

}