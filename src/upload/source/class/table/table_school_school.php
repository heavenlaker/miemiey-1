
<?php

/**
 *      [Miemiey] (C)2012-2099 Miemiey.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_school_school.php  $
 *      $author: heavenlaker $
 *      $for: ���������ĳ־û�����صĲ�ѯ����  $
 *      
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_school_school extends discuz_table
{
	public function __construct() {

		$this->_table = 'school_school';
		$this->_pk    = 'id';

		parent::__construct();
	}

	/**
	 * @param  enum('apply','audited','closed') $status
	 * @param string $orderby �����ַ���
	 * @return multitype:unknown ���ݼ�
	 */
	public function fetch_all_by_status($status, $orderby = 1) {
		$status = $status ? 1 : 0;
		$ordersql = $orderby ? 'ORDER BY t.dateline desc' : '';
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." t WHERE t.status='$status' $ordersql");
	}
	/**
	 * @param string $name 
	 */
	public function fetch_all_by_name($name) {
		// ģ��ƥ��fullname �� shortname
		return DB::result_first("SELECT * FROM %t WHERE fullname like %s or ", array($this->_table, $name));  //�ַ�����ʽ����
	}
	/**
	 * @param int $fid 빿�ID
	 * @return multitype:unknown 
	 */
	public function fetch_all_by_fid($fid) {
		return DB::fetch_all("SELECT * FROM %t WHERE fid =%s", array($this->_table, $fid));
	}
	
	/**
	 * @param string $ids ��������ID�б�
	 * @return multitype:unknown 
	 */
	public function fetch_all_by_id($ids) {
		return DB::fetch_all("SELECT * FROM %t WHERE id IN(%n)", array($this->_table, (array)$ids), $this->_pk);
	}
	/**
	 * @param unknown_type $ids
	 * @return boolean
	 */
	public function delete_by_id($ids) {
		if(empty($ids)) {
			return false;
		}
		DB::query("DELETE FROM ".DB::table($this->_table)." WHERE %i", array(DB::field('id', $ids)));
	}
	/**
	 * @param int $id ��������ID
	 * @param enum('apply','audited','closed')  $status ״̬
	 */
	public function update_status_by_fup($id, $status) {
		DB::query("UPDATE ".DB::table($this->_table)." SET status=%s WHERE id=%i", array($status, $id));
	}

}

?>