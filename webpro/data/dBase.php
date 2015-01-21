<?php

require_once APP_HOME . 'configs/config.php';

class dBase
{
    
    /**
     * 构造实例
     * @param string   $_host
     * @param int      $_port
     * @param string   $_user
     * @param string   $_pass
     * @param string   $_dbname
     * @param string   $_charset
     * @param resource $_link
     *
     */
    public $_host, $_port, $_user, $_pass, $_dbname, $_charset, $_link;
    
    public function __construct(){
        global $guestbookDBCfg;
        $this->_host    = $guestbookDBCfg['host'];
        $this->_user    = $guestbookDBCfg['user'];
        $this->_pass    = $guestbookDBCfg['pass'];
        $this->_dbname  = $guestbookDBCfg['dbName'];
        $this->_port    = $guestbookDBCfg['port'];
        $this->_charset = $guestbookDBCfg['charset'];
        $this->connect();
    }
	/**
     * execute query and return results
     *
     * @param string $sql
     * @return resource $result
     */
    public function query($sql){
    	$result = mysql_query($sql, $this->_link);
    	if(!$result) {
            throw new Exception(mysql_error($this->_link));
        }
        return $result;
    }
    
    /**
     * connect to the MySQL database
     *
     */
    public function connect(){
        $this->_link = mysql_connect($this->_host . ":" . $this->_port, $this->_user, $this->_pass);
        if (!$this->_link) {
            throw new Exception ("Cannot Connect to MySQL Server ..." . mysql_error());
        }
        if (!mysql_select_db ($this->_dbname, $this->_link)) {
            throw new Exception ( "Select db Error..." );
        }
        if($this->_charset) {
            $this->query("set names '" .$this->_charset . "'");
        }
    }
    
/**
     * execute query and return array result
     *
     * @param string $sql
     * @return array $res
     */
    public function fetchAll($sql = ''){
        if ($sql != '') {
            $result = mysql_query($sql,$this->_link);
        }
        if ($result) {
            $res = array ();
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $res [] = $row;
            }
            return $res;
        }
    }
    /**
     * 从结果集中取得一行
     * @param string $sql
     * @return array
     */
    public function fetchRow($sql = '', $type = 'mysql_fetch_row'){
    	if ($sql != '') {
    		$result = $this->query($sql);
    	}
    	if ($result) {
    		return $type($result);
    	}
    }
    
    /**
     * destructor (Close database connection)
     *
     */
    public function __destruct(){
        if ($this->_link) {
            @mysql_close($this->_link);
        }
    }
}