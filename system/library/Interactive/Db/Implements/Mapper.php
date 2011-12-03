<?php

/**
 * Interface para aplicação padrão do mapper
 */
interface Interactive_Db_Implements_Mapper {
	
	public function __construct($params = NULL);
	
	public function salvar($objeto);
	
	public function excluir($condicao);
	
	public function consultaLinha($condicao);
	
	public function consultaTabela($where = NULL, $ordem = NULL, $limite = NULL);
	
}

?>