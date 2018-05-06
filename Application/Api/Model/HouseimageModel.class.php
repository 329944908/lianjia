<?php
namespace Api\Model;
class HouseimageModel extends BaseModel{
	protected $tableName = 'house_image';
	public function format($info){
		$data = array(
			'image'=>$info['image']
			);
		return $data;
	}
	/**
	 * @author Yanyuxuan
	 * @email    329944908@qq.com
	 * @DateTime 2018-05-04
	 * @param    [int]           $id [房屋id]
	 * @return   [array]               [图片数组]
	 */
	public function getImages($id){
		$images = $this->where(array('house_id'=>$id))->getField('image',true);
		return $images;
	}
}