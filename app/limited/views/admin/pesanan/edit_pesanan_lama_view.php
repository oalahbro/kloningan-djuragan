<div class="container-fluid">
    <!-- start .page-content -->
    <div class="page-content">
        <?php echo $this->load->view('admin/include/menu_satu'); ?>

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
                            echo form_open_multipart('administrator/update_pesanan_lama', $atribut_form, $hidden_form); ?>
                            <div class="panel-body">

                                <!-- field nama -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <?php echo form_input(array( 'value' => $row->nama, 'name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama')); ?>
                                </div>

                                <!-- field alamat -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <?php echo form_textarea(array( 'value' => $row->alamat, 'name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '4')); ?>
                                </div>

                                <!-- field hape -->
                                <div class="form-group">
                                    <label for="hp">HP</label>
                                    <?php echo form_input(array('value' => $row->hp, 'name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'required' => '', 'placeholder' => 'hp')); ?>
                                </div>

                                <!-- field hape -->
                                <div class="form-group">
                                    <label for="kode">Kode Barang & Size</label>
                                    <?php echo form_input(array('value' => $row->kode, 'name' => 'kode', 'id' => 'kode', 'class' => 'form-control', 'required' => '', 'placeholder' => 'BK-01 (M)')); ?>
                                </div>
                                <!-- field hape -->
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <?php echo form_input(array('value' => $row->jumlah, 'name' => 'jumlah', 'id' => 'jumlah', 'class' => 'form-control', 'required' => '', 'placeholder' => '1')); ?>
                                </div>

                                <!-- field harga -->
                                <div class="form-group">
                                    <label for="harga">Harga Barang</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp</span>
                                        <?php echo form_input(array('value' => $row->harga, 'name' => 'harga', 'id' => 'harga', 'class' => 'form-control', 'required' => '', 'placeholder' => 'harga')); ?>
                                    </div>
                                </div>

                                <!-- field ongkir -->
                                <div class="form-group">
                                    <label for="ongkir">Ongkir</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp</span>
                                        <?php echo form_input(array('value' => $row->ongkir, 'name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'required' => '', 'placeholder' => 'ongkir')); ?>
                                    </div>
                                </div>

                                <!-- field transfer -->
                                <div class="form-group">
                                    <label for="transfer">Total Transfer</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp</span>
                                        <?php echo form_input(array('value' => $row->transfer,'name' => 'transfer', 'id' => 'transfer', 'class' => 'form-control', 'required' => '', 'placeholder' => 'transfer')); ?>
                                    </div>
                                </div>

                                <!-- field transfer -->
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="bank">BANK</label>
                                    <?php echo form_input(array('value' => $row->bank, 'name' => 'bank', 'id' => 'bank', 'class' => 'form-control', 'required' => '', 'placeholder' => 'bank')); ?>
                                </div>

                                <!-- field keterangan -->
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <?php echo form_textarea(array('value' => str_ireplace('<br />', '', $row->keterangan), 'name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => '4')); ?>

                                </div>

                                <!-- custom gambar -->
                                <div class="form-group">
                                    <label for="customGambar">Custom Gambar</label>
                                    <div class="input-group">
                                        <input id="customGambar" name="image" type="file">
                                    </div>
                                </div>


                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary"> Simpan </button>
                            </div>
                            <?php echo form_close(); } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .page-content -->
</div>