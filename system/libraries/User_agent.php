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
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * User Agent Class
 *
<<<<<<< HEAD
<<<<<<< HEAD
 * Identifies the platform, browser, robot, or mobile devise of the browsing agent
=======
 * Identifies the platform, browser, robot, or mobile device of the browsing agent
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * Identifies the platform, browser, robot, or mobile device of the browsing agent
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	User Agent
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/user_agent.html
 */
class CI_User_agent {

	var $agent		= NULL;

	var $is_browser	= FALSE;
	var $is_robot	= FALSE;
	var $is_mobile	= FALSE;

	var $languages	= array();
	var $charsets	= array();

	var $platforms	= array();
	var $browsers	= array();
	var $mobiles	= array();
	var $robots		= array();

	var $platform	= '';
	var $browser	= '';
	var $version	= '';
	var $mobile		= '';
	var $robot		= '';
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/user_agent.html
 */
class CI_User_agent {

	/**
	 * Current user-agent
	 *
	 * @var string
	 */
	public $agent = NULL;

	/**
	 * Flag for if the user-agent belongs to a browser
	 *
	 * @var bool
	 */
	public $is_browser = FALSE;

	/**
	 * Flag for if the user-agent is a robot
	 *
	 * @var bool
	 */
	public $is_robot = FALSE;

	/**
	 * Flag for if the user-agent is a mobile browser
	 *
	 * @var bool
	 */
	public $is_mobile = FALSE;

	/**
	 * Languages accepted by the current user agent
	 *
	 * @var array
	 */
	public $languages = array();

	/**
	 * Character sets accepted by the current user agent
	 *
	 * @var array
	 */
	public $charsets = array();

	/**
	 * List of platforms to compare against current user agent
	 *
	 * @var array
	 */
	public $platforms = array();

	/**
	 * List of browsers to compare against current user agent
	 *
	 * @var array
	 */
	public $browsers = array();

	/**
	 * List of mobile browsers to compare against current user agent
	 *
	 * @var array
	 */
	public $mobiles = array();

	/**
	 * List of robots to compare against current user agent
	 *
	 * @var array
	 */
	public $robots = array();

	/**
	 * Current user-agent platform
	 *
	 * @var string
	 */
	public $platform = '';

	/**
	 * Current user-agent browser
	 *
	 * @var string
	 */
	public $browser = '';

	/**
	 * Current user-agent version
	 *
	 * @var string
	 */
	public $version = '';

	/**
	 * Current user-agent mobile name
	 *
	 * @var string
	 */
	public $mobile = '';

	/**
	 * Current user-agent robot name
	 *
	 * @var string
	 */
	public $robot = '';

	/**
	 * HTTP Referer
	 *
	 * @var	mixed
	 */
	public $referer;

	// --------------------------------------------------------------------
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	/**
	 * Constructor
	 *
	 * Sets the User Agent and runs the compilation routine
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	public function __construct()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
			$this->agent = trim($_SERVER['HTTP_USER_AGENT']);
		}

		if ( ! is_null($this->agent))
		{
			if ($this->_load_agent_file())
			{
				$this->_compile_data();
			}
		}

		log_message('debug', "User Agent Class Initialized");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$this->_load_agent_file();

		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
			$this->agent = trim($_SERVER['HTTP_USER_AGENT']);
			$this->_compile_data();
		}

		log_message('info', 'User Agent Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Compile the User Agent Data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	private function _load_agent_file()
	{
		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php');
		}
		elseif (is_file(APPPATH.'config/user_agents.php'))
		{
			include(APPPATH.'config/user_agents.php');
		}
		else
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _load_agent_file()
	{
		if (($found = file_exists(APPPATH.'config/user_agents.php')))
		{
			include(APPPATH.'config/user_agents.php');
		}

		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php');
			$found = TRUE;
		}

		if ($found !== TRUE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		$return = FALSE;

		if (isset($platforms))
		{
			$this->platforms = $platforms;
			unset($platforms);
			$return = TRUE;
		}

		if (isset($browsers))
		{
			$this->browsers = $browsers;
			unset($browsers);
			$return = TRUE;
		}

		if (isset($mobiles))
		{
			$this->mobiles = $mobiles;
			unset($mobiles);
			$return = TRUE;
		}

		if (isset($robots))
		{
			$this->robots = $robots;
			unset($robots);
			$return = TRUE;
		}

		return $return;
	}

	// --------------------------------------------------------------------

	/**
	 * Compile the User Agent Data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	private function _compile_data()
=======
	 * @return	bool
	 */
	protected function _compile_data()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	bool
	 */
	protected function _compile_data()
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$this->_set_platform();

		foreach (array('_set_robot', '_set_browser', '_set_mobile') as $function)
		{
			if ($this->$function() === TRUE)
			{
				break;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Platform
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	mixed
	 */
	private function _set_platform()
	{
		if (is_array($this->platforms) AND count($this->platforms) > 0)
		{
			foreach ($this->platforms as $key => $val)
			{
				if (preg_match("|".preg_quote($key)."|i", $this->agent))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _set_platform()
	{
		if (is_array($this->platforms) && count($this->platforms) > 0)
		{
			foreach ($this->platforms as $key => $val)
			{
				if (preg_match('|'.preg_quote($key).'|i', $this->agent))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					$this->platform = $val;
					return TRUE;
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
		$this->platform = 'Unknown Platform';
=======

		$this->platform = 'Unknown Platform';
		return FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

		$this->platform = 'Unknown Platform';
		return FALSE;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Browser
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	private function _set_browser()
	{
		if (is_array($this->browsers) AND count($this->browsers) > 0)
		{
			foreach ($this->browsers as $key => $val)
			{
				if (preg_match("|".preg_quote($key).".*?([0-9\.]+)|i", $this->agent, $match))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _set_browser()
	{
		if (is_array($this->browsers) && count($this->browsers) > 0)
		{
			foreach ($this->browsers as $key => $val)
			{
				if (preg_match('|'.$key.'.*?([0-9\.]+)|i', $this->agent, $match))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					$this->is_browser = TRUE;
					$this->version = $match[1];
					$this->browser = $val;
					$this->_set_mobile();
					return TRUE;
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Robot
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	private function _set_robot()
	{
		if (is_array($this->robots) AND count($this->robots) > 0)
		{
			foreach ($this->robots as $key => $val)
			{
				if (preg_match("|".preg_quote($key)."|i", $this->agent))
				{
					$this->is_robot = TRUE;
					$this->robot = $val;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _set_robot()
	{
		if (is_array($this->robots) && count($this->robots) > 0)
		{
			foreach ($this->robots as $key => $val)
			{
				if (preg_match('|'.preg_quote($key).'|i', $this->agent))
				{
					$this->is_robot = TRUE;
					$this->robot = $val;
					$this->_set_mobile();
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					return TRUE;
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Mobile Device
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	private function _set_mobile()
	{
		if (is_array($this->mobiles) AND count($this->mobiles) > 0)
		{
			foreach ($this->mobiles as $key => $val)
			{
				if (FALSE !== (strpos(strtolower($this->agent), $key)))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _set_mobile()
	{
		if (is_array($this->mobiles) && count($this->mobiles) > 0)
		{
			foreach ($this->mobiles as $key => $val)
			{
				if (FALSE !== (stripos($this->agent, $key)))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					$this->is_mobile = TRUE;
					$this->mobile = $val;
					return TRUE;
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the accepted languages
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	void
	 */
	private function _set_languages()
	{
		if ((count($this->languages) == 0) AND isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) AND $_SERVER['HTTP_ACCEPT_LANGUAGE'] != '')
		{
			$languages = preg_replace('/(;q=[0-9\.]+)/i', '', strtolower(trim($_SERVER['HTTP_ACCEPT_LANGUAGE'])));

			$this->languages = explode(',', $languages);
		}

		if (count($this->languages) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	protected function _set_languages()
	{
		if ((count($this->languages) === 0) && ! empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$this->languages = explode(',', preg_replace('/(;\s?q=[0-9\.]+)|\s/i', '', strtolower(trim($_SERVER['HTTP_ACCEPT_LANGUAGE']))));
		}

		if (count($this->languages) === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->languages = array('Undefined');
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set the accepted character sets
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	void
	 */
	private function _set_charsets()
	{
		if ((count($this->charsets) == 0) AND isset($_SERVER['HTTP_ACCEPT_CHARSET']) AND $_SERVER['HTTP_ACCEPT_CHARSET'] != '')
		{
			$charsets = preg_replace('/(;q=.+)/i', '', strtolower(trim($_SERVER['HTTP_ACCEPT_CHARSET'])));

			$this->charsets = explode(',', $charsets);
		}

		if (count($this->charsets) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	protected function _set_charsets()
	{
		if ((count($this->charsets) === 0) && ! empty($_SERVER['HTTP_ACCEPT_CHARSET']))
		{
			$this->charsets = explode(',', preg_replace('/(;\s?q=.+)|\s/i', '', strtolower(trim($_SERVER['HTTP_ACCEPT_CHARSET']))));
		}

		if (count($this->charsets) === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->charsets = array('Undefined');
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Is Browser
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$key
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$key
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function is_browser($key = NULL)
	{
		if ( ! $this->is_browser)
		{
			return FALSE;
		}

		// No need to be specific, it's a browser
		if ($key === NULL)
		{
			return TRUE;
		}

		// Check for a specific browser
<<<<<<< HEAD
<<<<<<< HEAD
		return array_key_exists($key, $this->browsers) AND $this->browser === $this->browsers[$key];
=======
		return (isset($this->browsers[$key]) && $this->browser === $this->browsers[$key]);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (isset($this->browsers[$key]) && $this->browser === $this->browsers[$key]);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is Robot
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$key
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$key
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function is_robot($key = NULL)
	{
		if ( ! $this->is_robot)
		{
			return FALSE;
		}

		// No need to be specific, it's a robot
		if ($key === NULL)
		{
			return TRUE;
		}

		// Check for a specific robot
<<<<<<< HEAD
<<<<<<< HEAD
		return array_key_exists($key, $this->robots) AND $this->robot === $this->robots[$key];
=======
		return (isset($this->robots[$key]) && $this->robot === $this->robots[$key]);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (isset($this->robots[$key]) && $this->robot === $this->robots[$key]);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is Mobile
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$key
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$key
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function is_mobile($key = NULL)
	{
		if ( ! $this->is_mobile)
		{
			return FALSE;
		}

		// No need to be specific, it's a mobile
		if ($key === NULL)
		{
			return TRUE;
		}

		// Check for a specific robot
<<<<<<< HEAD
<<<<<<< HEAD
		return array_key_exists($key, $this->mobiles) AND $this->mobile === $this->mobiles[$key];
=======
		return (isset($this->mobiles[$key]) && $this->mobile === $this->mobiles[$key]);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (isset($this->mobiles[$key]) && $this->mobile === $this->mobiles[$key]);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is this a referral from another site?
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function is_referral()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($_SERVER['HTTP_REFERER']) OR $_SERVER['HTTP_REFERER'] == '')
		{
			return FALSE;
		}
		return TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! isset($this->referer))
		{
			if (empty($_SERVER['HTTP_REFERER']))
			{
				$this->referer = FALSE;
			}
			else
			{
				$referer_host = @parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
				$own_host = parse_url(config_item('base_url'), PHP_URL_HOST);

				$this->referer = ($referer_host && $referer_host !== $own_host);
			}
		}

		return $this->referer;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Agent String
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function agent_string()
	{
		return $this->agent;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Platform
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function platform()
	{
		return $this->platform;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Browser Name
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function browser()
	{
		return $this->browser;
	}

	// --------------------------------------------------------------------

	/**
	 * Get the Browser Version
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function version()
	{
		return $this->version;
	}

	// --------------------------------------------------------------------

	/**
	 * Get The Robot Name
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function robot()
	{
		return $this->robot;
	}
	// --------------------------------------------------------------------

	/**
	 * Get the Mobile Device
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function mobile()
	{
		return $this->mobile;
	}

	// --------------------------------------------------------------------

	/**
	 * Get the referrer
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function referrer()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return ( ! isset($_SERVER['HTTP_REFERER']) OR $_SERVER['HTTP_REFERER'] == '') ? '' : trim($_SERVER['HTTP_REFERER']);
=======
		return empty($_SERVER['HTTP_REFERER']) ? '' : trim($_SERVER['HTTP_REFERER']);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return empty($_SERVER['HTTP_REFERER']) ? '' : trim($_SERVER['HTTP_REFERER']);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Get the accepted languages
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	public function languages()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (count($this->languages) == 0)
=======
		if (count($this->languages) === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (count($this->languages) === 0)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->_set_languages();
		}

		return $this->languages;
	}

	// --------------------------------------------------------------------

	/**
	 * Get the accepted Character Sets
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	public function charsets()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (count($this->charsets) == 0)
=======
		if (count($this->charsets) === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (count($this->charsets) === 0)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->_set_charsets();
		}

		return $this->charsets;
	}

	// --------------------------------------------------------------------

	/**
	 * Test for a particular language
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$lang
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$lang
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function accept_lang($lang = 'en')
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return (in_array(strtolower($lang), $this->languages(), TRUE));
=======
		return in_array(strtolower($lang), $this->languages(), TRUE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return in_array(strtolower($lang), $this->languages(), TRUE);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Test for a particular character set
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$charset
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$charset
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function accept_charset($charset = 'utf-8')
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return (in_array(strtolower($charset), $this->charsets(), TRUE));
	}

}


/* End of file User_agent.php */
/* Location: ./system/libraries/User_agent.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return in_array(strtolower($charset), $this->charsets(), TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a custom user-agent string
	 *
	 * @param	string	$string
	 * @return	void
	 */
	public function parse($string)
	{
		// Reset values
		$this->is_browser = FALSE;
		$this->is_robot = FALSE;
		$this->is_mobile = FALSE;
		$this->browser = '';
		$this->version = '';
		$this->mobile = '';
		$this->robot = '';

		// Set the new user-agent string and parse it, unless empty
		$this->agent = $string;

		if ( ! empty($string))
		{
			$this->_compile_data();
		}
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
