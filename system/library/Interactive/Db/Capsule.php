<?php
/**
 * Classe resposavel em criar o encapsulamento.
 * @author tiare
 *
 */
abstract class Interactive_Db_Capsule
{
	/**
	 * Inicializa os metodos set e get com a array passada como parametro na sua inicialização
	 * @param array $options
	 */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
	
    /**
     * Pega as variaveis do objeto
     */
  	public function getParams() {
        $parans = get_object_vars($this);
        
        foreach ($parans as $id=>$valor){
        	
        	$retorno[] = substr($id, 1);
        	
        }
        
        return $retorno;
    }
    
    /**
     * Defini os métodos set
     * @param string $name
     * @param string $value
     * @throws Exception
     */
	public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Metodo Invalido');
        }
        $this->$method($value);
    }
 
    /**
     * Defini os métodos get
     * @param string $name
     * @throws Exception
     */	
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Metodo Invalido');
        }
        return $this->$method();
    }
 
    /**
     * Defini os valores dos métodos
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }	
	
}