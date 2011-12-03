<?php

class Configuracao_Model_AnalyticsMapper extends Interactive_Db_Mapper implements Interactive_Db_Implements_Mapper
{

	public function __construct($params = NULL) {
		
		$this->_dbTable = $this->_setDbTable("Configuracao_Model_DbTable_Analytics");
		
		if(!empty($params)){
			$this->_params = $params;
		}
		
		if(empty($this->_params)){
			$objeto = new Configuracao_Model_Analytics();
			$this->_params = $objeto->getParams();
		}
		
	}

	public function salvar($objeto) {
		return $this->_insert($this->_params, $objeto, array("id = ?"=>$objeto->getId()));
	}

	public function excluir($condicao) {
		return $this->_delete($condicao);
	}

	public function consultaLinha($condicao) {
		return $this->_fetchRow($condicao);
	}

	public function consultaTabela($where = NULL, $ordem = NULL, $limite = NULL) {
		return $this->_fetchAll($this->_params, "Configuracao_Model_Analytics", $where, $ordem, $limite);
	}

}

