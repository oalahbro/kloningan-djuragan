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
                        $url = site_url('cs/notifikasi/read/' . $notifikasi->id_notifikasi . '_' .  $notifikasi->tanggal);
                        
                        $nama = $this->pengguna->_nama_pengguna($notifikasi->dari);

                        switch ($notifikasi->type) {
                            case '2':
                                $isi = 'Penambahan biaya pembayaran <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span>';
                                $ico = '<i class="fas fa-wallet"></i>';
                                break;
                            
                            case '3':
                                $isi = 'Pembayaran pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dicek masuk/ada';
                                $ico = '<i class="fas fa-box"></i>';
                                break;

                            case '7':
                                $isi = 'Pembayaran pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dicek belum masuk/ada';
                                $ico = '<i class="fas fa-box"></i>';
                                break;
                            
                            case '4':
                                $isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dibatalkan';
                                $ico = '<i class="fas fa-box"></i>';
                                break;

                            case '5':
                                $isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> diproses';
                                $ico = '<i class="fas fa-box"></i>';
                                break;
                            
                            case '6':
                                $isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> belum diproses';
                                $ico = '<i class="fas fa-box"></i>';
                                break;

                            case '8':
                                $isi = 'Pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dikirim/diambil';
                                $ico = '<i class="fas fa-plane-departure"></i>';
                                break;
                            
                            default:
                                # membuat pesanan baru
                                $isi = 'Dibuat pesanan baru <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span>';
                                $ico = '<i class="fas fa-file-signature"></i>';
                                break;
                        }
                        
                        echo '<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="notif-'.$notifikasi->id_notifikasi.'" data-id="'.$notifikasi->id_notifikasi.'" data-baca="'.$notifikasi->dibaca.'">';
                            echo '<div><span class="text-muted d-inline-block mr-3">'. mdate('%d-%m-%Y', $notifikasi->tanggal) .'</span>';
                            echo '<a href="'.$url.'" class="text-decoration-none inf text-dark d-inline-block '.($notifikasi->dibaca === '0'? 'font-weight-bold':'').'">';
                                echo '<p class="mb-0">'.$isi.'</p>';
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
        var action = "<?php echo site_url('cs/notifikasi/hapus'); ?>";
        var id = $div.attr('data-id');
        
        $.post(action,
        {
            id_notifikasi: id,
        },
        function(data, status){
            if(data.del) {
                $('#notif-'+id).remove();
            }
            // console.log(id);
            // $('#main-table').load(document.URL + ' #table-pesanan');
        });
    });

    $(document).on("click", ".toggleNotif", function(e){
        e.preventDefault();
        var $div = $(e.target).closest( "li" );
        var action = "<?php echo site_url('cs/notifikasi/toggle'); ?>";
        var id = $div.attr('data-id');
        var baca = $div.attr('data-baca');
        
        $.post(action, {
            id_notifikasi: id,
            baca: baca
        },
        function(data, status){
            //if(data.toggle) {
                $('#notif-'+id+ ' .inf').toggleClass( "font-weight-bold" );
                $('#notif-'+id+ ' .toggleNotif').text(data.text);
            //}
            // console.log(id);
            // $('#main-table').load(document.URL + ' #table-pesanan');
        });
    });
});
</script>