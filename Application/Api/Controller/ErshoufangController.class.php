<?php
namespace Api\Controller;
class ErshoufangController extends CommonController {
	/**
	 * @author Yanyuxuan
	 * @email    329944908@qq.com
	 * @DateTime 2018-05-03
	 * @return   [json]           [二手房首页除搜索条件外的数据]
	 */
	public function index(){
		$bannerModel = D('Banner');
		$bannerLists = $bannerModel->getLists();
		$findConditionModel = D('Findcondition');
		$houseModel =D('House');
		$tabModel = D('Tab');
		$house_imageModel= D('Houseimage');
		$house_type_id  = isset($_GET['type']) ?$_GET['type'] :'all';
		$orientation_id = isset($_GET['orientation']) ?$_GET['orientation'] :'all';
		$tab_id = isset($_GET['tab']) ?$_GET['tab'] :'all';
		$condition_str = 'type-'.$house_type_id.'orientation-'.$orientation_id.'tab-'.$tab_id;
		$ids = $findConditionModel->where(array('key'=>$condition_str))->getField('ids');
		$house_id_arr = explode(',', $ids);
		$where['id'] =array('in',$house_id_arr);
		$house_lists = $houseModel->getLists($where);
		// var_dump($houseModel->getLastSql());die();
		foreach ($house_lists as $key => $value) {
			$tabArr = $value['tab_id'];
			$tabArr = explode(',', $tabArr);
				$map['id']=array('in',$tabArr);
				$tab = $tabModel->where($map)->select();
				foreach ($tab  as $k => $v) {
					$tab[$k] = $v['name'];
				}
			$house_lists[$key] = $houseModel->format($value);
			$house_lists[$key]['tab']=$tab;
			$images=$house_imageModel->getImages($value['id']);
			$house_lists[$key]['image']=$images[0];
		}
		$hotpushModel =D('Hotpush');
		$hotpush = $hotpushModel->getLists();
		$result = array(
			'banner' => $bannerLists,
			'hotpush' =>$hotpush,
			'house_lists'=>$house_lists,
		);
		_res($result);
	}
	/**
	 * @author Yanyuxuan
	 * @email    329944908@qq.com
	 * @DateTime 2018-05-03
	 * @return   [json]           [搜索条件]
	 */
	public function condition(){
		$regionModel = D('Region');
		$house_typeModel= D('Housetype');
		$tabModel = D('Tab');
		$orientationModel = D('Orientation');
		$where = "id=4";
		$currentCity = $regionModel->getLists($where);
		var_dump($regionModel->getLastSql());die();
		// var_dump($currentCity);die();
		$where = "parent_id = {$currentCity[0]['id']}";
		$region = $regionModel->getLists($where);
		foreach ($region as $key => $value) {
			$region[$key] = $regionModel->format($value);
			$where = "parent_id = {$value['id']}";
			$region2 = $regionModel->getLists($where);
			foreach ($region2 as $k => $v) {
				$region2[$k] = $regionModel->format($v);
			}
			$region[$key]['region2'] = $region2;
		}
		$house_type = $house_typeModel->getLists();
		foreach ($house_type as $key => $value) {
			$house_type[$key] = $house_typeModel->format($value);
		}
		$tab = $tabModel->getLists();
		foreach ($tab as $key => $value) {
			$tab[$key] = $tabModel->format($value);
		}
		$orientation = $orientationModel->getLists();
		foreach ($orientation as $key => $value) {
			$orientation[$key] = $orientationModel->format($value);
		}
		$result = array(
			'region' => $region,
			'house_type' => $house_type,
			'orientation' => $orientation,
			'tab' => $tab,
		);
		_res($result);
	}
	/**
	 * @author Yanyuxuan
	 * @email    329944908@qq.com
	 * @DateTime 2018-05-03
	 * @param    [int]           $id [房屋id]
	 * @return   [type]               [description]
	 */
	public function info(){
		$id = $_GET['id'];
		if(isset($id)&&!empty($id)){
			$houseModel =D('House');
			$house_imageModel= D('Houseimage');
			$house_info = $houseModel->relation(true)->getInfoById($id);
			$house_info = $houseModel->format($house_info);
			$house_info['image_lists'] = $house_imageModel->where(array('house_id'=>$house_info['id']))->select();
			foreach ($house_info['image_lists'] as $key => $value) {
				$house_info['image_lists'][$key] = $house_imageModel->format($value);
			}
			$result = array(
				'house_info' => $house_info,
			);
			_res($result);
		}else{
			_res('参数错误',false,'1001');
		}
	}
}