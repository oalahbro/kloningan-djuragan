<?php
if( ! empty($juragan))
{
	$id_user = '&juragan=' .$juragan;
}
else
{
	$id_user = '';
}




?>

<ul class="nav nav-tabs">
	<li role="presentation" <?php echo class_active($halaman, 'semua') ?>><?php echo anchor('pesanan?pg=semua'.$id_user, '<i class="glyphicon glyphicon-th-large"></i> Semua') ?></li>
	<li role="presentation" <?php echo class_active($halaman, 'terkirim') ?>><?php echo anchor('pesanan?pg=terkirim'.$id_user, '<i class="glyphicon glyphicon-ok"></i> Terkirim') ?></li>
	<li role="presentation" <?php echo class_active($halaman, 'pending') ?>><?php echo anchor('pesanan?pg=pending'.$id_user, '<i class="glyphicon glyphicon-refresh"></i> Pending') ?></li>
	<li role="presentation" <?php echo class_active($halaman, 'tambah') ?>><?php echo anchor('pesanan/tambah?'.$id_user, '<i class="glyphicon glyphicon-plus"></i> Tambah') ?></li>
</ul>