<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo form_open('auth/daftar', array('class' => 'form-signin'));
	echo img(array('src'   => 'assets/img/logo.png', 'alt'   => 'Logo', 'width' => '150', 'height'=> '150', 'class' => 'mb-4 rounded border p-2 bg-light'));

	echo heading('Silakan Daftar', 1, array('class' => 'h3 font-weight-normal'));

	echo validation_errors('<div class="alert alert-danger">', '</div>');

	// nama
	echo form_label('Nama', 'nama', array('class' => 'sr-only'));
	echo form_input(array('name' => 'nama','class' => 'form-control top', 'id' => 'nama', 'placeholder' => 'nama', 'required' => 'required'), set_value('nama'));

	// email
	echo form_label('Email', 'email', array('class' => 'sr-only'));
	echo form_input(array('name' => 'email','class' => 'form-control middle','id' => 'email', 'placeholder' => 'email', 'required' => 'required'), set_value('email'));

	// username
	echo form_label('Username', 'username', array('class' => 'sr-only'));
	echo form_input(array('name' => 'username','class' => 'form-control middle', 'id' => 'username', 'placeholder' => 'username', 'required' => 'required'), set_value('username'));

	// password
	echo form_label('Password', 'password', array('class' => 'sr-only'));
	echo form_password(array('name' => 'password','class' => 'form-control bottom', 'id' => 'password','placeholder' => 'password', 'required' => 'required'));

	// submit
	echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-dark btn-block', 'content' => 'Daftar'));

	echo '<div class="clearfix">';
		echo '<span class="float-right">' . anchor('auth/lupa', 'Lupa Sandi?', array('class' => 'small text-muted')) . '</span>';
		echo '<span class="float-left">' . anchor('auth/masuk', 'Sudah Punya Akun', array('class' => 'small text-muted')) . '</span>';
	echo '</div>';
	echo '<p class="mt-5 mb-3 text-muted">&copy; 2013 - '. date('Y') .'</p>';

echo form_close();

?>
