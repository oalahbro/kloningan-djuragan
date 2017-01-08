<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="jumbotron jumbotron-fluid" style="margin-top: 100px">
	<div class="container">
		<h1 class="display-3"><?php echo $title_navbar; ?></h1>
		<p class="lead"><?php echo $lead; ?></p>
	</div>
</div>
<div>
	<div class="container-fluid">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Juragan</th>
					<th width="8%">Tanggal</th>
					<th>Pemesan</th>
					<th width="15%">Pesanan</th>
					<th width="15%">Biaya</th>
					<th>Keterangan</th>
					<th>Resi</th>
				</tr>
			</thead>

			<tbody>
				
				<?php 
				foreach ($pesanan->result() as $key) { 

					if($key->status_kirim === '0' && $key->status_transfer === '0') {
						$transfer_class = '';
						$status_class = '';
						$button_kirim = form_button(array('class' => 'btn btn-secondary btn-block text-xs-left btn-sm', 'disabled' => '', 'content' => '<span class="icon-ok"></span> Kirim'));
						$button_transfer = form_button(array('class' => 'btn btn-success btn-block text-xs-left btn-sm', 'content' => '<span class="icon-ok"></span> Transfer '));
					}
					elseif($key->status_kirim === '0' && $key->status_transfer === '1') {
						$transfer_class = ' table-success';
						$status_class = '';
						$button_kirim = form_button(array('class' => 'btn btn-success btn-block text-xs-left btn-sm', 'content' => '<span class="icon-ok"></span> Kirim'));
						$button_transfer = form_button(array('class' => 'btn btn-warning btn-block text-xs-left btn-sm', 'content' => '<span class="icon-remove"></span> Transfer'));
					}
					elseif($key->status_kirim === '1' && $key->status_transfer === '1') {
						$transfer_class = '';
						$status_class = ' class="table-success"';
						$button_kirim = form_button(array('class' => 'btn btn-success btn-block text-xs-left btn-sm', 'content' => '<span class="icon-remove"></span> Kirim'));
						$button_transfer = form_button(array('class' => 'btn btn-secondary btn-block text-xs-left btn-sm', 'disabled' => '', 'content' => '<span class="icon-ok"></span> Transfer'));
					}


					$resi = '';
					if( ! empty($key->kurir_resi)) {
						$resi_ = explode(',', $key->kurir_resi);

						
						if( empty($resi_[2])) {
							$resi_d = nice_date($key->tanggal, 'd-M-Y');
						}
						else {
							$resi_d = nice_date($resi_d[3], 'd-M-Y');
						}

						$resi_p = '';
						if( ! empty($resi_[1])) {
							$resi_p = $resi_[1];
						}

						$resi = '<strong>' . $resi_[0] . '</strong><br/>';
						$resi .= '<em>' . $resi_p . '<br/>';
						$resi .= '<small>terkirim : '. $resi_d .'</small></em>';
					}

					$gambar = '';
					if( ! empty($key->gambar)) {
						$gmb = explode(',', $key->gambar);
						$gci = 1;

						if(count($gmb) > 1) {
							$gambar = '<div class="btn-group">';
								$gambar .= '<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Custom Gambar</button>';
								$gambar .= '<div class="dropdown-menu">';
									foreach ($gmb as $src) {
										$gambar .= '<a href='.$src.' class="dropdown-item" target="_blank">Gambar '.$gci++.'</a>';
									}
								$gambar .= '</div>';
							$gambar .= '</div>';
						}
						else {
							$gambar .= '<a href='.$gmb[0].' class="btn btn-warning" target="_blank">Custom Gambar</a>';
						}

					}

				?>

					<tr<?php echo $status_class; ?>>
						<td><?php echo $key->id; ?></td>
						<td><?php echo anchor('admin/pesanan/lihat/' . $key->alias_juragan, $key->nama_juragan); ?><!-- <br/><?php echo $key->cs; ?>--></td>
						<td class="<?php echo $transfer_class;?>"><?php echo '<abbr title="'.$key->tanggal.'">'.tanggal($key->tanggal).'</abbr>'; ?>
						<?php echo $button_transfer; ?>
						<?php echo $button_kirim; ?>
						
						</td>
						<td>
							<strong><?php echo strtoupper($key->nama); ?></strong><br/>
							<?php 
							$hp = explode(',', $key->hp);
							echo '<span class="tag tag-info normal-text">' . $hp[0] . '</span>';
							if(isset($hp[1])) {
								echo ' <span class="sr-only">/</span> <span class="tag tag-info normal-text">' . $hp[1] . '</span>';
							}

							?>
							<br/>
							<?php echo strtoupper($key->alamat); ?>
						</td>
						<td>
						<?php

						$string = $key->pesanan;
						$count_pesanan = 0;
						if($string !== NULL) {
							$s = explode('#', $string);
							$ukuran = array_map('trim',explode("#",$string));
							$jumlah_array = count($ukuran);

							for ($i = 0; $i <  $jumlah_array; $i++) {
								$data = array_map('trim',explode(",",$s[$i]));
								echo "<div>";
								echo strtoupper($data[0]). '';
								echo ' (' . strtoupper($data[1]). ') = ';
								echo strtoupper($data[2]) . ' pcs';
								$count_pesanan += $data[2];
								echo '</div>';
							}
						}
						echo '<hr/><small><em>Total</em></small> : <span class="tag tag-pill tag-default">' . $count_pesanan . '</span> pcs';


						?>
						</td>
						<td>
							<?php 
							//////// penampakan bank
							if($key->status_biaya_transfer === '0') {
								$status = 'DP';
							}
							else {
								$status = 'Lunas';
							}

							//////// PENAMPAKAN ONGKIR & ONGKIR FIX
							$onkr = explode(',', $key->total_ongkir);

							$ongkir = '';
							if($onkr[0] > 1000) {
								$ongkir = '<div>ongkir : <span class="tag tag-success normal-text">' . rupiah($onkr[0]) . '</span></div>';
							}
							else {
								$ongkir = '<div><span class="tag tag-success normal-text">FREE ONGKIR</span></div>';
							}

							if( ! empty($onkr[1])) {
								$ongkir .= '<div>ongkir fix : <span class="tag tag-info normal-text">' . rupiah($onkr[1]) . '</span></div>';
							}


							//////// penampakan transfer
							$trf = explode(',', $key->total_transfer);
							$transfer = '';

							// jika status transfer belum lunas, maka menamplkan tombol pelunasan
							if($key->status_transfer === '0' && $key->status_biaya_transfer === '0') {
								if(isset($trf[1])) {
									$transfer .= '<div>DP : <span class="tag tag-danger normal-text">' . rupiah($trf[0]) . '</span></div>';
									$transfer .= '<div>Lunas : <span class="tag tag-danger normal-text">' . rupiah($trf[1]) . '</span></div>';
								}
								else {
									$transfer .= '<div>DP : <span class="tag tag-danger normal-text">' . rupiah($trf[0]) . '</span></div>';
									$transfer .= '<div><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".modalPelunasan" data-nama="'.$key->nama.'" data-uid="'.$key->uid.'" data-id="'.$key->id.'">Pelunasan</button></div>';
								}
							}
							elseif($key->status_transfer === '1' && $key->status_biaya_transfer === '0') {
								if(isset($trf[1])) {
									$transfer .= '<div>DP : <span class="tag tag-danger normal-text">' . rupiah($trf[0]) . '</span></div>';
									$transfer .= '<div>Lunas : <span class="tag tag-danger normal-text">' . rupiah($trf[1]) . '</span></div>';
								}
							}
							else {
								$transfer .= '<div>transfer : <span class="tag tag-danger normal-text">' . rupiah($trf[0]) . '</span></div>';
							}

							?>
							<div style="margin-bottom: 5px;">
								<button type="button" class="btn btn-secondary btn-sm btn-block btn-clean" disabled><?php echo $key->bank; ?></button>
								<button type="button" class="btn btn-secondary btn-sm btn-block btn-clean" disabled><?php echo $status; ?></button>
							</div>

							<div class="text-xs-right biaya">
								<?php echo '<div>biaya : <span class="tag tag-warning normal-text">' .  rupiah($key->total_biaya) . '</span></div>'; ?>
								<?php echo $ongkir; ?>
								<?php echo $transfer; ?>
							</div>
						</td>
						<td><?php echo $key->keterangan; ?><br/><?php echo $gambar; ?></td>
						<td><?php echo $resi; ?></td>
					</tr>
					
				<?php }
				?>

			</tbody>

		</table>
	</div>
	<?php echo $this->pagination->create_links(); ?>
</div>



<!-- Small modal -->
<div class="modal fade modalPelunasan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="exampleModalLabel">Pelunasan #<span class="kodePesanan"></span></h4>
			</div>
			<div class="modal-body">
				<div class="">
					<p class="text-success">Pelunasan untuk pesanan #<span class="kodePesanan"></span> atas nama <strong class="namaPemesan"></strong>.</p>
				</div>
				<?php echo form_open('admin/pesanan/set_pelunasan', '',array('uid' => '')); ?>

					<div class="form-group">
						
						<?php 
						$form_pelunasan = array(
							'name' => 'pelunasan',
							'id' => 'pelunasan',
							'class' => 'form-control pelunasan',
							'placeholder' => '150000',
							'required' => 'required',
							'pattern' => '^(?:[1-9]\d*|0)$',
							'title' => 'nominal uang'
							);
						echo form_label('Total Pelunasan', 'pelunasan');
						echo '<div class="input-group">';
						echo '<span class="input-group-addon" id="basic-addon1">Rp</span>';
						echo form_input($form_pelunasan);
						echo '</div>';
						?>
					</div>

					<div class="form-group">
						<label for="message-text" class="form-control-label">Keterangan:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>

					<?php echo form_button(array('class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Simpan')); ?>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.modalPelunasan').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('nama') // Extract info from data-* attributes
		var uid = button.data('uid') // Extract info from data-* attributes
		var id = button.data('id') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.namaPemesan').text(recipient)
		modal.find('.kodePesanan').text(id)
		modal.find('[name="uid"]').val(uid)
		// modal.find('.modal-body input').val(recipient)
	});

</script>
