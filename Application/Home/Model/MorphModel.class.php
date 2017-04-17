<?php
namespace Home\Model;
use Think\Model;
class MorphModel extends Model {
    protected $connection = 'DB_CONFIG2';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
	
    public function showWordsByMorpheme($morphemeId){
        $sql = "SELECT ww.* FROM wiki_word_root_rela wwrr LEFT JOIN wiki_word ww ON wwrr.word_id=ww.id WHERE wwrr.word_root_id=%d order by ww.word asc";
        return $this->query($sql,$morphemeId);
    }
	
	public function showMorphemeById($morphemeId){
        $sql = "select id,word_root,meaning,origin from wiki_word_root where id = %d";
        return $this->query($sql,$morphemeId);
    }

    public function showMorphemeByCapital($capital){
        $sql = "select id,word_root,meaning,origin from wiki_word_root where capital_letter = '%s'";
		return $this->query($sql,$capital);
    }
}

