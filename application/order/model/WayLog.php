<?php
namespace app\order\model;

use think\Model;
use think\Db;

class WayLog extends Model
{
	protected $table 	= 'way_log';
 	protected $pk 		= "id";


 	/**
	 * 
	 *查询所有出入口信息
	 * @return array();
	 */
 	public function getAllLog()
 	{
		return Db::query("SELECT * FROM (SELECT *,'in' AS type FROM way_log_in where status=0 UNION SELECT *,'out' AS type FROM way_log_out WHERE status=0) AS a ORDER BY a.user_id,a.create_time ASC");
 	}
 	/**
	 * 
	 *插入
	 * @param  (array())$data 待插入的数据
	 * @return (int);插入生成的主键
	 */
 	public function add($data){
 		return Db::name($this->table)->insertGetId($data);
 	}
}