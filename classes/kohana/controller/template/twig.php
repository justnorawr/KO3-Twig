<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 *
 *
 *
 */

abstract class Kohana_Controller_Template_Twig extends Controller
{
	/**
	 * @var  string
	 */
	public $template = NULL;

	/**
	 * @var  boolean  auto render template
	 **/
	public $auto_render = TRUE;

	/**
	 * Loads the template view object
	 *
	  * @return	void
	 */
	public function before()
	{
		if ($this->auto_render === TRUE)
		{
			if ($this->template === NULL)
			{
				// Load the template
				$this->template = $this->template_name($this->request->controller(), $this->request->action());
			}
		}

		$this->template = Twig_View::factory($this->template);
	}

	/**
	 *
	 * @param	string		$controller
	 * @param	string		$action
	 * @return	void
	 */
	protected function template_name ($controller, $action)
	{
		$path	=	str_replace('controller_', '', strtolower($controller));
		$path	=	str_replace('_', '/', $path);
		$file	=	str_replace('action_', '', strtolower($action));

		return $path . '/' . $file;
	}

	/**
	 * Renders the template view object
	 *
	  * @return	void
	 */
	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			// add template contents to response body
			$this->response->body($this->template->render());
		}

		parent::after();
	}
}
