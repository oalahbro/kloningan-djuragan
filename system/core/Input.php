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
 * Input Class
 *
 * Pre-processes global input data for security
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Input
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/input.html
=======
 * @link		https://codeigniter.com/user_guide/libraries/input.html
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/libraries/input.html
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_Input {

	/**
	 * IP address of the current user
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @var string
	 */
	var $ip_address				= FALSE;
	/**
	 * user agent (web browser) being used by the current user
	 *
	 * @var string
	 */
	var $user_agent				= FALSE;
	/**
	 * If FALSE, then $_GET will be set to an empty array
	 *
	 * @var bool
	 */
	var $_allow_get_array		= TRUE;
	/**
	 * If TRUE, then newlines are standardized
	 *
	 * @var bool
	 */
	var $_standardize_newlines	= TRUE;
	/**
	 * Determines whether the XSS filter is always active when GET, POST or COOKIE data is encountered
	 * Set automatically based on config setting
	 *
	 * @var bool
	 */
	var $_enable_xss			= FALSE;
	/**
	 * Enables a CSRF cookie token to be set.
	 * Set automatically based on config setting
	 *
	 * @var bool
	 */
	var $_enable_csrf			= FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @var	string
	 */
	protected $ip_address = FALSE;

	/**
	 * Allow GET array flag
	 *
	 * If set to FALSE, then $_GET will be set to an empty array.
	 *
	 * @var	bool
	 */
	protected $_allow_get_array = TRUE;

	/**
	 * Standardize new lines flag
	 *
	 * If set to TRUE, then newlines are standardized.
	 *
	 * @var	bool
	 */
	protected $_standardize_newlines;

	/**
	 * Enable XSS flag
	 *
	 * Determines whether the XSS filter is always active when
	 * GET, POST or COOKIE data is encountered.
	 * Set automatically based on config setting.
	 *
	 * @var	bool
	 */
	protected $_enable_xss = FALSE;

	/**
	 * Enable CSRF flag
	 *
	 * Enables a CSRF cookie token to be set.
	 * Set automatically based on config setting.
	 *
	 * @var	bool
	 */
	protected $_enable_csrf = FALSE;

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * List of all HTTP request headers
	 *
	 * @var array
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	protected $headers			= array();

	/**
	 * Constructor
	 *
	 * Sets whether to globally enable the XSS processing
	 * and whether to allow the $_GET array
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	protected $headers = array();

	/**
	 * Raw input stream data
	 *
	 * Holds a cache of php://input contents
	 *
	 * @var	string
	 */
	protected $_raw_input_stream;

	/**
	 * Parsed input stream data
	 *
	 * Parsed from php://input at runtime
	 *
	 * @see	CI_Input::input_stream()
	 * @var	array
	 */
	protected $_input_stream;

	protected $security;
	protected $uni;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * Determines whether to globally enable the XSS processing
	 * and whether to allow the $_GET array.
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * @return	void
	 */
	public function __construct()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		log_message('debug', "Input Class Initialized");

		$this->_allow_get_array	= (config_item('allow_get_array') === TRUE);
		$this->_enable_xss		= (config_item('global_xss_filtering') === TRUE);
		$this->_enable_csrf		= (config_item('csrf_protection') === TRUE);

		global $SEC;
		$this->security =& $SEC;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$this->_allow_get_array		= (config_item('allow_get_array') === TRUE);
		$this->_enable_xss		= (config_item('global_xss_filtering') === TRUE);
		$this->_enable_csrf		= (config_item('csrf_protection') === TRUE);
		$this->_standardize_newlines	= (bool) config_item('standardize_newlines');

		$this->security =& load_class('Security', 'core');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// Do we need the UTF-8 class?
		if (UTF8_ENABLED === TRUE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			global $UNI;
			$this->uni =& $UNI;
=======
			$this->uni =& load_class('Utf8', 'core');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$this->uni =& load_class('Utf8', 'core');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// Sanitize global arrays
		$this->_sanitize_globals();
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// CSRF Protection check
		if ($this->_enable_csrf === TRUE && ! is_cli())
		{
			$this->security->csrf_verify();
		}

		log_message('info', 'Input Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch from array
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * This is a helper function to retrieve values from global arrays
	 *
	 * @access	private
	 * @param	array
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function _fetch_from_array(&$array, $index = '', $xss_clean = FALSE)
	{
		if ( ! isset($array[$index]))
		{
			return FALSE;
		}

		if ($xss_clean === TRUE)
		{
			return $this->security->xss_clean($array[$index]);
		}

		return $array[$index];
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Internal method used to retrieve values from global arrays.
	 *
	 * @param	array	&$array		$_GET, $_POST, $_COOKIE, $_SERVER, etc.
	 * @param	mixed	$index		Index for item to be fetched from $array
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	protected function _fetch_from_array(&$array, $index = NULL, $xss_clean = NULL)
	{
		is_bool($xss_clean) OR $xss_clean = $this->_enable_xss;

		// If $index is NULL, it means that the whole $array is requested
		isset($index) OR $index = array_keys($array);

		// allow fetching multiple keys at once
		if (is_array($index))
		{
			$output = array();
			foreach ($index as $key)
			{
				$output[$key] = $this->_fetch_from_array($array, $key, $xss_clean);
			}

			return $output;
		}

		if (isset($array[$index]))
		{
			$value = $array[$index];
		}
		elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) // Does the index contain array notation
		{
			$value = $array;
			for ($i = 0; $i < $count; $i++)
			{
				$key = trim($matches[0][$i], '[]');
				if ($key === '') // Empty notation will return the value as array
				{
					break;
				}

				if (isset($value[$key]))
				{
					$value = $value[$key];
				}
				else
				{
					return NULL;
				}
			}
		}
		else
		{
			return NULL;
		}

		return ($xss_clean === TRUE)
			? $this->security->xss_clean($value)
			: $value;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Fetch an item from the GET array
	*
	* @access	public
	* @param	string
	* @param	bool
	* @return	string
	*/
	function get($index = NULL, $xss_clean = FALSE)
	{
		// Check if a field has been provided
		if ($index === NULL AND ! empty($_GET))
		{
			$get = array();

			// loop through the full _GET array
			foreach (array_keys($_GET) as $key)
			{
				$get[$key] = $this->_fetch_from_array($_GET, $key, $xss_clean);
			}
			return $get;
		}

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch an item from the GET array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_GET
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function get($index = NULL, $xss_clean = NULL)
	{
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this->_fetch_from_array($_GET, $index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Fetch an item from the POST array
	*
	* @access	public
	* @param	string
	* @param	bool
	* @return	string
	*/
	function post($index = NULL, $xss_clean = FALSE)
	{
		// Check if a field has been provided
		if ($index === NULL AND ! empty($_POST))
		{
			$post = array();

			// Loop through the full _POST array and return it
			foreach (array_keys($_POST) as $key)
			{
				$post[$key] = $this->_fetch_from_array($_POST, $key, $xss_clean);
			}
			return $post;
		}

		return $this->_fetch_from_array($_POST, $index, $xss_clean);
	}

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch an item from the POST array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_POST
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function post($index = NULL, $xss_clean = NULL)
	{
		return $this->_fetch_from_array($_POST, $index, $xss_clean);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch an item from POST data with fallback to GET
	 *
	 * @param	string	$index		Index for item to be fetched from $_POST or $_GET
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function post_get($index, $xss_clean = NULL)
	{
		return isset($_POST[$index])
			? $this->post($index, $xss_clean)
			: $this->get($index, $xss_clean);
	}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Fetch an item from either the GET array or the POST
	*
	* @access	public
	* @param	string	The index key
	* @param	bool	XSS cleaning
	* @return	string
	*/
	function get_post($index = '', $xss_clean = FALSE)
	{
		if ( ! isset($_POST[$index]) )
		{
			return $this->get($index, $xss_clean);
		}
		else
		{
			return $this->post($index, $xss_clean);
		}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch an item from GET data with fallback to POST
	 *
	 * @param	string	$index		Index for item to be fetched from $_GET or $_POST
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function get_post($index, $xss_clean = NULL)
	{
		return isset($_GET[$index])
			? $this->get($index, $xss_clean)
			: $this->post($index, $xss_clean);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Fetch an item from the COOKIE array
	*
	* @access	public
	* @param	string
	* @param	bool
	* @return	string
	*/
	function cookie($index = '', $xss_clean = FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch an item from the COOKIE array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_COOKIE
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function cookie($index = NULL, $xss_clean = NULL)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->_fetch_from_array($_COOKIE, $index, $xss_clean);
	}

<<<<<<< HEAD
<<<<<<< HEAD
	// ------------------------------------------------------------------------

	/**
	* Set cookie
	*
	* Accepts six parameter, or you can submit an associative
	* array in the first parameter containing all the values.
	*
	* @access	public
	* @param	mixed
	* @param	string	the value of the cookie
	* @param	string	the number of seconds until expiration
	* @param	string	the cookie domain.  Usually:  .yourdomain.com
	* @param	string	the cookie path
	* @param	string	the cookie prefix
	* @param	bool	true makes the cookie secure
	* @return	void
	*/
	function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Fetch an item from the SERVER array
	 *
	 * @param	mixed	$index		Index for item to be fetched from $_SERVER
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function server($index, $xss_clean = NULL)
	{
		return $this->_fetch_from_array($_SERVER, $index, $xss_clean);
	}

	// ------------------------------------------------------------------------

	/**
	 * Fetch an item from the php://input stream
	 *
	 * Useful when you need to access PUT, DELETE or PATCH request data.
	 *
	 * @param	string	$index		Index for item to be fetched
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	mixed
	 */
	public function input_stream($index = NULL, $xss_clean = NULL)
	{
		// Prior to PHP 5.6, the input stream can only be read once,
		// so we'll need to check if we have already done that first.
		if ( ! is_array($this->_input_stream))
		{
			// $this->raw_input_stream will trigger __get().
			parse_str($this->raw_input_stream, $this->_input_stream);
			is_array($this->_input_stream) OR $this->_input_stream = array();
		}

		return $this->_fetch_from_array($this->_input_stream, $index, $xss_clean);
	}

	// ------------------------------------------------------------------------

	/**
	 * Set cookie
	 *
	 * Accepts an arbitrary number of parameters (up to 7) or an associative
	 * array in the first parameter containing all the values.
	 *
	 * @param	string|mixed[]	$name		Cookie name or an array containing parameters
	 * @param	string		$value		Cookie value
	 * @param	int		$expire		Cookie expiration time in seconds
	 * @param	string		$domain		Cookie domain (e.g.: '.yourdomain.com')
	 * @param	string		$path		Cookie path (default: '/')
	 * @param	string		$prefix		Cookie name prefix
	 * @param	bool		$secure		Whether to only transfer cookies via SSL
	 * @param	bool		$httponly	Whether to only makes the cookie accessible via HTTP (no javascript)
	 * @return	void
	 */
	public function set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE, $httponly = FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if (is_array($name))
		{
			// always leave 'name' in last place, as the loop will break otherwise, due to $$item
<<<<<<< HEAD
<<<<<<< HEAD
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'name') as $item)
=======
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'httponly', 'name') as $item)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'httponly', 'name') as $item)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				if (isset($name[$item]))
				{
					$$item = $name[$item];
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($prefix == '' AND config_item('cookie_prefix') != '')
		{
			$prefix = config_item('cookie_prefix');
		}
		if ($domain == '' AND config_item('cookie_domain') != '')
		{
			$domain = config_item('cookie_domain');
		}
		if ($path == '/' AND config_item('cookie_path') != '/')
		{
			$path = config_item('cookie_path');
		}
		if ($secure == FALSE AND config_item('cookie_secure') != FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ($prefix === '' && config_item('cookie_prefix') !== '')
		{
			$prefix = config_item('cookie_prefix');
		}

		if ($domain == '' && config_item('cookie_domain') != '')
		{
			$domain = config_item('cookie_domain');
		}

		if ($path === '/' && config_item('cookie_path') !== '/')
		{
			$path = config_item('cookie_path');
		}

		if ($secure === FALSE && config_item('cookie_secure') === TRUE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$secure = config_item('cookie_secure');
		}

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ($httponly === FALSE && config_item('cookie_httponly') !== FALSE)
		{
			$httponly = config_item('cookie_httponly');
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! is_numeric($expire))
		{
			$expire = time() - 86500;
		}
		else
		{
			$expire = ($expire > 0) ? time() + $expire : 0;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		setcookie($prefix.$name, $value, $expire, $path, $domain, $secure);
	}

	// --------------------------------------------------------------------

	/**
	* Fetch an item from the SERVER array
	*
	* @access	public
	* @param	string
	* @param	bool
	* @return	string
	*/
	function server($index = '', $xss_clean = FALSE)
	{
		return $this->_fetch_from_array($_SERVER, $index, $xss_clean);
=======
		setcookie($prefix.$name, $value, $expire, $path, $domain, $secure, $httponly);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		setcookie($prefix.$name, $value, $expire, $path, $domain, $secure, $httponly);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Fetch the IP Address
	*
	* @return	string
	*/
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch the IP Address
	 *
	 * Determines and validates the visitor's IP address.
	 *
	 * @return	string	IP address
	 */
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	public function ip_address()
	{
		if ($this->ip_address !== FALSE)
		{
			return $this->ip_address;
		}

		$proxy_ips = config_item('proxy_ips');
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! empty($proxy_ips))
		{
			$proxy_ips = explode(',', str_replace(' ', '', $proxy_ips));
			foreach (array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'HTTP_X_CLIENT_IP', 'HTTP_X_CLUSTER_CLIENT_IP') as $header)
			{
				if (($spoof = $this->server($header)) !== FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! empty($proxy_ips) && ! is_array($proxy_ips))
		{
			$proxy_ips = explode(',', str_replace(' ', '', $proxy_ips));
		}

		$this->ip_address = $this->server('REMOTE_ADDR');

		if ($proxy_ips)
		{
			foreach (array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'HTTP_X_CLIENT_IP', 'HTTP_X_CLUSTER_CLIENT_IP') as $header)
			{
				if (($spoof = $this->server($header)) !== NULL)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					// Some proxies typically list the whole chain of IP
					// addresses through which the client has reached us.
					// e.g. client_ip, proxy_ip1, proxy_ip2, etc.
<<<<<<< HEAD
<<<<<<< HEAD
					if (strpos($spoof, ',') !== FALSE)
					{
						$spoof = explode(',', $spoof, 2);
						$spoof = $spoof[0];
					}

					if ( ! $this->valid_ip($spoof))
					{
						$spoof = FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					sscanf($spoof, '%[^,]', $spoof);

					if ( ! $this->valid_ip($spoof))
					{
						$spoof = NULL;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					}
					else
					{
						break;
					}
				}
			}

<<<<<<< HEAD
<<<<<<< HEAD
			$this->ip_address = ($spoof !== FALSE && in_array($_SERVER['REMOTE_ADDR'], $proxy_ips, TRUE))
				? $spoof : $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			$this->ip_address = $_SERVER['REMOTE_ADDR'];
		}

		if ( ! $this->valid_ip($this->ip_address))
		{
			$this->ip_address = '0.0.0.0';
		}

		return $this->ip_address;
	}

	// --------------------------------------------------------------------

	/**
	* Validate IP Address
	*
	* @access	public
	* @param	string
	* @param	string	ipv4 or ipv6
	* @return	bool
	*/
	public function valid_ip($ip, $which = '')
	{
		$which = strtolower($which);

		// First check if filter_var is available
		if (is_callable('filter_var'))
		{
			switch ($which) {
				case 'ipv4':
					$flag = FILTER_FLAG_IPV4;
					break;
				case 'ipv6':
					$flag = FILTER_FLAG_IPV6;
					break;
				default:
					$flag = '';
					break;
			}

			return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flag);
		}

		if ($which !== 'ipv6' && $which !== 'ipv4')
		{
			if (strpos($ip, ':') !== FALSE)
			{
				$which = 'ipv6';
			}
			elseif (strpos($ip, '.') !== FALSE)
			{
				$which = 'ipv4';
			}
			else
			{
				return FALSE;
			}
		}

		$func = '_valid_'.$which;
		return $this->$func($ip);
	}

	// --------------------------------------------------------------------

	/**
	* Validate IPv4 Address
	*
	* Updated version suggested by Geert De Deckere
	*
	* @access	protected
	* @param	string
	* @return	bool
	*/
	protected function _valid_ipv4($ip)
	{
		$ip_segments = explode('.', $ip);

		// Always 4 segments needed
		if (count($ip_segments) !== 4)
		{
			return FALSE;
		}
		// IP can not start with 0
		if ($ip_segments[0][0] == '0')
		{
			return FALSE;
		}

		// Check each segment
		foreach ($ip_segments as $segment)
		{
			// IP segments must be digits and can not be
			// longer than 3 digits or greater then 255
			if ($segment == '' OR preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3)
			{
				return FALSE;
			}
		}

		return TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($spoof)
			{
				for ($i = 0, $c = count($proxy_ips); $i < $c; $i++)
				{
					// Check if we have an IP address or a subnet
					if (strpos($proxy_ips[$i], '/') === FALSE)
					{
						// An IP address (and not a subnet) is specified.
						// We can compare right away.
						if ($proxy_ips[$i] === $this->ip_address)
						{
							$this->ip_address = $spoof;
							break;
						}

						continue;
					}

					// We have a subnet ... now the heavy lifting begins
					isset($separator) OR $separator = $this->valid_ip($this->ip_address, 'ipv6') ? ':' : '.';

					// If the proxy entry doesn't match the IP protocol - skip it
					if (strpos($proxy_ips[$i], $separator) === FALSE)
					{
						continue;
					}

					// Convert the REMOTE_ADDR IP address to binary, if needed
					if ( ! isset($ip, $sprintf))
					{
						if ($separator === ':')
						{
							// Make sure we're have the "full" IPv6 format
							$ip = explode(':',
								str_replace('::',
									str_repeat(':', 9 - substr_count($this->ip_address, ':')),
									$this->ip_address
								)
							);

							for ($j = 0; $j < 8; $j++)
							{
								$ip[$j] = intval($ip[$j], 16);
							}

							$sprintf = '%016b%016b%016b%016b%016b%016b%016b%016b';
						}
						else
						{
							$ip = explode('.', $this->ip_address);
							$sprintf = '%08b%08b%08b%08b';
						}

						$ip = vsprintf($sprintf, $ip);
					}

					// Split the netmask length off the network address
					sscanf($proxy_ips[$i], '%[^/]/%d', $netaddr, $masklen);

					// Again, an IPv6 address is most likely in a compressed form
					if ($separator === ':')
					{
						$netaddr = explode(':', str_replace('::', str_repeat(':', 9 - substr_count($netaddr, ':')), $netaddr));
						for ($j = 0; $j < 8; $j++)
						{
							$netaddr[$i] = intval($netaddr[$j], 16);
						}
					}
					else
					{
						$netaddr = explode('.', $netaddr);
					}

					// Convert to binary and finally compare
					if (strncmp($ip, vsprintf($sprintf, $netaddr), $masklen) === 0)
					{
						$this->ip_address = $spoof;
						break;
					}
				}
			}
		}

		if ( ! $this->valid_ip($this->ip_address))
		{
			return $this->ip_address = '0.0.0.0';
		}

		return $this->ip_address;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Validate IPv6 Address
	*
	* @access	protected
	* @param	string
	* @return	bool
	*/
	protected function _valid_ipv6($str)
	{
		// 8 groups, separated by :
		// 0-ffff per group
		// one set of consecutive 0 groups can be collapsed to ::

		$groups = 8;
		$collapsed = FALSE;

		$chunks = array_filter(
			preg_split('/(:{1,2})/', $str, NULL, PREG_SPLIT_DELIM_CAPTURE)
		);

		// Rule out easy nonsense
		if (current($chunks) == ':' OR end($chunks) == ':')
		{
			return FALSE;
		}

		// PHP supports IPv4-mapped IPv6 addresses, so we'll expect those as well
		if (strpos(end($chunks), '.') !== FALSE)
		{
			$ipv4 = array_pop($chunks);

			if ( ! $this->_valid_ipv4($ipv4))
			{
				return FALSE;
			}

			$groups--;
		}

		while ($seg = array_pop($chunks))
		{
			if ($seg[0] == ':')
			{
				if (--$groups == 0)
				{
					return FALSE;	// too many groups
				}

				if (strlen($seg) > 2)
				{
					return FALSE;	// long separator
				}

				if ($seg == '::')
				{
					if ($collapsed)
					{
						return FALSE;	// multiple collapsed
					}

					$collapsed = TRUE;
				}
			}
			elseif (preg_match("/[^0-9a-f]/i", $seg) OR strlen($seg) > 4)
			{
				return FALSE; // invalid segment
			}
		}

		return $collapsed OR $groups == 1;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Validate IP Address
	 *
	 * @param	string	$ip	IP address
	 * @param	string	$which	IP protocol: 'ipv4' or 'ipv6'
	 * @return	bool
	 */
	public function valid_ip($ip, $which = '')
	{
		switch (strtolower($which))
		{
			case 'ipv4':
				$which = FILTER_FLAG_IPV4;
				break;
			case 'ipv6':
				$which = FILTER_FLAG_IPV6;
				break;
			default:
				$which = NULL;
				break;
		}

		return (bool) filter_var($ip, FILTER_VALIDATE_IP, $which);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* User Agent
	*
	* @access	public
	* @return	string
	*/
	function user_agent()
	{
		if ($this->user_agent !== FALSE)
		{
			return $this->user_agent;
		}

		$this->user_agent = ( ! isset($_SERVER['HTTP_USER_AGENT'])) ? FALSE : $_SERVER['HTTP_USER_AGENT'];

		return $this->user_agent;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Fetch User Agent string
	 *
	 * @return	string|null	User Agent string or NULL if it doesn't exist
	 */
	public function user_agent($xss_clean = NULL)
	{
		return $this->_fetch_from_array($_SERVER, 'HTTP_USER_AGENT', $xss_clean);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Sanitize Globals
	*
	* This function does the following:
	*
	* Unsets $_GET data (if query strings are not enabled)
	*
	* Unsets all globals if register_globals is enabled
	*
	* Standardizes newline characters to \n
	*
	* @access	private
	* @return	void
	*/
	function _sanitize_globals()
	{
		// It would be "wrong" to unset any of these GLOBALS.
		$protected = array('_SERVER', '_GET', '_POST', '_FILES', '_REQUEST',
							'_SESSION', '_ENV', 'GLOBALS', 'HTTP_RAW_POST_DATA',
							'system_folder', 'application_folder', 'BM', 'EXT',
							'CFG', 'URI', 'RTR', 'OUT', 'IN');

		// Unset globals for securiy.
		// This is effectively the same as register_globals = off
		foreach (array($_GET, $_POST, $_COOKIE) as $global)
		{
			if ( ! is_array($global))
			{
				if ( ! in_array($global, $protected))
				{
					global $$global;
					$$global = NULL;
				}
			}
			else
			{
				foreach ($global as $key => $val)
				{
					if ( ! in_array($key, $protected))
					{
						global $$key;
						$$key = NULL;
					}
				}
			}
		}

		// Is $_GET data allowed? If not we'll set the $_GET to an empty array
		if ($this->_allow_get_array == FALSE)
		{
			$_GET = array();
		}
		else
		{
			if (is_array($_GET) AND count($_GET) > 0)
			{
				foreach ($_GET as $key => $val)
				{
					$_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
				}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Sanitize Globals
	 *
	 * Internal method serving for the following purposes:
	 *
	 *	- Unsets $_GET data, if query strings are not enabled
	 *	- Cleans POST, COOKIE and SERVER data
	 * 	- Standardizes newline characters to PHP_EOL
	 *
	 * @return	void
	 */
	protected function _sanitize_globals()
	{
		// Is $_GET data allowed? If not we'll set the $_GET to an empty array
		if ($this->_allow_get_array === FALSE)
		{
			$_GET = array();
		}
		elseif (is_array($_GET))
		{
			foreach ($_GET as $key => $val)
			{
				$_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}
		}

		// Clean $_POST Data
<<<<<<< HEAD
<<<<<<< HEAD
		if (is_array($_POST) AND count($_POST) > 0)
=======
		if (is_array($_POST))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (is_array($_POST))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			foreach ($_POST as $key => $val)
			{
				$_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
		}

		// Clean $_COOKIE Data
<<<<<<< HEAD
<<<<<<< HEAD
		if (is_array($_COOKIE) AND count($_COOKIE) > 0)
=======
		if (is_array($_COOKIE))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (is_array($_COOKIE))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			// Also get rid of specially treated cookies that might be set by a server
			// or silly application, that are of no use to a CI application anyway
			// but that when present will trip our 'Disallowed Key Characters' alarm
			// http://www.ietf.org/rfc/rfc2109.txt
			// note that the key names below are single quoted strings, and are not PHP variables
<<<<<<< HEAD
<<<<<<< HEAD
			unset($_COOKIE['$Version']);
			unset($_COOKIE['$Path']);
			unset($_COOKIE['$Domain']);

			// Work-around for PHP bug #66827 (https://bugs.php.net/bug.php?id=66827)
			//
			// The session ID sanitizer doesn't check for the value type and blindly does
			// an implicit cast to string, which triggers an 'Array to string' E_NOTICE.
			$sess_cookie_name = config_item('cookie_prefix').config_item('sess_cookie_name');
			if (isset($_COOKIE[$sess_cookie_name]) && ! is_string($_COOKIE[$sess_cookie_name]))
			{
				unset($_COOKIE[$sess_cookie_name]);
			}

			foreach ($_COOKIE as $key => $val)
			{
				// _clean_input_data() has been reported to break encrypted cookies
				if ($key === $sess_cookie_name && config_item('sess_encrypt_cookie'))
				{
					continue;
				}

				$_COOKIE[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			unset(
				$_COOKIE['$Version'],
				$_COOKIE['$Path'],
				$_COOKIE['$Domain']
			);

			foreach ($_COOKIE as $key => $val)
			{
				if (($cookie_key = $this->_clean_input_keys($key)) !== FALSE)
				{
					$_COOKIE[$cookie_key] = $this->_clean_input_data($val);
				}
				else
				{
					unset($_COOKIE[$key]);
				}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}
		}

		// Sanitize PHP_SELF
		$_SERVER['PHP_SELF'] = strip_tags($_SERVER['PHP_SELF']);

<<<<<<< HEAD
<<<<<<< HEAD

		// CSRF Protection check on HTTP requests
		if ($this->_enable_csrf == TRUE && ! $this->is_cli_request())
		{
			$this->security->csrf_verify();
		}

		log_message('debug', "Global POST and COOKIE data sanitized");
=======
		log_message('debug', 'Global POST, GET and COOKIE data sanitized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		log_message('debug', 'Global POST, GET and COOKIE data sanitized');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Clean Input Data
	*
	* This is a helper function. It escapes data and
	* standardizes newline characters to \n
	*
	* @access	private
	* @param	string
	* @return	string
	*/
	function _clean_input_data($str)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Clean Input Data
	 *
	 * Internal method that aids in escaping data and
	 * standardizing newline characters to PHP_EOL.
	 *
	 * @param	string|string[]	$str	Input string(s)
	 * @return	string
	 */
	protected function _clean_input_data($str)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if (is_array($str))
		{
			$new_array = array();
<<<<<<< HEAD
<<<<<<< HEAD
			foreach ($str as $key => $val)
			{
				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
=======
			foreach (array_keys($str) as $key)
			{
				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($str[$key]);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			foreach (array_keys($str) as $key)
			{
				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($str[$key]);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}
			return $new_array;
		}

		/* We strip slashes if magic quotes is on to keep things consistent

		   NOTE: In PHP 5.4 get_magic_quotes_gpc() will always return 0 and
<<<<<<< HEAD
<<<<<<< HEAD
			 it will probably not exist in future versions at all.
=======
		         it will probably not exist in future versions at all.
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		         it will probably not exist in future versions at all.
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		*/
		if ( ! is_php('5.4') && get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}

		// Clean UTF-8 if supported
		if (UTF8_ENABLED === TRUE)
		{
			$str = $this->uni->clean_string($str);
		}

		// Remove control characters
<<<<<<< HEAD
<<<<<<< HEAD
		$str = remove_invisible_characters($str);

		// Should we filter the input data?
		if ($this->_enable_xss === TRUE)
		{
			$str = $this->security->xss_clean($str);
		}

		// Standardize newlines if needed
		if ($this->_standardize_newlines == TRUE)
		{
			if (strpos($str, "\r") !== FALSE)
			{
				$str = str_replace(array("\r\n", "\r", "\r\n\n"), PHP_EOL, $str);
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$str = remove_invisible_characters($str, FALSE);

		// Standardize newlines if needed
		if ($this->_standardize_newlines === TRUE)
		{
			return preg_replace('/(?:\r\n|[\r\n])/', PHP_EOL, $str);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	* Clean Keys
	*
	* This is a helper function. To prevent malicious users
	* from trying to exploit keys we make sure that keys are
	* only named with alpha-numeric text and a few other items.
	*
	* @access	private
	* @param	string
	* @return	string
	*/
	function _clean_input_keys($str)
	{
		if ( ! preg_match("/^[a-z0-9:_\/-]+$/i", $str))
		{
			exit('Disallowed Key Characters.');
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Clean Keys
	 *
	 * Internal method that helps to prevent malicious users
	 * from trying to exploit keys we make sure that keys are
	 * only named with alpha-numeric text and a few other items.
	 *
	 * @param	string	$str	Input string
	 * @param	bool	$fatal	Whether to terminate script exection
	 *				or to return FALSE if an invalid
	 *				key is encountered
	 * @return	string|bool
	 */
	protected function _clean_input_keys($str, $fatal = TRUE)
	{
		if ( ! preg_match('/^[a-z0-9:_\/|-]+$/i', $str))
		{
			if ($fatal === TRUE)
			{
				return FALSE;
			}
			else
			{
				set_status_header(503);
				echo 'Disallowed Key Characters.';
				exit(7); // EXIT_USER_INPUT
			}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// Clean UTF-8 if supported
		if (UTF8_ENABLED === TRUE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$str = $this->uni->clean_string($str);
=======
			return $this->uni->clean_string($str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			return $this->uni->clean_string($str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Request Headers
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * In Apache, you can simply call apache_request_headers(), however for
	 * people running other webservers the function is undefined.
	 *
	 * @param	bool XSS cleaning
	 *
	 * @return array
	 */
	public function request_headers($xss_clean = FALSE)
	{
		// Look at Apache go!
		if (function_exists('apache_request_headers'))
		{
			$headers = apache_request_headers();
		}
		else
		{
			$headers['Content-Type'] = (isset($_SERVER['CONTENT_TYPE'])) ? $_SERVER['CONTENT_TYPE'] : @getenv('CONTENT_TYPE');

			foreach ($_SERVER as $key => $val)
			{
				if (strncmp($key, 'HTTP_', 5) === 0)
				{
					$headers[substr($key, 5)] = $this->_fetch_from_array($_SERVER, $key, $xss_clean);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	bool	$xss_clean	Whether to apply XSS filtering
	 * @return	array
	 */
	public function request_headers($xss_clean = FALSE)
	{
		// If header is already defined, return it immediately
		if ( ! empty($this->headers))
		{
			return $this->_fetch_from_array($this->headers, NULL, $xss_clean);
		}

		// In Apache, you can simply call apache_request_headers()
		if (function_exists('apache_request_headers'))
		{
			$this->headers = apache_request_headers();
		}
		else
		{
			isset($_SERVER['CONTENT_TYPE']) && $this->headers['Content-Type'] = $_SERVER['CONTENT_TYPE'];

			foreach ($_SERVER as $key => $val)
			{
				if (sscanf($key, 'HTTP_%s', $header) === 1)
				{
					// take SOME_HEADER and turn it into Some-Header
					$header = str_replace('_', ' ', strtolower($header));
					$header = str_replace(' ', '-', ucwords($header));

					$this->headers[$header] = $_SERVER[$key];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// take SOME_HEADER and turn it into Some-Header
		foreach ($headers as $key => $val)
		{
			$key = str_replace('_', ' ', strtolower($key));
			$key = str_replace(' ', '-', ucwords($key));

			$this->headers[$key] = $val;
		}

		return $this->headers;
=======
		return $this->_fetch_from_array($this->headers, NULL, $xss_clean);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return $this->_fetch_from_array($this->headers, NULL, $xss_clean);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Get Request Header
	 *
	 * Returns the value of a single member of the headers class member
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	string		array key for $this->headers
	 * @param	boolean		XSS Clean or not
	 * @return 	mixed		FALSE on failure, string on success
	 */
	public function get_request_header($index, $xss_clean = FALSE)
	{
		if (empty($this->headers))
		{
			$this->request_headers();
		}

		if ( ! isset($this->headers[$index]))
		{
			return FALSE;
		}

		if ($xss_clean === TRUE)
		{
			return $this->security->xss_clean($this->headers[$index]);
		}

		return $this->headers[$index];
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string		$index		Header name
	 * @param	bool		$xss_clean	Whether to apply XSS filtering
	 * @return	string|null	The requested header on success or NULL on failure
	 */
	public function get_request_header($index, $xss_clean = FALSE)
	{
		static $headers;

		if ( ! isset($headers))
		{
			empty($this->headers) && $this->request_headers();
			foreach ($this->headers as $key => $value)
			{
				$headers[strtolower($key)] = $value;
			}
		}

		$index = strtolower($index);

		if ( ! isset($headers[$index]))
		{
			return NULL;
		}

		return ($xss_clean === TRUE)
			? $this->security->xss_clean($headers[$index])
			: $headers[$index];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Is ajax Request?
	 *
	 * Test to see if a request contains the HTTP_X_REQUESTED_WITH header
	 *
	 * @return 	boolean
	 */
	public function is_ajax_request()
	{
		return ($this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest');
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Is AJAX request?
	 *
	 * Test to see if a request contains the HTTP_X_REQUESTED_WITH header.
	 *
	 * @return 	bool
	 */
	public function is_ajax_request()
	{
		return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Is cli Request?
	 *
	 * Test to see if a request was made from the command line
	 *
	 * @return 	bool
	 */
	public function is_cli_request()
	{
		return (php_sapi_name() === 'cli' OR defined('STDIN'));
	}

}

/* End of file Input.php */
/* Location: ./system/core/Input.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Is CLI request?
	 *
	 * Test to see if a request was made from the command line.
	 *
	 * @deprecated	3.0.0	Use is_cli() instead
	 * @return	bool
	 */
	public function is_cli_request()
	{
		return is_cli();
	}

	// --------------------------------------------------------------------

	/**
	 * Get Request Method
	 *
	 * Return the request method
	 *
	 * @param	bool	$upper	Whether to return in upper or lower case
	 *				(default: FALSE)
	 * @return 	string
	 */
	public function method($upper = FALSE)
	{
		return ($upper)
			? strtoupper($this->server('REQUEST_METHOD'))
			: strtolower($this->server('REQUEST_METHOD'));
	}

	// ------------------------------------------------------------------------

	/**
	 * Magic __get()
	 *
	 * Allows read access to protected properties
	 *
	 * @param	string	$name
	 * @return	mixed
	 */
	public function __get($name)
	{
		if ($name === 'raw_input_stream')
		{
			isset($this->_raw_input_stream) OR $this->_raw_input_stream = file_get_contents('php://input');
			return $this->_raw_input_stream;
		}
		elseif ($name === 'ip_address')
		{
			return $this->ip_address;
		}
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
