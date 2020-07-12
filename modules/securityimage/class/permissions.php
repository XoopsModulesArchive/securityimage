<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
if (!defined("XOOPS_ROOT_PATH")) {
	die("XOOPS root path not defined");
}

class SecurityImagePermissionHandler extends XoopsObjectHandler
{
    function getCount($criteria = null)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->db->prefix('group_permission');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
        }
        $result = $this->db->query($sql);
        if (!$result) {
            return 0;
        }
        list($count) = $this->db->fetchRow($result);
        return $count;
    }

    function checkRight($gperm_name, $gperm_itemid, $gperm_groupid, $gperm_modid = 1)
    {
        $criteria = new CriteriaCompo(new Criteria('gperm_modid', $gperm_modid));
        $criteria->add(new Criteria('gperm_name', $gperm_name));
        $gperm_itemid = intval($gperm_itemid);
        if ($gperm_itemid > 0) {
            $criteria->add(new Criteria('gperm_itemid', $gperm_itemid));
        }
        if (is_array($gperm_groupid)) {
//			if (in_array(XOOPS_GROUP_ADMIN, $gperm_groupid)) {
//                return true;
//            }
            $criteria2 = new CriteriaCompo();
            foreach ($gperm_groupid as $gid) {
                $criteria2->add(new Criteria('gperm_groupid', $gid), 'OR');
            }
            $criteria->add($criteria2);
        } else {
//            if (XOOPS_GROUP_ADMIN == $gperm_groupid) {
//                return true;
//            }
            $criteria->add(new Criteria('gperm_groupid', $gperm_groupid));
        }
        if ($this->getCount($criteria) > 0) {
            return true;
        }
        return false;
    }

}
?>