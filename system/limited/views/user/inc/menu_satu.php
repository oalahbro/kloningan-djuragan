<?php if($juragan > 0) { 
	$jur = $juragan;
}
else {
	$jur = '';
} ?>

<div class="content-head">
	<!-- start .page-title -->
	<div class="page-header">
		<h2><?php echo show_header($halaman, $juragan) ?></h2>
	</div> 
	<!-- end .page-title -->
	<div class="row menu-table">
		<div class="col-sm-8">
			<div class="">
				<ul class="nav nav-pills">
					<li role="presentation"<?php if($halaman === 'semua') { echo ' class="active"';}?>><?php echo anchor('user?pg=semua', '<i class="glyphicon glyphicon-th-large"></i> Semua'); ?></li>
					<li role="presentation"<?php if($halaman === 'terkirim') { echo ' class="active"';}?>><?php echo anchor('user?pg=terkirim', '<i class="glyphicon glyphicon-ok"></i> Terkirim'); ?></li>
					<li role="presentation"<?php if($halaman === 'pending') { echo ' class="active"';}?>><?php echo anchor('user?pg=pending', '<i class="glyphicon glyphicon-refresh"></i> Pending'); ?></li>
					<?php if($juragan > 0) { ?>
					<li role="presentation"<?php if($halaman === 'tambah') { echo ' class="active"';}?>><?php echo anchor('user/tambah/', '<i class="glyphicon glyphicon-plus"></i> Tambah'); ?></li>
					<?php } ?>
					<?php if(punya_member($juragan)) { ?>
					<li role="presentation"<?php if($halaman === 'tambah_member') { echo ' class="active"';}?>><?php echo anchor('user/tambah_member/', '<i class="glyphicon glyphicon-plus"></i> Tambah Pesanan Member'); ?></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="">
				<div class="search_">
					<form name="form">
						<div class="input-group">
							<?php echo form_input(array('name' => 'name','autocomplete' => 'off', 'data-date-format' => 'YYYY-MM-DD', 'id' => 'fn', 'class' => 'form-control dates', 'placeholder' => 'pencarian data')) ?>
							<div class="input-group-btn">
								<?php echo form_button(array('type'=> 'submit','id' => 'search-btn', 'class' => 'btn btn-primary', 'content' => '<i class="glyphicon glyphicon-search"></i>')) ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>