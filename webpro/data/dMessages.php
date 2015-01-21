<?php 

require_once 'dBase.php';


class dMessages extends dBase
{
	/**
	 * get All Message
	 * @return void
	 */
	public function fetchAllMessage($roomID){
		$sql = 'select id,room_id,content,send_at from messages where room_id='.$roomID;
		$resultArray = $this->fetchAll($sql);
		return $resultArray;
	}
	/**
	 * get New Message
	 * @return void
	 */
	public function fetchNewMessage($roomID,$msgID){
		$sql = 'select id,room_id,content,send_at from messages where room_id='.$roomID.' and id > '.$msgID;
		$resultArray = $this->fetchAll($sql);
		return $resultArray;
	}
	/**
	 * insert a message
	 * @param int $room_id
	 * @param string $content
	 * @param string $time
	 */
	public function insertMessage($room_id,$content,$time){
		$sql = "insert into messages(room_id,content,send_at) values(" . $room_id . ",'" . $content . "','" . $time ."')";
		$this->query($sql);
		return;
	}
}
?>