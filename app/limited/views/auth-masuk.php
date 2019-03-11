<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo $this->load->view("_inc/header", $judul, TRUE);
echo '<div class="mainpage">';
	echo '<div class="boxed">';

		echo form_open('auth/masuk', array('class' => 'form-signin'));
			echo '<div class="mb-4 text-center">' . img(array('src'   => 'berkas/img/logo.png', 'alt'   => 'Logo', 'width' => '150', 'height'=> '150', 'class' => '')) . '</div>';

			echo heading('Silakan Masuk', 1, array('class' => 'h3 font-weight-normal'));

			echo $this->session->flashdata('notifikasi');

			// username
			echo form_label('Username', 'username', array('class' => 'sr-only'));
			echo form_input(array('name' => 'username','class' => 'form-control top', 'id' => 'username','placeholder' => 'username', 'required' => 'required'));

			// password
			echo form_label('Password', 'password', array('class' => 'sr-only'));
			echo form_password(array('name' => 'password','class' => 'form-control bottom', 'id' => 'password','placeholder' => 'password', 'required' => 'required'));

			// submit
			echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-dark btn-block', 'content' => 'Masuk'));

			echo '<div class="clearfix">';
				echo '<span class="float-right">' . anchor('auth/lupa', 'Lupa Sandi?', array('class' => 'small text-muted')) . '</span>';
				echo '<span class="float-left">' . anchor('auth/daftar', 'Daftar Akun Baru', array('class' => 'small text-muted')) . '</span>';
			echo '</div>';
			echo '<p class="mt-5 mb-3 text-muted">&copy; 2013 - '. date('Y') .'</p>';

		echo form_close();
	echo '</div>';
echo '</div>';

echo $this->load->view('_inc/footer', array(), TRUE);
