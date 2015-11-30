
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<?php echo form_open('administrator/hapus_kategori/konfirm/'.$id); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Hapus Kategori</h4>
			</div>
			<div class="modal-body">
			<div class="well">
				Hapus Kategori, semua daftar produk didalamnya juga dihapus ?
			</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i></button>
				<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#myModal').modal({
		'show' : true
	});
</script>
