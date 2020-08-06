<?php
$pesan = $this->session->userdata('info');
if( ! empty($pesan))
	{ ?>
<div class="alert alert-info alert-custom">
	<?php echo $pesan; ?>
</div>
<?php } $this->session->unset_userdata('info'); ?>



<div class="content-inti" id="reload">	

	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th width="8%">Tanggal</th>
					<th width="30%">Alamat</th>
					<th width="15%">Kode, Size / Jumlah</th>
					<th width="14%">Biaya</th>
					<th width="">Keterangan</th>
					<th width="12%">Resi Kirim</th>
				</tr>
			</thead>
			<tbody>
				<?php if($pesanan->num_rows() > 0) { ?>
				<?php foreach ($pesanan->result() as $row) : ?>
						<?php 
						$resi = '';
						if($row->kurir !== NULL)
						{
							$resi .= '<strong>' . strtoupper($row->kurir) . '</strong>';
						}
						if($row->resi !== NULL)
						{
							$resi .= '<div> '.$row->resi . ' </div>';
						}

						if($row->kurir === 'COD')
						{
							$kiriman = 'terambil';
						}
						else
						{
							$kiriman ='terkirim';
						}

						if($row->cek_kirim !== NULL)
						{
							$resi .= '<small><em>' .$kiriman. ' : <abbr data-toggle="tooltip" title="'. $row->cek_kirim .'">' .tanggal($row->cek_kirim) . '</abbr></em></small>';
						}

						?>

						<?php 
						$ongkir_fix = '';
					if($row->ongkir_fix !== NULL) {
						$ongkir_fix = '<div class="btn-margin">ongkir fix : <span class="label label-info2">' . harga($row->ongkir_fix) . '</span></div>';
					}
					$ongkirnya = '<div class="btn-margin">ongkir : <span class="label label-success">' . harga($row->ongkir) . '</span></div>';
					if($row->ongkir < 1000) {
						$ongkirnya = '<div class="btn-margin"><span class="label label-success">FREE ONGKIR</span></div>';
					}

					$biaya = '<div class="text-right"><div class="btn-margin">harga : <span class="label label-info">' . harga($row->harga) . '</span></div>'. $ongkirnya . $ongkir_fix . '<div class="btn-margin">transfer : <span class="label label-danger">' . harga($row->transfer) . '</span></div></div>';
						?>
						<?php /////////////////////////////// tombol group kirim & transfer ///////////////////////////////
						if($row->barang === 'Pending' && $row->status_transfer === 'Belum')
						{
							$transfer_class = '';
							$status_class = '';
							$button_kirim = '<div class="btn-margin"><a href="#" class="btn-block btn btn-default btn-xs disabled"><i class="glyphicon glyphicon-refresh text-warning"></i> Pending</a></div>';
							$button_transfer = '<div class="btn-margin"><a href="#" class="btn-block btn btn-default btn-xs disabled"><i class="glyphicon glyphicon-remove text-warning"></i> Belum</a></div>';
						}
						elseif($row->barang === 'Pending' && $row->status_transfer === 'Masuk')
						{
							$transfer_class = ' danger';
							$status_class = '';
							$button_kirim = '<div class="btn-margin"><a href="#" class="btn-block btn btn-default btn-xs disabled"><i class="glyphicon glyphicon-refresh text-success"></i> Pending</a></div>';
							$button_transfer = '<div class="btn-margin"><abbr title="'.$row->cek_transfer.'"><a href="#" class="btn-block btn btn-success btn-xs disabled"><i class="glyphicon glyphicon-ok"></i> Masuk</a></abbr></div>';
						}
						elseif($row->barang === 'Terkirim' && $row->status_transfer === 'Masuk')
						{
							$transfer_class = '';
							$status_class = ' class="danger"';
							$button_kirim = '<div class="btn-margin"><abbr title="'.$row->cek_kirim.'"><a href="#" class="btn-block btn btn-success btn-xs disabled"><i class="glyphicon glyphicon-ok"></i> Terkirim</a></abbr></div>';
							$button_transfer = '<div class="btn-margin"><abbr title="'.$row->cek_transfer.'"><a href="#" class="btn-block btn btn-success btn-xs disabled"><i class="glyphicon glyphicon-ok"></i> Masuk</a></abbr></div>';
						}
						
						//
						if($row->status_transfer === 'Belum')
						{
							$button_edit = '<div class="btn-hover-tr"><div class="btn-group btn-group-xs" role="group" aria-label="">' .
							form_button(array('content' => 'edit', 'class' => 'btn-default btn btn-edit', 'id' => $row->id)) . 
							form_button(array('content' => '<i class="glyphicon glyphicon-trash"></i>', 'class' => 'btn-danger btn btn-remove', 'id' => $row->id)) .
							'</div></div>';
						}
						else
						{
							$button_edit = "";
						}
						?>

						<tr<?php echo $status_class; ?>>
						<td><?php echo $row->id ?></td>
						
						<td class="text-center<?php echo $transfer_class ?>"><?php echo '<abbr data-toggle="tooltip" title="'. $row->tanggal_order .'">'.tanggal($row->tanggal_order).'</abbr>'; ?>
							<?php echo $button_transfer; ?>
							<?php echo $button_kirim; ?>
							<?php echo $button_edit; ?>
						</td>
						<td><?php echo '<div class="nama_pemesan"><strong>' . strtoupper($row->nama) . '</strong></div><span class="label label-info2">' . $row->hp . '</span><br/>';
						echo strtoupper($row->alamat); ?></td>
						<td><?php $string = $row->pesanan;
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

						 echo $row->kode . '<br/><span class="label label-default">' . $row->jumlah .'</span> pcs'; ?></td>
						 <td><div class="btn-group btn-group-justified" role="group" aria-label="...">
						 	<div class="btn-group" role="group">
						 		<button type="button" class="btn btn-default disabled btn-clean"><?php echo strtoupper($row->bank); ?></button>
						 	</div>
						 	<div class="btn-group" role="group">
						 	<button type="button" class="btn btn-default disabled <?php if($row->status === 'Lunas') { echo 'btn-lunas'; } else { echo 'btn-dp'; }; ?>"><?php if($row->status === 'Lunas') { echo '<i class="glyphicon glyphicon-heart"></i>'; } else { echo '<i class="glyphicon glyphicon-heart-empty"></i>'; }; ?> <?php echo strtoupper($row->status); ?></button>
						 	</div>
						 </div>
						<?php echo $biaya; ?></td>
							<td><?php 
								if($row->member_id > 0) { ?>
									<div class="well well-sm">
										<strong class="text-danger">PESANAN MEMBER</strong><br/>
										<u>Pengirim :</u><br/>
										<?php echo $row->nama_member; ?><br/><?php echo $row->hp_member; ?>
									</div>
								<?php } ?>
								<?php echo strtoupper($row->keterangan);
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
								<?php } ?></td>
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

	<div class="" id="load"></div>

	<script>
		$(function () {
			$('.pg a').click(function(event) {
				
				//var UID = $(this).attr('id');
				$('#loader').html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
				$("#loader").load(this.href, 'submit=yes').hide().fadeIn('slow'); 
				$("html, body").animate({
					scrollTop: 0
				}, 1000);
				event.preventDefault();
			});
			//a("[href=#]").click(function(a){a.preventDefault()});

			function loadPage(){
				$("html, body").animate({
					scrollTop: 0
				}, 1000);
				
			}
			
			//a("[href=#]").click(function(a){a.preventDefault()});

			$('button.submit-btn').click(function(event) {

				var UID = $(this).attr('id');
				var post = "<?php echo site_url('administrator/set_up') ?>";
				var reload = "<?php echo site_url('administrator/lihat_data/'.$halaman.'/'.$juragan) ?>";

				$.post( post, { submit: "yes", id: UID,  } )
				.done(function( data ) {
					 // alert("Data: " + data);
					 $('#loader').html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
					 $("#loader").load(reload, 'submit=yes&pg=all').hide().fadeIn('slow'); 
					});

				loadPage();
				event.preventDefault();
			});

			// edit pesanan 
			$('button.btn-edit').click(function(event) {
				var UID = '/' + $(this).attr('id');
				var HAL = '/<?php echo $halaman ?>';
				var URL = '<?php echo site_url('user/edit') ?>';
				$(location).attr('href', URL + UID + HAL);
			});

			// hapus pesanan
			$('button.btn-remove').click(function(event) {
				var UID = $(this).attr('id');
				var JUR = '<?php echo $juragan ?>';
				var HAL = '<?php echo $halaman ?>';
				var reload = "<?php echo site_url('user/hapus/alert') ?>";

				$("#load").load(reload, { submit: "yes", id: UID, hal: HAL, jur: JUR  });

				event.preventDefault();
			});

			$(".alert-custom").fadeTo(3000, 500).slideUp(500, function(){
				$(".alert-custom").alert('close');
			});

			
			$('[data-toggle=popover]').popover({ 
				html : true,
				placement : 'auto right',
				trigger : 'focus'
			});
			$('.loader').click(function(event) {
				event.preventDefault();
				// var UID = $(this).attr('id');
				$("#load_data").load(this.href, 'submit=yes' ); // { uid: UID }
			});
		});

$("#bb-cari").appendTo("#bb-tab");


	</script>
