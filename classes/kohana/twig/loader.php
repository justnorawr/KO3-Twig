<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 *
 *
 *
 */

class Kohana_Twig_loader extends Twig_Loader_Filesystem
{
	/**
	 * Returns true if the template is still fresh.
	 *
	 * @param	string		The template name
	 * @param	timestamp	The last modification time of the cached template
	 * @return	string		Filepath to template
	 */
	protected function findTemplate($name)
	{
		// normalize name
		$name = preg_replace('#/{2,}#', '/', strtr($name, '\\', '/'));

		if (isset($this->cache[$name])) {
			return $this->cache[$name];
		}

		$this->validateName($name);

		// File details
		$file = pathinfo($name);

		// Full path to the file.
		$path = Kohana::find_file('views', $file['dirname'].DIRECTORY_SEPARATOR.$file['filename'], $file['extension']);

		if (FALSE === $path)
		{
			throw new RuntimeException(sprintf('Unable to find template "%s".', $name));
		}

		return $this->cache[$name] = $path;
	}
}
