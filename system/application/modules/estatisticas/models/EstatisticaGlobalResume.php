<?php

class Estatisticas_Model_EstatisticaGlobalResume extends Interactive_Db_Capsule
{

	protected $_id;
	protected $_mes;
	protected $_ano;
	protected $_visitas;
	protected $_novas;
	protected $_pageview;
	protected $_profile;
	
	/**
	 * @return the $_profile
	 */
	public function getProfile() {
		return $this->_profile;
	}

	/**
	 * @param field_type $_profile
	 */
	public function setProfile($_profile) {
		$this->_profile = $_profile;
	}

	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @return the $_mes
	 */
	public function getMes() {
		return $this->_mes;
	}

	/**
	 * @return the $_ano
	 */
	public function getAno() {
		return $this->_ano;
	}

	/**
	 * @return the $_visitas
	 */
	public function getVisitas() {
		return $this->_visitas;
	}

	/**
	 * @return the $_novas
	 */
	public function getNovas() {
		return $this->_novas;
	}

	/**
	 * @return the $_pageview
	 */
	public function getPageview() {
		return $this->_pageview;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @param field_type $_mes
	 */
	public function setMes($_mes) {
		$this->_mes = $_mes;
	}

	/**
	 * @param field_type $_ano
	 */
	public function setAno($_ano) {
		$this->_ano = $_ano;
	}

	/**
	 * @param field_type $_visitas
	 */
	public function setVisitas($_visitas) {
		$this->_visitas = $_visitas;
	}

	/**
	 * @param field_type $_novas
	 */
	public function setNovas($_novas) {
		$this->_novas = $_novas;
	}

	/**
	 * @param field_type $_pageview
	 */
	public function setPageview($_pageview) {
		$this->_pageview = $_pageview;
	}


}

