<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="konten mb-5" id="konten">
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4"><?php echo $judul; ?></h1>
			<!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
		</div>
	</div>

	<div class="container">
		<?php echo form_open('', '', array('id' => '') ); ?>
		<div class="row">
			
			<div class="col-sm-6 mb-3">
				
				<div class="form-group">
					<?php
					echo form_label('Nama', 'nama');
					echo form_input(array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control'), $pengguna->nama);
					?>
				</div>
				<div class="form-group">
					<?php
					echo form_label('Username', 'username');
					echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'readonly' => ''), $pengguna->username);
					?>
				</div>
				<div class="form-group">
					<?php
					echo form_label('Email', 'email');
					echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control'), $pengguna->email);
					?>
				</div>

				<div class="custom-control custom-switch">
					<?php
					$data_valid = array(
						'name'          => 'valid',
						'id'            => 'valid',
						'class' 		=> 'custom-control-input',
						'value'         => 'ya',
						'checked'       => ($pengguna->valid === 'ya' ? TRUE: FALSE)
					);
					
					echo form_hidden('valid', 'tidak');
					echo form_checkbox($data_valid);
					echo form_label('Valid', 'valid', array('class' => 'custom-control-label'));
					?>
				</div>

				<div class="form-group">
					<div class="custom-control custom-switch">
						<?php
						$data_aktif = array(
							'name'          => 'aktif',
							'id'            => 'aktif',
							'class' 		=> 'custom-control-input',
							'value'         => 'ya',
							'checked'       => ($pengguna->aktif === 'ya' ? TRUE: FALSE)
						);

						echo form_hidden('aktif', 'tidak');
						echo form_checkbox($data_aktif);
						echo form_label('Aktif', 'aktif', array('class' => 'custom-control-label'));
						?>
					</div>
					<div class="custom-control custom-switch">
						<?php
						$data_blokir = array(
							'name'          => 'blokir',
							'id'            => 'blokir',
							'class' 		=> 'custom-control-input',
							'value'         => 'ya',
							'checked'       => ($pengguna->blokir === 'ya' ? TRUE: FALSE)
						);
						
						echo form_hidden('blokir', 'tidak');
						echo form_checkbox($data_blokir);
						echo form_label('Blokir', 'blokir', array('class' => 'custom-control-label'));
						?>
					</div>
				</div>

				<div class="border bg-light shadow-sm rounded p-3">
					<div class="custom-control custom-switch">
						<?php
						$data_ganti_sandi = array(
							'name'          => 'ganti_sandi',
							'id'            => 'ganti_sandi',
							'class' 		=> 'custom-control-input',
							'value'         => 'ya',
							'checked'       => FALSE
						);
						
						echo form_hidden('ganti_sandi', 'tidak');
						echo form_checkbox($data_ganti_sandi);
						echo form_label('Ganti Sandi?', 'ganti_sandi', array('class' => 'custom-control-label'));
						?>
					</div>
					<div class="collapse" id="collapse_sandi">
						<div class="form-group">
							<?php
							echo form_label('Kata Sandi', 'sandi');
							echo form_password(array('name' => 'sandi', 'id' => 'sandi', 'class' => 'form-control', 'placeholder' => 'sandi baru'));
							?>
						</div>
						<div class="form-group">
							<?php
							echo form_label('Ulangi Kata Sandi', 'sandi2');
							echo form_password(array('name' => 'sandi2', 'id' => 'sandi2', 'class' => 'form-control', 'placeholder' => 'ulangi sandi baru'));
							?>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-sm-6 mb-3">
				<div class="form-group">
					<?php
					echo form_label('Role', 'leve1');
					?>
					<div class="radio">
						<label>
							<?php echo form_radio('level', 'reseller', ($pengguna->level === 'reseller' ? TRUE: FALSE), array('id' => 'level3')); ?> Reseller
						</label>
					</div>
					<div class="radio">
						<label>
							<?php echo form_radio('level', 'cs', ($pengguna->level === 'cs' ? TRUE: FALSE), array('id' => 'level')); ?> CS
						</label>
					</div>
					<div class="radio">
						<label>
							<?php echo form_radio('level', 'admin', ($pengguna->level === 'admin' ? TRUE: FALSE), array('id' => 'level2')); ?> Admin
						</label>
					</div>
				</div>
				<div class="form-group">
					<?php
					echo form_label('Juragan', 'juragan');

					$juragan_list = $this->juragan->_semua()->result();

					foreach ($juragan_list as $jl) {
						$option[$jl->id] = $jl->nama;
					}

					$selected = array();
					$qr = $this->pengguna->get_juragan($pengguna->id)->result();
					foreach ($qr as $key) {
						$selected[] = $key->juragan_id;
					}

					echo form_multiselect('juragan[]', $option, $selected, array('class' => 'form-control') );
					?>
					<p class="help-block">tekan tombol CTRL untuk memilih lebih dari satu (hanya untuk role CS)</p>
				</div>
				
			</div>
			<div class="col-sm-12">
					<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script>
$(function () {
	$(document).on("keyup change", '[name="ganti_sandi"]',function(){
		if(this.checked) {
			//Do stuff
			$('#collapse_sandi').collapse('show');
		}
		else {
			$('#collapse_sandi').collapse('hide');
		}
	});
});
</script>