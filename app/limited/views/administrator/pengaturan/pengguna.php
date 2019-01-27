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
			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<caption><span class="dot d-inline-block rounded-circle mr-2 border bg-info" style="width: 13px; height: 13px"></span>: belum cek email, <span class="dot d-inline-block rounded-circle mr-2 border bg-danger" style="width: 13px; height: 13px"></span>: diblokir, <span class="dot d-inline-block rounded-circle mr-2 border bg-warning" style="width: 13px; height: 13px"></span>: tidak aktif</caption>
					<thead>
						<tr>
							<th>#</th>
							<th>Terakhir Login</th>
							<th>Nama / Username / Email</th>
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
								$jur = $this->pengguna->get_juragan($p->id)->result();

								$juragan = '';
								foreach ($jur as $a) {
									$slug = $this->juragan->_slug($a->juragan_id);
									$juragan .= anchor('pesanan/' . $slug, '<span class="badge badge-'.random_element($col).'">' . $this->juragan->_nama($a->juragan_id) . '</span>') .' ';
								}

								$tableclass = '';
								if ($p->valid === 'ya') {
									if ( in_array($p->aktif, array('ya','tidak')) && $p->blokir === 'ya') {
										$tableclass = 'table-danger';
									}
									else if ($p->aktif === 'tidak' && $p->blokir === 'tidak') {
										$tableclass = 'table-warning';
									}
								}
								else {
									$tableclass = 'table-info';

								}
								?>
								<tr class="<?php echo $tableclass; ?>">
									<td><?php echo $i; ?></td>
									<td><?php echo mdate('%d-%m-%Y %H:%i:%s', $p->login_terakhir); ?></td>
									<td><?php 
									echo '<span class="font-weight-bold">' . $p->nama . '</span> <em>(' . strtoupper($p->level) . ')</em>';
									echo '<br/><code>' . $p->username . '</code><br/>';
									echo mailto($p->email);
									?></td>
									<td><?php echo $juragan; ?></td>
									<td><?php 
									if($p->username !== $this->session->username) {
										echo anchor('admin/pengaturan/sunting_pengguna/' . $p->id . '____' . $p->username, 'Atur', array('class' => 'btn btn-outline-primary')); 
									}
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
	</div>