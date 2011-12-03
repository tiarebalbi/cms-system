<?php
/**
 * Class responsavel em auxiliar o mapeamento da tabela e funções basicas
 * de inserção, exclusão e alteração. 
 * 
 * @author tiare
 * @category Zend_Model_Abstract
 */
abstract class Interactive_Db_Mapper
{
	/**
	 * Parametro que armazena temporariamente a instancia da tabela. 
	 * @var object
	 */
    protected $_dbTable;
    
    /**
     * Parametros que serão utilizado no mapeamento das tabelas
     * @var array
     */
    protected $_params;
    
    /**
     * É responsavel em definir o adaptador a ser usado.
     * @param String $dbTable
     * @throws Exception
     */
    protected function _setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Adaptador invalido');
        }
        $this->_dbTable = $dbTable;
        return $this->_dbTable;
    }
 
    /**
     * Class que retorn o objeto temporario armazenado
     */
    protected function _getDbTable()
    {
        return $this->_dbTable;
    }    	

    /**
     * Função responsavel em montar o objeto a ser enviado para o database
     * Essa funcão ficará responsavel em gerar os Inserts e os Updates
     * @param Array $campos = Informações que deveram ser mapiadas
     * @param Object $objeto = Objeto que contem o encapsulamento
     * @param Array $condicao = condição do UPDATE
     * @throws Zend_Db_Adapter_Exception Exception referente a base de dados
     */
    protected function _insert($campos, $objeto, $condicao)
    {

    	$info = array();
    	
    	foreach ($campos as $item){
    		$metodo = 'get' . ucfirst($item);
    		$info[$item] = $objeto->$metodo();
    	}
    	
    	try{
    		
	    	if(empty($info['id']) || !isset($info['id'])){
	    		return $this->_getDbTable()->insert($info);
	    	}else{
	    		return $this->_getDbTable()->update($info, $condicao);
	    	}
	    	
    	}catch (Zend_Db_Adapter_Exception $e){
    		
    		throw new Exception($e->getMessage());
    		
    	}
    	
    }
    
    /**
     * Função para a listagem dos conteudos cadastrados
     * @param Array $campos = array com nomes dos itens que deveram ser mapiados
     * @param String $nameObjeto = nome da instancia que deverá ser criado
     * @param Array|String $where = Array com condições para a listagem
     * @param Array|String $ordem = Array com condições para a ordenação
     */
    
    protected function _fetchAll($campos, $nameObjeto, $where, $ordem, $limite)
    {
    	
    	$resultado = $this->_getDbTable()->fetchAll($where, $ordem, $limite);
   		$info = array();
   		
		foreach ($resultado as $valor){
			$objeto = new $nameObjeto();
			foreach ($campos as $opcao){
				$metodo = 'set' . ucfirst($opcao);
				$objeto->$metodo($valor->$opcao);
			}
			
			$info[] = $objeto;
		}

		return $info;
    }
    
    
    /**
     * Função responsavel em fazer a pesquisa da informação
     * @param Array $condicao
     */
    protected function _fetchRow($condicao)
    {
		$row = $this->_getDbTable()->fetchRow($condicao);
    	if($row){
    		return $row->toArray();
    	}
    	
    	return null;
    }
    
    protected function _delete($condicao)
    {
    	return $this->_getDbTable()->delete($condicao);
    }
}