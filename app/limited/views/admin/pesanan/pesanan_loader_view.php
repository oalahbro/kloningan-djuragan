<?php
$pesan = $this->session->userdata('info_tampil');
if($pesan) { ?>
<div class="alert alert-info alert-custom">
	<?php echo $this->session->userdata('info'); $this->session->unset_userdata('info') ?>
</div>
<?php } $this->session->unset_userdata('info_tampil'); ?>

<div class="content-inti" id="reload">	

	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Juragan</th>
					<th width="7%">Tanggal</th>
					<th width="30%">Alamat</th>
					<th width="15%">Kode, Size / Jumlah</th>
					<th width="15%">Biaya</th>
					<th width="18%">Keterangan</th>
					<th width="12%">Resi Kirim</th>
				</tr>
			</thead>
			<tbody>
				<?php if($pesanan->num_rows() > 0) { ?>
				<?php foreach ($pesanan->result() as $row) : ?>
					<?php 
					$resi = '';
					if($row->kurir !== NULL) {
						$resi .= '<strong>' . strtoupper($row->kurir) . '</strong>';
					}
					if($row->resi !== NULL) {
						$resi .= '<div> '.$row->resi . ' </div>';
					}

					if($row->kurir === 'COD') {
						$kiriman = 'terambil';
					}
					else {
						$kiriman ='terkirim';
					}

					if($row->cek_kirim !== NULL) {
						$resi .= '<small><em>' .$kiriman. ' : <abbr data-toggle="tooltip" title="'. $row->cek_kirim .'">' .tanggal($row->cek_kirim) . '</abbr></em></small>';
						//$resi .= '<br/>' . anchor('administrator/edit_resi/'.$row->id, 'edit', array('class' => 'manual btn-hover-tr', 'id' => $row->id));
					}

					

					$ongkir_fix = '';
					if($row->ongkir_fix !== NULL) {
						$ongkir_fix = '<div class="btn-margin">ongkir fix : <span class="label label-info2">' . harga($row->ongkir_fix) . '</span></div>';
					}
					$ongkirnya = '<div class="btn-margin">ongkir : <span class="label label-success">' . harga($row->ongkir) . '</span></div>';
					if($row->ongkir < 1000) {
						$ongkirnya = '<div class="btn-margin"><span class="label label-success">FREE ONGKIR</span></div>';
					}

					$biaya = '<div class="text-right"><div class="btn-margin">harga : <span class="label label-info">' . harga($row->harga) . '</span></div>'. $ongkirnya . $ongkir_fix . '<div class="btn-margin">transfer : <span class="label label-danger">' . harga($row->transfer) . '</span></div></div>';
				
				/////////////////////////////// tombol group kirim & transfer ///////////////////////////////
				if($row->barang === 'Pending' && $row->status_transfer === 'Belum')
				{
					$transfer_class = '';
					$status_class = '';
					$button_kirim = '<div class="text-center btn-margin "><a href="#" class="btn btn-default btn-xs disabled btn-block"><i class="glyphicon glyphicon-refresh text-info"></i> pending</a></div>';
					$button_transfer = '<div class="btn-margin btn-group btn-group-justified" role="group" aria-label="btn-transfer">
					<div class="btn-group" role="group">'.
						form_button(array('title' => 'Transfer Masuk', 'id' => 'transfer-ok_' . $row->id, 'class' => 'btn btn-success submit-btn btn-xs tooltips', 'content' => '<i class="glyphicon glyphicon-ok"></i>')). '</div><div class="btn-group" role="group">'.
						form_button(array('class' => 'btn btn-default disabled btn-xs', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).'</div></div>';
					}
					elseif($row->barang === 'Pending' && $row->status_transfer === 'Masuk')
					{
						$transfer_class = ' danger';
						$status_class = '';
						$button_kirim = '<div class="btn-margin btn-group btn-group-justified" role="group" aria-label="btn-kirim">
						<div class="btn-group" role="group">'.
							form_button(array('title' => 'Sudah dikirim', 'id' => $row->id, 'class' => 'btn btn-success submit-resi btn-xs tooltips', 'content' => '<i class="glyphicon glyphicon-ok"></i>')). '</div><div class="btn-group" role="group">'.
							form_button(array('class' => 'btn btn-default disabled btn-xs', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).'</div></div>';
							$button_transfer = '<div class="btn-margin btn-group btn-group-justified" role="group" aria-label="btn-transfer"><div class="btn-group" role="group">'.
							form_button(array('class' => 'btn btn-success disabled btn-xs', 'content' => '<i class="glyphicon glyphicon-ok"></i>')). '</div><div class="btn-group" role="group">' .
							form_button(array('title' => 'Belum Transfer', 'id' => 'transfer-remove_' . $row->id, 'class' => 'btn btn-default submit-btn btn-xs tooltips', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).'</div></div>';
						}
						elseif($row->barang === 'Terkirim' && $row->status_transfer === 'Masuk')
						{
							$transfer_class = '';
							$status_class = ' class="danger"';
							$button_kirim = '<div class="btn-margin btn-group btn-group-xs btn-group-justified" role="group" aria-label="btn-kirim"><div class="btn-group" role="group">'.
							form_button(array('class' => 'btn btn-success disabled btn-xs', 'content' => '<i class="glyphicon glyphicon-ok"></i>')). '</div><div class="btn-group" role="group">' .
							form_button(array('title' => 'Belum dikirim','id' => 'kirim-remove_' . $row->id, 'class' => 'btn btn-default submit-btn btn-xs tooltips', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).'</div></div>';
							$button_transfer = '<div class="text-center btn-margin "><a href="#" class="btn btn-success btn-xs disabled btn-block"><i class="glyphicon glyphicon-ok"></i> Masuk</a></div>';
						}

						$button_edit = '<div class="btn-hover-tr"><div class="btn-group btn-group-xs" role="group" aria-label="">' .
						form_button(array('title' => 'Ubah data','content' => 'edit', 'class' => 'btn-default btn btn-edit tooltips', 'id' => $row->id)) . 
						form_button(array('title' => 'Hapus','content' => '<i class="glyphicon glyphicon-trash"></i>', 'class' => 'tooltips btn-danger btn btn-remove', 'id' => $row->id)) .
						'</div></div>';
						?>

						<tr<?php echo $status_class; ?>>
						<td><?php echo $row->id ?></td>

						<td><?php echo anchor('administrator?pg='.$halaman.'&juragan='.$row->user_id, $row->juragan); ?></td>
						<td class="text-center<?php echo $transfer_class ?>"><?php echo '<abbr data-toggle="tooltip" title="'. $row->tanggal_order .'">'.tanggal($row->tanggal_order).'</abbr>'; ?>
							<?php echo $button_transfer ?>
							<?php echo $button_kirim ?>
							<?php echo $button_edit; ?>
						</td>
						<!-- <td><?php echo $row->nama . '<br/><span class="label label-default">' . $row->hp . '</span>'; ?></td> -->
						<td><?php echo '<span class="nama_pemesan"><strong>' . strtoupper($row->nama) . '</strong></span><br/><span class="label label-info2">' . $row->hp . '</span><br/>';
							echo strtoupper($row->alamat); ?></td>
							<td><?php $string = $row->pesanan;
								if($string !== NULL)
								{
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

								echo '<div>' . strtoupper($row->kode) . '<br/><span class="label label-default">' . strtoupper($row->jumlah) .'</span> pcs</div>'; ?></td>
								<td><div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default disabled btn-clean"><?php echo strtoupper($row->bank); ?></button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default disabled <?php if($row->status === 'Lunas') { echo 'btn-lunas'; } else { echo 'btn-dp'; }; ?>"><?php if($row->status === 'Lunas') { echo '<i class="glyphicon glyphicon-heart"></i>'; } else { echo '<i class="glyphicon glyphicon-heart-empty"></i>'; }; ?> <?php echo strtoupper($row->status); ?></button>
									</div>
								</div>
								<?php echo $biaya; ?></td>
								<td>
								<?php 
								if($row->member_id > 0) { ?>
									<div class="well well-sm">
										<strong class="text-danger">PESANAN MEMBER</strong><br/>
										<u>Pengirim :</u><br/>
										<?php echo $row->nama_member; ?><br/><?php echo $row->hp_member; ?>
									</div>
								<?php }

								echo $row->keterangan; 

								if($row->customgambar !== NULL) {

								?>
								<div class="dropdown">
								  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="glyphicon glyphicon-picture"></i> Custom Gambar <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								   <?php
								   	$i = 1;
								   	$gmb = explode(',', $row->customgambar);
								   	foreach ($gmb as $key ) {
								   		echo '<li>'. anchor($key, 'Gambar ' . $i++, array('target' => '_blank')) .'</li>';
								   	}
								   	?>   
								  </ul>
								</div>
								<?php } ?>
								</td>
								<td><?php echo $resi; ?></td>
							</tr>
						<?php endforeach; ?>
						<?php } else { ?>
						<tr>
							<td colspan="12" class="text-center bg-warning"><strong class="">TIDAK ADA DATA!</strong></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php echo $pagination; ?>
		</div>

		<!-- resi submit -->
		<div class="modal fade" id="submit_resi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<?php echo form_open('administrator/resi/confirm','', array('url' => str_replace(site_url() . '/', '', $_SERVER["HTTP_REFERER"]), 'submit' => 'yes', 'id' => NULL)); ?>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel"><span class="addid"></span><?php // echo $pesan->id ?></h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="exampleInputEmail1">Kurir</label>
									<select id="kurir_list" class="form-control" name="kurir">
										<?php foreach (kurir()->result() as $row)
										{
											if($row->nama === 'JNE') { $check = 'selected=""';} else {$check = '';}
											echo '<option value="'.$row->nama.'"' . $check . '>';
											echo $row->nama;
											echo '</option>';
										} ?>
										<option value="lainnya">Lainnya</option>
									</select>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label for="lain">Lainnya</label>
									<?php echo form_input(array('name' => 'lain', 'id' => 'lain', 'class' => 'form-control lain', 'disabled' => '', 'placeholder' => 'lainnya')) ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="ongkir">Ongkir FIX</label>
							<?php echo form_input(array('name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'placeholder' => 'ongkir')) ?>
						</div>
						<div class="form-group">
							<label for="resi">No. Resi / keterangan</label>
							<?php echo form_input(array('autocomplete' => 'off', 'required' => '', 'name' => 'resi', 'id' => 'resi', 'class' => 'form-control', 'placeholder' => 'no resi / keterangan')) ?>
						</div>
					</div>
					<div class="modal-footer">
						<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-remove"></i>', 'data-dismiss' => 'modal', 'class' => 'btn btn-default')) .
						form_button(array('content' => '<i class="glyphicon glyphicon-ok"></i> Simpan', 'class' => 'btn btn-primary', 'type' => 'submit'));
						?>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<!-- /resi submit -->

		<!-- hapus -->
		<div class="modal fade" id="hapus_alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
				<?php echo form_open('administrator/hapus/confirm', '', array('id' => '', 'jur' => $juragan, 'hal' => $halaman, 'submit' => 'yes')) ?>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Hapus Data ID <span class="delid"></span></h4>
					</div>
					<div class="modal-body">
						<div class="well well-sm">
							Hapus data pesanan dengan <u>ID-<span class="delid"></span></u>.<br/>Penghapusan data tidak dapat dibatalkan.
						</div>
					</div>
					<div class="modal-footer">
						<?php echo form_button(array('class' => 'btn btn-default', 'data-dismiss' => 'modal', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).
						form_button(array('class' => 'btn btn-danger', 'type' => 'submit', 'content' => '<i class="glyphicon glyphicon-trash"></i> Hapus')) ?>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<!-- hapus -->

			<div class="" id="load"></div>

			<script>
				$(function () {
					$('.manual').click(function(event) {
			event.preventDefault();
			var ID = $(this).attr('id');
			$("#load").load(this.href, { id: ID }); 
		});
					$("#kurir_list").change(function() {
						if ($(this).val() === "lainnya") {
			        $('.lain').attr('disabled', false);
			        $('.lain').attr('required', true);
			      }
			      else {
			        $('.lain').attr('disabled', true);
			      }
			      if($(this).val() === "COD") {
			      	<?php $dt = mdate("%d%m%Y", now()); ?>
			      	$('#resi').val('COD<?php echo $dt; ?>');
			      }
			      else {
			      	$('#resi').val('');	
			      }
			    });
					
					
					$('.pg a').click(function(event) {
						$('#loader').html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
						$("#loader").load(this.href, 'submit=yes').hide().fadeIn('slow'); 
						loadPage();
						event.preventDefault();
					});

					$('button.submit-btn').click(function(event) {
						var UID = $(this).attr('id');
						var post = "<?php echo site_url('administrator/set_up') ?>";
						var reload = "<?php echo site_url('administrator/lihat_data/'.$halaman.'/'.$juragan) ?>";

						$.post( post, { submit: "yes", id: UID,  } )
						.done(function( data ) {
							$('#loader').html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
							$("#loader").load(reload, 'submit=yes&pg=all').hide().fadeIn('slow'); 
						});
						loadPage();
						event.preventDefault();
					});

					function loadPage(){
						$("html, body").animate({
							scrollTop: 0
						}, 1000);
					}

					$('.submit-resi').click(function(event){
						event.preventDefault();
						var UID = $(this).attr('id');
						$( "span.addid" ).text( 'Submit Resi ' + UID );
						$( "input[name=id]" ).val( 'submit-resi_' + UID );

						$('#submit_resi').modal({
							show: true
						});
					});

					$('.btn-remove').click(function(event){
						event.preventDefault();
						var UID = $(this).attr('id');
						$( "span.delid" ).text( UID );
						$( "input[name=id]" ).val( UID );

						$('#hapus_alert').modal({
							show: true
						});
					});

					$('button.btn-edit').click(function(event) {
						var UID = '/' + $(this).attr('id');
						var JUR = '/<?php echo $juragan ?>';
						var HAL = '/<?php echo $halaman ?>';
						var URL = '<?php echo site_url('administrator/edit_pesanan') ?>';
						$(location).attr('href', URL + UID + HAL + JUR);
					});

					$(".alert-custom").fadeTo(3000, 500).slideUp(500, function(){
						$(".alert-custom").alert('close');
					});

					$('[data-toggle=popover]').popover({ 
						html : true,
						placement : 'auto right',
						trigger : 'focus'
					});

					$('.tooltips').tooltip();

					$('.loader').click(function(event) {
						event.preventDefault();
				$("#load_data").load(this.href, 'submit=yes' ); // { uid: UID }
			});
				});
</script>
