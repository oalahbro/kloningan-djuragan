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
              <?php $atribut_form = array('class' => 'form-horizontal', 'id' => 'form');
              $hidden_form = array('id' => $juragan, 'url' => uri_string(current_url()));
              echo form_open_multipart('', $atribut_form, $hidden_form); ?>
              <div class="panel-body">

                <!-- field nama -->
                <div class="form-group <?php // if( ! empty(form_error('nama'))) {echo 'has-error';} ?>">
                  <label for="nama">Nama</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <?php echo form_input(array( 'value' => set_value('nama'), 'name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama')); ?>
                    </div>
                  </div>
                </div>

                <!-- field alamat -->
                <div class="form-group <?php // if( ! empty(form_error('alamat'))) {echo 'has-error';} ?>">
                  <label for="alamat">Alamat</label>
                  <div class="row">
                    <div class="col-sm-8">
                      <?php echo form_textarea(array( 'value' => set_value('alamat'), 'name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '4')); ?>
                    </div>
                  </div>
                </div>

                <!-- field hape -->
                <div class="form-group <?php // if( ! empty(form_error('hp'))) {echo 'has-error';} ?>">
                  <label for="hp">HP</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <?php echo form_input(array('value' => set_value('hp'), 'name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'required' => '', 'placeholder' => '08xxxxxxxxxx', 'maxlength' => '14', 'minlength' => '10')); ?>
                    </div>
                  </div>
                </div>

                <!-- kode / ukuran / jumlah -->
                <div class="form-group">
                  <label for="exampleInputFile">Kode / Size</label>
                  <div class="row entry multiple-form-group" id="entry">
                    <div class="col-sm-4">
                      <div class="input-group <?php // if( ! empty(form_error('kode[]'))) {echo 'has-error';} ?>">
                        <span class="input-group-addon">KODE</span>
                        <?php echo form_input(array('autocomplete' => 'off', 'value' => set_value('kode[]'),'class' => 'form-control kode', 'required' => '', 'name' => 'kode[]', 'placeholder' => 'kode produk')) ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group <?php // if( ! empty(form_error('size[]'))) {echo 'has-error';} ?>">
                        <span class="input-group-addon">UKURAN</span>
                        <select required="" name="size[]" class="form-control">
                          <option selected="" disabled="">-- ukuran --</option>
                          <?php $query = $this->produk_model->get_size()->result();
                          foreach ($query as $size) { ?>
                          <option value="<?php echo $size->size; ?>" <?php echo set_select('size[]', $size->size); ?>><?php echo $size->size; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group <?php // if( ! empty(form_error('jumlah[]'))) {echo 'has-error';} ?>">
                        <span class="input-group-addon">JUMLAH</span>
                        <?php echo form_input(array('value' => set_value('jumlah[]'), 'class' => 'form-control', 'required' => '', 'name' => 'jumlah[]', 'placeholder' => '1', 'type' => 'number', 'min' => '1')) ?>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <button class="btn btn-success btn-block btn-add" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- field harga -->
                <div class="form-group <?php // if( ! empty(form_error('harga'))) {echo 'has-error';} ?>">
                  <label for="harga">Harga Barang</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <?php echo form_input(array('value' => set_value('harga'), 'name' => 'harga', 'id' => 'harga', 'class' => 'form-control', 'required' => '', 'placeholder' => '280000')); ?>
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
                        <?php echo form_input(array('value' => set_value('ongkir'), 'name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'required' => '', 'placeholder' => '20000')); ?>
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
                        <?php echo form_input(array('value' => set_value('transfer') ,'name' => 'transfer', 'id' => 'transfer', 'class' => 'form-control', 'required' => '', 'placeholder' => '300000')); ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- field transfer -->
                <div class="form-group <?php // if( ! empty(form_error('status'))) {echo 'has-error';} ?>">
                <label for="orderStatus">Status Pembayaran</label>
                  <div class="radio">
                    <label>
                      <input required="" id="orderStatus2" value="Lunas" type="radio" name="status" <?php echo set_radio('status', 'Lunas'); ?>>
                      <span class="label label-success">Lunas</span>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input required="" id="orderStatus1" value="DP" type="radio" name="status" <?php echo set_radio('status', 'DP'); ?>>
                      <span class="label label-warning">DP</span> <small><em>--down payment--</em></small>
                    </label>
                  </div>
                </div>

                <!-- field bank -->
                <div class="form-group <?php // if( ! empty(form_error('bank'))) {echo 'has-error';} ?>">
                  <label for="bank">BANK</label>
                  <div class="row">
                    <div class="col-sm-2">
                      <?php echo form_input(array('value' => set_value('bank'), 'name' => 'bank', 'id' => 'bank', 'class' => 'form-control', 'required' => '', 'placeholder' => 'bank')); ?>
                    </div>
                  </div>
                </div>

                <!-- field keterangan -->
                <div class="form-group <?php // if( ! empty(form_error('keterangan'))) {echo 'has-error';} ?>">
                  <label for="keterangan">Keterangan</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <?php echo form_textarea(array('value' => set_value('keterangan'), 'name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => '4')); ?>
                    </div>
                  </div>
                </div>

                <!-- custom gambar -->
                <div class="form-group">
                  <label for="customGambar">Custom Gambar</label>
                  <div class="input-group">
                    <input id="customGambar" disabled="" name="image" type="file">
                  </div>
                </div>

              </div>
              <div class="panel-footer">
                <button type="submit" class="btn btn-primary"> Simpan </button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end .page-content -->
</div>    

