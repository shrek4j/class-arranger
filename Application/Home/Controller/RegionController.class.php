<?php
namespace Home\Controller;
use Think\Controller;
class RegionController extends Controller {

    public function showCities($provinceId){
        $regionModel = new \Home\Model\RegionModel();
        $cities = $regionModel->showCities($provinceId);
        for($i=0;$i<count($cities);$i++){
            $regionId = $cities[$i]['region_id'];
            $showName = $cities[$i]['show_name'];
            $data .= $regionId.":".$showName.";";
        }
        $this->ajaxReturn($data);
    }

    public function showDistricts($cityId){
        $regionModel = new \Home\Model\RegionModel();
        $districts = $regionModel->showDistricts($cityId);
        for($i=0;$i<count($districts);$i++){
            $regionId = $districts[$i]['region_id'];
            $showName = $districts[$i]['show_name'];
            $data .= $regionId.":".$showName.";";
        }
        $this->ajaxReturn($data);
    }

}