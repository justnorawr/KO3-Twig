<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default' => array
	(
	 	'suffix'		=>	'twig',

		'environment' => array
		(
			'debug'               	=>	TRUE,
			'trim_blocks'         	=>	TRUE,
			'charset'             	=>	'utf-8',
			'base_template_class' 	=>	'Twig_Template',
			'cache'               	=>	MODPATH.'twig/cache',
			'auto_reload'         	=>	TRUE,
			'strict_variables'	=>	TRUE,

			'syntax' => array
			(
				'tag_block'    		=>	array('{%', '%}'),
				'tag_comment' 	=>	array('{#', '#}'),
				'tag_variable'		=>	array('{{', '}}'),
			)
		),

		'extensions' => array
		(

		),
	)
);
