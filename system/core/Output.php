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
 * Output Class
 *
<<<<<<< HEAD
<<<<<<< HEAD
 * Responsible for sending final output to browser
=======
 * Responsible for sending final output to the browser.
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * Responsible for sending final output to the browser.
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Output
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/output.html
=======
 * @link		https://codeigniter.com/user_guide/libraries/output.html
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/libraries/output.html
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_Output {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Current output string
	 *
	 * @var string
	 * @access 	protected
	 */
	protected $final_output;
	/**
	 * Cache expiration time
	 *
	 * @var int
	 * @access 	protected
	 */
	protected $cache_expiration	= 0;
	/**
	 * List of server headers
	 *
	 * @var array
	 * @access 	protected
	 */
	protected $headers			= array();
	/**
	 * List of mime types
	 *
	 * @var array
	 * @access 	protected
	 */
	protected $mime_types		= array();
	/**
	 * Determines wether profiler is enabled
	 *
	 * @var book
	 * @access 	protected
	 */
	protected $enable_profiler	= FALSE;
	/**
	 * Determines if output compression is enabled
	 *
	 * @var bool
	 * @access 	protected
	 */
	protected $_zlib_oc			= FALSE;
	/**
	 * List of profiler sections
	 *
	 * @var array
	 * @access 	protected
	 */
	protected $_profiler_sections = array();
	/**
	 * Whether or not to parse variables like {elapsed_time} and {memory_usage}
	 *
	 * @var bool
	 * @access 	protected
	 */
	protected $parse_exec_vars	= TRUE;

	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		$this->_zlib_oc = @ini_get('zlib.output_compression');

		// Get mime types for later
		if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
		{
		    include APPPATH.'config/'.ENVIRONMENT.'/mimes.php';
		}
		else
		{
			include APPPATH.'config/mimes.php';
		}


		$this->mime_types = $mimes;

		log_message('debug', "Output Class Initialized");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Final output string
	 *
	 * @var	string
	 */
	public $final_output;

	/**
	 * Cache expiration time
	 *
	 * @var	int
	 */
	public $cache_expiration = 0;

	/**
	 * List of server headers
	 *
	 * @var	array
	 */
	public $headers = array();

	/**
	 * List of mime types
	 *
	 * @var	array
	 */
	public $mimes =	array();

	/**
	 * Mime-type for the current page
	 *
	 * @var	string
	 */
	protected $mime_type = 'text/html';

	/**
	 * Enable Profiler flag
	 *
	 * @var	bool
	 */
	public $enable_profiler = FALSE;

	/**
	 * php.ini zlib.output_compression flag
	 *
	 * @var	bool
	 */
	protected $_zlib_oc = FALSE;

	/**
	 * CI output compression flag
	 *
	 * @var	bool
	 */
	protected $_compress_output = FALSE;

	/**
	 * List of profiler sections
	 *
	 * @var	array
	 */
	protected $_profiler_sections =	array();

	/**
	 * Parse markers flag
	 *
	 * Whether or not to parse variables like {elapsed_time} and {memory_usage}.
	 *
	 * @var	bool
	 */
	public $parse_exec_vars = TRUE;

	/**
<<<<<<< HEAD
=======
	 * mbstring.func_override flag
	 *
	 * @var	bool
	 */
	protected static $func_override;

	/**
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Class constructor
	 *
	 * Determines whether zLib output compression will be used.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->_zlib_oc = (bool) ini_get('zlib.output_compression');
		$this->_compress_output = (
			$this->_zlib_oc === FALSE
			&& config_item('compress_output') === TRUE
			&& extension_loaded('zlib')
		);

<<<<<<< HEAD
=======
		isset(self::$func_override) OR self::$func_override = (extension_loaded('mbstring') && ini_get('mbstring.func_override'));

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Get mime types for later
		$this->mimes =& get_mimes();

		log_message('info', 'Output Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Get Output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Returns the current output string
	 *
	 * @access	public
	 * @return	string
	 */
	function get_output()
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Returns the current output string.
	 *
	 * @return	string
	 */
	public function get_output()
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->final_output;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Sets the output string
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function set_output($output)
	{
		$this->final_output = $output;

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Sets the output string.
	 *
	 * @param	string	$output	Output data
	 * @return	CI_Output
	 */
	public function set_output($output)
	{
		$this->final_output = $output;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Append Output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Appends data onto the output string
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function append_output($output)
	{
		if ($this->final_output == '')
		{
			$this->final_output = $output;
		}
		else
		{
			$this->final_output .= $output;
		}

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Appends data onto the output string.
	 *
	 * @param	string	$output	Data to append
	 * @return	CI_Output
	 */
	public function append_output($output)
	{
		$this->final_output .= $output;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Header
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Lets you set a server header which will be outputted with the final display.
	 *
	 * Note:  If a file is cached, headers will not be sent.  We need to figure out
	 * how to permit header data to be saved with the cache data...
	 *
	 * @access	public
	 * @param	string
	 * @param 	bool
	 * @return	void
	 */
	function set_header($header, $replace = TRUE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Lets you set a server header which will be sent with the final output.
	 *
	 * Note: If a file is cached, headers will not be sent.
	 * @todo	We need to figure out how to permit headers to be cached.
	 *
	 * @param	string	$header		Header
	 * @param	bool	$replace	Whether to replace the old header value, if already set
	 * @return	CI_Output
	 */
	public function set_header($header, $replace = TRUE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		// If zlib.output_compression is enabled it will compress the output,
		// but it will not modify the content-length header to compensate for
		// the reduction, causing the browser to hang waiting for more data.
		// We'll just skip content-length in those cases.
<<<<<<< HEAD
<<<<<<< HEAD

		if ($this->_zlib_oc && strncasecmp($header, 'content-length', 14) == 0)
		{
			return;
		}

		$this->headers[] = array($header, $replace);

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ($this->_zlib_oc && strncasecmp($header, 'content-length', 14) === 0)
		{
			return $this;
		}

		$this->headers[] = array($header, $replace);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set Content Type Header
	 *
	 * @access	public
	 * @param	string	extension of the file we're outputting
	 * @return	void
	 */
	function set_content_type($mime_type)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Set Content-Type Header
	 *
	 * @param	string	$mime_type	Extension of the file we're outputting
	 * @param	string	$charset	Character set (default: NULL)
	 * @return	CI_Output
	 */
	public function set_content_type($mime_type, $charset = NULL)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if (strpos($mime_type, '/') === FALSE)
		{
			$extension = ltrim($mime_type, '.');

			// Is this extension supported?
<<<<<<< HEAD
<<<<<<< HEAD
			if (isset($this->mime_types[$extension]))
			{
				$mime_type =& $this->mime_types[$extension];
=======
			if (isset($this->mimes[$extension]))
			{
				$mime_type =& $this->mimes[$extension];
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if (isset($this->mimes[$extension]))
			{
				$mime_type =& $this->mimes[$extension];
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

				if (is_array($mime_type))
				{
					$mime_type = current($mime_type);
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$header = 'Content-Type: '.$mime_type;

		$this->headers[] = array($header, TRUE);

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$this->mime_type = $mime_type;

		if (empty($charset))
		{
			$charset = config_item('charset');
		}

		$header = 'Content-Type: '.$mime_type
			.(empty($charset) ? '' : '; charset='.$charset);

		$this->headers[] = array($header, TRUE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set HTTP Status Header
	 * moved to Common procedural functions in 1.7.2
	 *
	 * @access	public
	 * @param	int		the status code
	 * @param	string
	 * @return	void
	 */
	function set_status_header($code = 200, $text = '')
	{
		set_status_header($code, $text);

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Get Current Content-Type Header
	 *
	 * @return	string	'text/html', if not already set
	 */
	public function get_content_type()
	{
		for ($i = 0, $c = count($this->headers); $i < $c; $i++)
		{
			if (sscanf($this->headers[$i][0], 'Content-Type: %[^;]', $content_type) === 1)
			{
				return $content_type;
			}
		}

		return 'text/html';
	}

	// --------------------------------------------------------------------

	/**
	 * Get Header
	 *
	 * @param	string	$header
	 * @return	string
	 */
	public function get_header($header)
	{
		// Combine headers already sent with our batched headers
		$headers = array_merge(
			// We only need [x][0] from our multi-dimensional array
			array_map('array_shift', $this->headers),
			headers_list()
		);

		if (empty($headers) OR empty($header))
		{
			return NULL;
		}

		for ($i = 0, $c = count($headers); $i < $c; $i++)
		{
<<<<<<< HEAD
			if (strncasecmp($header, $headers[$i], $l = strlen($header)) === 0)
			{
				return trim(substr($headers[$i], $l+1));
=======
			if (strncasecmp($header, $headers[$i], $l = self::strlen($header)) === 0)
			{
				return trim(self::substr($headers[$i], $l+1));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}
		}

		return NULL;
	}

	// --------------------------------------------------------------------

	/**
	 * Set HTTP Status Header
	 *
	 * As of version 1.7.2, this is an alias for common function
	 * set_status_header().
	 *
	 * @param	int	$code	Status code (default: 200)
	 * @param	string	$text	Optional message
	 * @return	CI_Output
	 */
	public function set_status_header($code = 200, $text = '')
	{
		set_status_header($code, $text);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Enable/disable Profiler
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	bool
	 * @return	void
	 */
	function enable_profiler($val = TRUE)
	{
		$this->enable_profiler = (is_bool($val)) ? $val : TRUE;

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	bool	$val	TRUE to enable or FALSE to disable
	 * @return	CI_Output
	 */
	public function enable_profiler($val = TRUE)
	{
		$this->enable_profiler = is_bool($val) ? $val : TRUE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Profiler Sections
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Allows override of default / config settings for Profiler section display
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function set_profiler_sections($sections)
	{
		foreach ($sections as $section => $enable)
		{
			$this->_profiler_sections[$section] = ($enable !== FALSE) ? TRUE : FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Allows override of default/config settings for
	 * Profiler section display.
	 *
	 * @param	array	$sections	Profiler sections
	 * @return	CI_Output
	 */
	public function set_profiler_sections($sections)
	{
		if (isset($sections['query_toggle_count']))
		{
			$this->_profiler_sections['query_toggle_count'] = (int) $sections['query_toggle_count'];
			unset($sections['query_toggle_count']);
		}

		foreach ($sections as $section => $enable)
		{
			$this->_profiler_sections[$section] = ($enable !== FALSE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Cache
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	integer
	 * @return	void
	 */
	function cache($time)
	{
		$this->cache_expiration = ( ! is_numeric($time)) ? 0 : $time;

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	int	$time	Cache expiration time in minutes
	 * @return	CI_Output
	 */
	public function cache($time)
	{
		$this->cache_expiration = is_numeric($time) ? $time : 0;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Display Output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * All "view" data is automatically put into this variable by the controller class:
	 *
	 * $this->final_output
	 *
	 * This function sends the finalized output data to the browser along
	 * with any server headers and profile data.  It also stops the
	 * benchmark timer so the page rendering speed and memory usage can be shown.
	 *
	 * @access	public
	 * @param 	string
	 * @return	mixed
	 */
	function _display($output = '')
	{
		// Note:  We use globals because we can't use $CI =& get_instance()
		// since this function is sometimes called by the caching mechanism,
		// which happens before the CI super object is available.
		global $BM, $CFG;

		// Grab the super object if we can.
		if (class_exists('CI_Controller'))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Processes and sends finalized output data to the browser along
	 * with any server headers and profile data. It also stops benchmark
	 * timers so the page rendering speed and memory usage can be shown.
	 *
	 * Note: All "view" data is automatically put into $this->final_output
	 *	 by controller class.
	 *
	 * @uses	CI_Output::$final_output
	 * @param	string	$output	Output data override
	 * @return	void
	 */
	public function _display($output = '')
	{
		// Note:  We use load_class() because we can't use $CI =& get_instance()
		// since this function is sometimes called by the caching mechanism,
		// which happens before the CI super object is available.
		$BM =& load_class('Benchmark', 'core');
		$CFG =& load_class('Config', 'core');

		// Grab the super object if we can.
		if (class_exists('CI_Controller', FALSE))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$CI =& get_instance();
		}

		// --------------------------------------------------------------------

		// Set the output data
<<<<<<< HEAD
<<<<<<< HEAD
		if ($output == '')
=======
		if ($output === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($output === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$output =& $this->final_output;
		}

		// --------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
		// Do we need to write a cache file?  Only if the controller does not have its
=======
		// Do we need to write a cache file? Only if the controller does not have its
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		// Do we need to write a cache file? Only if the controller does not have its
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// own _output() method and we are not dealing with a cache file, which we
		// can determine by the existence of the $CI object above
		if ($this->cache_expiration > 0 && isset($CI) && ! method_exists($CI, '_output'))
		{
			$this->_write_cache($output);
		}

		// --------------------------------------------------------------------

		// Parse out the elapsed time and memory usage,
		// then swap the pseudo-variables with the data

		$elapsed = $BM->elapsed_time('total_execution_time_start', 'total_execution_time_end');

		if ($this->parse_exec_vars === TRUE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$memory	 = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';

			$output = str_replace('{elapsed_time}', $elapsed, $output);
			$output = str_replace('{memory_usage}', $memory, $output);
=======
			$memory	= round(memory_get_usage() / 1024 / 1024, 2).'MB';
			$output = str_replace(array('{elapsed_time}', '{memory_usage}'), array($elapsed, $memory), $output);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$memory	= round(memory_get_usage() / 1024 / 1024, 2).'MB';
			$output = str_replace(array('{elapsed_time}', '{memory_usage}'), array($elapsed, $memory), $output);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// --------------------------------------------------------------------

		// Is compression requested?
<<<<<<< HEAD
<<<<<<< HEAD
		if ($CFG->item('compress_output') === TRUE && $this->_zlib_oc == FALSE)
		{
			if (extension_loaded('zlib'))
			{
				if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
				{
					ob_start('ob_gzhandler');
				}
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (isset($CI) // This means that we're not serving a cache file, if we were, it would already be compressed
			&& $this->_compress_output === TRUE
			&& isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
		{
			ob_start('ob_gzhandler');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// --------------------------------------------------------------------

		// Are there any server headers to send?
		if (count($this->headers) > 0)
		{
			foreach ($this->headers as $header)
			{
				@header($header[0], $header[1]);
			}
		}

		// --------------------------------------------------------------------

		// Does the $CI object exist?
		// If not we know we are dealing with a cache file so we'll
		// simply echo out the data and exit.
		if ( ! isset($CI))
		{
<<<<<<< HEAD
<<<<<<< HEAD
			echo $output;
			log_message('debug', "Final output sent to browser");
			log_message('debug', "Total execution time: ".$elapsed);
			return TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->_compress_output === TRUE)
			{
				if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
				{
					header('Content-Encoding: gzip');
<<<<<<< HEAD
					header('Content-Length: '.strlen($output));
=======
					header('Content-Length: '.self::strlen($output));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
				else
				{
					// User agent doesn't support gzip compression,
					// so we'll have to decompress our cache
<<<<<<< HEAD
					$output = gzinflate(substr($output, 10, -8));
=======
					$output = gzinflate(self::substr($output, 10, -8));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
			}

			echo $output;
			log_message('info', 'Final output sent to browser');
			log_message('debug', 'Total execution time: '.$elapsed);
			return;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// --------------------------------------------------------------------

		// Do we need to generate profile data?
		// If so, load the Profile class and run it.
<<<<<<< HEAD
<<<<<<< HEAD
		if ($this->enable_profiler == TRUE)
		{
			$CI->load->library('profiler');

=======
		if ($this->enable_profiler === TRUE)
		{
			$CI->load->library('profiler');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($this->enable_profiler === TRUE)
		{
			$CI->load->library('profiler');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ( ! empty($this->_profiler_sections))
			{
				$CI->profiler->set_sections($this->_profiler_sections);
			}

			// If the output data contains closing </body> and </html> tags
			// we will remove them and add them back after we insert the profile data
<<<<<<< HEAD
<<<<<<< HEAD
			if (preg_match("|</body>.*?</html>|is", $output))
			{
				$output  = preg_replace("|</body>.*?</html>|is", '', $output);
				$output .= $CI->profiler->run();
				$output .= '</body></html>';
			}
			else
			{
				$output .= $CI->profiler->run();
			}
		}

		// --------------------------------------------------------------------

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$output = preg_replace('|</body>.*?</html>|is', '', $output, -1, $count).$CI->profiler->run();
			if ($count > 0)
			{
				$output .= '</body></html>';
			}
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Does the controller contain a function named _output()?
		// If so send the output there.  Otherwise, echo it.
		if (method_exists($CI, '_output'))
		{
			$CI->_output($output);
		}
		else
		{
<<<<<<< HEAD
<<<<<<< HEAD
			echo $output;  // Send it to the browser!
		}

		log_message('debug', "Final output sent to browser");
		log_message('debug', "Total execution time: ".$elapsed);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			echo $output; // Send it to the browser!
		}

		log_message('info', 'Final output sent to browser');
		log_message('debug', 'Total execution time: '.$elapsed);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Write a Cache File
	 *
	 * @access	public
	 * @param 	string
	 * @return	void
	 */
	function _write_cache($output)
	{
		$CI =& get_instance();
		$path = $CI->config->item('cache_path');

		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

		if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
		{
			log_message('error', "Unable to write cache file: ".$cache_path);
			return;
		}

		$uri =	$CI->config->item('base_url').
				$CI->config->item('index_page').
				$CI->uri->uri_string();

		$cache_path .= md5($uri);

		if ( ! $fp = @fopen($cache_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{
			log_message('error', "Unable to write cache file: ".$cache_path);
			return;
		}

		$expire = time() + ($this->cache_expiration * 60);

		if (flock($fp, LOCK_EX))
		{
			fwrite($fp, $expire.'TS--->'.$output);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Write Cache
	 *
	 * @param	string	$output	Output data to cache
	 * @return	void
	 */
	public function _write_cache($output)
	{
		$CI =& get_instance();
		$path = $CI->config->item('cache_path');
		$cache_path = ($path === '') ? APPPATH.'cache/' : $path;

		if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
		{
			log_message('error', 'Unable to write cache file: '.$cache_path);
			return;
		}

		$uri = $CI->config->item('base_url')
			.$CI->config->item('index_page')
			.$CI->uri->uri_string();

		if (($cache_query_string = $CI->config->item('cache_query_string')) && ! empty($_SERVER['QUERY_STRING']))
		{
			if (is_array($cache_query_string))
			{
				$uri .= '?'.http_build_query(array_intersect_key($_GET, array_flip($cache_query_string)));
			}
			else
			{
				$uri .= '?'.$_SERVER['QUERY_STRING'];
			}
		}

		$cache_path .= md5($uri);

		if ( ! $fp = @fopen($cache_path, 'w+b'))
		{
			log_message('error', 'Unable to write cache file: '.$cache_path);
			return;
		}

		if (flock($fp, LOCK_EX))
		{
			// If output compression is enabled, compress the cache
			// itself, so that we don't have to do that each time
			// we're serving it
			if ($this->_compress_output === TRUE)
			{
				$output = gzencode($output);

				if ($this->get_header('content-type') === NULL)
				{
					$this->set_content_type($this->mime_type);
				}
			}

			$expire = time() + ($this->cache_expiration * 60);

			// Put together our serialized info.
			$cache_info = serialize(array(
				'expire'	=> $expire,
				'headers'	=> $this->headers
			));

			$output = $cache_info.'ENDCI--->'.$output;

<<<<<<< HEAD
			for ($written = 0, $length = strlen($output); $written < $length; $written += $result)
			{
				if (($result = fwrite($fp, substr($output, $written))) === FALSE)
=======
			for ($written = 0, $length = self::strlen($output); $written < $length; $written += $result)
			{
				if (($result = fwrite($fp, self::substr($output, $written))) === FALSE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					break;
				}
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			flock($fp, LOCK_UN);
		}
		else
		{
<<<<<<< HEAD
<<<<<<< HEAD
			log_message('error', "Unable to secure a file lock for file at: ".$cache_path);
			return;
		}
		fclose($fp);
		@chmod($cache_path, FILE_WRITE_MODE);

		log_message('debug', "Cache file written: ".$cache_path);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			log_message('error', 'Unable to secure a file lock for file at: '.$cache_path);
			return;
		}

		fclose($fp);

		if (is_int($result))
		{
			chmod($cache_path, 0640);
			log_message('debug', 'Cache file written: '.$cache_path);

			// Send HTTP cache-control headers to browser to match file cache settings.
			$this->set_cache_header($_SERVER['REQUEST_TIME'], $expire);
		}
		else
		{
			@unlink($cache_path);
			log_message('error', 'Unable to write the complete cache content at: '.$cache_path);
		}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Update/serve a cached file
	 *
	 * @access	public
	 * @param 	object	config class
	 * @param 	object	uri class
	 * @return	void
	 */
	function _display_cache(&$CFG, &$URI)
	{
		$cache_path = ($CFG->item('cache_path') == '') ? APPPATH.'cache/' : $CFG->item('cache_path');

		// Build the file path.  The file name is an MD5 hash of the full URI
		$uri =	$CFG->item('base_url').
				$CFG->item('index_page').
				$URI->uri_string;

		$filepath = $cache_path.md5($uri);

		if ( ! @file_exists($filepath))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Update/serve cached output
	 *
	 * @uses	CI_Config
	 * @uses	CI_URI
	 *
	 * @param	object	&$CFG	CI_Config class instance
	 * @param	object	&$URI	CI_URI class instance
	 * @return	bool	TRUE on success or FALSE on failure
	 */
	public function _display_cache(&$CFG, &$URI)
	{
		$cache_path = ($CFG->item('cache_path') === '') ? APPPATH.'cache/' : $CFG->item('cache_path');

		// Build the file path. The file name is an MD5 hash of the full URI
		$uri = $CFG->item('base_url').$CFG->item('index_page').$URI->uri_string;

		if (($cache_query_string = $CFG->item('cache_query_string')) && ! empty($_SERVER['QUERY_STRING']))
		{
			if (is_array($cache_query_string))
			{
				$uri .= '?'.http_build_query(array_intersect_key($_GET, array_flip($cache_query_string)));
			}
			else
			{
				$uri .= '?'.$_SERVER['QUERY_STRING'];
			}
		}

		$filepath = $cache_path.md5($uri);

		if ( ! file_exists($filepath) OR ! $fp = @fopen($filepath, 'rb'))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! $fp = @fopen($filepath, FOPEN_READ))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		flock($fp, LOCK_SH);

		$cache = (filesize($filepath) > 0) ? fread($fp, filesize($filepath)) : '';

		flock($fp, LOCK_UN);
		fclose($fp);

		// Look for embedded serialized file info.
		if ( ! preg_match('/^(.*)ENDCI--->/', $cache, $match))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return FALSE;
		}

<<<<<<< HEAD
		flock($fp, LOCK_SH);

		$cache = '';
		if (filesize($filepath) > 0)
		{
			$cache = fread($fp, filesize($filepath));
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		// Strip out the embedded timestamp
		if ( ! preg_match("/(\d+TS--->)/", $cache, $match))
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
		// Has the file expired? If so we'll delete it.
		if (time() >= trim(str_replace('TS--->', '', $match['1'])))
		{
			if (is_really_writable($cache_path))
			{
				@unlink($filepath);
				log_message('debug', "Cache file has expired. File deleted");
				return FALSE;
			}
		}

		// Display the cache
		$this->_display(str_replace($match['0'], '', $cache));
		log_message('debug', "Cache file is current. Sending it to browser.");
		return TRUE;
	}


}
// END Output Class

/* End of file Output.php */
/* Location: ./system/core/Output.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$cache_info = unserialize($match[1]);
		$expire = $cache_info['expire'];

		$last_modified = filemtime($filepath);

		// Has the file expired?
		if ($_SERVER['REQUEST_TIME'] >= $expire && is_really_writable($cache_path))
		{
			// If so we'll delete it.
			@unlink($filepath);
			log_message('debug', 'Cache file has expired. File deleted.');
			return FALSE;
		}
		else
		{
			// Or else send the HTTP cache control headers.
			$this->set_cache_header($last_modified, $expire);
		}

		// Add headers from cache file.
		foreach ($cache_info['headers'] as $header)
		{
			$this->set_header($header[0], $header[1]);
		}

		// Display the cache
<<<<<<< HEAD
		$this->_display(substr($cache, strlen($match[0])));
=======
		$this->_display(self::substr($cache, self::strlen($match[0])));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		log_message('debug', 'Cache file is current. Sending it to browser.');
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Delete cache
	 *
	 * @param	string	$uri	URI string
	 * @return	bool
	 */
	public function delete_cache($uri = '')
	{
		$CI =& get_instance();
		$cache_path = $CI->config->item('cache_path');
		if ($cache_path === '')
		{
			$cache_path = APPPATH.'cache/';
		}

		if ( ! is_dir($cache_path))
		{
			log_message('error', 'Unable to find cache path: '.$cache_path);
			return FALSE;
		}

		if (empty($uri))
		{
			$uri = $CI->uri->uri_string();

			if (($cache_query_string = $CI->config->item('cache_query_string')) && ! empty($_SERVER['QUERY_STRING']))
			{
				if (is_array($cache_query_string))
				{
					$uri .= '?'.http_build_query(array_intersect_key($_GET, array_flip($cache_query_string)));
				}
				else
				{
					$uri .= '?'.$_SERVER['QUERY_STRING'];
				}
			}
		}

		$cache_path .= md5($CI->config->item('base_url').$CI->config->item('index_page').ltrim($uri, '/'));

		if ( ! @unlink($cache_path))
		{
			log_message('error', 'Unable to delete cache file for '.$uri);
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Cache Header
	 *
	 * Set the HTTP headers to match the server-side file cache settings
	 * in order to reduce bandwidth.
	 *
	 * @param	int	$last_modified	Timestamp of when the page was last modified
	 * @param	int	$expiration	Timestamp of when should the requested page expire from cache
	 * @return	void
	 */
	public function set_cache_header($last_modified, $expiration)
	{
		$max_age = $expiration - $_SERVER['REQUEST_TIME'];

		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $last_modified <= strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']))
		{
			$this->set_status_header(304);
			exit;
		}
		else
		{
			header('Pragma: public');
			header('Cache-Control: max-age='.$max_age.', public');
			header('Expires: '.gmdate('D, d M Y H:i:s', $expiration).' GMT');
			header('Last-modified: '.gmdate('D, d M Y H:i:s', $last_modified).' GMT');
		}
	}

<<<<<<< HEAD
}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	// --------------------------------------------------------------------

	/**
	 * Byte-safe strlen()
	 *
	 * @param	string	$str
	 * @return	int
	 */
	protected static function strlen($str)
	{
		return (self::$func_override)
			? mb_strlen($str, '8bit')
			: strlen($str);
	}

	// --------------------------------------------------------------------

	/**
	 * Byte-safe substr()
	 *
	 * @param	string	$str
	 * @param	int	$start
	 * @param	int	$length
	 * @return	string
	 */
	protected static function substr($str, $start, $length = NULL)
	{
		if (self::$func_override)
		{
			// mb_substr($str, $start, null, '8bit') returns an empty
			// string on PHP 5.3
			isset($length) OR $length = ($start >= 0 ? self::strlen($str) - $start : -$start);
			return mb_substr($str, $start, $length, '8bit');
		}

		return isset($length)
			? substr($str, $start, $length)
			: substr($str, $start);
	}
}
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
