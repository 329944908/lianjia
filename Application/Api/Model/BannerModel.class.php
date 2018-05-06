<?php
namespace Api\Model;
class BannerModel extends BaseModel{
	public function addBann(){
		$data = array('image'=>1,'url'=>'2');
		$this->add($data);
	}
}