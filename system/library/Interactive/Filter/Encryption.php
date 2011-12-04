<?php
/**
 * Class com função de criar Criptografia de dados
 * @author tiare
 * @version 1.0
 */
class Interactive_Filter_Encryption {

	/**
	 * Vetor para criação da Criptografia
	 * @var string
	 */
	private static $_VETOR = "aW@3cW23";
	
	/**
	 * Chave para criação da Criptografia
	 * @var string
	 */
	private static $_CHAVE = "jn4qi32A";
	
	/**
	 * Cria a Criptografia
	 * @param string $valor
	 * @return string
	 */
	public function encrypt($valor)
	{
		$filter = new Zend_Filter_Encrypt();
		$filter->setEncryption(array('key' => self::$_CHAVE));
		$filter->setVector(self::$_VETOR);
		return $filter->filter($valor);
	}
	
	/**
	 * Cria a Decriptografia
	 * @param string $valor
	 * @return string
	 */
	public function decrypt($valor)
	{
		$filter = new Zend_Filter_Decrypt();
		$filter->setEncryption(array('key' => self::$_CHAVE));
		$filter->setVector(self::$_VETOR);
		return $filter->filter($valor);
	}
}

?>