<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<?php echo form_open('admin/pengaturan/save_kurir'); ?>
						<div class="form-group">
							<?php 
							$kurir_list = json_decode($this->config->item('list_kurir'));
							$dlk = '';
							$i = 1;
							foreach ($kurir_list as $x) {
								$dlk .= $x . (count($kurir_list) === $i ? '': "\n");
								$i++;
							}

							echo form_label('Kurir', 'kurir');
							echo form_textarea(array('rows' => 7, 'id' => 'kurir', 'class' => 'form-control', 'name' => 'kurir'), $dlk)
							?>
							<small class="form-text text-muted"><em>Masukkan data perbaris menggunakan <kbd>enter</kbd>.</em></small>
						</div>
						<button type="submit" class="btn btn-secondary">Submit</button>
					<?php echo form_close(); ?>
				</div>
				<div class="col-sm-6">
					<?php echo form_open('admin/pengaturan/save_size'); ?>
						<div class="form-group">
							<?php 
							$size_list = json_decode($this->config->item('list_size'));
							$sl = '';
							$i = 1;
							foreach ($size_list as $x) {
								$sl .= $x . (count($size_list) === $i ? '': "\n");
								$i++;
							}

							echo form_label('Ukuran', 'ukuran');
							echo form_textarea(array('rows' => 7, 'id' => 'ukuran', 'class' => 'form-control', 'name' => 'size'), $sl)
							?>
							<small class="form-text text-muted"><em>Masukkan data perbaris menggunakan <kbd>enter</kbd>.</em></small>
						</div>

						<button type="submit" class="btn btn-secondary">Submit</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
