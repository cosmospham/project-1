<?php
class Application_Model_Result extends Zend_Db_Table_Abstract
{
    protected $_name = 'result';

    public function random()
    {
        $db = Zend_Registry::get('db');
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->_name;
        $res = $db->query($sql);
        $res = $res->fetch();

        if ($res) {
            $have_gift = isset($res['total']) ? $res['total'] : 0;

            if ($total >= TOTAL)
                return false;
        }

        $sql = 'SELECT COUNT(id) AS total FROM user';
        $res = $db->query($sql);
        $res = $res->fetch();

        if ($res) {
            $total_user = isset($res['total']) ? $res['total'] : 0;

            if ( rand( 1, ($total_user-$have_gift) ) <= (TOTAL - $have_gift) )
                return true;
        }

        return false;
    }
}