<?php if (!defined('ROUTED_REQUEST')) exit;

define('DATA_DIR', str_replace(basename(__FILE__), '', __FILE__));

/**
 * DataAPI is the API for all data manipulations
 *
 * @author Stefano
 */
class DataAPI
{
    private static $singleton_instance;

    /**
     * Constructor. It's private because of Singleton implementation
     * 
     */
    private function __construct()
    {
        require_once DATA_DIR . '/system/DataIO.php';
    }

    /**
     * Return the single instance of this API
     * 
     * @return DataAPI
     */
    public static function getInstance()
    {
        if (self::$singleton_instance == null)
        {
            self::$singleton_instance = new DataAPI();
        }

        return self::$singleton_instance;
    }

    /**
     * Dummy method
     * 
     * @param DataIO $dataIO
     * @return DataIO
     */
    public function sessions_getDetailsForToken(DataIO $dataIO)
    {
        if ($dataIO->getInputValue('sessionToken') == '0cc175b9c0f1b6a831c399e269772661')
        {
            $dataIO->setOutputValue('user_id', 5);
        }
        else
        {
            $dataIO->setErrorCode(10003); // Not found error
        }
        
        return $dataIO->sealOutputs();
    }
    
    /**
     * Dummy method: Return the textual username for a user_id
     * 
     * @param DataIO $dataIO
     * @return DataIO
     */
    public function user_getUsername(DataIO $dataIO)
    {
        if ($dataIO->getInputValue('user_id') == 4)
        {
            $dataIO->setOutputValue('username', "Schups");
        }
        else if ($dataIO->getInputValue('user_id') == 5)
        {
            $dataIO->setOutputValue('username', "Ravi");
        }
        else
        {
            $dataIO->setErrorCode(10003); // Not found error
        }
        
        return $dataIO->sealOutputs();
    }
}
