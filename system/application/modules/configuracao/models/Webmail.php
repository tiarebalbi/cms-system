<?php

class Configuracao_Model_Webmail extends Interactive_Db_Capsule
{

	protected $_id;
	protected $_host;
	protected $_usuario;
	protected $_senha;
	protected $_porta;
	protected $_status;
	protected $_conta;
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @return the $_host
	 */
	public function getHost() {
		return $this->_host;
	}

	/**
	 * @param field_type $_host
	 */
	public function setHost($_host) {
		$this->_host = $_host;
	}

	/**
	 * @return the $_usuario
	 */
	public function getUsuario() {
		return $this->_usuario;
	}

	/**
	 * @param field_type $_usuario
	 */
	public function setUsuario($_usuario) {
		$this->_usuario = $_usuario;
	}

	/**
	 * @return the $_senha
	 */
	public function getSenha() {
		return $this->_senha;
	}

	/**
	 * @param field_type $_senha
	 */
	public function setSenha($_senha) {
		$this->_senha = $_senha;
	}

	/**
	 * @return the $_porta
	 */
	public function getPorta() {
		return $this->_porta;
	}

	/**
	 * @param field_type $_porta
	 */
	public function setPorta($_porta) {
		$this->_porta = $_porta;
	}

	/**
	 * @return the $_status
	 */
	public function getStatus() {
		return $this->_status;
	}

	/**
	 * @param field_type $_status
	 */
	public function setStatus($_status) {
		$this->_status = $_status;
	}
	/**
	 * @return the $_conta
	 */
	public function getConta() {
		return $this->_conta;
	}

	/**
	 * @param field_type $_conta
	 */
	public function setConta($_conta) {
		$this->_conta = $_conta;
	}


	
	

}

