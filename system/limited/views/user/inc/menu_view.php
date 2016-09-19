<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('', title('name') . '<sup class="text-danger"><small>v'. title('ver') .'</small></sup>', array('class' => 'navbar-brand')) ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <div id="menus">
        <?php 
        $pending_kirim = get_count(data_session('id'), 'kirim', 'Pending');
        $pending_transfer = get_count(data_session('id'), 'transfer', 'Belum');

        $total_pending = $pending_kirim + $pending_transfer;
        if($total_pending > 0)
        {
          $pendingan = $total_pending;
        }
        else
        {
          $pendingan = '0';
        }

        if($pending_kirim > 0)
        {
          $kiriman = $pending_kirim;
        }
        else
        {
          $kiriman = '0';
        }
        if($pending_transfer > 0)
        {
          $transferan = $pending_transfer;
        }
        else
        {
          $transferan = '0';
        }

        ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> Daftar Pesanan <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><?php echo anchor('user?pg=semua', 'Semua'); ?></li>
              <li><?php echo anchor('user?pg=terkirim', 'Terkirim'); ?></li>
              <li><?php echo anchor('user?pg=pending', 'Pending'); ?></li>
            </ul>
          </li>
          <li><?php echo anchor('user/tambah', '<i class="glyphicon glyphicon-plus"></i> Tambah Pesanan'); ?></li>
          <li><?php echo anchor('user/status', '<i class="glyphicon glyphicon-sort-by-order"></i> Status'); ?></li>
          <li><?php echo anchor('user/stock', '<i class="glyphicon glyphicon-compressed"></i> Stock' ) ?></li>
          <?php if(punya_member(data_session('id'))) { ?>
          <li><?php echo anchor('user/membership', '<i class="glyphicon glyphicon-star"></i> Membership' ) ?></li>
          <?php } ?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bullhorn"></i> Notifikasi <span class="label label-danger"><?php echo $pendingan ?></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><?php echo anchor('user?pg=pending', '<span class="label label-danger">'. $kiriman .'</span> total kiriman pending') ?></li>
              <li><?php echo anchor('user?pg=pending', '<span class="label label-danger">'. $transferan .'</span> total belum transfer') ?></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo data_session('nama'); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!-- <li><?php echo anchor('', 'Ubah Password'); ?></li>
              <li class="divider"></li> -->
              <li><?php echo anchor('logout', 'Logout') ?></li>
            </ul>
          </li>
          
        </ul>
      </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>