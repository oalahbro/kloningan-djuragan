<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
$config = array(
	'cur_tag_open' => '<li class="active"><a href="#!">',
	'cur_tag_close' => '</a></li>',
	'full_tag_open' => '<nav class="text-center"><ul class="pagination">',
	'full_tag_close' => '</ul></nav>',
	'num_tag_open' => '<li>',
	'num_tag_close' => '</li>',
	
	'prev_tag_open' => '<li>',
	'prev_tag_close' => '</li>',
	'prev_link' => '<i class="glyphicon glyphicon-backward"></i>',

	'next_tag_open' => '<li>',
	'next_tag_close' => '</li>',
	'next_link' => '<i class="glyphicon glyphicon-forward"></i>',

	'first_tag_open' => '<li>',
	'first_tag_close' => '</li>',
	'first_link' => '<i class="glyphicon glyphicon-fast-backward"></i>',

	'last_tag_open' => '<li>',
	'last_tag_close' => '</li>',
	'last_link' => '<i class="glyphicon glyphicon-fast-forward"></i>'
=======

$config = array(
	'full_tag_open' 	=> '<nav aria-label="Page navigation" class="text-xs-center"><ul class="pagination">',
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
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	);
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
$config = array(
    'cur_tag_open'   => '<li class="page-item active"><a class="page-link" href="#!"><span class="sr-only">(current)</span>',
    'cur_tag_close'   => '</a></li>',
    'num_tag_open'    => '<li class="page-item">',
    'num_tag_close'   => '</li>',
    'next_link'       => '<i class="fas fa-angle-right"></i>',
    'next_tag_open'   => '<li class="page-item">',
    'next_tag_close'  => '</li>',
    'prev_link'       => '<i class="fas fa-angle-left"></i>',
    'prev_tag_open'   => '<li class="page-item">',
    'prev_tag_close'  => '</li>',
    'first_link'      => '<i class="fas fa-angle-double-left"></i>',
    'first_tag_open'  => '<li class="page-item">',
    'first_tag_close' => '</li>',
    'last_link'       => '<i class="fas fa-angle-double-right"></i>',
    'last_tag_open'   => '<li class="page-item">',
    'last_tag_close'  => '</li>',
    'full_tag_open'   => '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">',
    'full_tag_close'  => '</ul></nav>',
    'attributes' => array('class' => 'page-link')
    );
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
