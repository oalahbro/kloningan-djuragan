<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-6 offset-md-3">
    <div class="card mx-2">
        <div class="card-block p-2">
            <h1>Lupa Sandi</h1>
            <p class="text-muted">Untuk reset sandi, silakan isi form berikut.</p>
            <?php 
                echo form_open();

                echo '<div class="input-group mb-1">';
                echo '<span class="input-group-addon">@</span>';
                echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control'));
                echo '</div>';

                echo form_button(array('class' => 'btn btn-block btn-success', 'content' => 'Daftar'));

                echo form_close();
            ?>
        </div>
    </div>
</div>
