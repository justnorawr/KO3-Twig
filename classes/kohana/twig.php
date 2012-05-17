<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Helper class allows for Twig configuration via Kohana config files
 *
 * @package	Kohana-Twig
 * @author	Nicholas Curtis	<nich.curtis@gmail.com>
 */

abstract class Kohana_Twig
{
	/**
	 * @var 	array
	 */
	public static $instances = array();

	/**
	 * @var 	Twig_Environment
	 */
	protected $twig_helper;

	/**
	 * @var 	array
	 */
	public $config;

	/**
	  * Loads instance of twig for config group passed
	  *
	  * @param 	string 		$config_group
	  * @return 	Twig
	  */
	public static function instance ($config_group='default')
	{
		if (in_array($config_group, self::$instances))
		{
			return self::$instances[$config_group];
		}

		if ($config = Kohana::$config->load('twig'))
		{
			if ($config->$config_group)
			{
				self::$instances[$config_group] = new Twig($config[$config_group]);
				return self::$instances[$config_group];
			}
		}

		throw new Kohana_Exception('Invalid group for Twig configuration', array(':config_group' => $config_group));
	}

	/**
	  * Takes configuration and loads Twig environment / extensions
	  *
	  * @param 	array 		$config
	  * @return 	void
	  */
	private function __construct (array $config)
	{
		$this->config = $config;

		$loader = new Twig_Loader(APPPATH.'views');

		$this->twig_helper = new Twig_Environment($loader, $this->config['environment']);

		if (count($this->config['extensions']) > 0)
		{
			foreach ($this->config['extensions'] AS $extension)
			{
				// verify that class exists and then load extensions
				if (class_exists($extension))
					$this->twig->addExtension(new $extension);
			}
		}
	}

	/**
	 * Returns instance of Twig Environment
	 *
	 * @return	Twig_Enviornment
	 */
	public function helper ()
	{
		return $this->twig_helper;
	}
}
