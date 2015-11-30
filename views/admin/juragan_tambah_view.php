	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!-- start .page-title -->
				<div class="page-header">
					<h2><i class="glyphicon glyphicon-headphones"></i> <?php echo $judul ?></h2>
				</div>
				<!-- end .page-title -->

				<!-- start .page-content -->
				<div class="page-content">
					<ul class="nav nav-tabs">
						<li role="presentation" <?php echo class_active($halaman, 'home') ?>><?php echo anchor('juragan', '<i class="glyphicon glyphicon-headphones"></i> Semua'); ?></li>
						<li role="presentation" <?php echo class_active($halaman, 'tambah') ?>><?php echo anchor('juragan/tambah', '<i class="glyphicon glyphicon-plus"></i> Tambah'); ?></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<div class="panel panel-default">
										<div class="panel-body">
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!-- end .page-content -->
			</div>
		</div>
	</div> 