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
 * Parser Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Parser
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/parser.html
 */
class CI_Parser {

	var $l_delim = '{';
	var $r_delim = '}';
	var $object;

	/**
	 *  Parse a template
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/parser.html
 */
class CI_Parser {

	/**
	 * Left delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $l_delim = '{';

	/**
	 * Right delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $r_delim = '}';

	/**
	 * Reference to CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		log_message('info', 'Parser Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a template
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * Parses pseudo-variables contained in the specified template view,
	 * replacing them with the data in the second param
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	public function parse($template, $data, $return = FALSE)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		$CI =& get_instance();
		$template = $CI->load->view($template, $data, TRUE);
=======
		$template = $this->CI->load->view($template, $data, TRUE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$template = $this->CI->load->view($template, $data, TRUE);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		return $this->_parse($template, $data, $return);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 *  Parse a String
=======
	 * Parse a String
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * Parse a String
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * Parses pseudo-variables contained in the specified string,
	 * replacing them with the data in the second param
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function parse_string($template, $data, $return = FALSE)
=======
	public function parse_string($template, $data, $return = FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function parse_string($template, $data, $return = FALSE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->_parse($template, $data, $return);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 *  Parse a template
=======
	 * Parse a template
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * Parse a template
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * Parses pseudo-variables contained in the specified template,
	 * replacing them with the data in the second param
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _parse($template, $data, $return = FALSE)
	{
		if ($template == '')
=======
	protected function _parse($template, $data, $return = FALSE)
	{
		if ($template === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	protected function _parse($template, $data, $return = FALSE)
	{
		if ($template === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		foreach ($data as $key => $val)
		{
			if (is_array($val))
			{
				$template = $this->_parse_pair($key, $val, $template);
			}
			else
			{
				$template = $this->_parse_single($key, (string)$val, $template);
			}
		}

		if ($return == FALSE)
		{
			$CI =& get_instance();
			$CI->output->append_output($template);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$replace = array();
		foreach ($data as $key => $val)
		{
			$replace = array_merge(
				$replace,
				is_array($val)
					? $this->_parse_pair($key, $val, $template)
					: $this->_parse_single($key, (string) $val, $template)
			);
		}

		unset($data);
		$template = strtr($template, $replace);

		if ($return === FALSE)
		{
			$this->CI->output->append_output($template);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $template;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 *  Set the left/right variable delimiters
	 *
	 * @access	public
=======
	 * Set the left/right variable delimiters
	 *
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * Set the left/right variable delimiters
	 *
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	void
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function set_delimiters($l = '{', $r = '}')
=======
	public function set_delimiters($l = '{', $r = '}')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function set_delimiters($l = '{', $r = '}')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$this->l_delim = $l;
		$this->r_delim = $r;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 *  Parse a single key/value
	 *
	 * @access	private
=======
	 * Parse a single key/value
	 *
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * Parse a single key/value
	 *
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _parse_single($key, $val, $string)
	{
		return str_replace($this->l_delim.$key.$this->r_delim, $val, $string);
=======
	protected function _parse_single($key, $val, $string)
	{
		return array($this->l_delim.$key.$this->r_delim => (string) $val);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	protected function _parse_single($key, $val, $string)
	{
		return array($this->l_delim.$key.$this->r_delim => (string) $val);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 *  Parse a tag pair
	 *
	 * Parses tag pairs:  {some_tag} string... {/some_tag}
	 *
	 * @access	private
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Parse a tag pair
	 *
	 * Parses tag pairs: {some_tag} string... {/some_tag}
	 *
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _parse_pair($variable, $data, $string)
	{
		if (FALSE === ($match = $this->_match_pair($string, $variable)))
		{
			return $string;
		}

		$str = '';
		foreach ($data as $row)
		{
			$temp = $match['1'];
			foreach ($row as $key => $val)
			{
				if ( ! is_array($val))
				{
					$temp = $this->_parse_single($key, $val, $temp);
				}
				else
				{
					$temp = $this->_parse_pair($key, $val, $temp);
				}
			}

			$str .= $temp;
		}

		return str_replace($match['0'], $str, $string);
	}

	// --------------------------------------------------------------------

	/**
	 *  Matches a variable pair
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	mixed
	 */
	function _match_pair($string, $variable)
	{
		if ( ! preg_match("|" . preg_quote($this->l_delim) . $variable . preg_quote($this->r_delim) . "(.+?)". preg_quote($this->l_delim) . '/' . $variable . preg_quote($this->r_delim) . "|s", $string, $match))
		{
			return FALSE;
		}

		return $match;
	}

}
// END Parser Class

/* End of file Parser.php */
/* Location: ./system/libraries/Parser.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	protected function _parse_pair($variable, $data, $string)
	{
		$replace = array();
		preg_match_all(
			'#'.preg_quote($this->l_delim.$variable.$this->r_delim).'(.+?)'.preg_quote($this->l_delim.'/'.$variable.$this->r_delim).'#s',
			$string,
			$matches,
			PREG_SET_ORDER
		);

		foreach ($matches as $match)
		{
			$str = '';
			foreach ($data as $row)
			{
				$temp = array();
				foreach ($row as $key => $val)
				{
					if (is_array($val))
					{
						$pair = $this->_parse_pair($key, $val, $match[1]);
						if ( ! empty($pair))
						{
							$temp = array_merge($temp, $pair);
						}

						continue;
					}

					$temp[$this->l_delim.$key.$this->r_delim] = $val;
				}

				$str .= strtr($match[1], $temp);
			}

			$replace[$match[0]] = $str;
		}

		return $replace;
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
