<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $bannerModel = D('Banner');
       $bannerModel->addBann();
    }
}