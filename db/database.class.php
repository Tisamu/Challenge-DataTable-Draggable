<?php
//***********************//
//**Database Class in PDO**
//***********************//
require('identifier.php');

class Database{
  private $_host = DB_HOST;
  private $_user = DB_USER;
  private $_pass = DB_PASS;
  private $_dbname = DB_NAME;
  
  private $_dbh;
  private $_error;
  
  private $_stmt;
  
    public function __construct(){
        //Set Database Source Name (DSN)
        $dsn = 'mysql:host='.$this->_host.';dbname='.$this->_dbname;
        //Set Options
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //Create the PDO instance
        try{
            $this->_dbh = new PDO($dsn,$this->_user,$this->_pass, $options);
        } catch (PDOException $e) {
            $this->_error = $e->getMessage();
        }  
    }
    
    public function query($query){
        $this->_stmt = $this->_dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch (true) {
              case is_int($value):
                $type = PDO::PARAM_INT;
                break;
              case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
              case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
              default:
                $type = PDO::PARAM_STR;
            }
        }
        $this->_stmt->bindvalue($param,$value,$type);
    }
    
    public function execute(){
        return $this->_stmt->execute();
    }
    
    public function resultset(){
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function single(){
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rowCount(){
        return $this->_stmt->rowCount();
    }
    
    public function lastInsertId(){
        return $this->_dbh->lastInsertId();
    }
    
    public function beginTransaction(){
        return $this->_dbh->beginTransaction();
    }
    
    public function endTransaction(){
        return $this->_dbh->commit();
    }
    
    public function cancelTransaction(){
        return $this->_dbh->rollBack();
    }
    
    public function debugDumpParams(){
        return $this->_stmt->debugDumpParamas();
    }
  
  
}