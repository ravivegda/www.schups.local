<?php if (!defined('ROUTED_REQUEST')) exit;

define('BUSINESS_DIR', str_replace(basename(__FILE__), '', __FILE__));

/**
 * DataAPI is the API for all data manipulations
 *
 * @author Stefano
 */
class BusinessAPI
{
    private static $singleton_instance;

    /**
     * Constructor. It's private because of Singleton implementation
     * 
     */
    private function __construct()
    {
        require_once BUSINESS_DIR . '/system/BusinessIO.php';
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
            self::$singleton_instance = new BusinessAPI();
        }

        return self::$singleton_instance;
    }

    /**
     * Dummy method
     * 
     * @param BusinessIO $businessIO
     * @return BusinessIO
     */
    public function getUsername(BusinessIO $businessIO)
    {
        require_once './APIs/Data/DataAPI.php';
        $dataAPI = DataAPI::getInstance();

        // First call to the Data API, get user id for the specified token
        $dataIO_A = new DataIO();
        $dataIO_A->setInputValue('sessionToken', $businessIO->getInputValue('sessionToken'));
        $dataIO_A->sealInputs();

        $dataIO_A = $dataAPI->sessions_getDetailsForToken($dataIO_A);

        // Second call to the Data API, get user name for the specified user_id
        $dataIO_B = new DataIO();
        $dataIO_B->setInputValue('user_id', $dataIO_A->getOutputValue('user_id'));
        $dataIO_B->sealInputs();
        
        $dataIO_B = $dataAPI->user_getUsername($dataIO_B);
        
        // Return result
        $businessIO->setOutputValue('username', $dataIO_B->getOutputValue('username'));
        $businessIO->sealOutputs();
        
        return $businessIO;
    }
}
