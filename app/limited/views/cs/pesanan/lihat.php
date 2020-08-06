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

	<div class="container-fluid navigasi">
		<ul class="nav nav-tabs">
			<li role="presentation" class="<?php echo ($status === 'all' ? 'active':''); ?>"><?php echo anchor( $juragan . '/pesanan/all', 'Semua'); ?></li>
			<li role="presentation" class="<?php echo ($status === 'pending' ? 'active':''); ?>"><?php echo anchor( $juragan . '/pesanan/pending', 'Pending'); ?></li>
			<li role="presentation" class="<?php echo ($status ==='terkirim' ? 'active':''); ?>"><?php echo anchor( $juragan . '/pesanan/terkirim', 'Terkirim'); ?></li>
			<li role="presentation"><?php echo anchor($juragan . '/tambah', 'Tambah'); ?></li>
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
						<button type="submit" class="btn btn-default">OK</button>
					</form>

				</div>

				<div class="col-sm-3 col-sm-push-6">
					<?php echo form_open('', array('method' => 'get', 'id' => 'myForm', 'class' => 'form-inline')); ?>

						<div class="form-group">
							<?php 

							echo form_input('cari', $cari, array('class' => 'form-control', 'id' => 'cari', 'placeholder' => 'cari data' )) ?>
						</div>
						<button type="submit" class="btn btn-default" id="search-btn">OK</button>
					</form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal</th>
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

								// lets play with button
								if($key->status_transfer === 'ada' && $key->status_kirim === 'pending') {
									$class_tr = ''; // default
									$class_td = 'success';

									$button_transfer = '<button class="btn btn-success btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button class="btn btn-default btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
								}
								else if($key->status_transfer === 'ada' && $key->status_kirim === 'terkirim') {
									$class_tr = 'success'; // default
									$class_td = '';

									$button_transfer = '<button class="btn btn-success btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Ada</button>';

									$button_Kirim = '<button class="btn btn-success btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-ok"></i> Terkirim</button>';
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

									$button_transfer = '<button class="btn btn-default btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-remove"></i> Belum</button>';

									$button_Kirim = '<button class="btn btn-default btn-xs btn-block" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> Pending</button>';
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
										<button type="button" class="btn btn-default btn-xs dropdown-toggle deropdowen" id="menuD-<?php echo $key->id_pesanan; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
									echo '<span class="label label-info">' . strtoupper( $pm->p[0] ) . '</span>' . (isset($pm->p[1]) ? ' <span class="sr-only">/</span> <span class="label label-info">' . $pm->p[1] . '</span>': '' );
									echo '<br/>' . strtoupper( nl2br( $pm->a) );
									?></td>
									<td><?php
									$total_pesanan = 0;
									foreach ($pesanan as $pesan) {
										$total_pesanan = $total_pesanan+$pesan->q;
										echo strtoupper($pesan->c) . ' (' .strtoupper($pesan->s). ') = ' . $pesan->q . 'pcs<br/>';
									}
									echo '<hr/><em class="text-info">total: <span class="label label-default">' . $total_pesanan . '</span> pcs</em>';
									?></td>
									<td>
									<?php
									
									echo '<button class="btn btn-bank btn-block btn-xs">' . strtoupper($biaya->b) . '</button>';
									echo '<button class="btn btn-status btn-block btn-xs '. $biaya->s .'">' . strtoupper($biaya->s) . '</button>';
									echo '<div class="text-right">';
									echo 'harga : <span class="label label-info">' . harga($biaya->m->h) . '</span><br/>';
									echo (isset($biaya->m->o) && $biaya->m->o > 0 ? 'ongkir : <span class="label label-success">' . harga($biaya->m->o) . '</span>': '<span class="label label-success">FREE ONGKIR</span>') . '<br/>';
									echo (isset($biaya->m->of)? 'ongkir fix : <span class="label label-warning">' . harga($biaya->m->of) . '</span><br/>' : '');
									echo (isset($biaya->m->d) && $biaya->m->d > 0? 'diskon : <span class="label label-default">- ' . harga($biaya->m->d) . '</span><br/>' : '');
									echo 'transfer : <span class="label label-danger">' . harga($biaya->m->t) . '</span><br/>';
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
			'<?php echo base_url('assets/js/bootstrap.min.js'); ?>', 
			'<?php echo base_url('assets/js/pace.min.js'); ?>'
			];

			$.getMultiScripts(script_arr).done(function() {
                // all scripts loaded
                $('.deropdowen').dropdown();                
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