<?php

require_once APP_HOME . 'controller/Controller.php';
require_once APP_HOME . 'model/mMessages.php';
require_once APP_HOME . 'model/mRooms.php';
session_start();

class Messages extends Controller
{

	public function run(){
	
		if(isset($_REQUEST['action'])){
			if($_REQUEST['action'] == 'init'){
				$this->init();
			}else if($_REQUEST['action'] == 'insert'){
				$this->insert();
			}else if($_REQUEST['action'] == 'getAllMsg'){
				$this->getAllMsg();
			}else if($_REQUEST['action'] == 'getNewMsg'){
				$this->getNewMsg();
			}
		}else{
			$this->display('index.html');
		}
		
	}
	public function insert(){
		$db = mMessages::getInstance();
		
		$content = '';
		$room = 0;
		$time = '';
		
		if(!get_magic_quotes_gpc()){
			$content = isset($_POST['content']) ? addslashes($_POST['content']) : '';
			$room = isset($_POST['room']) ? addslashes($_POST['room']) : 0;
			$time = isset($_POST['time']) ? addslashes($_POST['time']) : '';
		}
		if($content != ''){
			$db->insertMessage($room,$content,$time);
		}
		//$this->pubRedirect('index');
		echo 'success';
	}
	public function init(){
		if(!get_magic_quotes_gpc()){ 
			$room = isset($_GET['room']) ? addslashes($_GET['room']) : '';
			echo '<input type=\'hidden\' id=\'room\' value=\''.$room .'\'></input>';
			if(!is_numeric($room)) {
				$this->pubRedirect('index');
				return ;
			}
			/*Room Info*/
			$dbRoom = mRooms::getInstance();
			$resultRoomArray = $dbRoom->getSingle($room);
			//print_r($resultRoomArray);
			$this->assign('name', $resultRoomArray[0]['name']);
			//echo $resultRoomArray[0]['name'];
			/*Message Info*/
			$db = mMessages::getInstance();
			$resultArray = $db->fetchAllMessage($room);
			$this->assign('title', 'Starter Template for Bootstrap');
			$this->assign('resultArray', $resultArray);
			$this->display('messages.html');
		} else {
			$this->pubRedirect('index');
		}
	}
	public function getAllMsg(){
		if(!get_magic_quotes_gpc()){ 
			$room = isset($_POST['room']) ? addslashes($_POST['room']) : 0;
			if(!is_numeric($room)) {
				echo 'error.';
				return ;
			}
			/*Message Info*/
			$db = mMessages::getInstance();
			$resultArray = $db->fetchAllMessage($room);
			//echo $room.':'.sizeof($resultArray);
			echo json_encode($resultArray);
		} else {
			echo 'error.';
		}
	}
	public function getNewMsg(){
		if(!get_magic_quotes_gpc()){ 
			$room = isset($_POST['room']) ? addslashes($_POST['room']) : 0;
			$msgID = isset($_POST['msgID']) ? addslashes($_POST['msgID']) : 0;
			if(!is_numeric($room)||!is_numeric($msgID)) {
				echo 'error.';
				return ;
			}
			/*Message Info*/
			$db = mMessages::getInstance();
			$resultArray = $db->fetchNewMessage($room,$msgID);
			echo json_encode($resultArray);
		} else {
			echo 'error.';
		}
	}
}
?>