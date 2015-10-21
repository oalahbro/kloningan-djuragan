<div class="container-fluid">
  <!-- start .page-content -->
  <div class="page-content">
    <?php echo $this->load->view('user/inc/menu_satu'); ?>

    <div class="content-inti" id="reload">  
      <div class="" id="load"></div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="well">
            <div class="panel panel-danger">
              <?php 
              if ($pesanan->num_rows() > 0)
              {
                $row = $pesanan->row(); 

                $atribut_form = array('class' => 'form-horizontal', 'id' => 'form');
                $hidden_form = array('id' => $row->id, 'url' => uri_string(current_url()));
                echo form_open_multipart('', $atribut_form, $hidden_form); ?>
                <div class="panel-body">

                  <!-- field nama -->
                  <div class="form-group <?php // if( ! empty(form_error('nama'))) {echo 'has-error';} ?>">
                    <label for="nama">Nama</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <?php echo form_input(array( 'value' => $row->nama, 'name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama')); ?>
                      </div>
                    </div>
                  </div>

                  <!-- field alamat -->
                  <div class="form-group <?php // if( ! empty(form_error('alamat'))) {echo 'has-error';} ?>">
                    <label for="alamat">Alamat</label>
                    <div class="row">
                      <div class="col-sm-8">
                        <?php echo form_textarea(array( 'value' => $row->alamat, 'name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '4')); ?>
                      </div>
                    </div>
                  </div>

                  <!-- field hape -->
                  <div class="form-group <?php // if( ! empty(form_error('hp'))) {echo 'has-error';} ?>">
                    <label for="hp">HP</label>
                    <div class="row">
                      <div class="col-sm-3">
                        <?php echo form_input(array('value' => $row->hp, 'name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'required' => '', 'placeholder' => 'hp')); ?>
                      </div>
                    </div>
                  </div>

                  <!-- kode / size / jumlah -->
                  <div class="form-group">
                    <label for="exampleInputFile">Kode / Ukuran / Jumlah</label>
                    <?php 
                    $s = explode('#', $row->pesanan);
                    $ukuran = array_map('trim',explode("#", $row->pesanan));
                    $jumlah_array = count($ukuran);
                    $mines_one = $jumlah_array-1;

                    for ($i = 0; $i <  $jumlah_array; $i++) {
                      $data = array_map('trim',explode(",",$s[$i]));
                      ?>
                    <div id="entry" class="row entry multiple-form-group">
                      <div class="col-sm-4">
                        <div class="input-group <?php // if( ! empty(form_error('kode[]'))) {echo 'has-error';} ?>">
                          <span class="input-group-addon">KODE</span>
                          <?php echo form_input(array('value' => strtoupper($data[0]),'class' => 'form-control kode', 'required' => '', 'name' => 'kode[]', 'placeholder' => 'kode produk')) ?>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-group <?php // if( ! empty(form_error('size[]'))) {echo 'has-error';} ?>">
                          <span class="input-group-addon">UKURAN</span>
                          <select name="size[]" class="form-control">
                            <option disabled="">-- size --</option>
                            <?php $query = $this->produk_model->get_size()->result();
                            foreach ($query as $size) { ?>
                            <option value="<?php echo $size->size; ?>" <?php if($data[1] === $size->size) { echo 'selected=""'; } ?>><?php echo $size->size; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="input-group <?php // if( ! empty(form_error('jumlah[]'))) {echo 'has-error';} ?>">
                          <span class="input-group-addon">JUMLAH</span>
                          <?php echo form_input(array('value' => strtoupper($data[2]), 'class' => 'form-control', 'required' => '', 'name' => 'jumlah[]', 'placeholder' => '1', 'type' => 'number', 'min' => '1')) ?>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <?php if($i !== $mines_one) { ?>
                        <span class="input-group-btn">
                          <button class="btn btn-block btn-danger btn-remove" type="button">
                            <span class="glyphicon glyphicon-minus"></span>
                          </button>
                        </span>
                        <?php } else { ?>
                        <span class="input-group-btn">
                          <button class="btn btn-success btn-block btn-add" type="button">
                            <span class="glyphicon glyphicon-plus"></span>
                          </button>
                        </span>
                        <?php } ?>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

                  <!-- field harga -->
                  <div class="form-group <?php // if( ! empty(form_error('harga'))) {echo 'has-error';} ?>">
                    <label for="harga">Harga Barang</label>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="input-group">
                          <span class="input-group-addon">Rp</span>
                          <?php echo form_input(array('value' => $row->harga, 'name' => 'harga', 'id' => 'harga', 'class' => 'form-control', 'required' => '', 'placeholder' => 'harga')); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- field ongkir -->
                  <div class="form-group <?php // if( ! empty(form_error('ongkir'))) {echo 'has-error';} ?>">
                    <label for="ongkir">Ongkir</label>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="input-group">
                          <span class="input-group-addon">Rp</span>
                          <?php echo form_input(array('value' => $row->ongkir, 'name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'required' => '', 'placeholder' => 'ongkir')); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- field transfer -->
                  <div class="form-group <?php // if( ! empty(form_error('transfer'))) {echo 'has-error';} ?>">
                    <label for="transfer">Total Transfer</label>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="input-group">
                          <span class="input-group-addon">Rp</span>
                          <?php echo form_input(array('value' => $row->transfer,'name' => 'transfer', 'id' => 'transfer', 'class' => 'form-control', 'required' => '', 'placeholder' => 'transfer')); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- field transfer -->
                  <div class="form-group <?php // if( ! empty(form_error('status'))) {echo 'has-error';} ?>">
                    <label for="orderStatus">Status Pembayaran</label>
                    <div class="radio">
                      <label>
                        <input required="" <?php if($row->status === 'Lunas') { echo 'checked=""'; } ?> id="orderStatus2" value="Lunas" type="radio" name="status">
                        <span class="label label-success">Lunas</span>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input required="" <?php if($row->status === 'DP') { echo 'checked=""'; } ?> id="orderStatus1" value="DP" type="radio" name="status">
                        <span class="label label-warning">DP</span> <small><em>--down payment--</em></small>
                      </label>
                    </div>
                  </div>

                  <!-- field bank -->
                  <div class="form-group <?php // if( ! empty(form_error('bank'))) {echo 'has-error';} ?>">
                    <div class="row">
                      <div class="col-sm-2"> 
                        <label for="bank">BANK</label>
                        <?php echo form_input(array('value' => $row->bank, 'name' => 'bank', 'id' => 'bank', 'class' => 'form-control', 'required' => '', 'placeholder' => 'bank')); ?>
                      </div>
                    </div>
                  </div>

                  <!-- field keterangan -->
                  <div class="form-group <?php // if( ! empty(form_error('keterangan'))) {echo 'has-error';} ?>">
                    <label for="keterangan">Keterangan</label>
                    <div class="row">
                      <div class="col-sm-6"> 
                        <?php echo form_textarea(array('value' => str_replace('<br />', '', $row->keterangan), 'name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => '4')); ?>
                      </div>
                    </div>
                  </div>

                  <!-- custom gambar -->
                  <div class="form-group">
                    <label for="customGambar">Custom Gambar</label>
                    <div class="input-group">
                      <input disabled="" id="customGambar" name="image" type="file">
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                  <button type="submit" class="btn btn-primary"> Simpan </button>
                </div>
                <?php echo form_close(); ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end .page-content -->
  </div>