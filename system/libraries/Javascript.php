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
 * Javascript Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Javascript
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/javascript.html
 */
class CI_Javascript {

	var $_javascript_location = 'js';

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/javascript.html
 * @deprecated	3.0.0	This was never a good idea in the first place.
 */
class CI_Javascript {

	/**
	 * JavaScript location
	 *
	 * @var	string
	 */
	protected $_javascript_location = 'js';

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	array	$params
	 * @return	void
	 */
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	public function __construct($params = array())
	{
		$defaults = array('js_library_driver' => 'jquery', 'autoload' => TRUE);

		foreach ($defaults as $key => $val)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if (isset($params[$key]) && $params[$key] !== "")
=======
			if (isset($params[$key]) && $params[$key] !== '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if (isset($params[$key]) && $params[$key] !== '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$defaults[$key] = $params[$key];
			}
		}

		extract($defaults);

		$this->CI =& get_instance();

		// load the requested js library
<<<<<<< HEAD
<<<<<<< HEAD
		$this->CI->load->library('javascript/'.$js_library_driver, array('autoload' => $autoload));
		// make js to refer to current library
		$this->js =& $this->CI->$js_library_driver;

		log_message('debug', "Javascript Class Initialized and loaded.  Driver used: $js_library_driver");
	}

	// --------------------------------------------------------------------	
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$this->CI->load->library('Javascript/'.$js_library_driver, array('autoload' => $autoload));
		// make js to refer to current library
		$this->js =& $this->CI->$js_library_driver;

		log_message('info', 'Javascript Class Initialized and loaded. Driver used: '.$js_library_driver);
	}

	// --------------------------------------------------------------------
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// Event Code
	// --------------------------------------------------------------------

	/**
	 * Blur
	 *
	 * Outputs a javascript library blur event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function blur($element = 'this', $js = '')
=======
	public function blur($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function blur($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_blur($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Change
	 *
	 * Outputs a javascript library change event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function change($element = 'this', $js = '')
=======
	public function change($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function change($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_change($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Click
	 *
	 * Outputs a javascript library click event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @param	boolean	whether or not to return false
	 * @return	string
	 */
	function click($element = 'this', $js = '', $ret_false = TRUE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @param	bool	whether or not to return false
	 * @return	string
	 */
	public function click($element = 'this', $js = '', $ret_false = TRUE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_click($element, $js, $ret_false);
	}

	// --------------------------------------------------------------------

	/**
	 * Double Click
	 *
	 * Outputs a javascript library dblclick event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function dblclick($element = 'this', $js = '')
=======
	public function dblclick($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function dblclick($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_dblclick($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Error
	 *
	 * Outputs a javascript library error event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function error($element = 'this', $js = '')
=======
	public function error($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function error($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_error($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Focus
	 *
	 * Outputs a javascript library focus event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function focus($element = 'this', $js = '')
	{
		return $this->js->__add_event($focus, $js);
=======
	public function focus($element = 'this', $js = '')
	{
		return $this->js->_focus($element, $js);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function focus($element = 'this', $js = '')
	{
		return $this->js->_focus($element, $js);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Hover
	 *
	 * Outputs a javascript library hover event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- Javascript code for mouse over
	 * @param	string	- Javascript code for mouse out
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function hover($element = 'this', $over, $out)
	{
		return $this->js->__hover($element, $over, $out);
=======
	public function hover($element = 'this', $over = '', $out = '')
	{
		return $this->js->_hover($element, $over, $out);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function hover($element = 'this', $over = '', $out = '')
	{
		return $this->js->_hover($element, $over, $out);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Keydown
	 *
	 * Outputs a javascript library keydown event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function keydown($element = 'this', $js = '')
=======
	public function keydown($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function keydown($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_keydown($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Keyup
	 *
	 * Outputs a javascript library keydown event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function keyup($element = 'this', $js = '')
=======
	public function keyup($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function keyup($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_keyup($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Load
	 *
	 * Outputs a javascript library load event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function load($element = 'this', $js = '')
=======
	public function load($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function load($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_load($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mousedown
	 *
	 * Outputs a javascript library mousedown event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mousedown($element = 'this', $js = '')
=======
	public function mousedown($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mousedown($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_mousedown($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Out
	 *
	 * Outputs a javascript library mouseout event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mouseout($element = 'this', $js = '')
=======
	public function mouseout($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mouseout($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_mouseout($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Over
	 *
	 * Outputs a javascript library mouseover event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mouseover($element = 'this', $js = '')
=======
	public function mouseover($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mouseover($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_mouseover($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouseup
	 *
	 * Outputs a javascript library mouseup event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mouseup($element = 'this', $js = '')
=======
	public function mouseup($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mouseup($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_mouseup($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Output
	 *
	 * Outputs the called javascript to the screen
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The code to output
	 * @return	string
	 */
	function output($js)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The code to output
	 * @return	string
	 */
	public function output($js)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_output($js);
	}

	// --------------------------------------------------------------------

	/**
	 * Ready
	 *
	 * Outputs a javascript library mouseup event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function ready($js)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$js	Code to execute
	 * @return	string
	 */
	public function ready($js)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_document_ready($js);
	}

	// --------------------------------------------------------------------

	/**
	 * Resize
	 *
	 * Outputs a javascript library resize event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function resize($element = 'this', $js = '')
=======
	public function resize($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function resize($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_resize($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Scroll
	 *
	 * Outputs a javascript library scroll event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function scroll($element = 'this', $js = '')
=======
	public function scroll($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function scroll($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_scroll($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Unload
	 *
	 * Outputs a javascript library unload event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function unload($element = 'this', $js = '')
=======
	public function unload($element = 'this', $js = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function unload($element = 'this', $js = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_unload($element, $js);
	}

<<<<<<< HEAD
<<<<<<< HEAD
	// --------------------------------------------------------------------	
	// Effects
	// --------------------------------------------------------------------


=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------
	// Effects
	// --------------------------------------------------------------------

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * Add Class
	 *
	 * Outputs a javascript library addClass event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- Class to add
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function addClass($element = 'this', $class = '')
=======
	public function addClass($element = 'this', $class = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function addClass($element = 'this', $class = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_addClass($element, $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Animate
	 *
	 * Outputs a javascript library animate event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function animate($element = 'this', $params = array(), $speed = '', $extra = '')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$element = 'this'
	 * @param	array	$params = array()
	 * @param	mixed	$speed			'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	$extra
	 * @return	string
	 */
	public function animate($element = 'this', $params = array(), $speed = '', $extra = '')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_animate($element, $params, $speed, $extra);
	}

	// --------------------------------------------------------------------

	/**
	 * Fade In
	 *
	 * Outputs a javascript library hide event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function fadeIn($element = 'this', $speed = '', $callback = '')
=======
	public function fadeIn($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function fadeIn($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_fadeIn($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Fade Out
	 *
	 * Outputs a javascript library hide event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function fadeOut($element = 'this', $speed = '', $callback = '')
=======
	public function fadeOut($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function fadeOut($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_fadeOut($element, $speed, $callback);
	}
	// --------------------------------------------------------------------

	/**
	 * Slide Up
	 *
	 * Outputs a javascript library slideUp event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function slideUp($element = 'this', $speed = '', $callback = '')
=======
	public function slideUp($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function slideUp($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_slideUp($element, $speed, $callback);

	}

	// --------------------------------------------------------------------

	/**
	 * Remove Class
	 *
	 * Outputs a javascript library removeClass event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- Class to add
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function removeClass($element = 'this', $class = '')
=======
	public function removeClass($element = 'this', $class = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function removeClass($element = 'this', $class = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_removeClass($element, $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Down
	 *
	 * Outputs a javascript library slideDown event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function slideDown($element = 'this', $speed = '', $callback = '')
=======
	public function slideDown($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function slideDown($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_slideDown($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Toggle
	 *
	 * Outputs a javascript library slideToggle event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function slideToggle($element = 'this', $speed = '', $callback = '')
=======
	public function slideToggle($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function slideToggle($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_slideToggle($element, $speed, $callback);

	}

	// --------------------------------------------------------------------

	/**
	 * Hide
	 *
	 * Outputs a javascript library hide action
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function hide($element = 'this', $speed = '', $callback = '')
=======
	public function hide($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function hide($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_hide($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Toggle
	 *
	 * Outputs a javascript library toggle event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	- element
	 * @return	string
	 */
	function toggle($element = 'this')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @return	string
	 */
	public function toggle($element = 'this')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_toggle($element);

	}

	// --------------------------------------------------------------------

	/**
	 * Toggle Class
	 *
	 * Outputs a javascript library toggle class event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	- element
	 * @return	string
	 */
	function toggleClass($element = 'this', $class='')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$element = 'this'
	 * @param	string	$class = ''
	 * @return	string
	 */
	public function toggleClass($element = 'this', $class = '')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_toggleClass($element, $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Show
	 *
	 * Outputs a javascript library show event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function show($element = 'this', $speed = '', $callback = '')
=======
	public function show($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function show($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_show($element, $speed, $callback);
	}

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Compile
	 *
	 * gather together all script needing to be output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @return	string
	 */
	function compile($view_var = 'script_foot', $script_tags = TRUE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$view_var
	 * @param	bool	$script_tags
	 * @return	string
	 */
	public function compile($view_var = 'script_foot', $script_tags = TRUE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$this->js->_compile($view_var, $script_tags);
	}

<<<<<<< HEAD
<<<<<<< HEAD
=======
	// --------------------------------------------------------------------

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	// --------------------------------------------------------------------

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * Clear Compile
	 *
	 * Clears any previous javascript collected for output
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function clear_compile()
=======
	 * @return	void
	 */
	public function clear_compile()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	void
	 */
	public function clear_compile()
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$this->js->_clear_compile();
	}

	// --------------------------------------------------------------------

	/**
	 * External
	 *
	 * Outputs a <script> tag with the source as an external js file
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @return	string
	 */
	function external($external_file = '', $relative = FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$external_file
	 * @param	bool	$relative
	 * @return	string
	 */
	public function external($external_file = '', $relative = FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ($external_file !== '')
		{
			$this->_javascript_location = $external_file;
		}
<<<<<<< HEAD
<<<<<<< HEAD
		else
		{
			if ($this->CI->config->item('javascript_location') != '')
			{
				$this->_javascript_location = $this->CI->config->item('javascript_location');
			}
		}

		if ($relative === TRUE OR strncmp($external_file, 'http://', 7) == 0 OR strncmp($external_file, 'https://', 8) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		elseif ($this->CI->config->item('javascript_location') !== '')
		{
			$this->_javascript_location = $this->CI->config->item('javascript_location');
		}

		if ($relative === TRUE OR strpos($external_file, 'http://') === 0 OR strpos($external_file, 'https://') === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$str = $this->_open_script($external_file);
		}
		elseif (strpos($this->_javascript_location, 'http://') !== FALSE)
		{
			$str = $this->_open_script($this->_javascript_location.$external_file);
		}
		else
		{
			$str = $this->_open_script($this->CI->config->slash_item('base_url').$this->_javascript_location.$external_file);
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$str .= $this->_close_script();
		return $str;
=======
		return $str.$this->_close_script();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return $str.$this->_close_script();
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Inline
	 *
	 * Outputs a <script> tag
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	boolean	If a CDATA section should be added
	 * @return	string
	 */
	function inline($script, $cdata = TRUE)
	{
		$str = $this->_open_script();
		$str .= ($cdata) ? "\n// <![CDATA[\n{$script}\n// ]]>\n" : "\n{$script}\n";
		$str .= $this->_close_script();

		return $str;
	}
	
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	The element to attach the event to
	 * @param	bool	If a CDATA section should be added
	 * @return	string
	 */
	public function inline($script, $cdata = TRUE)
	{
		return $this->_open_script()
			. ($cdata ? "\n// <![CDATA[\n".$script."\n// ]]>\n" : "\n".$script."\n")
			. $this->_close_script();
	}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Open Script
	 *
	 * Outputs an opening <script>
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _open_script($src = '')
	{
		$str = '<script type="text/javascript" charset="'.strtolower($this->CI->config->item('charset')).'"';
		$str .= ($src == '') ? '>' : ' src="'.$src.'">';
		return $str;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	protected function _open_script($src = '')
	{
		return '<script type="text/javascript" charset="'.strtolower($this->CI->config->item('charset')).'"'
			.($src === '' ? '>' : ' src="'.$src.'">');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Close Script
	 *
	 * Outputs an closing </script>
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _close_script($extra = "\n")
	{
		return "</script>$extra";
	}


	// --------------------------------------------------------------------
	// --------------------------------------------------------------------
	// AJAX-Y STUFF - still a testbed
	// --------------------------------------------------------------------
	// --------------------------------------------------------------------
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	protected function _close_script($extra = "\n")
	{
		return '</script>'.$extra;
	}

	// --------------------------------------------------------------------
	// AJAX-Y STUFF - still a testbed
	// --------------------------------------------------------------------
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	/**
	 * Update
	 *
	 * Outputs a javascript library slideDown event
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function update($element = 'this', $speed = '', $callback = '')
=======
	public function update($element = 'this', $speed = '', $callback = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function update($element = 'this', $speed = '', $callback = '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->js->_updater($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Generate JSON
	 *
	 * Can be passed a database result or associative array and returns a JSON formatted string
	 *
	 * @param	mixed	result set or array
	 * @param	bool	match array types (defaults to objects)
	 * @return	string	a json formatted string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function generate_json($result = NULL, $match_array_type = FALSE)
	{
		// JSON data can optionally be passed to this function
		// either as a database result object or an array, or a user supplied array
		if ( ! is_null($result))
		{
			if (is_object($result))
			{
				$json_result = $result->result_array();
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	public function generate_json($result = NULL, $match_array_type = FALSE)
	{
		// JSON data can optionally be passed to this function
		// either as a database result object or an array, or a user supplied array
		if ($result !== NULL)
		{
			if (is_object($result))
			{
				$json_result = is_callable(array($result, 'result_array')) ? $result->result_array() : (array) $result;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}
			elseif (is_array($result))
			{
				$json_result = $result;
			}
			else
			{
				return $this->_prep_args($result);
			}
		}
		else
		{
			return 'null';
		}

		$json = array();
		$_is_assoc = TRUE;

<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_array($json_result) AND empty($json_result))
		{
			show_error("Generate JSON Failed - Illegal key, value pair.");
=======
		if ( ! is_array($json_result) && empty($json_result))
		{
			show_error('Generate JSON Failed - Illegal key, value pair.');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ( ! is_array($json_result) && empty($json_result))
		{
			show_error('Generate JSON Failed - Illegal key, value pair.');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}
		elseif ($match_array_type)
		{
			$_is_assoc = $this->_is_associative_array($json_result);
		}

		foreach ($json_result as $k => $v)
		{
			if ($_is_assoc)
			{
				$json[] = $this->_prep_args($k, TRUE).':'.$this->generate_json($v, $match_array_type);
			}
			else
			{
				$json[] = $this->generate_json($v, $match_array_type);
			}
		}

		$json = implode(',', $json);

<<<<<<< HEAD
<<<<<<< HEAD
		return $_is_assoc ? "{".$json."}" : "[".$json."]";
=======
		return $_is_assoc ? '{'.$json.'}' : '['.$json.']';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return $_is_assoc ? '{'.$json.'}' : '['.$json.']';
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	}

	// --------------------------------------------------------------------

	/**
	 * Is associative array
	 *
	 * Checks for an associative array
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _is_associative_array($arr)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array
	 * @return	bool
	 */
	protected function _is_associative_array($arr)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		foreach (array_keys($arr) as $key => $val)
		{
			if ($key !== $val)
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Prep Args
	 *
	 * Ensures a standard json value and escapes values
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _prep_args($result, $is_key = FALSE)
	{
		if (is_null($result))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	mixed	$result
	 * @param	bool	$is_key = FALSE
	 * @return	string
	 */
	protected function _prep_args($result, $is_key = FALSE)
	{
		if ($result === NULL)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return 'null';
		}
		elseif (is_bool($result))
		{
			return ($result === TRUE) ? 'true' : 'false';
		}
		elseif (is_string($result) OR $is_key)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			return '"'.str_replace(array('\\', "\t", "\n", "\r", '"', '/'), array('\\\\', '\\t', '\\n', "\\r", '\"', '\/'), $result).'"';			
=======
			return '"'.str_replace(array('\\', "\t", "\n", "\r", '"', '/'), array('\\\\', '\\t', '\\n', "\\r", '\"', '\/'), $result).'"';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			return '"'.str_replace(array('\\', "\t", "\n", "\r", '"', '/'), array('\\\\', '\\t', '\\n', "\\r", '\"', '\/'), $result).'"';
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}
		elseif (is_scalar($result))
		{
			return $result;
		}
	}

<<<<<<< HEAD
<<<<<<< HEAD
	// --------------------------------------------------------------------
}
// END Javascript Class

/* End of file Javascript.php */
/* Location: ./system/libraries/Javascript.php */
=======
}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
}
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
