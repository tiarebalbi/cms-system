<?php

final class Interactive_Security_Auth_Application {

	protected $_tabela;
	protected $_campoUsuario;
	protected $_campoSenha;
	protected $_tratamento;
	protected $_instancia;
	protected $_error;
	
	public function getError() {
		return $this->_error;
	}

	public function setError($_error) {
		$this->_error = $_error;
	}

	public function getInstancia() {
		return $this->_instancia;
	}

	public function setInstancia($_instancia) {
		$this->_instancia = $_instancia;
	}

	public function getTabela() {
		return $this->_tabela;
	}

	public function setTabela($_tabela) {
		$this->_tabela = $_tabela;
	}

	public function getCampoUsuario() {
		return $this->_campoUsuario;
	}

	public function setCampoUsuario($_campoUsuario) {
		$this->_campoUsuario = $_campoUsuario;
	}

	public function getCampoSenha() {
		return $this->_campoSenha;
	}

	public function setCampoSenha($_campoSenha) {
		$this->_campoSenha = $_campoSenha;
	}

	public function getTratamento() {
		return $this->_tratamento;
	}

	public function setTratamento($_tratamento) {
		$this->_tratamento = $_tratamento;
	}

	private function _isValid()
	{
		if(empty($this->_campoSenha)){
			$this->setError(array("Não foi definido o Campo Senha da tabela"));
			return false;
		}
		
		if(empty($this->_campoUsuario)){
			$this->setError(array("Não foi definido o Campo Usuário da tabela"));
			return false;
		}
		
		if(empty($this->_tabela)){
			$this->setError(array("Não foi definido a tabela de autenticação"));
			return false;
		}
		
		if(empty($this->_tratamento)){
			$this->setError(array("Nenhum tratamento da senha foi definido"));
			return false;
		}
		
		return true;
	}
	
	public function autenticar($usuario, $senha)
	{
		
		if($this->_isValid()){
			return $this->_processar($usuario, $senha);
		}
		
		return false;
	}
	
	
	private function _processar($usuario, $senha)
	{
		$adapter = $this->_getAuthAdapter();

		$adapter->setIdentity($usuario);
		$adapter->setCredential($senha);
		
		$auth = Zend_Auth::getInstance();
		
		if(!empty($this->_instancia)){
			$auth->setStorage(new Zend_Auth_Storage_Session($this->getInstancia()));
		}
		
		$result = $auth->authenticate($adapter);
		
		if ($result->isValid()) {

			$user = $adapter->getResultRowObject();
			$auth->getStorage()->write($user);
		
			return true;
		
		}
		
		switch ($result->getCode()) {
			case 0:
				$this->setError(array("ERRO#0 - Ocorreu uma falha na autenticação, por favor tente novamente"));
			break;
			case -1:
				$this->setError(array("ERRO#1 - Usuário não cadastrado"));
				break;
			case -2:
				$this->setError(array("ERRO#2 - Cadastro duplicado, por favor contate o setor administrativo"));
				break;
			case -3:
				$this->setError(array("ERRO#3 - Senha Incorreta"));
				break;
			case -4:
				$this->setError(array("ERRO#4 - Erro não identificado"));
				break;
			default:
				$this->setError(array("ERRO#5" . $result->getMessages()));
			break;
		}
		
		
		return false;
	}
	
	private function _getAuthAdapter() {
	
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
	
		$authAdapter->setTableName($this->getTabela())
				    ->setIdentityColumn($this->getCampoUsuario())
					->setCredentialColumn($this->getCampoSenha())
					->setCredentialTreatment($this->getTratamento());
	
		return $authAdapter;
	}
	
}

?>