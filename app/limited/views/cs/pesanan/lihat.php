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
<div class="content">
	<div class="" id="utamaOrder">
		<div class="jumbotron jumbotron-fluid mb-3 pb-0 ">
			<div class="container-fluid">
				<h1><?php echo $judul; ?> <span class="font-weight-light"><?php echo $nama_juragan; ?></span></h1>
				
				<ul class="nav nav-tabs mt-5">
					<li class="nav-item">
						<?php echo anchor( 'kardusin/' . $juragan . '/all', 'Semua', array('class' => 'nav-link' . ($status === 'all' ? ' active':''))); ?>
					</li>
					<li class="nav-item">
						<?php echo anchor( 'kardusin/' . $juragan . '/pending', 'Pending', array('class' => 'nav-link' . ($status === 'pending' ? ' active':''))); ?>
					</li>
					<li class="nav-item">
						<?php echo anchor( 'kardusin/' . $juragan . '/terkirim', 'Terkirim', array('class' => 'nav-link' . ($status === 'terkirim' ? ' active':''))); ?>
					</li>
				</ul>
			</div>
		</div>
		

	<div class="utama">
		<div class="p-sm-3">
			<div class="row">
				<div class="col-sm-3 d-none d-sm-block mb-2">
					<form class="form-row" method="get">
						<div class="col-2">
							<?php echo form_label('Limit', 'limit', array('class' => 'my-1 float-right')) ?>
						</div>
						<div class="col-4">
							<select class="custom-select" name="limit" id="limit">
								<option value="<?php echo save_url_encode(10); ?>"<?php echo ((int) $limit === 10 ? ' selected=""': ''); ?>>10</option>
								<option value="<?php echo save_url_encode(30); ?>"<?php echo ((int) $limit === 30 ? ' selected=""': ''); ?>>30</option>
								<option value="<?php echo save_url_encode(50); ?>"<?php echo ((int) $limit === 50 ? ' selected=""': ''); ?>>50</option>
								<option value="<?php echo save_url_encode(100); ?>"<?php echo ((int) $limit === 100 ? ' selected=""': ''); ?>>100</option>
								<option value="<?php echo save_url_encode(150); ?>"<?php echo ((int) $limit === 150 ? ' selected=""': ''); ?>>150</option>
							</select>
						</div>
						<div class="col">
							<button type="submit" class="btn btn-outline-primary">OK</button>
						</div>
					</form>
				</div>

				<div class="col mb-2">
					<?php echo form_open('', array('method' => 'get', 'id' => 'myForm', 'class' => 'form-row float-md-right')); ?>
						<div class="col-8 pl-3">
							<?php 
							echo form_input('cari', $cari, array('class' => 'form-control', 'id' => 'cari', 'placeholder' => 'cari data' )) ?>
						</div>
						<div class="col pr-3">
							<button type="submit" class="btn btn-outline-primary btn-block" id="search-btn">OK</button>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th style="min-width: 160px">Tanggal</th>
							<th>Pemesan</th>
							<th style="min-width: 160px">Pesanan</th>
							<th style="min-width: 170px">Biaya</th>
							<th>Keterangan</th>
							<th>Resi Kirim</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$id_submitted = $this->pengguna->_id($this->session->username);
						if($q->num_rows() > 0) {
							foreach ($q->result() as $key) {
								$detail = json_decode($key->detail);
								$biaya = json_decode($key->biaya);
								$pesanan = $detail->p;
								$slug = save_url_encode($key->slug);
								$slug_edit = save_url_encode($key->id_pesanan);

								$button_sunting = '';
								$button_remove = '';
								$status_transfer = '';

								// lets play with button
								if($key->status_transfer === 'ada' && $key->status_kirim === 'pending') {
									$class_tr = ''; // default
									$class_td = 'table-success';
									
									$button_transfer = '<button class="btn btn-success btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button class="btn btn-secondary btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
								}
								else if($key->status_transfer === 'ada' && $key->status_kirim === 'terkirim') {
									$class_tr = 'table-success'; // default
									$class_td = '';

									$button_transfer = '<button class="btn btn-success btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button class="btn btn-success btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Terkirim</button>';
								}
								else {
									$class_tr = ''; // default
									$class_td = '';
									

									if($id_submitted === $key->oleh) {
										$button_sunting = '<li>' . anchor($juragan . '/sunting?id=' . $slug_edit, 'Sunting'). '</li>';
									}

									if($id_submitted === $key->oleh) {
										$button_remove = '<li>' . anchor($juragan . '/hapus?id=' . $slug_edit, 'Hapus'). '</li>';
									}

									$button_transfer = '<button class="btn btn-secondary btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-remove"></i> Belum</button>';

									$button_Kirim = '<button class="btn btn-secondary btn-sm btn-block" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
								}
								?>
								<tr class="<?php echo $class_tr; ?>">
									<td><?php echo $key->id_pesanan; ?></td>
									<td class="<?php echo $class_td; ?>">
										<abbr title="<?php echo unix_to_human($key->tanggal_submit); ?>"><?php echo mdate('%d-%M-%y', $key->tanggal_submit); ?></abbr>
										<?php echo $button_transfer; ?>
										<?php echo $button_Kirim; ?>
										
										<!-- Single button -->
										<div class="btn-group btn-block">
										<button type="button" class="btn btn-secondary btn-sm dropdown-toggle deropdowen" id="menuD-<?php echo $key->id_pesanan; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Aksi <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" aria-labelledby="menuD-<?php echo $key->id_pesanan; ?>">
												<?php echo $button_sunting; ?>
												<li><?php echo anchor('download?id=' . $slug, 'Download Invoice (PDF)', array('target' => '_blank') ) ?></li>
											</ul>
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
									echo '<hr/><em class="text-info">total: <span class="badge badge-secondary">' . $total_pesanan . '</span> pcs</em>';
									?></td>
									<td>
									<?php
									
									echo '<div class="border border-primary text-center mb-2">' . strtoupper($biaya->b) . '</div>';
									echo '<div class="border text-center mb-2 border-'. ($biaya->s === 'dp'? 'danger': 'success') .'">' . strtoupper($biaya->s) . '</div>';
									echo '<div class="text-right">';
									echo 'harga : <span class="badge badge-info">' . harga($biaya->m->h) . '</span><br/>';
									echo (isset($biaya->m->o) && $biaya->m->o > 0 ? 'ongkir : <span class="badge badge-success">' . harga($biaya->m->o) . '</span>': '<span class="badge badge-success">FREE ONGKIR</span>') . '<br/>';
									echo (isset($biaya->m->of)? 'ongkir fix : <span class="badge badge-warning">' . harga($biaya->m->of) . '</span><br/>' : '');
									echo (isset($biaya->m->d) && $biaya->m->d > 0? 'diskon : <span class="badge badge-secondary">- ' . harga($biaya->m->d) . '</span><br/>' : '');
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
				// $('.deropdowen').dropdown();
				$('[data-toggle="tooltip"]').tooltip()
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