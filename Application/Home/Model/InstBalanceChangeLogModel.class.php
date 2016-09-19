<?php
namespace Home\Model;
use Think\Model;
class InstBalanceChangeLogModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveLog($instId,$reason,$studentId,$payment){
        $sql = "insert into inst_balance_change_log($instId,$reason,$studentId,$payment) values(%d,%d,%d,%d)";
        return $this->execute($sql,$studentId,$reason,$classId,$payment);
    }

}
