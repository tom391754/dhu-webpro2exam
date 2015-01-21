<?php

require_once APP_HOME . 'controller/Controller.php';
require_once APP_HOME . 'model/mRooms.php';
session_start();


class Index extends Controller
{
	/**
	 * The unified entrance program
	 * @return void
	 */
	public function run(){
		$db = mRooms::getInstance();
		$resultArray = $db->fetchAllRoom();
		$this->assign('title', 'Starter Template for Bootstrap');
		$this->assign('resultArray', $resultArray);
        $this->display('index.html');
	}
}
?>