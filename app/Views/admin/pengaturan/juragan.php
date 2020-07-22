<?php
use CodeIgniter\I18n\Time;
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

    <h1 class="h3 mt-5">Semua Juragan</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
            <li class="breadcrumb-item active" aria-current="page">Juragan</li>
        </ol>
    </nav>

    <div class="row">
    	<div class="col-sm-8">
    		<div class="card">
    			<div class="card-body">
    				<div class="table-responsive">
	    				<table class="table">
    						<thead>
    							<tr>
    								<th>Juragan</th>
    							</tr>
    						</thead>
    						<tbody>
    							<tr>
    								<td>
    									<div class="lead">Limitedshoping</div>
    									<div class="">
    										<a href="" class="text-decoration-none mr-1 text-decoraion-none"><i class="fad fa-file-search"></i> lihat orderan</a>
    										<a href="" class="text-decoration-none mr-1 text-decoraion-none"><i class="fad fa-pencil"></i> sunting</a>
    										<a href="" class="text-decoration-none mr-1 text-decoraion-none"><i class="fad fa-trash"></i> hapus</a>
    									</div>
    								</td>
    							</tr>
    						</tbody>
    						
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-sm-4">
    		<div class="card">
    			<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Tambah</span>
						</li>
					</ul>
				</div>
    			<div class="card-body">
    				<div class="mb-3">
						<?= form_label('Nama Juragan', 'nama_juragan', ['class' => 'form-label']); ?>
						<?= form_input('nama_juragan', '', ['class' => 'form-control', 'id' => 'nama_juragan', 'required' => '']); ?>
					</div>
					<div class="mb-3">
						<?= form_label('Rekening Bank', 'rekening', ['class' => 'form-label']); ?>
						<select name="juragan_id" id="juragan_id" class="form-select" required="">
							<option value="" selected="selected">Pilih Juragan</option>
							<option value="3">Blazer Jaket</option>
							<option value="29">Custom Juragan</option>
							<option value="32">Dayat</option>
							<option value="21">DistroKorea.com</option>
							<option value="10">Fashion Cowok</option>
							<option value="2">Fashion Lelaki</option>
							<option value="13">Indonesia Shop</option>
							<option value="23">Jaket Anime</option>
							<option value="4">Jaket Korean</option>
							<option value="18">Joker</option>
							<option value="11">Juragan Jaket</option>
							<option value="27">Juragan Jaket 2</option>
							<option value="8">Korea Hunter</option>
							<option value="9">Limited Shoping</option>
							<option value="15">No Rules</option>
							<option value="1">RA</option>
							<option value="30">Reseller</option>
							<option value="24">Reseller Nine</option>
							<option value="19">SayCleo</option>
							<option value="12">Seven Domu</option>
							<option value="33">Suit Men tailor</option>
						</select>
					</div>
					<hr/>
					<div class="mb-3">
						<button class="btn btn-primary btn-block"><i class="fad fa-save"></i> Tambahkan</button>
					</div>
    			</div>
    		</div>
    	</div>
    </div>

</div>

<?php /*
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
								<th>Dibuat</th>
								<th>Diubah</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($jrgn as $juragan) {
							$dibuat = Time::createFromTimestamp($juragan->jrgn_dibuat);
							$diubah = Time::createFromTimestamp($juragan->jrgn_diubah);
							?>
							<tr>
								<td>
									<?= $juragan->nama_jrgn; ?><br/>
									<ul class="list-inline small mb-0">
										<li class="list-inline-item"><a class="" href="">Lihat</a></li>
										<li class="list-inline-item"><?= anchor('juragan#!', 'Sunting', ['data-toggle' => 'modal', 'data-target' => '#editJuragan','data-whatever' => $juragan->nama_jrgn, 'data-id' => $juragan->id_jrgn]); ?></li>
										<li class="list-inline-item"><a class="text-danger" href="">Hapus</a></li>
									</ul>
								</td>
								<td><?= $dibuat->toDateTimeString(); ?></td>
								<td><?= $diubah->toDateTimeString(); ?></td>
							</tr>	
							<?php } ?>

						</tbody>
					</table>
				</div>
				<?= $pager->links('juragan', 'front_full'); ?>
			</div>
		</div>
		<div class="side col-sm-4">

			<div class="modal fade" id="editJuragan" tabindex="-1" role="dialog" aria-labelledby="editJuraganLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editJuraganLabel">Sunting </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?= form_open('juragan/sunting', ['class' => ''], ['id' => '']); ?>
								<div class="form-group">
									<?php 
									echo form_label('Nama Juragan', 'nama');
									echo form_input('nama', set_value('nama'), ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'nama juragan', 'required' => '']);
									?>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</div>

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
*/ ?>

<?= $this->endSection() ?>