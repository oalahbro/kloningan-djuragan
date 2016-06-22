<div id="load_data">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Juragan</th>
					<th width="7%">Tanggal</th>
					<th width="30%">Pemesan</th>
					<th width="15%">Kode, Size, Jumlah</th>
					<th width="15%">Biaya</th>
					<th width="18%">Keterangan</th>
					<th width="12%">Resi Kirim</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if($data->num_rows() > 0) {
					foreach ($data->result() as $pesanan) {

						/////////////////////////////// tombol group kirim & transfer ///////////////////////////////

						if($pesanan->barang === 'Pending' && $pesanan->status_transfer === 'Belum') {
							$transfer_class = '';
							$status_class = '';
							$button_kirim = '<div class="text-center btn-margin "><a href="#" class="btn btn-default btn-xs disabled btn-block"><i class="glyphicon glyphicon-refresh text-info"></i> pending</a></div>';

							$button_transfer = form_button(array('title' => 'Transfer Masuk', 'id' => 'ok_' . $pesanan->id, 'class' => 'btn btn-success btn-xs btn-block tooltips btn-transfer', 'content' => '<i class="glyphicon glyphicon-ok"></i>'));
						}
						elseif($pesanan->barang === 'Pending' && $pesanan->status_transfer === 'Masuk') {
							$transfer_class = ' danger';
							$status_class = '';
								$button_kirim = form_button(array('title' => 'Sudah dikirim', 'id' => 'ok_' . $pesanan->id, 'class' => 'btn btn-success submit-resi btn-xs tooltips btn-block btn-kirim', 'content' => '<i class="glyphicon glyphicon-ok"></i>'));

								$button_transfer = form_button(array('title' => 'Belum Transfer', 'id' => 'remove_' . $pesanan->id, 'class' => 'btn btn-default btn-xs tooltips btn-block btn-transfer', 'content' => '<i class="glyphicon glyphicon-remove"></i>'));
						}
						elseif($pesanan->barang === 'Terkirim' && $pesanan->status_transfer === 'Masuk') {
							$transfer_class = '';
							$status_class = ' class="danger"';
							$button_kirim = form_button(array('title' => 'Belum dikirim','id' => 'remove_' . $pesanan->id, 'class' => 'btn btn-default btn-xs tooltips btn-block btn-kirim', 'content' => '<i class="glyphicon glyphicon-remove"></i>'));
							$button_transfer = '<div class="text-center btn-margin "><a href="#" class="btn btn-success btn-xs disabled btn-block"><i class="glyphicon glyphicon-ok"></i> Masuk</a></div>';
						}

						/////////////////////// button edit ///////////////////////////

						$tombol_edit = '<div class="dropdown">';
						$tombol_edit .= '<button class="btn btn-default btn-xs dropdown-toggle" type="button" id="editing-' . $pesanan->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
						$tombol_edit .= 'Aksi <span class="caret"></span>';
						$tombol_edit .= '</button>';
						$tombol_edit .= '<ul class="dropdown-menu" aria-labelledby="editing-' . $pesanan->id . '">';
							$tombol_edit .= '<li>'. anchor('admin/pesanan/update/' . $pesanan->unik, '<i class="glyphicon glyphicon-pencil"></i> Ubah') .'</li>';
							$tombol_edit .= '<li>'. anchor('admin/pesanan/duplicate/' . $pesanan->unik, '<i class=" glyphicon glyphicon-duplicate"></i> Duplikat') .'</li>';
							$tombol_edit .= '<li>'. anchor('', '<i class="glyphicon glyphicon-trash"></i> Hapus', array('data-unik' => $pesanan->unik, 'data-id' => $pesanan->id, 'class' => 'hapusdata')) .'</li>';
						$tombol_edit .= '</ul>';
						$tombol_edit .= '</div>';

						/////////////////////// biaya ////////////////////////
						$ongkir_fix = '';
						if($pesanan->ongkir_fix !== NULL) {
							$ongkir_fix = '<div class="btn-margin">ongkir fix : <span class="label label-info2">' . harga($pesanan->ongkir_fix) . '</span></div>';
						}
						$ongkirnya = '<div class="btn-margin">ongkir : <span class="label label-success">' . harga($pesanan->ongkir) . '</span></div>';
						if($pesanan->ongkir < 1000) {
							$ongkirnya = '<div class="btn-margin"><span class="label label-success">FREE ONGKIR</span></div>';
						}
						$biaya = '<div class="text-right"><div class="btn-margin">harga : <span class="label label-info">' . harga($pesanan->harga) . '</span></div>'. $ongkirnya . $ongkir_fix . '<div class="btn-margin">transfer : <span class="label label-danger">' . harga($pesanan->transfer) . '</span></div></div>';

						/////////////////////////////// resi //////////////////////////////////
						$resi = '';
						if($pesanan->kurir !== NULL) {
							$resi .= '<strong>' . strtoupper($pesanan->kurir) . '</strong>';
						}
						if($pesanan->resi !== NULL) {
							$resi .= '<div> '.$pesanan->resi . ' </div>';
						}

						if($pesanan->kurir === 'COD') {
							$kiriman = 'terambil';
						}
						else {
							$kiriman ='terkirim';
						}

						if($pesanan->cek_kirim !== NULL) {
							$resi .= '<small><em>' .$kiriman. ' : <abbr data-toggle="tooltip" title="'. $pesanan->cek_kirim .'">' .nice_date($pesanan->cek_kirim, 'd-M-y') . '</abbr></em></small>';
						}
					?>
						<tr<?php echo $status_class; ?>>
							<td><?php echo $pesanan->id; ?></td>
							<td><?php echo anchor('admin/pesanan/read/' . $pesanan->username . '/' . $status, $pesanan->juragan); echo $tombol_edit;?></td>
							<td class="<?php echo $transfer_class; ?>"><?php echo '<abbr title="' . $pesanan->tanggal_order . '">' . nice_date($pesanan->tanggal_order, 'd-M-y') . '</abbr>'; echo $button_transfer; echo $button_kirim; ?></td>
							<td><?php echo '<span class="nama_pemesan"><strong>' . strtoupper($pesanan->nama) . '</strong></span><br/><span class="label label-info2">' . $pesanan->hp . '</span><br/>';
								echo strtoupper($pesanan->alamat); ?></td>
							<td><?php $string = $pesanan->pesanan;
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
											echo '</div>';
										}
									}

									echo '<div>' . strtoupper($pesanan->kode) . '<br/><span class="label label-default">' . strtoupper($pesanan->jumlah) .'</span> pcs</div>'; ?></td>
							<td><div class="btn-group btn-group-justified" role="group" aria-label="...">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default disabled btn-clean"><?php echo strtoupper($pesanan->bank); ?></button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default disabled <?php if($pesanan->status === 'Lunas') { echo 'btn-lunas'; } else { echo 'btn-dp'; }; ?>"><?php if($pesanan->status === 'Lunas') { echo '<i class="glyphicon glyphicon-heart"></i>'; } else { echo '<i class="glyphicon glyphicon-heart-empty"></i>'; }; ?> <?php echo strtoupper($pesanan->status); ?></button>
										</div>
									</div>
									<?php echo $biaya; ?></td>
							<td><?php 
									if($pesanan->member_id > 0) { ?>
										<div class="well well-sm">
											<strong class="text-danger">PESANAN MEMBER</strong><br/>
											<u>Pengirim :</u><br/>
											<?php echo $pesanan->nama_member; ?><br/><?php echo $pesanan->hp_member; ?>
										</div>
									<?php }

									echo $pesanan->keterangan; 
									if($pesanan->customgambar !== NULL) {

								?>
								<div class="dropdown">
								  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="glyphicon glyphicon-picture"></i> Custom Gambar <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								   <?php
								   	$i = 1;
								   	$gmb = explode(',', $pesanan->customgambar);
								   	foreach ($gmb as $key ) {
								   		echo '<li>'. anchor($key, 'Gambar ' . $i++, array('target' => '_blank')) .'</li>';
								   	}
								   	?>   
								  </ul>
								</div>
								<?php } ?></td>
							<td><?php echo $resi; ?></td>
						</tr>
					<?php }
				}
				else {
					echo '<tr class="warning"><td colspan="8" class="text-center">Data Tidak Ada!</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="akses">
		<?php echo $pagination; ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="HapusDataAlert" tabindex="-1" role="dialog" aria-labelledby="HapusDataAlertLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="HapusDataAlertLabel">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<div class="well well-sm">
					Hapus data pesanan dengan ID-<span class="dataid"></span>.
					<br/>Penghapusan data tidak dapat dibatalkan.
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_open('admin/pesanan/delete', '', array('unik' => '')) ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// hapus data
	$('a.hapusdata').click(function(event) {
		event.preventDefault();
		$('#HapusDataAlert').modal({show: true});
		$('.dataid').text($(this).data("id"));
		$('[name="unik"]').val($(this).data("unik"));
	});

	// pagination
	$('.akses a').click(function(event) {
		event.preventDefault();
		$("html, body").animate({scrollTop: 0}, 3000);
		$( '#load_data' ).html('<div class="progress jadi-loading"><div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Loading ....</div></div>');
		$("#load_data").load(this.href, 'submit=yes' );
	});


	// setting transfer status
	$('.btn-transfer').click(function(event) {
		event.preventDefault();
		var result = $(this).attr("id").split('_');
		flash();
		var box = $(".bootstrap-flash");

		$.ajax({type: "POST",
			url: "<?php echo site_url('admin/pesanan/transferan'); ?>",
			data: { id: result[1], status: result[0] },
			success:function(){
				box.find("p").html('Berhasil, data transfer pesanan <b>#' + result[1] + '</b> sudah diupdate!'),
				box.addClass('alert-success');

				$('#search-btn').trigger('click');
				$("html, body").animate({scrollTop: 0}, 3000);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				box.find("p").html('Maaf, Ada kesalahan sistem!'),
				box.addClass('alert-danger');
			}
		});
	});

	// setting kirim status
	$('.btn-kirim').click(function(event) {
		event.preventDefault();
		var result = $(this).attr("id").split('_');

		flash();
		var box = $(".bootstrap-flash");

		$.ajax({type: "POST",
			url: "<?php echo site_url('admin/pesanan/kiriman'); ?>",
			data: { id: result[1], status: result[0] },
			success:function(){
				box.find("p").html('Berhasil, data kirim pesanan <b>#' + result[1] + '</b> sudah diupdate!'),
				box.addClass('alert-success');

				$('#search-btn').trigger('click');
				$("html, body").animate({scrollTop: 0}, 3000);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				box.find("p").html('Maaf, Ada kesalahan sistem!'),
				box.addClass('alert-danger');
			}
		});
	});

	function flash() {
		$("body").append('<div class="bootstrap-flash alert" role="alert" style="position:fixed;top:40px;left:25%;width:50%;float:left;z-index:1500;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p></p></div>');
	}
</script>