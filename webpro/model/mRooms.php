<?php

require_once APP_HOME . 'data/dRooms.php';
require_once APP_HOME . 'model/mBase.php';

class mRooms extends mBase
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
	/**
     * 构造函数
     * @return void
     */
	private function __construct(){
		$this->db = new dRooms();
	}
	/**
     * creates/references model class instance
     *
     * @return object
     */
    public static function getInstance()
    {
        if (!self::$dbInstance) {
            self::$dbInstance = new mRooms();
        }
        return self::$dbInstance;
    }
    /**
	 * Get All Rooms
	 * @return
	 */
    public function fetchAllRoom(){
    	return $this->db->fetchAllRoom();
    }
	
	public function getSingle($id){
    	return $this->db->getSingle($id);
    }
    /**
	 * Insert An Room
	 * @return void
	 */
    public function insertRoom($name){
    	$this->db->insertRoom($name);
    }
}
?>