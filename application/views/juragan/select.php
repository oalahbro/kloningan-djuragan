<div class="container">
	<div class="row">
		<h2>Pilih Akun Juragan</h2>
		<p>pilih yang akan dikelola</p>
		<ul class="ds-btn">
			<?php 
			$row = $auth_list->row();
			$list = explode(',' , $row->allow_id);
			foreach($list as $i =>$key) {

				$username = $this->juragan->ambil_username_by_id($key);
				$nama = $this->juragan->ambil_nama_by_id($key);

				echo '<li>';
				echo anchor('juragan/dasbor/select/' . $key, $nama, array('class' => 'btn btn-lg', 'style' => 'background-color:' . _warna($nama) . ';color:#fff;') );
				echo '</li>';
			} ?>
		</ul>
	</div>
</div>
