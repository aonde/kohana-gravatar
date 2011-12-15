<?php defined('SYSPATH') or die('No direct script access.');

abstract class  Gravatar extends Kohana_Gravatar {
    

	/**
	 * Gravatar constructor
	 *
	 * @param   string       email   the Gravatar to fetch for email address
	 * @param   string       config  the name of the configuration grouping
	 * @param   array        config  array of key value configuration pairs
	 * @access  public
	 * @throws  Kohana_Gravatar_Exception
	 */
	protected function __construct($email, $config = NULL)
	{
	   
		// Set the email address
		$this->email = $email;

		if (empty($config))
		{
			// v3.1 $this->_config = Kohana::config('gravatar.default');
            $this->_config = Kohana::$config->load('gravatar')->default;
		}
		elseif (is_array($config))
		{
			// Setup the configuration
			// v3.1 $config += Kohana::config('gravatar.default');
            $config += Kohana::$config->load('gravatar')->default;
            
			$this->_config = $config;
		}
		elseif (is_string($config))
		{
			// v3.1 if ($config = Kohana::config('gravatar.'.$config) === NULL)
            if ($config = Kohana::$config->load('gravatar.')->$config === NULL)
			{
				throw new Kohana_Gravatar_Exception('Gravatar.__construct() , Invalid configuration group name : :config', array(':config' => $config));
			}

			$this->_config = $config + Kohana::config('gravatar.default');
		}
	}
    
}