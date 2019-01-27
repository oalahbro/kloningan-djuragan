<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="konten mb-5" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Juragan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$col = array('secondary','primary','success','warning','info','danger','dark','light');

								if($q->num_rows() > 0) {
									$per_page = $this->input->get('halaman');
									if( ! isset($per_page)) {
										$per_page = 0;
									}

									$i = 1 + $per_page;

									foreach ($q->result() as $p) { 
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo anchor('pesanan/' . $p->slug, $p->nama . ' (' . $p->short . ')'); ?></td>
											<td><?php 
												echo anchor('admin/pengaturan/sunting_juragan/' . $p->slug, 'Atur', array('class' => 'btn btn-outline-primary')); 
											?></td>
										</tr>
									<?php 
									$i++;
									}
								}
								else {
									echo '<tr><td colspan="6" class="warning text-center">Tidak ada data</td></tr>';
								}
								?>
							</tbody>
							
						</table>
					</div>
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<div class="col-sm-4">
					<div class="sticky-top pt-5">
						<h4 class="mt-5">Tambah Juragan</h4>
						<?php echo form_open(); ?>
							<div class="form-group">
								<?php 
								echo form_label('Nama Juragan', 'nama');
								echo form_input(array('name' => 'nama',  'maxlength' => '100', 'class' => 'form-control', 'placeholder' => 'nama juragan'));
								?>
							</div>
							<div class="form-group">
								<?php 
								echo form_label('Shortcode', 'short');
								echo form_input(array('name' => 'short', 'maxlength' => '2', 'class' => 'form-control', 'placeholder' => 'shortcode'));
								?>
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
$(document).on("keyup change", 'input[name="nama"]',function(){
	var str = $(this).val();

	var words = $.trim(str).split(" ");
	var matches = str.match(/\b(\w)/g);
	var acronym = matches.join('');

	if(words.length > 1) {
		var short = acronym.slice(0, 2);
	}
	else {
		var short = str.slice(0, 2);
	}

	

	$('input[name="short"]').val(short);

})
</script>