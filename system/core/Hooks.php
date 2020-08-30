<<<<<<< HEAD
<<<<<<< HEAD
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Hooks Class
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hooks Class
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 *
 * Provides a mechanism to extend the base system without hacking.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/encryption.html
=======
 * @link		https://codeigniter.com/user_guide/general/hooks.html
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/general/hooks.html
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_Hooks {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Determines wether hooks are enabled
	 *
	 * @var bool
	 */
	var $enabled		= FALSE;
	/**
	 * List of all hooks set in config/hooks.php
	 *
	 * @var array
	 */
	var $hooks			= array();
	/**
	 * Determines wether hook is in progress, used to prevent infinte loops
	 *
	 * @var bool
	 */
	var $in_progress	= FALSE;

	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		$this->_initialize();
		log_message('debug', "Hooks Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize the Hooks Preferences
	 *
	 * @access	private
	 * @return	void
	 */
	function _initialize()
	{
		$CFG =& load_class('Config', 'core');

		// If hooks are not enabled in the config file
		// there is nothing else to do

		if ($CFG->item('enable_hooks') == FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Determines whether hooks are enabled
	 *
	 * @var	bool
	 */
	public $enabled = FALSE;

	/**
	 * List of all hooks set in config/hooks.php
	 *
	 * @var	array
	 */
	public $hooks =	array();

	/**
	 * Array with class objects to use hooks methods
	 *
	 * @var array
	 */
	protected $_objects = array();

	/**
	 * In progress flag
	 *
	 * Determines whether hook is in progress, used to prevent infinte loops
	 *
	 * @var	bool
	 */
	protected $_in_progress = FALSE;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$CFG =& load_class('Config', 'core');
		log_message('info', 'Hooks Class Initialized');

		// If hooks are not enabled in the config file
		// there is nothing else to do
		if ($CFG->item('enable_hooks') === FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return;
		}

		// Grab the "hooks" definition file.
<<<<<<< HEAD
<<<<<<< HEAD
		// If there are no hooks, we're done.

		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/hooks.php'))
		{
		    include(APPPATH.'config/'.ENVIRONMENT.'/hooks.php');
		}
		elseif (is_file(APPPATH.'config/hooks.php'))
=======
		if (file_exists(APPPATH.'config/hooks.php'))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (file_exists(APPPATH.'config/hooks.php'))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			include(APPPATH.'config/hooks.php');
		}

<<<<<<< HEAD
<<<<<<< HEAD

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/hooks.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/hooks.php');
		}

		// If there are no hooks, we're done.
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! isset($hook) OR ! is_array($hook))
		{
			return;
		}

		$this->hooks =& $hook;
		$this->enabled = TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Call Hook
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Calls a particular hook
	 *
	 * @access	private
	 * @param	string	the hook name
	 * @return	mixed
	 */
	function _call_hook($which = '')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Calls a particular hook. Called by CodeIgniter.php.
	 *
	 * @uses	CI_Hooks::_run_hook()
	 *
	 * @param	string	$which	Hook name
	 * @return	bool	TRUE on success or FALSE on failure
	 */
	public function call_hook($which = '')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->enabled OR ! isset($this->hooks[$which]))
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if (isset($this->hooks[$which][0]) AND is_array($this->hooks[$which][0]))
=======
		if (is_array($this->hooks[$which]) && ! isset($this->hooks[$which]['function']))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (is_array($this->hooks[$which]) && ! isset($this->hooks[$which]['function']))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			foreach ($this->hooks[$which] as $val)
			{
				$this->_run_hook($val);
			}
		}
		else
		{
			$this->_run_hook($this->hooks[$which]);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Run Hook
	 *
	 * Runs a particular hook
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	array	the hook details
	 * @return	bool
	 */
	function _run_hook($data)
	{
		if ( ! is_array($data))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$data	Hook details
	 * @return	bool	TRUE on success or FALSE on failure
	 */
	protected function _run_hook($data)
	{
		// Closures/lambda functions and array($object, 'method') callables
		if (is_callable($data))
		{
			is_array($data)
				? $data[0]->{$data[1]}()
				: $data();

			return TRUE;
		}
		elseif ( ! is_array($data))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		// -----------------------------------
		// Safety - Prevents run-away loops
		// -----------------------------------

		// If the script being called happens to have the same
		// hook call within it a loop can happen
<<<<<<< HEAD
<<<<<<< HEAD

		if ($this->in_progress == TRUE)
=======
		if ($this->_in_progress === TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($this->_in_progress === TRUE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return;
		}

		// -----------------------------------
		// Set file path
		// -----------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($data['filepath']) OR ! isset($data['filename']))
=======
		if ( ! isset($data['filepath'], $data['filename']))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ( ! isset($data['filepath'], $data['filename']))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		$filepath = APPPATH.$data['filepath'].'/'.$data['filename'];

		if ( ! file_exists($filepath))
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// -----------------------------------
		// Set class/function name
		// -----------------------------------

		$class		= FALSE;
		$function	= FALSE;
		$params		= '';

		if (isset($data['class']) AND $data['class'] != '')
		{
			$class = $data['class'];
		}

		if (isset($data['function']))
		{
			$function = $data['function'];
		}

		if (isset($data['params']))
		{
			$params = $data['params'];
		}

		if ($class === FALSE AND $function === FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Determine and class and/or function names
		$class		= empty($data['class']) ? FALSE : $data['class'];
		$function	= empty($data['function']) ? FALSE : $data['function'];
		$params		= isset($data['params']) ? $data['params'] : '';

		if (empty($function))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// -----------------------------------
		// Set the in_progress flag
		// -----------------------------------

		$this->in_progress = TRUE;

		// -----------------------------------
		// Call the requested class and/or function
		// -----------------------------------

		if ($class !== FALSE)
		{
			if ( ! class_exists($class))
			{
				require($filepath);
			}

			$HOOK = new $class;
			$HOOK->$function($params);
		}
		else
		{
			if ( ! function_exists($function))
			{
				require($filepath);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Set the _in_progress flag
		$this->_in_progress = TRUE;

		// Call the requested class and/or function
		if ($class !== FALSE)
		{
			// The object is stored?
			if (isset($this->_objects[$class]))
			{
				if (method_exists($this->_objects[$class], $function))
				{
					$this->_objects[$class]->$function($params);
				}
				else
				{
					return $this->_in_progress = FALSE;
				}
			}
			else
			{
				class_exists($class, FALSE) OR require_once($filepath);

				if ( ! class_exists($class, FALSE) OR ! method_exists($class, $function))
				{
					return $this->_in_progress = FALSE;
				}

				// Store the object and execute the method
				$this->_objects[$class] = new $class();
				$this->_objects[$class]->$function($params);
			}
		}
		else
		{
			function_exists($function) OR require_once($filepath);

			if ( ! function_exists($function))
			{
				return $this->_in_progress = FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$function($params);
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$this->in_progress = FALSE;
=======
		$this->_in_progress = FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$this->_in_progress = FALSE;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return TRUE;
	}

}
<<<<<<< HEAD
<<<<<<< HEAD

// END CI_Hooks class

/* End of file Hooks.php */
/* Location: ./system/core/Hooks.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
