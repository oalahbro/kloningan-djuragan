<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="" id="utamaUser">
	<div class="page-header">
		<h1>Daftar User <small><?php echo $status; ?></small></h1>
	</div>

	<div class="container-fluid navigasi">
		<ul class="nav nav-tabs">
			<li role="presentation" class="<?php echo ($status === 'aktif' ? 'active':''); ?>"><?php echo anchor('admin/pengguna/lihat/aktif', 'Aktif'); ?></li>
			<li role="presentation" class="<?php echo ($status === 'baru' ? 'active':''); ?>"><?php echo anchor('admin/pengguna/lihat/baru', 'Belum Aktif'); ?></li>
			<li role="presentation" class="<?php echo ($status ==='blokir' ? 'active':''); ?>"><?php echo anchor('admin/pengguna/lihat/blokir', 'Diblokir'); ?></li>
		</ul>
	</div>

	<div class="utama">
		<div class="container-fluid">
			<?php
			$in = $this->input->get('ok');
			$alert = (int) save_url_decode($in);
			if( ! empty($in)) {
				if($alert === 0) {
					echo '<div class="alert alert-warning" role="alert">';
						echo 'Tidak ada data yang berubah untuk disimpan!';
					echo '</div>';
				}
				else {
					echo '<div class="alert alert-success" role="alert">';
						echo 'Data sudah diperbaharui!';
					echo '</div>';
				}
			}
			?>

			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th style="width: 300px">Juragan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$col = array('default','primary','success','warning','info','danger');

						if($q->num_rows() > 0) {
							$i = 1;

							foreach ($q->result() as $p) { 
								$en_user = save_url_encode($p->username);

								$jur = json_decode(($p->juragan === NULL ? '[]': $p->juragan));

								$juragan = '';
								foreach ($jur as $a) {
									$slug = $this->juragan->_slug($a);
									$juragan .= anchor('admin/pesanan/lihat/' . $slug, '<span class="label label-'.random_element($col).'">' . $this->juragan->_nama($a) . '</span>') .' ';
								}
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $p->nama; ?></td>
									<td><?php echo $p->username; ?></td>
									<td><?php echo $p->email; ?></td>
									<td><?php echo strtoupper($p->level); ?></td>
									<td><?php echo $juragan; ?></td>
									<td><?php 
									if($p->username !== $this->session->username) {
										echo anchor('admin/pengguna/sunting?id=' . $en_user, 'Atur User', array('class' => 'btn btn-default')); 
									}
									?></td>
								</tr>

							<?php 
							$i++;
							}
						}
						else {
							echo '<tr><td colspan="7" class="warning text-center">Tidak ada data</td></tr>';
						}
						?>
					</tbody>
					
				</table>
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