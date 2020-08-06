<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id_juragan = $this->juragan->_id($juragan);
$nama_juragan = $this->juragan->_nama($id_juragan);

if ($status === 'pending') {
	$judul = 'Pesanan Pending';
}
else if ($status === 'terkirim') {
	$judul = 'Pesanan Terkirim';
}
else {
	$judul = 'Semua Pesanan';
}
?>
<div id="pesan_update"></div>

<div class="" id="utamaOrder">
	<div class="page-header">
		<h1><?php echo $judul; ?> <small><?php echo $nama_juragan; ?></small></h1>
	</div>

	<div class="container-fluid navigasi mb-3">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<?php echo anchor('arsip/pesanan/' . $juragan . '/all', 'Semua', array('class' => 'nav-link ' . ($status === 'all' ? 'active':''))); ?>
			</li>
			<li class="nav-item">
				<?php echo anchor('arsip/pesanan/' . $juragan . '/pending', 'Pending', array('class' => 'nav-link ' . ($status === 'pending' ? 'active':''))); ?>
			</li>
			<li class="nav-item">
				<?php echo anchor('arsip/pesanan/' . $juragan . '/terkirim', 'Terkirim', array('class' => 'nav-link ' . ($status === 'terkirim' ? 'active':''))); ?>
			</li>
		</ul>
	</div>

	<div class="utama">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3">

					<form class="form-inline limited" method="get">
						<div class="form-group">
							<label class="sr-only">Limit</label>
							<p class="form-control-static">Limit</p>
						</div>
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Limit</label>
							<select class="form-control" name="limit">
								<option value="<?php echo save_url_encode(10); ?>"<?php echo ((int) $limit === 10 ? ' selected=""': ''); ?>>10</option>
								<option value="<?php echo save_url_encode(30); ?>"<?php echo ((int) $limit === 30 ? ' selected=""': ''); ?>>30</option>
								<option value="<?php echo save_url_encode(50); ?>"<?php echo ((int) $limit === 50 ? ' selected=""': ''); ?>>50</option>
								<option value="<?php echo save_url_encode(100); ?>"<?php echo ((int) $limit === 100 ? ' selected=""': ''); ?>>100</option>
								<option value="<?php echo save_url_encode(150); ?>"<?php echo ((int) $limit === 150 ? ' selected=""': ''); ?>>150</option>
							</select>
						</div>
						<button type="submit" class="btn btn-light">OK</button>
					</form>

				</div>

				<div class="col-sm-3 col-sm-push-6">
					<?php echo form_open('', array('method' => 'get', 'id' => 'myForm', 'class' => 'form-inline')); ?>

						<div class="form-group">
							<?php 

							echo form_input('cari', $cari, array('class' => 'form-control', 'id' => 'cari', 'placeholder' => 'cari data' )) ?>
						</div>
						<button type="submit" class="btn btn-light" id="search-btn">OK</button>
					</form>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Juragan</th>
							<th style="min-width: 120px">Tanggal</th>
							<th>Pemesan</th>
							<th style="min-width: 160px">Pesanan</th>
							<th style="min-width: 170px">Biaya</th>
							<th>Keterangan</th>
							<th>Resi Kirim</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($q->num_rows() > 0) {
							foreach ($q->result() as $key) {
								$detail = json_decode($key->detail);
								$biaya = json_decode($key->biaya);
								$pesanan = $detail->p;
								$slug = save_url_encode($key->slug);

								$arr_transfer['func'] = 'transfer';
								$arr_transfer['invoice']['id'] = $key->id_pesanan;
								$arr_transfer['invoice']['slug'] = $slug;

								$arr_kirim['func'] = 'kirim';
								$arr_kirim['invoice']['id'] = $key->id_pesanan;
								$arr_kirim['invoice']['slug'] = $slug;

								// lets play with button
								if($key->status_transfer === 'ada' && $key->status_kirim === 'pending') {
									$class_tr = ''; // default
									$class_td = 'table-success';

									$arr_transfer['invoice']['transfer'] = FALSE;
									$arr_kirim['invoice']['kirim'] = TRUE;

									$button_transfer = '<button id="quick" class="btn btn-success btn-sm btn-block" data-button=\'' . json_encode($arr_transfer) .'\'><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button id="quick" class="btn btn-secondary btn-sm btn-block" data-button=\'' . json_encode($arr_kirim) .'\'><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
								}
								else if($key->status_transfer === 'ada' && $key->status_kirim === 'terkirim') {
									$class_tr = 'table-success'; // default
									$class_td = '';

									$arr_kirim['invoice']['kirim'] = FALSE;
									if(isset($biaya->m->of)) {
										$ongkir_btn = $biaya->m->of;
									}
									else {
										$ongkir_btn = 0;
									}
									$arr_kirim['invoice']['resi']['ongkir'] = $ongkir_btn;

									if(isset($detail->s)) {
										$arr_kirim['invoice']['resi']['no'] = $detail->s->n;
										$arr_kirim['invoice']['resi']['kurir'] = $detail->s->k;
										$arr_kirim['invoice']['resi']['tanggal'] = mdate('%d-%m-%Y', $detail->s->d);
									}

									$button_transfer = '<button class="btn btn-success btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button id="quick" class="btn btn-success btn-sm btn-block" data-button=\'' . json_encode($arr_kirim) .'\'><i class="glyphicon glyphicon-ok"></i> Terkirim</button>';
								}
								else {
									$class_tr = ''; // default
									$class_td = '';

									$arr_transfer['invoice']['transfer'] = TRUE;

									$button_transfer = '<button id="quick" class="btn btn-light btn-sm btn-block" data-button=\'' . json_encode($arr_transfer) .'\'><i class="glyphicon glyphicon-remove"></i> Belum</button>';

									$button_Kirim = '<button class="btn btn-light btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
								}

								?>
								<tr class="<?php echo $class_tr; ?>">
									<td><?php echo $key->id_pesanan; ?></td>
									<td>
										<?php echo anchor('arsip/pesanan/' .$this->juragan->_slug($key->juragan) . '/all', $this->juragan->_nama($key->juragan)); ?><br/>
									</td>
									<td class="<?php echo $class_td; ?>">
										<abbr title="<?php echo unix_to_human($key->tanggal_submit); ?>"><?php echo mdate('%d-%M-%y', $key->tanggal_submit); ?></abbr>
										<?php echo $button_transfer; ?>
										<?php echo $button_Kirim; ?>
										<!-- Single button -->
										<div class="dropdown mt-2">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $key->id_pesanan; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Aksi
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $key->id_pesanan; ?>">
												<?php echo anchor('admin/pesanan/sunting?id=' . $slug, 'Sunting', array('class' => 'dropdown-item') ); ?>

												<?php echo anchor('download?id=' . $slug, 'Download Invoice (PDF)', array('target' => '_blank', 'class' => 'dropdown-item') ) ?>
												<a id="ahapus_pesanan" class="dropdown-item" data-button='<?php echo json_encode(array('slug' => $slug, 'id' => $key->id_pesanan)); ?>'>Hapus</a>
											</div>
										</div>
									</td>
									<td><?php
									$pm = json_decode($key->pemesan);
									echo '<strong>' . strtoupper( $pm->n ) . '</strong><br/>';
									echo '<span class="badge badge-info">' . strtoupper( $pm->p[0] ) . '</span>' . (isset($pm->p[1]) ? ' <span class="sr-only">/</span> <span class="badge badge-info">' . $pm->p[1] . '</span>': '' );
									echo '<br/>' . strtoupper( nl2br( $pm->a) );
									?></td>
									<td><?php
									$total_pesanan = 0;
									foreach ($pesanan as $pesan) {
										$total_pesanan = $total_pesanan+$pesan->q;
										echo strtoupper($pesan->c) . ' (' .strtoupper($pesan->s). ') = ' . $pesan->q . 'pcs<br/>';
									}
									echo '<hr/><em class="text-info">total: <span class="badge badge-default">' . $total_pesanan . '</span> pcs</em>';
									?></td>
									<td>
									<?php
									
									echo '<div class="text-center border border-primary">' . strtoupper($biaya->b) . '</div>';
									echo '<div class="mt-2 mb-2 border text-center border-'. ($biaya->s === 'dp'? 'success': 'danger') .'">' . strtoupper($biaya->s) . '</div>';
									echo '<div class="text-right">';
									echo 'harga : <span class="badge badge-info">' . harga($biaya->m->h) . '</span><br/>';
									echo (isset($biaya->m->o) && $biaya->m->o > 0 ? 'ongkir : <span class="badge badge-success">' . harga($biaya->m->o) . '</span>': '<span class="badge badge-success">FREE ONGKIR</span>') . '<br/>';
									echo (isset($biaya->m->of)? 'ongkir fix : <span class="badge badge-warning">' . harga($biaya->m->of) . '</span><br/>' : '');
									echo (isset($biaya->m->d) && $biaya->m->d > 0? 'diskon : <span class="badge badge-default">- ' . harga($biaya->m->d) . '</span><br/>' : '');
									echo 'transfer : <span class="badge badge-danger">' . harga($biaya->m->t) . '</span><br/>';
									echo '</div>';
									?>
									
									</td>
									<td><?php 
									echo (isset($detail->n) ? nl2br( $detail->n ) : '' ); 

									echo (isset($detail->n) && isset($detail->i) ? '<hr/>' : '' );
									if(isset($detail->i)) { ?>
									<div class="btn-group">
										<button id="gambar-<?php echo $key->id_pesanan; ?>" type="button" class="btn btn-info dropdown-toggle deropdowen" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Custom Gambar <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="gambar-<?php echo $key->id_pesanan; ?>">
											<?php 
											$i = 1;
											foreach ($detail->i as $image) {
											echo '<li>' . anchor($image, 'Gambar ' . $i++, array('target' => '_blank'));
										}
										?>
										</ul>
									</div>
									<?php
									}
									echo ($key->oleh !== NULL ? '<hr/><small class="text-muted">CS : <em>' . $this->pengguna->_nama_pengguna($key->oleh) . '</em></small>' : '');
									?></td>
									<td><?php 
									if(isset($detail->s)) {
										echo '<strong>' . $detail->s->k . '</strong><br />';
										echo strtoupper($detail->s->n);

										echo '<br/><em>' . ($detail->s->k === 'COD' ? 'terambil' : 'terkirim') . ' : ' . mdate('%d-%M-%y', $detail->s->d) . '</em>';
									}
									?></td>
								</tr>
								<?php 
							}
						}
						else {
							echo '<tr><td colspan="8" class="text-center warning">Data tidak ada!</td></tr>';
						}
						?>
					</tbody>

				</table>
			</div>
			<div id="pagee">
			<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="hapus_pesanan" tabindex="-1" role="dialog" aria-labelledby="hapus_pesananLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus_pesananLabel">Hapus Pesanan #<span id="inHapusID"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="well well-sm">Yakin mau hapus pesanan ini ?<br/>Penghapusan tidak dapat dibatalkan.</div>
      </div>
      <div class="modal-footer">
		<?php echo form_open('admin/pesanan/hapus', array('id' => 'remove_me'), array('slug' => '', 'current' => '')); ?>
		<button type="submit" class="btn btn-danger">Ya, Hapus</button>
		<?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal alert transfer-->
<div class="modal fade" id="modal_transfer" tabindex="-1" role="dialog" aria-labelledby="modal_transferTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_transferTitle">Set Transfer #<span id="numID"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="well well-sm" id="keterangan"></div>
      </div>
      <div class="modal-footer">
		<?php echo form_open('admin/pesanan/set/transfer', array('class' => 'modal-footer', 'id' => 'form_tr'), array('slug' => '', 'transfer' => '', 'current' => '' )); ?>
		<button type="submit" id="submit_tr" class="btn btn-primary">Ya!</button>
		<?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>


<!-- modal resi -->
<div class="modal fade" id="modal_resi_kirim" tabindex="-1" role="dialog" aria-labelledby="modal_resi_kirimTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
	<?php echo form_open('admin/pesanan/set/kirim', array('id' => 'form_kirim'), array('slug' => '', 'kirim' => '', 'current' => '')); ?>
	            <div class="modal-header">
				
	                <h4 class="modal-title" id="myModalLabel"><span class="addid">Submit Resi #<span id="invID"></span></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
					</div>
	            <div class="modal-body">
	            	<div class="well well-sm" id="keterangan_"></div>
	                <div class="row">
	                    <div class="col-sm-4">
	                        <div class="form-group">
	                        	<?php 
	                        	$arr = json_decode($this->config->item('list_kurir'));
								$kurir = array();
								foreach ($arr as $key) {
									$kurir[$key] = $key;
								}
								$options = array_merge($kurir, array('lainnya' => 'Lainnya'));

								echo form_label('Kurir', 'kurir_list');
								echo form_dropdown('kurir', $options, 'JNE', array('class' => 'form-control', 'id' => 'kurir_list'));
								?>
	                        </div>
	                    </div>
	                    <div class="col-sm-8">
	                        <div class="form-group">
	                            <label for="lain">Lainnya</label>
	                            <input name="lain" value="" id="lain" class="form-control lain" disabled="disabled" placeholder="lainnya" type="text">
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                	<label>Tanggal Kirim</label>
	                	<input name="tanggal" type='text' class="form-control" id='datetimepicker4' value="<?php echo mdate('%d-%m-%Y', time()); ?>" />
	                </div>
	                <div class="form-group">
	                    <label for="ongkir">Ongkir FIX</label>
	                    <input name="ongkir" value="" id="ongkir" class="form-control" placeholder="ongkir" type="text">
	                </div>
	                <div class="form-group">
	                    <label for="resi">No. Resi / keterangan</label>
	                    <input name="resi" value="" autocomplete="off" required="" id="resi" class="form-control" placeholder="no resi / keterangan" type="text">
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" id="set_pending" class="btn btn-light">Set Pending</button>
	                <button type="submit" id="submit_kirim" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
	            </div>
	        <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script>
	(function($){
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
			'<?php echo base_url('berkas/js/bootstrap.bundle.min.js'); ?>', 
			'<?php echo base_url('assets/js/pace.min.js'); ?>'
			];

			$.getMultiScripts(script_arr).done(function() {
                // all scripts loaded

                $('button#submit_tr').click(function(e){
                	e.preventDefault();
                	$.ajax({
                		type: 'POST',
                		url: $("form#form_tr").attr("action"),
                		data: $("form#form_tr").serialize(), 
                		success: function(response) {
                			if(response.status === 'sukses') {
                				$('#modal_transfer').modal('hide');
                				ajaxLoadPage(response.url);
                				back_to_top();

                				$('#pesan_update').html('<div class="alert alert-success flyover">'+response.message+'</div>');

                			}
                		},
                	});
                	return false;
                });

                $('button#set_pending').click(function(e){
                	e.preventDefault();
                	var val = { //Fetch form data
				            'slug' : $('form#form_kirim input[name="slug"]').val(),
				            'kirim' : 'pending',
				            'current' : $('form#form_kirim input[name="current"]').val(),
				        };

                	$.ajax({
                		type: 'POST',
                		url: $("form#form_kirim").attr("action"),
                		data: val, 
                		success: function(response) {
                			if(response.status === 'sukses') {
                				$('#modal_resi_kirim').modal('hide');
                				ajaxLoadPage(response.url);
                				back_to_top();

                				$('#pesan_update').html('<div class="alert alert-success flyover">'+response.message+'</div>');

                			}
                		},
                	});
                	return false;
                });

                $('form#form_kirim').submit(function(e){
                	e.preventDefault();
                	var kurir = $('form#form_kirim [name="kurir"]').val();

                	if(kurir === 'lainnya') {
                		kurir = $('form#form_kirim [name="lain"]').val();
                	}


                	var values = { //Fetch form data
				            'slug' : $('form#form_kirim input[name="slug"]').val(),
				            'kirim' : $('form#form_kirim input[name="kirim"]').val(),
				            'tanggal' : $('form#form_kirim input[name="tanggal"]').val(),
				            'resi' : $('form#form_kirim input[name="resi"]').val(),
				            'current' : $('form#form_kirim input[name="current"]').val(),
				            'kurir' : kurir,
				            'ongkir' : $('form#form_kirim input[name="ongkir"]').val(),
				        };

                	$.ajax({
                		type: 'POST',
                		url: $("form#form_kirim").attr("action"),
                		data: values, 
                		success: function(response) {

                			if(response.status === 'sukses') {
                				$('#modal_resi_kirim').modal('hide');
                				ajaxLoadPage(response.url);
                				back_to_top();

                				$('#pesan_update').html('<div class="alert alert-success flyover">'+response.message+'</div>');
                			}
                		},
                	});
                	return false;
                });

                $("#kurir_list").change(function() {
                	if ($(this).val() === "lainnya") {
                		$('.lain').attr('disabled', false);
                		$('.lain').attr('required', true);
                	} else {
                		$('.lain').attr('disabled', true);
                	}

                	if ($(this).val() === "COD") {
                		$('#resi').val('COD<?php echo mdate('%d%m%Y', time()); ?>');
                	} else {
                		$('#resi').val('');
                	}
                });

                $('.deropdowen').dropdown();

                $('form#remove_me').submit(function(e){
                	e.preventDefault();
                	
                	var values = { //Fetch form data
				            'slug' : $('form#remove_me input[name="slug"]').val(),
				            'current' : $('form#remove_me input[name="current"]').val()
				        };

                	$.ajax({
                		type: 'POST',
                		url: $("form#remove_me").attr("action"),
                		data: values, 
                		success: function(response) {

                			if(response.status === 'sukses') {
                				$('#hapus_pesanan').modal('hide');
                				ajaxLoadPage(response.url);
                				back_to_top();

                				$('#pesan_update').html('<div class="alert alert-success flyover">'+response.message+'</div>');
                			}
                		},
                	});
                	return false;
                });

                $('a#ahapus_pesanan').click(function(){
                	var data = JSON.parse( $(this).attr('data-button') );
                	$('#hapus_pesanan').modal('show');
                	$('#hapus_pesanan').on('shown.bs.modal', function (e) {
                		$('#hapus_pesanan #inHapusID').html(data.id);
                		$('#hapus_pesanan [name="slug"]').val(data.slug);
                		$('#hapus_pesanan [name="current"]').val(window.location);
                	});
                });
                
                var myFuncs = {
                	transfer: function (data) { 

                        // load modal untuk set transferan ada
                        // alert('TRANSFERAN ADA');
                        var transfer = 'tidak';
                        var dHTML = '';
                        $('#modal_transfer').modal('show');
                        $('#modal_transfer').on('shown.bs.modal', function (e) {
                        	$('#numID').html(data.invoice.id);
                        	if(data.invoice.transfer) {
                        		dHTML = 'Yakin Dana untuk invoice #' + data.invoice.id + ' sudah ada ?<br/>Set sudah transfer?';
                        		transfer = 'ada';
                        	}
                        	else {
                        		dHTML = 'Dana untuk Invoice #' + data.invoice.id + ' belum ada?<br/>Set belum transfer?';
                                // transfer = 'tidak';
                            }

                            $('#keterangan').html(dHTML);
                            $('input[name="slug"]').val(data.invoice.slug);
                            $('input[name="transfer"]').val(transfer);
                            $('input[name="current"]').val(window.location);
                        }).on('hidden.bs.modal', function (e) {
                        	$('#numID').html('');
                        	$('#keterangan').html('');
                        	$('input[name="slug"]').val('');
                        	$('input[name="transfer"]').val('');
                        });

                    },
                    kirim: function (data) { 
                    	
                    	var kHTML = '',
                    		resi = data.invoice.resi,
                    		kirim = '';
                    	// alert('input resi');
                    	$('#modal_resi_kirim').modal('show');
                    	$('#modal_resi_kirim').on('shown.bs.modal', function (e) {

                    		var arr = <?php echo $this->config->item('list_kurir'); ?>;

                    		if(typeof(resi) !== "undefined" && typeof(resi.kurir) !== "undefined" && resi.kurir !== null) {
	                    		if(jQuery.inArray( resi.kurir, arr ) > 0) {
	                    			$('#kurir_list').val(resi.kurir);
	                    			$('.lain').attr('disabled', true);
	                    		}
	                    		else {
	                    			$('#kurir_list').val('lainnya');
	                    			$('.lain').val(resi.kurir);
	                    			$('.lain').attr('disabled', false);
	                				$('.lain').attr('required', true);
	                    		}
	                    	}
                    	
                        	$('#invID').html(data.invoice.id);

                        	if(data.invoice.kirim) {
                        		$('#set_pending').addClass('hide');
                        		kHTML = 'Dengan mengisi data berikut, status pesanan akan dibah menjadi "Terkirim".';
                        	}
                        	else {
                        		$('#set_pending').removeClass('hide');
                        		kHTML = 'Jika ingin merubah / menghapus status terkirim, klik tombol "Set Pending".';
                        		// kirim = 'pending';
                        	}
                        	$('#keterangan_').html(kHTML);

                        	if(typeof(resi) !== "undefined" && typeof(resi.ongkir) !== "undefined" && resi.ongkir !== null) {
                        		$('#ongkir').val(resi.ongkir);
                        	}
                        	else {
                        		$('#ongkir').val(0);
                        	}

                        	if(typeof(resi) !== "undefined" && typeof(resi.no) !== "undefined" && resi.no !== null) {
                        		$('#resi').val(resi.no);
                        	}
                        	else {
                        		$('#resi').val('');
                        	}

                        	if(typeof(resi) !== "undefined" && typeof(resi.tanggal) !== "undefined" && resi.tanggal !== null) {
                        		$('#datetimepicker4').val(resi.tanggal);
                        	}
                        	$('input[name="slug"]').val(data.invoice.slug);
                            $('input[name="current"]').val(window.location);
                            $('input[name="kirim"]').val('terkirim');
                        });

                    }
                };

                $('button#quick').click(function(){
                	var data = JSON.parse( $(this).attr('data-button') );
                	myFuncs[data.func](data);
                });

                
            });

			$(".flyover").fadeTo(3000, 500).slideUp(500, function(){
				$(".flyover").alert('close');
			});


            // Used to detect initial (useless) popstate.
            // If history.state exists, pushState() has created the current entry so we can
            // assume browser isn't going to fire initial popstate
            var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;

            var content = $('#utamaOrder');

            var ajaxLoadPage = function (url) {
                // console.log('Loading ' + url);
                content.load(url);
            }

            var delay = (function(){
            	var timer = 0;
            	return function(callback, ms){
            		clearTimeout (timer);
            		timer = setTimeout(callback, ms);
            	};
            })();

            function back_to_top() {
            	$("html, body").animate({ scrollTop: 0 }, 2000);
            }

            // Handle click event of all links with href not starting with http, https or #
            $('#pagee a').on('click', function(e){
            	e.preventDefault();
            	var href = $(this).attr('href');
            	ajaxLoadPage(href);
            	history.pushState({page:href}, null, href);
            	back_to_top();
            });

            $("input#cari").bind("keyup", function(e) {
            	var search_string = $(this).val();
            	var href = $( '#myForm' ).attr( 'action' ) + '?cari=' + encodeURIComponent(search_string);

            	delay(function(){
            		ajaxLoadPage(href);
            		history.pushState({page:href}, null, href);
            	}, 1000 );

            });

            $(window).bind('popstate', function(event){

                // Ignore inital popstate that some browsers fire on page load
                var initialPop = !popped && location.href == initialURL;
                popped = true;
                if (initialPop) return;

                console.log('Popstate');

                // By the time popstate has fired, location.pathname has been changed
                ajaxLoadPage(location.pathname);

            });
        });

})(jQuery);
</script>