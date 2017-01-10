<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<footer class="footer">
		<span class="text-left">
			<a href="https://genesisui.com">Alba</a> © 2016 creativeLabs.
		</span>
		<span class="float-xs-right">
			Powered by <a href="https://genesisui.com">GenesisUI</a>
		</span>
	</footer>

	<!-- Bootstrap and necessary plugins -->
	<script src="<?php echo base_url('assets/js/libs/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/libs/tether.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/libs/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/libs/pace.min.js'); ?>"></script>

	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://localhost/dataTabls-css-for-bootstrap4/dataTables.bootstrap4.js"></script>

	<!-- GenesisUI main scripts -->
	<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

	<script type='text/javascript'>//<![CDATA[
		window.onload=function(){
			$(document).ready(function() {

				var oldStart = 0;
				var oTable = $('#example').DataTable({
					"serverSide": true,
					"ordering": false,
					"ajax": "<?php echo site_url('json/pesanan'); ?>",
					"columns": [
						{
							"data": "id",
							"createdCell": function (td, cellData, rowData, row, col) {
								if ( rowData.tanggal.cek_kirim == null ) {
									$(td).addClass('bg-warning')
								}
							}
						},
						{ 
							"data": "juragan",
							"render": function ( data, type, full, meta ) {
								var uri = "<?php echo site_url('admin/pesanan'); ?>/";
								return '<a href="'+uri+data.username+'">'+data.nama+'</a>';
							}
						},
						{
							"data": "tanggal.submit",
							"render": function ( data, type, full, meta ) {
								var r = data.split(' ');
								return '<abbr title="'+ data +'">' + r[0] + '</abbr>';
							}
						},
						{
							"data": "pemesan",
							"render": function ( data, type, full, meta ) {
								var nama = '<strong>'+data.nama+'</strong><br/>';
								var hp1 = '<span class="tag tag-info">'+data.hp[0]+'</span>';
								var hp2 = '';
								var alamat = '<br/>'+data.alamat+'';
								if(data.hp[1] != undefined) {
									hp2 = '<span class="sr-only"> / </span><span class="tag tag-info">'+data.hp[1]+'</span>';
								}

								return nama + hp1 + hp2 + alamat;
							}
						},
						{ "data": "biaya.harga" },
						{ "data": "biaya.ongkir" },
						{ "data": "pesanan.keterangan"},
						{
							"data": "pengiriman",
							"render": function ( data, type, full, meta ) {
								var inf = 'terkirim: ';
								if (data.kurir === 'COD') {
									var inf = 'terambil: ';
								}
								return '<strong>' + data.kurir + '</strong><br/>' + data.resi + '<br/>' + inf + '<abbr title="' + data.tanggal + '">' + data.tanggal + '</abbr>';

								//'<a class="btn btn-primary" href="'+data.resi+'">Download</a>';
							}
						}
					],
					"bLengthChange": false,
					"pageLength": 25,
					"language": {
						"lengthMenu": "Lihat _MENU_ data",
						"zeroRecords": "Data Tidak ditemukan",
						"info": "Hal _PAGE_ dari _PAGES_ (_MAX_ data)",
						"infoEmpty": "Data Tidak ditemukan",
						"infoFiltered": "(difilter dari _MAX_ total data)"
					},
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

</body>
</html>