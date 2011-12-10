<?php

class Configuracao_Model_Usuarios extends Interactive_Db_Capsule
{

	protected $_id;
	protected $_nome;
	protected $_email;
	protected $_login;
	protected $_senha;
	protected $_salt;
	protected $_hash;
	protected $_nascimento;
	protected $_grupo;
	protected $_status;
	protected $_foto; 
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @return the $_nome
	 */
	public function getNome() {
		return $this->_nome;
	}

	/**
	 * @return the $_email
	 */
	public function getEmail() {
		return $this->_email;
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
	 * @return the $_salt
	 */
	public function getSalt() {
		return $this->_salt;
	}

	/**
	 * @return the $_hash
	 */
	public function getHash() {
		return $this->_hash;
	}

	/**
	 * @return the $_nascimento
	 */
	public function getNascimento() {
		return $this->_nascimento;
	}

	/**
	 * @return the $_grupo
	 */
	public function getGrupo() {
		return $this->_grupo;
	}

	/**
	 * @return the $_status
	 */
	public function getStatus() {
		return $this->_status;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @param field_type $_nome
	 */
	public function setNome($_nome) {
		$this->_nome = $_nome;
	}

	/**
	 * @param field_type $_email
	 */
	public function setEmail($_email) {
		$this->_email = $_email;
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
	 * @param field_type $_salt
	 */
	public function setSalt($_salt) {
		$this->_salt = $_salt;
	}

	/**
	 * @param field_type $_hash
	 */
	public function setHash($_hash) {
		$this->_hash = $_hash;
	}

	/**
	 * @param field_type $_nascimento
	 */
	public function setNascimento($_nascimento) {
		$this->_nascimento = $_nascimento;
	}

	/**
	 * @param field_type $_grupo
	 */
	public function setGrupo($_grupo) {
		$this->_grupo = $_grupo;
	}

	/**
	 * @param field_type $_status
	 */
	public function setStatus($_status) {
		$this->_status = $_status;
	}
	/**
	 * @return the $_foto
	 */
	public function getFoto() {
		return $this->_foto;
	}

	/**
	 * @param field_type $_foto
	 */
	public function setFoto($_foto) {
		$this->_foto = $_foto;
	}


	
}