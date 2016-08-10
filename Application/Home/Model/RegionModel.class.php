<?php
namespace Home\Model;
use Think\Model;
class RegionModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应

    public function showProvinces(){
        $sql = "SELECT show_name,region_id FROM classoa_region WHERE region_type = 1 AND is_deleted = 0";
        return $this->query($sql);
    }

    public function showCities($parentId){
        $sql = "SELECT show_name,region_id FROM classoa_region WHERE parent_id = %d AND region_type = 2 AND is_deleted = 0";
        return $this->query($sql,$parentId);
    }

    public function showDistricts($parentId){
        $sql = "SELECT show_name,region_id FROM classoa_region WHERE parent_id = %d AND region_type = 3 AND is_deleted = 0";
        return $this->query($sql,$parentId);
    }

}

