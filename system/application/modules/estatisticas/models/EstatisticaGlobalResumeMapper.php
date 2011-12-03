<?php

class Estatisticas_Model_EstatisticaGlobalResumeMapper extends Interactive_Db_Mapper implements Interactive_Db_Implements_Mapper
{
	public function __construct($params = NULL) {
		
		$this->_dbTable = $this->_setDbTable("Estatisticas_Model_DbTable_EstatisticaGlobalResume");
		
		if(!empty($params)){
			$this->_params = $params;
		}
		
		if(empty($this->_params)){
			$objeto = new Estatisticas_Model_EstatisticaGlobalResume();
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

		return $this->_fetchAll($this->_params, "Estatisticas_Model_EstatisticaGlobalResume", $where, $ordem, $limite);
		
	}
	



}

