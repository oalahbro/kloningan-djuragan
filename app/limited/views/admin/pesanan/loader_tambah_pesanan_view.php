<?php if( input_get('submit') === 'yes') {?>

<?php
$pesan = $this->session->userdata('info');
if( ! empty($pesan))
	{ ?>
<div class="alert alert-info alert-custom">
	<?php echo $pesan; ?>
</div>
<?php } $this->session->unset_userdata('info'); ?>



<div class="content-inti" id="reload">	
	<div class="" id="load"></div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-danger">
				<div class="panel-body">
					<form enctype="multipart/form-data" id="form" method="post" class="form-horizontal" action="system/adm_submit.php" role="form" data-toggle="validator">
						<input type="hidden" name="id" value="3">

						<!-- field nama -->
						<div class="form-group">
							<label for="nama">Nama</label>
							<?php echo form_input(array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '')); ?>
						</div>

						<!-- field alamat -->
						<div class="form-group">
							<label for="orderAlamat">Alamat</label>
							<textarea required="" class="form-control" id="orderAlamat" placeholder="Jl. Sukun, Gg. Mawar No 133A, Karang Bendo, Banguntapan, Bantul, Yogyakarta" name="alamat"></textarea>
						</div>

						<!-- field hape -->
						<div class="form-group">
							<label for="orderHape">HP</label>
							<input maxlength="12" type="tel" required="" class="form-control" id="orderNama" placeholder="08xxxxxxxxx" name="hape" value="">
						</div>

						<!-- field kode & size -->
						<div class="form-group">
							<label for="orderKode">Kode Barang &amp; Size</label>
							<input autocomplete="on" type="text" required="" class="form-control" id="orderKode" placeholder="BK-01 (M)" name="kode" value="">
						</div>

						<!-- field jumlah -->
						<div class="form-group">
							<label for="orderJumlah">Jumlah Barang</label>
							<div class="input-group">
								<input min="1" autocomplete="on" type="number" required="" class="form-control" id="orderJumlah" placeholder="2" name="jumlah" value="">
								<span class="input-group-addon">pcs</span> </div>
							</div>

							<!-- field harga -->
							<div class="form-group">
								<label for="orderHarga">Harga Barang</label>
								<div class="input-group"> <span class="input-group-addon">Rp</span>
									<input autocomplete="on" type="text" required="" class="form-control" id="orderHarga" placeholder="280000" name="harga" value="">
								</div>
							</div>

							<!-- field ongkir -->
							<div class="form-group">
								<label for="orderOngkir">Ongkir</label>
								<div class="input-group"> <span class="input-group-addon">Rp</span>
									<input autocomplete="on" type="text" required="" class="form-control" id="orderOngkir" placeholder="280000" name="ongkir" value="">
								</div>
							</div>

							<!-- field transfer -->
							<div class="form-group">
								<label for="orderTransfer">Total Transfer</label>
								<div class="input-group"> <span class="input-group-addon">Rp</span>
									<input autocomplete="on" type="text" required="" class="form-control" id="orderTransfer" placeholder="280000" name="transfer" value="">
								</div>
							</div>

							<!-- field transfer -->
							<div class="form-group">
								<label for="orderStatus">Status Pembayaran</label>
								<div class="radio">
									<label>
										<input required="" id="orderStatus1" value="DP" type="radio" name="status">
										DP 
									</label>
								</div>
								<div class="radio">
									<label>
										<input required="" id="orderStatus2" value="Lunas" type="radio" name="status">
										Lunas
									</label>
								</div>
							</div>

							<!-- field bank -->
							<div class="form-group">
								<label for="orderBank">BANK</label>
								<input maxlength="12" type="text" required="" class="form-control" id="orderBank" placeholder="MANDIRI" name="bank" value="">
							</div>

							<!-- field keterangan -->
							<div class="form-group">
								<label for="orderKeterangan">Keterangan</label>
								<textarea class="form-control" id="orderKeterangan" placeholder="" name="keterangan"></textarea>
							</div>

							<!-- custom gambar -->
							<div class="form-group">
								<label for="customGambar">Custom Gambar</label>
								<div class="input-group">
									<input id="customGambar" name="image" type="file">
								</div>
							</div>

							<!-- tombol submit -->
							
						</form>
					</div>
					<div class="panel-footer">
								<button type="submit" class="btn btn-primary"> Simpan </button>
							</div>
				</div>
			</div>
		</div>



		<script>
			$(function () {
				$('.pg a').click(function(event) {

				//var UID = $(this).attr('id');
				$('#loader').html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
				$("#loader").load(this.href, 'submit=yes').hide().fadeIn('slow'); 
				$("html, body").animate({
					scrollTop: 0
				}, 2000);
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

			// submit resi
			$('button.submit-resi').click(function(event) {
				var UID = $(this).attr('id');
				var reload = "<?php echo site_url('administrator/resi/form') ?>";

				$("#load").load(reload, { submit: "yes", id: UID  });

				event.preventDefault();
			});

			// edit pesanan 
			$('button.btn-edit').click(function(event) {
				var UID = '?id=' + $(this).attr('id');
				var JUR = '&juragan=<?php echo $juragan ?>';
				var HAL = '&halaman=<?php echo $halaman ?>';
				var URL = '<?php echo site_url('administrator/pesanan/edit') ?>';
				$(location).attr('href', URL + UID + HAL + JUR);
			});

			// hapus pesanan
			$('button.btn-remove').click(function(event) {
				var UID = $(this).attr('id');
				var JUR = '<?php echo $juragan ?>';
				var HAL = '<?php echo $halaman ?>';
				var reload = "<?php echo site_url('administrator/hapus/alert') ?>";

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
<?php } ?>