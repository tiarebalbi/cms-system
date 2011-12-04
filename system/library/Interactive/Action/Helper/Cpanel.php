<?php
/**
 *
 * @author tiare
 * @version 1.0
 */
/**
 * Cpanel Action Helper 
 * 
 * @uses actionHelper Interactive_Action_Helper
 */
class Interactive_Action_Helper_Cpanel extends Zend_Controller_Action_Helper_Abstract {
	/**
	 * @var Zend_Loader_PluginLoader
	 */
	public $pluginLoader;
	
	/**
	 * @var Configuracao_Model_Webmail
	 */
	private $_config;
	
	/**
	 * Constructor: initialize plugin loader
	 * 
	 * @return void
	 */
	public function __construct() {
		// TODO Auto-generated Constructor
		$this->pluginLoader = new Zend_Loader_PluginLoader ();
		
		$config = new Configuracao_Model_WebmailMapper();
		$this->_config = $config->consultaLinha(array("status = ?"=>true));
		
	}
	
	/**
	 * Strategy pattern: call helper as broker method
	 */
	public function direct() {
		
	}
	
	public function getContas()
	{
		$cpanel = new Interactive_Api_Cpanel($this->_config["host"]);
		$cpanel->password_auth($this->_config["usuario"], $this->_config["senha"]);
		$cpanel->set_output("json");
		$cpanel->set_debug(0);
		
		$info = $cpanel->api2_query($this->_config["conta"], "Email", "listpopswithdisk");
		
		return Zend_Json::decode($info);
	}
	
	public function getDominio()
	{
		return $this->_config["dominio"];
	}
	
	public function criarConta($usuario, $senha, $espaco)
	{
		$cpanel = new Interactive_Api_Cpanel($this->_config["host"]);
		$cpanel->password_auth($this->_config["usuario"], $this->_config["senha"]);
		$cpanel->set_output("json");
		$cpanel->set_debug(0);
		
		$info = $cpanel->api2_query($this->_config["conta"], "Email", "addpop", 
				array("domain"=>$this->_config["dominio"],"email"=>$usuario, 
					  "password"=>$senha, "quota"=>$espaco));
		
		return Zend_Json::decode($info);
	}
	
	public function editarSenhaConta($novaSenha, $usuario, $dominio)
	{
		$cpanel = new Interactive_Api_Cpanel($this->_config["host"]);
		$cpanel->password_auth($this->_config["usuario"], $this->_config["senha"]);
		$cpanel->set_output("json");
		$cpanel->set_debug(0);
		
		$info = $cpanel->api2_query($this->_config["conta"], "Email", "passwdpop", 
				array("domain"=>$this->_config["dominio"],"email"=>$usuario, "password"=>$novaSenha));
		
		return Zend_Json::decode($info);
	}
	
	public function editarEspacoConta($novaEspaco, $usuario, $dominio)
	{
		$cpanel = new Interactive_Api_Cpanel($this->_config["host"]);
		$cpanel->password_auth($this->_config["usuario"], $this->_config["senha"]);
		$cpanel->set_output("json");
		$cpanel->set_debug(0);
	
		$info = $cpanel->api2_query($this->_config["conta"], "Email", "editquota", 
				array("domain"=>$this->_config["dominio"],"email"=>$usuario, "quota"=>$novaEspaco));
		
		return Zend_Json::decode($info);
	}
	
	public function excluirConta($usuario)
	{
		$cpanel = new Interactive_Api_Cpanel($this->_config["host"]);
		$cpanel->password_auth($this->_config["usuario"], $this->_config["senha"]);
		$cpanel->set_output("json");
		$cpanel->set_debug(0);
		
		$info = $cpanel->api2_query($this->_config["conta"], "Email", "delpop", 
				array("domain"=>$this->_config["dominio"],"email"=>$usuario));
		
		return Zend_Json::decode($info);
	}
	
}
