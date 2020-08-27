<<<<<<< HEAD
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2006 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------
=======
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
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

/**
 * CodeIgniter Driver Library Class
 *
 * This class enables you to create "Driver" libraries that add runtime ability
 * to extend the capabilities of a class via additional driver objects
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link
 */
class CI_Driver_Library {

<<<<<<< HEAD
	protected $valid_drivers	= array();
	protected $lib_name;

	// The first time a child is used it won't exist, so we instantiate it
	// subsequents calls will go straight to the proper child.
	function __get($child)
	{
		if ( ! isset($this->lib_name))
		{
			$this->lib_name = get_class($this);
		}

		// The class will be prefixed with the parent lib
		$child_class = $this->lib_name.'_'.$child;

		// Remove the CI_ prefix and lowercase
		$lib_name = ucfirst(strtolower(str_replace('CI_', '', $this->lib_name)));
		$driver_name = strtolower(str_replace('CI_', '', $child_class));

		if (in_array($driver_name, array_map('strtolower', $this->valid_drivers)))
		{
			// check and see if the driver is in a separate file
			if ( ! class_exists($child_class))
			{
				// check application path first
				foreach (get_instance()->load->get_package_paths(TRUE) as $path)
				{
					// loves me some nesting!
					foreach (array(ucfirst($driver_name), $driver_name) as $class)
					{
						$filepath = $path.'libraries/'.$lib_name.'/drivers/'.$class.'.php';

						if (file_exists($filepath))
						{
							include_once $filepath;
							break;
						}
					}
				}

				// it's a valid driver, but the file simply can't be found
				if ( ! class_exists($child_class))
				{
					log_message('error', "Unable to load the requested driver: ".$child_class);
					show_error("Unable to load the requested driver: ".$child_class);
				}
			}

			$obj = new $child_class;
			$obj->decorate($this);
			$this->$child = $obj;
			return $this->$child;
		}

		// The requested driver isn't valid!
		log_message('error', "Invalid driver requested: ".$child_class);
		show_error("Invalid driver requested: ".$child_class);
	}

	// --------------------------------------------------------------------

}
// END CI_Driver_Library CLASS

=======
	/**
	 * Array of drivers that are available to use with the driver class
	 *
	 * @var array
	 */
	protected $valid_drivers = array();

	/**
	 * Name of the current class - usually the driver class
	 *
	 * @var string
	 */
	protected $lib_name;

	/**
	 * Get magic method
	 *
	 * The first time a child is used it won't exist, so we instantiate it
	 * subsequents calls will go straight to the proper child.
	 *
	 * @param	string	Child class name
	 * @return	object	Child class
	 */
	public function __get($child)
	{
		// Try to load the driver
		return $this->load_driver($child);
	}

	/**
	 * Load driver
	 *
	 * Separate load_driver call to support explicit driver load by library or user
	 *
	 * @param	string	Driver name (w/o parent prefix)
	 * @return	object	Child class
	 */
	public function load_driver($child)
	{
		// Get CodeIgniter instance and subclass prefix
		$prefix = config_item('subclass_prefix');

		if ( ! isset($this->lib_name))
		{
			// Get library name without any prefix
			$this->lib_name = str_replace(array('CI_', $prefix), '', get_class($this));
		}

		// The child will be prefixed with the parent lib
		$child_name = $this->lib_name.'_'.$child;

		// See if requested child is a valid driver
		if ( ! in_array($child, $this->valid_drivers))
		{
			// The requested driver isn't valid!
			$msg = 'Invalid driver requested: '.$child_name;
			log_message('error', $msg);
			show_error($msg);
		}

		// Get package paths and filename case variations to search
		$CI = get_instance();
		$paths = $CI->load->get_package_paths(TRUE);

		// Is there an extension?
		$class_name = $prefix.$child_name;
		$found = class_exists($class_name, FALSE);
		if ( ! $found)
		{
			// Check for subclass file
			foreach ($paths as $path)
			{
				// Does the file exist?
				$file = $path.'libraries/'.$this->lib_name.'/drivers/'.$prefix.$child_name.'.php';
				if (file_exists($file))
				{
					// Yes - require base class from BASEPATH
					$basepath = BASEPATH.'libraries/'.$this->lib_name.'/drivers/'.$child_name.'.php';
					if ( ! file_exists($basepath))
					{
						$msg = 'Unable to load the requested class: CI_'.$child_name;
						log_message('error', $msg);
						show_error($msg);
					}

					// Include both sources and mark found
					include_once($basepath);
					include_once($file);
					$found = TRUE;
					break;
				}
			}
		}

		// Do we need to search for the class?
		if ( ! $found)
		{
			// Use standard class name
			$class_name = 'CI_'.$child_name;
			if ( ! class_exists($class_name, FALSE))
			{
				// Check package paths
				foreach ($paths as $path)
				{
					// Does the file exist?
					$file = $path.'libraries/'.$this->lib_name.'/drivers/'.$child_name.'.php';
					if (file_exists($file))
					{
						// Include source
						include_once($file);
						break;
					}
				}
			}
		}

		// Did we finally find the class?
		if ( ! class_exists($class_name, FALSE))
		{
			if (class_exists($child_name, FALSE))
			{
				$class_name = $child_name;
			}
			else
			{
				$msg = 'Unable to load the requested driver: '.$class_name;
				log_message('error', $msg);
				show_error($msg);
			}
		}

		// Instantiate, decorate and add child
		$obj = new $class_name();
		$obj->decorate($this);
		$this->$child = $obj;
		return $this->$child;
	}

}

// --------------------------------------------------------------------------
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

/**
 * CodeIgniter Driver Class
 *
 * This class enables you to create drivers for a Library based on the Driver Library.
 * It handles the drivers' access to the parent library
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link
 */
class CI_Driver {
<<<<<<< HEAD
	protected $parent;

	private $methods = array();
	private $properties = array();

	private static $reflections = array();
=======

	/**
	 * Instance of the parent class
	 *
	 * @var object
	 */
	protected $_parent;

	/**
	 * List of methods in the parent class
	 *
	 * @var array
	 */
	protected $_methods = array();

	/**
	 * List of properties in the parent class
	 *
	 * @var array
	 */
	protected $_properties = array();

	/**
	 * Array of methods and properties for the parent class(es)
	 *
	 * @static
	 * @var	array
	 */
	protected static $_reflections = array();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

	/**
	 * Decorate
	 *
	 * Decorates the child with the parent driver lib's methods and properties
	 *
	 * @param	object
	 * @return	void
	 */
	public function decorate($parent)
	{
<<<<<<< HEAD
		$this->parent = $parent;
=======
		$this->_parent = $parent;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

		// Lock down attributes to what is defined in the class
		// and speed up references in magic methods

		$class_name = get_class($parent);

<<<<<<< HEAD
		if ( ! isset(self::$reflections[$class_name]))
=======
		if ( ! isset(self::$_reflections[$class_name]))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$r = new ReflectionObject($parent);

			foreach ($r->getMethods() as $method)
			{
				if ($method->isPublic())
				{
<<<<<<< HEAD
					$this->methods[] = $method->getName();
=======
					$this->_methods[] = $method->getName();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				}
			}

			foreach ($r->getProperties() as $prop)
			{
				if ($prop->isPublic())
				{
<<<<<<< HEAD
					$this->properties[] = $prop->getName();
				}
			}

			self::$reflections[$class_name] = array($this->methods, $this->properties);
		}
		else
		{
			list($this->methods, $this->properties) = self::$reflections[$class_name];
=======
					$this->_properties[] = $prop->getName();
				}
			}

			self::$_reflections[$class_name] = array($this->_methods, $this->_properties);
		}
		else
		{
			list($this->_methods, $this->_properties) = self::$_reflections[$class_name];
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}
	}

	// --------------------------------------------------------------------

	/**
	 * __call magic method
	 *
	 * Handles access to the parent driver library's methods
	 *
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @param	string
	 * @param	array
	 * @return	mixed
	 */
	public function __call($method, $args = array())
	{
<<<<<<< HEAD
		if (in_array($method, $this->methods))
		{
			return call_user_func_array(array($this->parent, $method), $args);
		}

		$trace = debug_backtrace();
		_exception_handler(E_ERROR, "No such method '{$method}'", $trace[1]['file'], $trace[1]['line']);
		exit;
=======
		if (in_array($method, $this->_methods))
		{
			return call_user_func_array(array($this->_parent, $method), $args);
		}

		throw new BadMethodCallException('No such method: '.$method.'()');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic method
	 *
	 * Handles reading of the parent driver library's properties
	 *
	 * @param	string
	 * @return	mixed
	 */
	public function __get($var)
	{
<<<<<<< HEAD
		if (in_array($var, $this->properties))
		{
			return $this->parent->$var;
=======
		if (in_array($var, $this->_properties))
		{
			return $this->_parent->$var;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}
	}

	// --------------------------------------------------------------------

	/**
	 * __set magic method
	 *
	 * Handles writing to the parent driver library's properties
	 *
	 * @param	string
	 * @param	array
	 * @return	mixed
	 */
	public function __set($var, $val)
	{
<<<<<<< HEAD
		if (in_array($var, $this->properties))
		{
			$this->parent->$var = $val;
=======
		if (in_array($var, $this->_properties))
		{
			$this->_parent->$var = $val;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}
	}

}
<<<<<<< HEAD
// END CI_Driver CLASS

/* End of file Driver.php */
/* Location: ./system/libraries/Driver.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
