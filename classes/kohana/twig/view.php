<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 *
 *
 *
 */

abstract class Kohana_Twig_View extends View
{
	/**
	 *
	 * @var		Twig
	 */
	protected $Twig;

	/**
	 *
	 *
	 * @param	string		$file
	 * @param	string		$data
	 * @return 	Twig_View
	 */
	public static function factory($file = NULL, array $data = NULL)
	{
		return new Twig_View($file, $data);
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function __construct ($file=NULL, array $data=NULL)
	{
		$this->Twig = Twig::instance();

		parent::__construct($file, $data);
	}

	/**
	 *
	 *
	 * @param	string 		$kohana_view_filename
	 * @param	array 		$kohana_view_data
	 * @return	string
	 * @users	ARR::merge
	 */
	protected static function capture($kohana_view_filename, array $kohana_view_data)
	{
		$TwigHelper = Twig::instance()->helper();

		$data = ARR::merge($kohana_view_data, Twig_View::$_global_data);

		return $TwigHelper ->render($kohana_view_filename, $data);
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function set_filename($file)
	{
		$ext = $this->Twig->config['suffix'];
		if ($ext === NULL) {
			$this->_file = $file;
		} else {
			$this->_file = $file.'.'.$ext;
		}

		return $this;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function render($file = NULL)
	{
		if ($file !== NULL)
		{
			$this->set_filename($file);
		}

		if (empty($this->_file))
		{
			throw new Kohana_View_Exception('You must set the file to use within your view before rendering');
		}

		// Combine local and global data and capture the output
		return Twig_View::capture($this->_file, $this->_data);
	}
}
