
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">




	<title>dataTables by mylastof</title>
</head>

<body>
<div class="container-fluid">
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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://localhost/dataTabls-css-for-bootstrap4/dataTables.bootstrap4.js"></script>

<script type='text/javascript'>//<![CDATA[
	window.onload=function(){
		$(document).ready(function() {
	

			$('#example').DataTable({

        		"serverSide": true,
        		"ordering": false,
				"ajax": "<?php echo site_url('json/pesanan'); ?>", //http://localhost/order-juragan/index.php/json/pesanan",
				"fnInitComplete": 
					function() {
					    $("#datatables_wrapper").css("width","60%");
					 },
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
						"render": 
							function ( data, type, full, meta ) {
								var uri = "<?php echo site_url('admin/pesanan'); ?>/";
								return '<a href="'+uri+data.username+'">'+data.nama+'</a>';
							}
					},
					{"data": "tanggal.submit" },
					{
						"data": "pemesan",
						"render": 
							function ( data, type, full, meta ) {
								var nama = '<strong>'+data.nama+'</strong><br/>';
								var hp1 = '<span class="badge badge-info">'+data.hp[0]+'</span>';
								var hp2 = '';
								var alamat = '<br/>'+data.alamat+'';
								if(data.hp[1] != undefined) {
									hp2 = '<span class="sr-only"> / </span><span class="badge badge-info">'+data.hp[1]+'</span>';
								}
								
								return nama+hp1+hp2+alamat;
							}
					},
					{ "data": "biaya.harga" },
					{ "data": "biaya.ongkir" },
					{ "data": "biaya.transfer1"},
					{
				      "data": "uid",
				      "render": function ( data, type, full, meta ) {
							      return '<a class="btn btn-primary" href="'+data+'">Download</a>';
							  }
				    }
				]
			} );
		} );

}//]]> 

</script>
</body>

</html>

