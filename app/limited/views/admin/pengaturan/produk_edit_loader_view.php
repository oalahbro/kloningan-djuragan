
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('administrator/simpan_produk');
			$prod = $produk->row(); 
			echo form_hidden('id', $prod->id);
			?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo character_limiter($prod->nama, 40); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="kategori_id">Kategori Produk</label>
					<select name="kategori_id" id="kategori_id" class="form-control">
						<?php foreach ($kategori as $kat) { ?>
						<option <?php if($prod->kategori_id === $kat->id){ echo 'selected=""'; } ?> value="<?php echo $kat->id ?>"><?php echo $kat->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="nama_produk">Nama Produk</label>
					<?php echo form_input(array('name' => 'nama_produk', 'value' => $prod->nama , 'id' => 'nama_produk', 'class' => 'form-control', 'placeholder' => 'nama produk -- max.100', 'maxlength' => '100')) ?>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="kode_produk">Kode Produk</label>
							<?php echo form_input(array('name' => 'kode_produk', 'value' => $prod->kode ,  'id' => 'kode_produk', 'class' => 'form-control', 'placeholder' => 'kode produk -- max.10', 'maxlength' => '10', 'disabled' => 'disabled')) ?>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="form-group">
							<label for="harga_produk">Harga Produk</label>
							<?php echo form_input(array('name' => 'harga_produk', 'value' => $prod->harga,  'id' => 'harga_produk', 'class' => 'form-control', 'placeholder' => 'harga produk -- cukup angka saja tanpa huruf atau tanda apapun', 'maxlength' => '10')) ?>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<?php
				echo form_button(array('content' => '<i class="glyphicon glyphicon-remove"></i>', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) .
					 form_button(array('content' => '<i class="glyphicon glyphicon-ok"></i> Ubah', 'class' => 'btn btn-primary', 'type' => 'submit', 'name' => 'simpan'))
				?>
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
