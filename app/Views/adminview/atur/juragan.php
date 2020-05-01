<?php
use CodeIgniter\I18n\Time;
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h3>Atur Juragan</h3>
    </div>
</div>
<div class="px-sm-3">
	<div class="row">
		<div class="main col-sm-8">
			<div class="shadow-sm border rounded rounded-lg">
				<div class="table-responsive p-2">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Juragan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($jrgn as $juragan) { ?>
							<tr>
								<td>
									<?= $juragan['nama_jrgn']; ?><br/>
									<ul class="list-inline small mb-0">
										<li class="list-inline-item"><a class="" href="">Lihat</a></li>
										<li class="list-inline-item"><a class="" href="">Sunting</a></li>
										<li class="list-inline-item"><a class="text-danger" href="">Hapus</a></li>
									</ul>
								</td>
							</tr>	
							<?php } ?>

						</tbody>
					</table>
				</div>
				<?= $pager->links('juragan', 'front_full'); ?>
			</div>
		</div>
		<div class="side col-sm-4">
			<div class="shadow-sm border rounded rounded-lg">
			<?= form_open('juragan/baru', ['class' => 'p-2']); ?>
				<h2 class="h4 font-weight-bold">Tambah Juragan</h2>
				<hr/>
				<div class="form-group">
					<?php 
					echo form_label('Nama Juragan', 'nama');
					echo form_input('nama', set_value('nama'), ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'nama juragan', 'required' => '']);
					?>
				</div>
				<p class="border bg-info rounded rounded-lg p-2 text-light small">Shortcode dibuat otomatis (tidak dapat diedit).<br/>Shortcode digunakan untuk pemberian nomor faktur.</p>
				<button type="submit" class="btn btn-primary">Tambah</button>
			<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
