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
			<?php
            if ($notif->num_rows() > 0) {
            
                echo '<ul class="list-group">';
                    foreach ($notif->result() as $notifikasi) {
                        $url = site_url('admin/notifikasi/read/' . $notifikasi->id_notifikasi . '_' .  $notifikasi->tanggal);
                        
                        $nama = $this->pengguna->_nama_pengguna($notifikasi->dari);

                        switch ($notifikasi->type) {
                            case '2':
                                # tambah biaya pembayaran
                                $status = 'menambah data pembayaran';
                                break;
                            
                            default:
                                # membuat pesanan baru
                                $status = 'membuat pesanan';
                                break;
                        }
                        
                        echo '<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="notif-'.$notifikasi->id_notifikasi.'" data-id="'.$notifikasi->id_notifikasi.'" data-baca="'.$notifikasi->dibaca.'">';
                            echo '<div><span class="text-muted d-inline-block mr-3">'. mdate('%d-%m-%Y %H:%i:%s', $notifikasi->tanggal) .'</span>';
                            echo '<a href="'.$url.'" class="text-decoration-none inf text-dark d-inline-block '.($notifikasi->dibaca === '0'? 'font-weight-bold':'').'">';
                                echo '<p class="mb-0"><span class="text-primary">'.$nama.'</span> '.$status.' <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span></p>';
                            echo '</a></div>';
                            echo '<div class="dropdown"><button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  id="mm-'.$notifikasi->id_notifikasi.'" class="btn btn-link btn-sm"><i class="fas fa-chevron-down"></i></button>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mm-'.$notifikasi->id_notifikasi.'">
                            <a class="dropdown-item toggleNotif" href="#!">'.($notifikasi->dibaca === '0'? 'Tandai sudah dilihat':'Tandai belum dilihat').'</a>
                            <a class="dropdown-item hapusNotif" href="#!">Hapus</a>
                            </div>
                        </div>';
                        echo '</li>';
                    }
                echo '</ul>';
            }
            else {
                echo '<div class="alert alert-success" role="alert">Tidak ada notifikasi</div>';
            }
            ?>
		</div>
        <?php echo $this->pagination->create_links(); ?>
	</div>

<script>
$(function () {
    $(document).on("click", ".hapusNotif", function(e){
        e.preventDefault();
        var $div = $(e.target).closest( "li" );
        var action = "<?php echo site_url('admin/notifikasi/hapus'); ?>";
        var id = $div.attr('data-id');
        
        $.post(action,
        {
            id_notifikasi: id,
        },
        function(data, status){
            if(data.del) {
                $('#notif-'+id).remove();
            }
        });
    });

    $(document).on("click", ".toggleNotif", function(e){
        e.preventDefault();
        var $div = $(e.target).closest( "li" );
        var action = "<?php echo site_url('admin/notifikasi/toggle'); ?>";
        var id = $div.attr('data-id');
        var baca = $div.attr('data-baca');
        
        $.post(action, {
            id_notifikasi: id,
            baca: baca
        },
        function(data, status){
            $('#notif-'+id+ ' .inf').toggleClass( "font-weight-bold" );
            $('#notif-'+id+ ' .toggleNotif').text(data.text);
            $('#notif-'+id).attr('data-baca', data.baca);
        });
    });
});
</script>