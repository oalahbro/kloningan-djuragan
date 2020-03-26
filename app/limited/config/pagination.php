<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
