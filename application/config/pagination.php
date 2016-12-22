<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config = array(
	'full_tag_open' 	=> '<nav aria-label="Page navigation"><ul class="pagination">',
	'full_tag_close' 	=> '</ul></nav>',

	'cur_tag_open' 		=> '<li class="page-item active"><span class="page-link">',
	'cur_tag_close' 	=> ' <span class="sr-only">(current)</span></span></li>',
	
	'num_tag_open' 		=> '<li class="page-item">',
	'num_tag_close' 	=> '</li>',
	
	'prev_tag_open' 	=> '<li class="page-item">',
	'prev_tag_close' 	=> '</li>',
	'prev_link' 		=> '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>',

	'next_tag_open' 	=> '<li class="page-item">',
	'next_tag_close' 	=> '</li>',
	'next_link' 		=> '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>',

	'first_tag_open' 	=> '<li class="page-item">',
	'first_tag_close' 	=> '</li>',
	'first_link' 		=> '<span aria-hidden="true">&larr;</span><span class="sr-only">First</span>',

	'last_tag_open' 	=> '<li class="page-item">',
	'last_tag_close' 	=> '</li>',
	'last_link' 		=> '<span aria-hidden="true">&rarr;</span><span class="sr-only">Last</span>'
	);