
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php if ($user->num_rows() > 0)
			{
			   foreach ($user->result() as $row)
			   {?>
			<?php echo form_open('administrator/simpan_juragan', '', array('id' => $row->id)) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit <?php echo $row->nama; ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="nama">Nama Juragan</label>
					<?php echo form_input(array('name' => 'nama', 'value' => $row->nama , 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'nama juragan', 'maxlength' => '100')) ?>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<?php echo form_input(array('name' => 'username', 'disabled' => '', 'value' => $row->username , 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'username', 'maxlength' => '60')) ?>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<?php echo form_password(array('name' => 'password', 'value' => '' , 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'maxlength' => '100')) ?>
				</div>
				<div class="form-group">
					<label for="password_2">Ulangi Password</label>
					<?php echo form_password(array('name' => 'password_2', 'value' => '' , 'id' => 'password_2', 'class' => 'form-control', 'placeholder' => 'ulangi password', 'maxlength' => '100')) ?>
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-remove"></i>', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')).
									 form_button(array('content' => '<i class="glyphicon glyphicon-ok"></i> Ubah', 'class' => 'btn btn-primary', 'type' => 'submit'));
				?>
			</div>
			<?php }
			} ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#myModal').modal({
		'show' : true
	});

</script>
