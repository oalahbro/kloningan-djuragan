<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	#searchclear {
		position: absolute;
		right: 25px;
		top: 10px;
		cursor: pointer;
		color: #ccc;
	}
	#searchclear:hover {
		color: #222;
	}
	.dataTables_filter {
		display: none;
	}
</style>
		<!-- Main content -->
		<main class="main">
			<ol class="breadcrumb" id="tableH">
						<li class="breadcrumb-item">Home</li>
						<?php 
						$i = 0;
						$act = '';
						foreach ($breadcrumb as $key => $value) {
							$i++;
							if($i === count($breadcrumb)) {
								$act = ' active';
							}
							echo '<li class="breadcrumb-item' . $act . '">'.anchor($key, $value).'</li>';
						}
						?>
				</ol>

				<div class="kontener">
					<div class="card">
						<div class="card-block">
							<div class="row">
								<div class="col-sm-2">
									<select name='length_change' id='length_change' class="form-control">
										<option value='5'>5 data</option>
										<option value='25' selected="">25 data</option>
										<option value='50'>50 data</option>
										<option value='75'>75 data</option>
										<option value='100'>100 data</option>
									</select>
								</div>
								<div class="col-sm-3 offset-sm-7">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="cari data" id="myInputTextField">
										<span id="searchclear" class="icon-close"></span>
									</div>
								</div>
							</div>
							<table id="example" class="table table-border table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Juragan</th>
										<th>Tanggal</th>
										<th>Pemesan</th>
										<th>Pesanan</th>
										<th>Biaya</th>
										<th>Keterangan</th>
										<th>Resi</th>
										
									</tr>
								</thead>
							</table>
						</div>
					</div>


				</div>
				<!-- /.conainer-fluid -->
		</main>

		<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="http://localhost/dataTabls-css-for-bootstrap4/dataTables.bootstrap4.js"></script>

	 <script type='text/javascript'>//<![CDATA[
		window.onload=function(){
			$(document).ready(function() {

				var oldStart = 0;
				var oTable = $('#example').DataTable({
					"serverSide": true,
					"ordering": false,
					"ajax": "<?php echo site_url('json/pesanan/' . $juragan . '/' . $status); ?>",
					"columns": [
					{
						"data": "id",
						/*"createdCell": function (td, cellData, rowData, row, col) {
							if ( rowData.tanggal.cek_kirim == null ) {
								$(td).addClass('bg-warning')
							}
						}*/
					},
					{ 
						"data": "juragan",
						"render": function ( data, type, full, meta ) {
							var uri = "<?php echo site_url('admin/pesanan/lihat'); ?>/";
							return '<a href="'+uri+data.username+'">'+data.nama+'</a>';
						}
					},
					{
						"data": "status",
						"render": function ( data, type, full, meta ) {
							var r = data.submit.split(' ');
							var but = '';
							var col = '';
							var drop = '';

							if(data.transfer !== '0' && data.kirim !== '0') {
								// belum dicheck
								but = 'Terkirim';
								col = 'success';
								drop = '<button class="dropdown-item">Edit Resi</button>';
								drop += '<button class="dropdown-item">Batal Kirim</button>';
							}
							else if(data.transfer !== '0' && data.kirim === '0') {
								// transfer cek
								but = 'Pending';
								col = 'warning';
								drop = '<button class="dropdown-item">Batal Transfer</button>';
								drop += '<button class="dropdown-item">Set Kirim</button>';
							}
							else {
								//
								but = 'Belum Cek';
								col = 'danger';
								drop = '<button class="dropdown-item">Transfer Masuk</button>';
							}

							var btn = '<div class="btn-group">' + 
							  '<button type="button" class="btn btn-' + col + '">' + but + '</button>' +
							  '<button type="button" class="btn btn-' + col + ' dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
							    '<span class="sr-only">Toggle Dropdown</span>' +
							  '</button>' +
							  '<div class="dropdown-menu">' +
							    drop +
							    '<div class="dropdown-divider"></div>' +
							    '<button class="dropdown-item">Separated link</button>' +
							  '</div>' + 
							'</div>';
							return '<abbr title="'+ r[1] + ' ' + r[2] +'">' + r[0] + '</abbr>' + btn;
						}
					},
					{
						"data": "pemesan",
						"render": function ( data, type, full, meta ) {
							var nama = '<strong>'+data.nama+'</strong><br/>';
							var hp1 = '<span class="badge badge-info">'+data.hp[0]+'</span>';
							var hp2 = '';
							var alamat = '<br/>'+data.alamat+'';
							if(data.hp[1] != undefined) {
								hp2 = '<span class="sr-only"> / </span><span class="tag tag-info">'+data.hp[1]+'</span>';
							}

							return nama + hp1 + hp2 + alamat;
						}
					},
					{ "data": "biaya.harga" },
					{
						"data": "biaya",
						"render": function (data, type, full, meta) {
							var biaya = '<div>biaya: <span class="badge badge-warning">'+data.harga+'</span></div>';
							var ongkir = '<div>ongkir: <span class="badge badge-success">' +data.ongkir+ '</span></div>';
							var ongkir_fix = '<div>ongkir fix: <span class="badge badge-info">' +data.ongkir_fix+ '</span></div>';
							var dp = '<div>transfer: <span class="badge badge-danger">' +data.transfer1+ '</span></div>';

							if(data.ongkir < 100) {
								ongkir = '<div><span class="badge badge-success">FREE ONGKIR</span></div>';
							}

							if(data.ongkir_fix < 100) {
								ongkir_fix = '';
							}
							return biaya + ongkir + ongkir_fix + dp;
						},
						"width": "15%"
					},
					{ "data": "pesanan.keterangan"},
					{
						"data": "pengiriman",
						"render": function ( data, type, full, meta ) {
							var inf = 'terkirim: ';
							if (data.kurir === 'COD') {
								var inf = 'terambil: ';
							}
							return '<strong>' + data.kurir + '</strong><br/>' + data.resi + '<br/><small><em>' + inf + '<abbr title="' + data.tanggal + '">' + data.tanggal_display + '</abbr></em></small>';
							},
							"width": "12%"
						}
						],
						"bLengthChange": false,
						"pageLength": 25,
						"fnDrawCallback": function (o) {
							if ( o._iDisplayStart != oldStart ) {
								var targetOffset = $('#tableH').offset().top;
								$('html,body').animate({scrollTop: targetOffset}, 500);
								oldStart = o._iDisplayStart;
							}
						}
					});

				$('#searchclear').hide();
				$("#searchclear").click(function(){
					$("#myInputTextField").val('');
					$(this).hide();
					oTable.search('').draw();
				});

				$('#myInputTextField').bind('keyup',function(){
					oTable.search($(this).val()).draw() ;

					if( ! $(this).val()){
						$('#searchclear').hide();
					}
					else {
						$('#searchclear').show();
					}
				});

				$('#length_change').change( function() { 
					oTable.page.len( $(this).val() ).draw();
				});

			} );

		}//]]> 
	</script>
