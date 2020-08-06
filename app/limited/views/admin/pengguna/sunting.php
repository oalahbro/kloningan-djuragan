<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="" id="utamaUser">
	<div class="page-header">
		<h1>Sunting <small>pengguna</small></h1>
	</div>

	<div class="container-fluid navigasi">
		<ul class="nav nav-tabs">
			<li role="presentation"><?php echo anchor('admin/pengguna/lihat/aktif', 'Aktif'); ?></li>
			<li role="presentation"><?php echo anchor('admin/pengguna/lihat/baru', 'Belum Aktif'); ?></li>
			<li role="presentation"><?php echo anchor('admin/pengguna/lihat/blokir', 'Diblokir'); ?></li>
			<li role="presentation" class="active"><?php echo anchor(current_url() . '?id=' . $enc, 'Sunting'); ?></li>
		</ul>
	</div>

	<div class="utama">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<?php echo form_open('admin/pengguna/simpan', '', array('id' => $enc) ); ?>
					<div class="form-group">
						<?php
						echo form_label('Nama', 'nama');
						echo form_input(array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control'), $q->nama);
						?>
					</div>
					<div class="form-group">
						<?php
						echo form_label('Username', 'username');
						echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'readonly' => ''), $q->username);
						?>
					</div>
					<div class="form-group">
						<?php
						echo form_label('Email', 'email');
						echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control'), $q->email);
						?>
					</div>
					<div class="form-group">
						<?php
						echo form_label('Role', 'leve1');
						?>
						<div class="radio">
							<label>
								<?php echo form_radio('level', 'reseller', ($q->level === 'reseller' ? TRUE: FALSE), array('id' => 'level3')); ?> Reseller
							</label>
						</div>
						<div class="radio">
							<label>
								<?php echo form_radio('level', 'cs', ($q->level === 'cs' ? TRUE: FALSE), array('id' => 'level')); ?> CS
							</label>
						</div>
						<div class="radio">
							<label>
								<?php echo form_radio('level', 'admin', ($q->level === 'admin' ? TRUE: FALSE), array('id' => 'level2')); ?> Admin
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
						if($q->juragan !== NULL) {
							$selected = json_decode($q->juragan);
						}

						echo form_multiselect('juragan[]', $option, $selected, array('class' => 'form-control') );
						?>
						<p class="help-block">tekan tombol CTRL untuk memilih lebih dari satu (hanya untuk role CS)</p>
					</div>

					<div class="form-group">
						<?php
						echo form_label('Aktifkan ?', 'aktif');
						?>

						<div class="radio">
							<label>
								<?php echo form_radio('aktif', 'ya', ($q->aktif === 'ya' ? TRUE: FALSE), array('id' => 'aktif')); ?> Ya
							</label>
						</div>
						<div class="radio">
							<label>
								<?php echo form_radio('aktif', 'tidak', ($q->aktif === 'tidak' ? TRUE: FALSE), array('id' => 'aktif2')); ?> Tidak
							</label>
						</div>
					</div>

					<div class="form-group">
						<?php
						echo form_label('Blokir ?', 'blokir');
						?>

						<div class="radio">
							<label>
								<?php echo form_radio('blokir', 'ya', ($q->blokir === 'ya' ? TRUE: FALSE), array('id' => 'blokir')); ?> Ya
							</label>
						</div>
						<div class="radio">
							<label>
								<?php echo form_radio('blokir', 'tidak', ($q->blokir === 'tidak' ? TRUE: FALSE), array('id' => 'blokir')); ?> Tidak
							</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$.getMultiScripts = function(arr, path) {
			var _arr = $.map(arr, function(scr) {
				return $.getScript( (path||"") + scr );
			});

			_arr.push($.Deferred(function( deferred ){
				$( deferred.resolve );
			}));

			return $.when.apply($, _arr);
		}

		var script_arr = [
		'<?php echo base_url('assets/js/bootstrap.min.js'); ?>', 
		'<?php echo base_url('assets/js/pace.min.js'); ?>'
		];

		$.getMultiScripts(script_arr).done(function() {
            // all scripts loaded
             $('.deropdowen').dropdown();
        });
	});
</script>