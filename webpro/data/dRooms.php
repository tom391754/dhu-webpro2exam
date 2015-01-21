<?php 

require_once 'dBase.php';

class dRooms extends dBase
{
	/**
	 * get All rooms
	 * @return void
	 */
	public function fetchAllRoom(){
		$sql = 'select id,name from rooms ';
		$resultArray = $this->fetchAll($sql);
		return $resultArray;
	}
	public function getSingle($id){
		$sql = 'select name from rooms where id='.$id;
		$resultArray = $this->fetchAll($sql);
		return $resultArray;
	}
	/**
	 * insert an room
	 * @param int $room_id
	 * @param string $content
	 */
	public function insertRoom($name){
		$sql = "insert into rooms(name) values('" . $name ."')";
		$this->query($sql);
		return;
	}
}
?>