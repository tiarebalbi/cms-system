<?php

class Configuracao_Model_Analytics extends Interactive_Db_Capsule
{
	protected $_id;
	protected $_login;
	protected $_senha;
	protected $_profile;
	protected $_account;
	protected $_webProfile;
	protected $_titulo;
	protected $_updated;
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @return the $_login
	 */
	public function getLogin() {
		return $this->_login;
	}

	/**
	 * @return the $_senha
	 */
	public function getSenha() {
		return $this->_senha;
	}

	/**
	 * @return the $_profile
	 */
	public function getProfile() {
		return $this->_profile;
	}

	/**
	 * @return the $_account
	 */
	public function getAccount() {
		return $this->_account;
	}

	/**
	 * @return the $_webProfile
	 */
	public function getWebProfile() {
		return $this->_webProfile;
	}

	/**
	 * @return the $_titulo
	 */
	public function getTitulo() {
		return $this->_titulo;
	}

	/**
	 * @return the $_updated
	 */
	public function getUpdated() {
		return $this->_updated;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @param field_type $_login
	 */
	public function setLogin($_login) {
		$this->_login = $_login;
	}

	/**
	 * @param field_type $_senha
	 */
	public function setSenha($_senha) {
		$this->_senha = $_senha;
	}

	/**
	 * @param field_type $_profile
	 */
	public function setProfile($_profile) {
		$this->_profile = $_profile;
	}

	/**
	 * @param field_type $_account
	 */
	public function setAccount($_account) {
		$this->_account = $_account;
	}

	/**
	 * @param field_type $_webProfile
	 */
	public function setWebProfile($_webProfile) {
		$this->_webProfile = $_webProfile;
	}

	/**
	 * @param field_type $_titulo
	 */
	public function setTitulo($_titulo) {
		$this->_titulo = $_titulo;
	}

	/**
	 * @param field_type $_updated
	 */
	public function setUpdated($_updated) {
		$this->_updated = $_updated;
	}

	
}

