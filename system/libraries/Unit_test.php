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
 * @since		Version 1.3.1
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
 * @since	Version 1.3.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * Unit Testing Class
 *
 * Simple testing class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	UnitTesting
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/uri.html
 */
class CI_Unit_test {

	var $active					= TRUE;
	var $results				= array();
	var $strict					= FALSE;
	var $_template				= NULL;
	var $_template_rows			= NULL;
	var $_test_items_visible	= array();

	public function __construct()
	{
		// These are the default items visible when a test is run.
		$this->_test_items_visible = array (
							'test_name',
							'test_datatype',
							'res_datatype',
							'result',
							'file',
							'line',
							'notes'
						);

		log_message('debug', "Unit Testing Class Initialized");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/unit_testing.html
 */
class CI_Unit_test {

	/**
	 * Active flag
	 *
	 * @var	bool
	 */
	public $active = TRUE;

	/**
	 * Test results
	 *
	 * @var	array
	 */
	public $results = array();

	/**
	 * Strict comparison flag
	 *
	 * Whether to use === or == when comparing
	 *
	 * @var	bool
	 */
	public $strict = FALSE;

	/**
	 * Template
	 *
	 * @var	string
	 */
	protected $_template = NULL;

	/**
	 * Template rows
	 *
	 * @var	string
	 */
	protected $_template_rows = NULL;

	/**
	 * List of visible test items
	 *
	 * @var	array
	 */
	protected $_test_items_visible	= array(
		'test_name',
		'test_datatype',
		'res_datatype',
		'result',
		'file',
		'line',
		'notes'
	);

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Unit Testing Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Run the tests
	 *
	 * Runs the supplied tests
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function set_test_items($items = array())
	{
		if ( ! empty($items) AND is_array($items))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$items
	 * @return	void
	 */
	public function set_test_items($items)
	{
		if ( ! empty($items) && is_array($items))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->_test_items_visible = $items;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Run the tests
	 *
	 * Runs the supplied tests
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	mixed
	 * @param	mixed
	 * @param	string
	 * @return	string
	 */
	function run($test, $expected = TRUE, $test_name = 'undefined', $notes = '')
	{
		if ($this->active == FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	mixed	$test
	 * @param	mixed	$expected
	 * @param	string	$test_name
	 * @param	string	$notes
	 * @return	string
	 */
	public function run($test, $expected = TRUE, $test_name = 'undefined', $notes = '')
	{
		if ($this->active === FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if (in_array($expected, array('is_object', 'is_string', 'is_bool', 'is_true', 'is_false', 'is_int', 'is_numeric', 'is_float', 'is_double', 'is_array', 'is_null'), TRUE))
		{
			$expected = str_replace('is_float', 'is_double', $expected);
			$result = ($expected($test)) ? TRUE : FALSE;
=======
		if (in_array($expected, array('is_object', 'is_string', 'is_bool', 'is_true', 'is_false', 'is_int', 'is_numeric', 'is_float', 'is_double', 'is_array', 'is_null', 'is_resource'), TRUE))
		{
			$expected = str_replace('is_double', 'is_float', $expected);
			$result = $expected($test);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (in_array($expected, array('is_object', 'is_string', 'is_bool', 'is_true', 'is_false', 'is_int', 'is_numeric', 'is_float', 'is_double', 'is_array', 'is_null', 'is_resource'), TRUE))
		{
			$result = $expected($test);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$extype = str_replace(array('true', 'false'), 'bool', str_replace('is_', '', $expected));
		}
		else
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->strict == TRUE)
				$result = ($test === $expected) ? TRUE : FALSE;
			else
				$result = ($test == $expected) ? TRUE : FALSE;

=======
			$result = ($this->strict === TRUE) ? ($test === $expected) : ($test == $expected);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$result = ($this->strict === TRUE) ? ($test === $expected) : ($test == $expected);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$extype = gettype($expected);
		}

		$back = $this->_backtrace();

<<<<<<< HEAD
<<<<<<< HEAD
		$report[] = array (
							'test_name'			=> $test_name,
							'test_datatype'		=> gettype($test),
							'res_datatype'		=> $extype,
							'result'			=> ($result === TRUE) ? 'passed' : 'failed',
							'file'				=> $back['file'],
							'line'				=> $back['line'],
							'notes'				=> $notes
						);

		$this->results[] = $report;

		return($this->report($this->result($report)));
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$report = array (
			'test_name'     => $test_name,
			'test_datatype' => gettype($test),
			'res_datatype'  => $extype,
			'result'        => ($result === TRUE) ? 'passed' : 'failed',
			'file'          => $back['file'],
			'line'          => $back['line'],
			'notes'         => $notes
		);

		$this->results[] = $report;

		return $this->report($this->result(array($report)));
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Generate a report
	 *
	 * Displays a table with the test data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	string
	 */
	function report($result = array())
	{
		if (count($result) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	 $result
	 * @return	string
	 */
	public function report($result = array())
	{
		if (count($result) === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$result = $this->result();
		}

		$CI =& get_instance();
		$CI->load->language('unit_test');

		$this->_parse_template();

		$r = '';
		foreach ($result as $res)
		{
			$table = '';

			foreach ($res as $key => $val)
			{
<<<<<<< HEAD
<<<<<<< HEAD
				if ($key == $CI->lang->line('ut_result'))
				{
					if ($val == $CI->lang->line('ut_passed'))
					{
						$val = '<span style="color: #0C0;">'.$val.'</span>';
					}
					elseif ($val == $CI->lang->line('ut_failed'))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				if ($key === $CI->lang->line('ut_result'))
				{
					if ($val === $CI->lang->line('ut_passed'))
					{
						$val = '<span style="color: #0C0;">'.$val.'</span>';
					}
					elseif ($val === $CI->lang->line('ut_failed'))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					{
						$val = '<span style="color: #C00;">'.$val.'</span>';
					}
				}

<<<<<<< HEAD
<<<<<<< HEAD
				$temp = $this->_template_rows;
				$temp = str_replace('{item}', $key, $temp);
				$temp = str_replace('{result}', $val, $temp);
				$table .= $temp;
=======
				$table .= str_replace(array('{item}', '{result}'), array($key, $val), $this->_template_rows);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
				$table .= str_replace(array('{item}', '{result}'), array($key, $val), $this->_template_rows);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$r .= str_replace('{rows}', $table, $this->_template);
		}

		return $r;
	}

	// --------------------------------------------------------------------

	/**
	 * Use strict comparison
	 *
	 * Causes the evaluation to use === rather than ==
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	bool
	 * @return	null
	 */
	function use_strict($state = TRUE)
	{
		$this->strict = ($state == FALSE) ? FALSE : TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	bool	$state
	 * @return	void
	 */
	public function use_strict($state = TRUE)
	{
		$this->strict = (bool) $state;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Make Unit testing active
	 *
	 * Enables/disables unit testing
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	bool
	 * @return	null
	 */
	function active($state = TRUE)
	{
		$this->active = ($state == FALSE) ? FALSE : TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	bool
	 * @return	void
	 */
	public function active($state = TRUE)
	{
		$this->active = (bool) $state;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Result Array
	 *
	 * Returns the raw result data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function result($results = array())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$results
	 * @return	array
	 */
	public function result($results = array())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$CI =& get_instance();
		$CI->load->language('unit_test');

<<<<<<< HEAD
<<<<<<< HEAD
		if (count($results) == 0)
=======
		if (count($results) === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (count($results) === 0)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$results = $this->results;
		}

		$retval = array();
		foreach ($results as $result)
		{
			$temp = array();
			foreach ($result as $key => $val)
			{
				if ( ! in_array($key, $this->_test_items_visible))
				{
					continue;
				}
<<<<<<< HEAD
<<<<<<< HEAD

				if (is_array($val))
				{
					foreach ($val as $k => $v)
					{
						if (FALSE !== ($line = $CI->lang->line(strtolower('ut_'.$v))))
						{
							$v = $line;
						}
						$temp[$CI->lang->line('ut_'.$k)] = $v;
					}
				}
				else
				{
					if (FALSE !== ($line = $CI->lang->line(strtolower('ut_'.$val))))
					{
						$val = $line;
					}
					$temp[$CI->lang->line('ut_'.$key)] = $val;
				}
=======
				elseif (in_array($key, array('test_name', 'test_datatype', 'test_res_datatype', 'result'), TRUE))
=======
				elseif (in_array($key, array('test_name', 'test_datatype', 'res_datatype', 'result'), TRUE))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					if (FALSE !== ($line = $CI->lang->line(strtolower('ut_'.$val), FALSE)))
					{
						$val = $line;
					}
				}

				$temp[$CI->lang->line('ut_'.$key, FALSE)] = $val;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$retval[] = $temp;
		}

		return $retval;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the template
	 *
	 * This lets us set the template to be used to display results
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function set_template($template)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	void
	 */
	public function set_template($template)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$this->_template = $template;
	}

	// --------------------------------------------------------------------

	/**
	 * Generate a backtrace
	 *
	 * This lets us show file names and line numbers
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	array
	 */
	function _backtrace()
	{
		if (function_exists('debug_backtrace'))
		{
			$back = debug_backtrace();

			$file = ( ! isset($back['1']['file'])) ? '' : $back['1']['file'];
			$line = ( ! isset($back['1']['line'])) ? '' : $back['1']['line'];

			return array('file' => $file, 'line' => $line);
		}
		return array('file' => 'Unknown', 'line' => 'Unknown');
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	protected function _backtrace()
	{
		$back = debug_backtrace();
		return array(
			'file' => (isset($back[1]['file']) ? $back[1]['file'] : ''),
			'line' => (isset($back[1]['line']) ? $back[1]['line'] : '')
		);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Get Default Template
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	string
	 */
	function _default_template()
	{
		$this->_template = "\n".'<table style="width:100%; font-size:small; margin:10px 0; border-collapse:collapse; border:1px solid #CCC;">';
		$this->_template .= '{rows}';
		$this->_template .= "\n".'</table>';

		$this->_template_rows = "\n\t".'<tr>';
		$this->_template_rows .= "\n\t\t".'<th style="text-align: left; border-bottom:1px solid #CCC;">{item}</th>';
		$this->_template_rows .= "\n\t\t".'<td style="border-bottom:1px solid #CCC;">{result}</td>';
		$this->_template_rows .= "\n\t".'</tr>';
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	protected function _default_template()
	{
		$this->_template = "\n".'<table style="width:100%; font-size:small; margin:10px 0; border-collapse:collapse; border:1px solid #CCC;">{rows}'."\n</table>";

		$this->_template_rows = "\n\t<tr>\n\t\t".'<th style="text-align: left; border-bottom:1px solid #CCC;">{item}</th>'
					."\n\t\t".'<td style="border-bottom:1px solid #CCC;">{result}</td>'."\n\t</tr>";
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Parse Template
	 *
	 * Harvests the data within the template {pseudo-variables}
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	void
	 */
	function _parse_template()
	{
		if ( ! is_null($this->_template_rows))
		{
			return;
		}

		if (is_null($this->_template))
		{
			$this->_default_template();
			return;
		}

		if ( ! preg_match("/\{rows\}(.*?)\{\/rows\}/si", $this->_template, $match))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	protected function _parse_template()
	{
		if ($this->_template_rows !== NULL)
		{
			return;
		}

		if ($this->_template === NULL OR ! preg_match('/\{rows\}(.*?)\{\/rows\}/si', $this->_template, $match))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$this->_default_template();
			return;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$this->_template_rows = $match['1'];
		$this->_template = str_replace($match['0'], '{rows}', $this->_template);
	}

}
// END Unit_test Class

/**
 * Helper functions to test boolean true/false
 *
 *
 * @access	private
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$this->_template_rows = $match[1];
		$this->_template = str_replace($match[0], '{rows}', $this->_template);
	}

}

/**
 * Helper function to test boolean TRUE
 *
 * @param	mixed	$test
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @return	bool
 */
function is_true($test)
{
<<<<<<< HEAD
<<<<<<< HEAD
	return (is_bool($test) AND $test === TRUE) ? TRUE : FALSE;
}
function is_false($test)
{
	return (is_bool($test) AND $test === FALSE) ? TRUE : FALSE;
}


/* End of file Unit_test.php */
/* Location: ./system/libraries/Unit_test.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	return ($test === TRUE);
}

/**
 * Helper function to test boolean FALSE
 *
 * @param	mixed	$test
 * @return	bool
 */
function is_false($test)
{
	return ($test === FALSE);
}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
