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
 * @since		Version 2.0
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
 * @since	Version 2.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * Utf8 Class
 *
 * Provides support for UTF-8 environments
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	UTF-8
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/utf8.html
=======
 * @link		https://codeigniter.com/user_guide/libraries/utf8.html
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/libraries/utf8.html
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_Utf8 {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Constructor
	 *
	 * Determines if UTF-8 support is to be enabled
	 *
	 */
	function __construct()
	{
		log_message('debug', "Utf8 Class Initialized");

		global $CFG;

		if (
			preg_match('/./u', 'é') === 1					// PCRE must support UTF-8
			AND function_exists('iconv')					// iconv must be installed
			AND ini_get('mbstring.func_overload') != 1		// Multibyte string function overloading cannot be enabled
			AND $CFG->item('charset') == 'UTF-8'			// Application charset must be UTF-8
			)
		{
			log_message('debug', "UTF-8 Support Enabled");

			define('UTF8_ENABLED', TRUE);

			// set internal encoding for multibyte string functions if necessary
			// and set a flag so we don't have to repeatedly use extension_loaded()
			// or function_exists()
			if (extension_loaded('mbstring'))
			{
				define('MB_ENABLED', TRUE);
				mb_internal_encoding('UTF-8');
			}
			else
			{
				define('MB_ENABLED', FALSE);
			}
		}
		else
		{
			log_message('debug', "UTF-8 Support Disabled");
			define('UTF8_ENABLED', FALSE);
		}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Class constructor
	 *
	 * Determines if UTF-8 support is to be enabled.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		if (
			defined('PREG_BAD_UTF8_ERROR')				// PCRE must support UTF-8
			&& (ICONV_ENABLED === TRUE OR MB_ENABLED === TRUE)	// iconv or mbstring must be installed
			&& strtoupper(config_item('charset')) === 'UTF-8'	// Application charset must be UTF-8
			)
		{
			define('UTF8_ENABLED', TRUE);
			log_message('debug', 'UTF-8 Support Enabled');
		}
		else
		{
			define('UTF8_ENABLED', FALSE);
			log_message('debug', 'UTF-8 Support Disabled');
		}

		log_message('info', 'Utf8 Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Clean UTF-8 strings
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Ensures strings are UTF-8
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function clean_string($str)
	{
		if ($this->_is_ascii($str) === FALSE)
		{
			$str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Ensures strings contain only valid UTF-8 characters.
	 *
	 * @param	string	$str	String to clean
	 * @return	string
	 */
	public function clean_string($str)
	{
		if ($this->is_ascii($str) === FALSE)
		{
			if (MB_ENABLED)
			{
				$str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
			}
			elseif (ICONV_ENABLED)
			{
				$str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
			}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Remove ASCII control characters
	 *
	 * Removes all ASCII control characters except horizontal tabs,
	 * line feeds, and carriage returns, as all others can cause
<<<<<<< HEAD
<<<<<<< HEAD
	 * problems in XML
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function safe_ascii_for_xml($str)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * problems in XML.
	 *
	 * @param	string	$str	String to clean
	 * @return	string
	 */
	public function safe_ascii_for_xml($str)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return remove_invisible_characters($str, FALSE);
	}

	// --------------------------------------------------------------------

	/**
	 * Convert to UTF-8
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Attempts to convert a string to UTF-8
	 *
	 * @access	public
	 * @param	string
	 * @param	string	- input encoding
	 * @return	string
	 */
	function convert_to_utf8($str, $encoding)
	{
		if (function_exists('iconv'))
		{
			$str = @iconv($encoding, 'UTF-8', $str);
		}
		elseif (function_exists('mb_convert_encoding'))
		{
			$str = @mb_convert_encoding($str, 'UTF-8', $encoding);
		}
		else
		{
			return FALSE;
		}

		return $str;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Attempts to convert a string to UTF-8.
	 *
	 * @param	string	$str		Input string
	 * @param	string	$encoding	Input encoding
	 * @return	string	$str encoded in UTF-8 or FALSE on failure
	 */
	public function convert_to_utf8($str, $encoding)
	{
		if (MB_ENABLED)
		{
			return mb_convert_encoding($str, 'UTF-8', $encoding);
		}
		elseif (ICONV_ENABLED)
		{
			return @iconv($encoding, 'UTF-8', $str);
		}

		return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is ASCII?
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Tests if a string is standard 7-bit ASCII or not
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function _is_ascii($str)
	{
		return (preg_match('/[^\x00-\x7F]/S', $str) == 0);
	}

	// --------------------------------------------------------------------

}
// End Utf8 Class

/* End of file Utf8.php */
/* Location: ./system/core/Utf8.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Tests if a string is standard 7-bit ASCII or not.
	 *
	 * @param	string	$str	String to check
	 * @return	bool
	 */
	public function is_ascii($str)
	{
		return (preg_match('/[^\x00-\x7F]/S', $str) === 0);
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
