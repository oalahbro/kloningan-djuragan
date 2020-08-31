
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php if ($user->num_rows() > 0)
			{
			   foreach ($user->result() as $row)
			   {?>
			<?php echo form_open('user/simpan_member', '', array('id' => $row->id)) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Member <?php echo $row->nama; ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="user_card">Kode Member</label>
					<?php echo form_input(array('readonly' => 'readonly', 'name' => 'user_card', 'value' => strtoupper($user_card), 'id' => 'user_card', 'class' => 'form-control', 'placeholder' => 'kode member')) ?>
				</div>
				<div class="form-group">
					<label for="nama">Nama Member</label>
					<?php echo form_input(array('name' => 'nama' , 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'nama member')) ?>
				</div>
				<div class="form-group">
					<label for="hp">HP</label>
					<?php echo form_input(array('name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'placeholder' => '08xxxxxxxxxx')) ?>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<?php echo form_textarea(array('rows' => '3', 'name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'placeholder' => 'alamat')) ?>
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-remove"></i>', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')).
					form_button(array('content' => '<i class="glyphicon glyphicon-ok"></i> Simpan', 'class' => 'btn btn-primary', 'type' => 'submit'));
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
