<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<?php echo form_open('user/hapus/confirm', '', array('id' => $id, 'jur' => $juragan, 'hal' => $halaman, 'submit' => 'yes')) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Hapus ID-<?php echo $id ?></h4>
			</div>
			<div class="modal-body">
				<div class="well well-sm">
					Hapus data pesanan dengan <u>ID <?php echo $id ?></u>.<br/>Penghapusan tidak dapat dibatalkan.
					<?php // echo uri_string($_SERVER["HTTP_REFERER"]); ?>
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
<script type="text/javascript">
	$('#myModal').modal({
		show: true
	});

</script>