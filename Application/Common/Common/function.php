<?php
/**
 * @author Yanyuxuan
 * @email    329944908@qq.com
 * @DateTime 2018-04-22
 * @param    [type]           $data       [数据]
 * @param    boolean          $flag       [是否成功]
 * @param    integer          $error_code [错误码]
 * 输出一个json格式数据                     
 */
	function _res($data,$flag=true,$error_code=0){
		$result = array(
			"error_code"=>$error_code,
			"message"   =>'success',
			"data"      =>array(),     
			);
		if($flag){
			$result['data'] = $data;
		}else{
			$result['message'] = $data;
		}
		echo json_encode($result);
		die();
	}