<?php if (!defined('ROUTED_REQUEST')) exit;

class DataIO
{
    private $inputsSealed = false;
    private $outputSealed = false;
    
    private $inputValues = Array();
    private $outputValues = Array();
    
    private $errorCode = 0;
    private $errorValues = Array();
    
    /**
     * Saves an imput value
     * 
     * @param String $name
     * @param Object $value
     * 
     * @throws Exception
     */
    public function setInputValue($name, $value)
    {
        if ($this->isInputSealed() == true)
        {
            throw new Exception("The inputs have been sealed and they cannot be changed anymore!");
        }

        $this->inputValues[$name] = $value;
    }

    /**
     * Gets an input value
     * 
     * @param String $name
     * @return Object
     * 
     * @throws Exception
     */
    public function getInputValue($name)
    {
        if ($this->isInputSealed() == false)
        {
            throw new Exception("The inputs are not ready!");
        }

        return $this->inputValues[$name];
    }
    
    /**
     * Set an output value
     * 
     * @param String $name
     * @param Object $value
     * 
     * @throws Exception
     */
    public function setOutputValue($name, $value)
    {
        if ($this->isOutputSealed() == true)
        {
            throw new Exception("The outputs have been sealed and they cannot be changed anymore!");
        }

        $this->outputValues[$name] = $value;
    }

    /**
     * Get an output value
     * 
     * @param String $name
     * @return Object
     * 
     * @throws Exception
     */
    public function getOutputValue($name)
    {
        if ($this->isOutputSealed() == false)
        {
            throw new Exception("The outputs are not ready!");
        }

        return $this->outputValues[$name];
    }

    /**
     * Set an error code
     * 
     * @param Integer $code
     * 
     * @throws Exception
     */
    public function setErrorCode($code)
    {
        if ($this->isOutpuSealed() == true)
        {
            throw new Exception("The outputs have been sealed and the error cannot be changed anymore!");
        }

        $this->errorCode = $code;
    }
    
    /**
     * Set a value for the error (e.g. additional informations).
     * 
     * @param String $name
     * @param Object $value
     */
    public function setErrorValue($name, $value)
    {
        if ($this->isOutpuSealed() == true)
        {
            throw new Exception("The outputs have been sealed and the error cannot be changed anymore!");
        }
        
        $this->errorValues[$name] = $value;
    }

    /**
     * Get the error code
     * 
     * @return Integer Error code
     * 
     * @throws Exception
     */
    public function getErrorCode()
    {
        if ($this->isOutputSealed() == false)
        {
            throw new Exception("The outputs are not ready!");
        }

        return $errorCode;
    }

    /**
     * Seals the inputs. The object is ready to be passed to the API.
     * 
     * IMPORTANT:
     * - After this method is called no inputs can be set anymore.
     * - The inputs cannot be read before this method is called.
     * 
     * @return boolean
     */
    public function sealInputs()
    {
        $this->inputsSealed = true;

        return $this;
    }

    /**
     * Check if the inputs have been sealed
     * 
     * @return boolean
     */
    private function isInputSealed()
    {
        return $this->inputsSealed;
    }

    /**
     * Seals the outputs. The object is ready to be returned as a resoult of the API call.
     * 
     * IMPORTANT:
     * - After this method is called no ouputs can be set anymore.
     * - The outputs cannot be read before this method is called.
     * 
     * @return boolean
     */
    public function sealOutputs()
    {
        $this->outputSealed = true;

        return $this;
    }

    /**
     * Check if the outputs have been sealed
     * 
     * @return boolean
     */
    private function isOutputSealed()
    {
        return $this->outputSealed;
    }

}

