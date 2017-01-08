<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-8 offset-md-2">
    <div class="card-group">
        <div class="card p-2">
            <div class="card-block">
                <h1>Masuk</h1>
                <p class="text-muted">Masuk dengan akunmu</p>
                <?php 
                echo form_open();

                echo '<div class="input-group mb-1">';
                echo '<span class="input-group-addon"><i class="icon-user"></i></span>';
                echo form_input(array('name' => 'username', 'placeholder' => 'username', 'class' => 'form-control'));
                echo '</div>';

                echo '<div class="input-group mb-2">';
                echo '<span class="input-group-addon"><i class="icon-lock"></i></span>';
                echo form_password(array('name' => 'password', 'placeholder' => 'password', 'class' => 'form-control'));
                echo '</div>';

                echo ' <div class="row">';
                echo '<div class="col-xs-6">';
                echo form_button(array('class' => 'btn btn-primary px-2', 'content' => 'Masuk', 'type' => 'submit'));
                echo '</div>';

                echo '<div class="col-xs-6 text-xs-right">';
                echo anchor('lupa', 'Lupa Sandi?', array('class' => 'btn btn-link px-0'));
                echo '</div>';
                echo '</div>';

                echo form_close();
                ?>
            </div>
        </div>
        <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
            <div class="card-block text-xs-center">
                <div>
                    <h2>Daftar</h2>
                    <p>Bila belum memiliki akun, harap daftarkan diri terlebih dahulu.</p>
                    <?php echo anchor('daftar', 'Daftar Sekarang', array('class' => 'btn btn-primary active mt-1')); ?>
                </div>
            </div>
        </div>
    </div>
</div>