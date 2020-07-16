<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
    <title><?= $title; ?></title>

    <style type="text/css">
      
.dropdown-menu.notify-drop {
  min-width: 330px;
  min-height: 360px;
  max-height: 360px;
}

.dropdown-menu.notify-drop .drop-content {
  min-height: 280px;
  max-height: 280px;
  overflow-y: scroll;
}

#listJuragan {
  z-index: 10000;
  width: 100%;
  height: calc(100% - 50px);
  overflow-y: scroll;
}

#listJuragan a:hover {
  background: rgba(255, 255, 255, .5);
  text-decoration: none;
  color: white !important;
}

.sidebarcollapse {
  top: 0;
  height: 100vh;
  left: -250px;
  width: 250px;
  transition: all 0.4s ease;
  display: block;
  z-index: 10000;
}
.sidebarcollapse.collapsing {
  height: auto !important;
  margin-right: 50%;
  left: -250px;
  transition: all 0.2s ease;
}
.sidebarcollapse.show {
  left: 0;
}

.amplop::before, .amplop::after {
    content: '';
    height: 10px;
    display: block;
    margin-top: -4px;
    margin-left: -4px;
    margin-right: -4px;
    margin-bottom: 5px;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
    background-image: repeating-linear-gradient(135deg, #F29B91 0px, #F09290 15px, transparent 15px, transparent 25px, #83B3DB 25px, #84ADCB 40px, transparent 40px, transparent 50px);
}
.amplop::after {
    margin-top: 5px;
    margin-bottom: -4px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
}

    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div>
            <?php echo anchor('', 'Pesanan Juragan', ['class' => 'navbar-brand']); ?>
            <?php echo form_button(array('class' => 'btn-juragan btn btn-outline-light', 'data-toggle' => "collapse", 'data-target' => "#sidebar", 'id' => 'sidebarCollapse', 'content' => '<i class="fas fa-user-circle"></i>')); ?>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <?= anchor('faktur/baru', 'Tulis Pesanan', ['class'=>'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?php // echo anchor('chart', 'Chart', array('class'=>'nav-link')) ?>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown" id="notif">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-danger counter" id="count">0</span> Notifikasi
                    </a>
 
                    <div class="dropdown-menu dropdown-menu-right notify-drop" aria-labelledby="navbarDropdown">
                        <div class="notify-drop-title border-bottom">
                          <div class="d-flex justify-content-between px-3 pb-2">
                            <div>Notifikasi</div>
                            <div>
                              <!-- action -->
                            </div>
                          </div>
                        </div>
                        <!-- end notify title -->
                        <!-- notify content -->
                        <div class="drop-content">
                          <div class="list-group list-group-flush">
                            
                            <a href="#" class="list-group-item list-group-item-action px-3">
                              <div class="d-flex w-100 justify-content-start">
                                <i class="fas fa-plus-square fa-2x"></i>
                                <div class="ml-sm-2 small">
                                  <div>JS090956895869<br/>oleh Doni</div>
                                  <small class="text-muted">22/12/2019 12:12:12</small>
                                </div>
                              </div>
                              
                            </a>

                            <a href="#" class="list-group-item list-group-item-action px-3">
                              <div class="d-flex w-100 justify-content-start">
                                <i class="fas fa-pen-square fa-2x"></i>
                                 <div class="ml-sm-2 small">
                                  <div>JS090956895869<br/>oleh Doni</div>
                                  <small class="text-muted">22/12/2019 12:12:12</small>
                                </div>
                              </div>
                              
                            </a>
                          </div>
                        </div>
                        <div class="notify-drop-footer border-top pt-2 text-center">
                            <a href=""><i class="far fa-eye"></i> Lihat semua</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pengaturan
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php 
                        echo anchor('juragan', 'Juragan', ['class' => 'dropdown-item']);
                        echo anchor('pengguna', 'Pengguna', ['class' => 'dropdown-item']);
                        // echo anchor('pengaturan/index', 'Sistem', array('class' => 'dropdown-item'));
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['name']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <?= anchor('user/sunting', 'Ubah Profil', array('class' => 'dropdown-item')); ?>
                      <?= anchor('auth/keluar', 'Keluar', array('class' => 'dropdown-item')); ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
    <nav id="sidebar" class="position-fixed bg-dark collapse sidebarcollapse" style="">
        <div class="d-block border-bottom border-secondary shadow">
          <h6 class="dropdown-header py-3">Pilih Juragan</h6>
        </div>

        <div class="sidebar position-relative" id="listJuragan">
            
            <ul class="list-unstyled " id="listLi"></ul>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h3><?= $title ?></h3>

        </div>
    </div>

    <?= $this->renderSection('content') ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
      var popOverSettings = {
        trigger: 'focus',
          placement: 'right',
          container: 'body',
        html: true,
          selector: '[data-toggle="popHarga"]',
        template: '<div class="popover shadow" role="tooltip"><div class="arrow"></div><div class="popover-body"></div></div>'
      }

      $('#editJuragan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var id = button.data('id')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Sunting ' + recipient)
        modal.find('.modal-body input[name="nama"]').val(recipient)
        modal.find('.modal-body input[name="id"]').val(id)
      });

      $('body').popover(popOverSettings);





      $('#sidebar').on('show.bs.collapse', function () {
        var $div = $("<div>", {"class": "modal-backdrop fade show"});
        $("body").toggleClass('modal-open').append($div);

        $div.click(function(){ 
          $('#sidebar').collapse('hide');
          $div.remove();
          $("body").toggleClass('modal-open');
        });
      });


      $(function() {
        // juragan 
        $("#sidebarCollapse").click(function(){
          $('#listLi').html('');
        $.getJSON( "<?= site_url('juragan/get'); ?>", function( data ) {
          var items = [];
          items.push('<li><?= anchor('faktur/index', '<i class="fas fa-users"></i> Semua Juragan', ['class' => 'p-2 d-block text-light']); ?></li>');
          $.each( data, function( i, list ) {
            items.push( '<li><a class="p-2 d-block text-light" href="<?= site_url('faktur/index/') ?>'+list.juragan+'"><i class="fas fa-user-circle"></i> '+list.nama_jrgn+'</li>' );
          });
         
          $( items.join( "" ) ).appendTo( "#listLi" );
        })
        })
      });



    </script>
    <script defer src="https://kit.fontawesome.com/859e035253.js" data-auto-replace-svg="nest" crossorigin="anonymous"></script>

    <!--
    Page rendered in {elapsed_time} seconds
    Environment: <?= ENVIRONMENT ?> 
    -->
</body>
</html>