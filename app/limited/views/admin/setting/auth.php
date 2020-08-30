<div class="page-header">
	<div class="title-page">
		<div class="container-fluid">
			<h1><?php echo $judul; ?></h1>
		</div>
	</div>

	<div class="subnav">
		<div class="container-fluid">
			<div class="row">
				<div class="menu col-sm-9">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-body">
			<?php echo form_open(); ?>
				<div class="form-group">
					<?php 
					echo form_label('Nama CS', 'nama');
					echo form_input(
						array(
							'name' 	=> 'nama',
							'id' 	=> 'nama',
							'class' => 'form-control',
							'placeholder' 	=> 'nama CS'
							),
						set_value('nama')
						);
					?>
					<span id="helpBlock" class="help-block"><?php echo form_error('nama'); ?></span>
				</div>

<div class="form-group">
<?php 
echo form_label('Juragan yg diijinkan', 'nama');
$array = array(
'small'         => 'Small Shirt',
'med'           => 'Medium Shirt',
'large'         => 'Large Shirt',
'xlarge'        => 'Extra Large Shirt',
);
echo form_multiselect('juragan', $array, '', array('class' => 'form-control'));
?>
</div>




			<?php echo form_close(); ?>
			</div>
		</div>
		<div class="list-group">
			<?php foreach($this->juragan->ambil()->result() as $row) { ?>
			<div class="list-group-item">
				<div class="pull-right">
					<div class="btn-group btn-group-xs" role="group" aria-label="...">
						<?php echo anchor('administrator/edit_juragan/' . $row->user_id, '<i class="glyphicon glyphicon-edit"></i>', array('class' => 'btn btn-default manual', 'id' => 'edit_' . $row->user_id)) ?>
						<?php echo anchor('administrator/hapus_juragan/alert/' . $row->user_id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-danger manual', 'id' => 'hapus_' . $row->user_id)) ?>
					</div>
				</div>
				<?php echo $row->nama ?> - <small><em class="text-muted"><?php echo $row->username ?></em></small>
				<div class=""><i class="glyphicon glyphicon-bullhorn"></i> <?php echo $row->transfer . ' / ' . $row->kirim ?>
				<br/>
				<?php 
				if($row->membership === '1') {
					echo anchor('administrator/membership/' .  $row->username, 'membership', array('class' => 'btn btn-xs btn-warning'));
				}
				?></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
