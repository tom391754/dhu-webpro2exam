<?php

require_once APP_HOME . 'data/dMessages.php';
require_once APP_HOME . 'model/mBase.php';

class mMessages extends mBase
{
	/**
     * instance of model object
     *
     * @var object
     */
    private static $dbInstance; 
    /**
     * DB Object
     * @var object
     */
    public $db;

	private function __construct(){
		$this->db = new dMessages();
	}
	/**
     * creates/references model class instance
     *
     * @return object
     */
    public static function getInstance()
    {
        if (!self::$dbInstance) {
            self::$dbInstance = new mMessages();
        }
        return self::$dbInstance;
    }
    /**
	 * Get All Messages
	 * @return
	 */
    public function fetchAllMessage($roomID){
    	return $this->db->fetchAllMessage($roomID);
    }
	/**
	 * Get New Messages
	 * @return
	 */
    public function fetchNewMessage($roomID,$msgID){
    	return $this->db->fetchNewMessage($roomID,$msgID);
    }
    /**
	 * Insert a message
	 * @return void
	 */
    public function insertMessage($room_id,$content,$time){
    	$this->db->insertMessage($room_id,$content,$time);
    }
}
?>