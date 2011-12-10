<?php

class Interactive_Install_Database {

	
	private $_file;
	
	private $_error;
	
	public function __construct()
	{
		$this->_file = APPLICATION_PATH . '/configs/database.xml';
	}
	
	public function create($host, $username, $pass, $database, $adapter)
	{
		$config = new Zend_Config(array(), true);
		$config->production = array();
		$config->staging    = array();
		
		$config->setExtend('staging', 'production');
		
		$config->production->webhost = $host;
		$config->production->database = array();
		$config->production->database->adapter  = $adapter;
		$config->production->database->params   = array();
		$config->production->database->params->username = $username;
		$config->production->database->params->password = $pass;
		$config->production->database->params->dbname   = $database;
		
		$config->staging = array();
	
		$writer = new Zend_Config_Writer_Xml();
		$writer->write($this->_file, $config);
	}
	
	public function connect($instance = 'production')
	{
		$config = new Zend_Config_Xml($this->_file, $instance);
		
		try{
		
			$db = Zend_Db::factory($config->database);
			$db->getConnection();
			
			Zend_Db_Table_Abstract::setDefaultAdapter($db);
		
			$registry = Zend_Registry::getInstance();
			$registry->set('db', $db);
			
			$config = array(
					'name'           => 'sys_session',
					'primary'        => 'id',
					'modifiedColumn' => 'modificado',
					'dataColumn'     => 'informacoes',
					'lifetimeColumn' => 'lifetime'
			);
			
			Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($config));
			Zend_Session::start();
			
			return true;
			
		}catch( Exception $e){
		
			$this->setErro($e->getMessage());
			
			return false;
		}
	}
	
	public function getConfig($instance = 'production')
	{
		$config = new Zend_Config_Xml($this->_file, $instance);
		return $config;
	}
	
	public function test($host, $username, $pass, $database, $adapter)
	{
		try{
			
			$db = Zend_Db::factory('Pdo_Mysql', array(
					'host'     => $host,
					'username' => $username,
					'password' => $pass,
					'dbname'   => $database
			));
			$db->getConnection();
			
			return true;
			
		}catch(Zend_Db_Adapter_Exception $e){
			
			$this->setErro($e->getMessage());
			
			return false;
		}
	}
	
	public function install()
	{
		//TODO pega todos os arquivos .SQL dentro do diretorio "library/Interactive/Install/sql" e executa! 
	}
	
	
	public function getErro()
	{
		return $this->_error;
	}
	
	public function setErro($erro)
	{
		$this->_error = $erro;
	}
}