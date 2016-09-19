<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); ?>
		
		<div class="content-inti row" id="">
			<div class="col-xs-12">
				<h3>Daftar Member <?php echo $nama_juragan; ?></h3>
				<div>
					<?php echo anchor('administrator/tambah_membership/' . $juragan, 'tambah member', array('class' => 'btn btn-success manual')); ?>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Terdaftar</th>
							<th>User ID</th>
							<th>Nama</th>
							<th>HP</th>
							<th>ALamat</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($membership->result() as $member) { ?>
								<tr>
									<td><?php echo $member->tanggal_daftar; ?></td>
									<td><?php echo $member->user_card; ?></td>
									<td><?php echo $member->nama_member; ?></td>
									<td><?php echo $member->hp; ?></td>
									<td><?php echo $member->alamat; ?></td>
								</tr>
							<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
