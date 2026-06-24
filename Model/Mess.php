<?php
namespace Model;
use HY\Model;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class Mess extends Model {
    public function read($id){
        //{hook m_mess_read_1}
        return $this->get_row($id);
    }
    public function get_row($id,$name = '*'){
        //{hook m_mess_get_row_1}
        return $this->find($name,['id'=>$id]);
    }
    public function set_state($id){
        //{hook m_mess_set_state_1}
        return $this->update(['view'=>1],['id'=>$id]);
    }
    //{hook m_mess_fun}
}
