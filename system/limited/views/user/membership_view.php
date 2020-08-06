<div class="container-fluid">
  <!-- start .page-content -->
  <div class="page-content">
    <?php echo $this->load->view('user/inc/menu_satu'); ?>

    <div class="content-inti" id="reload">  
      <div>
          <?php echo anchor('user/tambah_membership/' . $juragan, 'tambah member', array('class' => 'btn btn-success manual')); ?>
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
  <!-- end .page-content -->
</div>    

