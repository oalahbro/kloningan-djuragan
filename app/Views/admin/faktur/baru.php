<?php 
use CodeIgniter\I18n\Time;

$sekarang = new Time('now');
?>

<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container">
	<?php echo form_open('', ['class' => 'mb-5']); 
	$r = Time::parse($sekarang);
	echo $r->toDateString() . '<br/>';
	echo Time::parse($r->toDateString() . $r->toTimeString());
	?>

	    <div class="form-row">
	        <div class="form-group col-md-4">
	        	<?php 
	        	echo form_label('Tanggal Pesan', 'tanggal_pesan');
	        	echo form_input('tanggal_pesan', set_value('tanggal_pesan',  $sekarang->toDateString()), ['class' => 'form-control', 'id' => 'tanggal_pesan', 'required' => ''], 'date');
	        	?>
	        </div>
	        <div class="form-group col-md-4">
	            <label for="juragan_id">Juragan</label><select name="juragan_id" id="juragan_id" class="custom-select" required="">
	                <option value="" selected="selected">Pilih Juragan</option>
	                <option value="3">Blazer Jaket</option>
	                <option value="29">Custom Juragan</option>
	                <option value="32">Dayat</option>
	                <option value="21">DistroKorea.com</option>
	                <option value="10">Fashion Cowok</option>
	                <option value="2">Fashion Lelaki</option>
	                <option value="13">Indonesia Shop</option>
	                <option value="23">Jaket Anime</option>
	                <option value="4">Jaket Korean</option>
	                <option value="18">Joker</option>
	                <option value="11">Juragan Jaket</option>
	                <option value="27">Juragan Jaket 2</option>
	                <option value="8">Korea Hunter</option>
	                <option value="9">Limited Shoping</option>
	                <option value="15">No Rules</option>
	                <option value="1">RA</option>
	                <option value="30">Reseller</option>
	                <option value="24">Reseller Nine</option>
	                <option value="19">SayCleo</option>
	                <option value="12">Seven Domu</option>
	                <option value="33">Suit Men tailor</option>
	            </select>
	        </div>
	        <div class="form-group col-md-4">
	            <label for="pengguna_id">CS</label><select name="pengguna_id" id="pengguna_id" class="custom-select" required="">
	                <option value="" selected="selected">Pilih CS</option>
	                <option value="37">Older User</option>
	                <option value="47">Devri Ifa</option>
	                <option value="16">Bela</option>
	                <option value="43">deanindia</option>
	                <option value="17">juraganjaket</option>
	                <option value="20">Dita Crismonika</option>
	                <option value="33">Heri</option>
	                <option value="6">Lelly</option>
	                <option value="14">Nisa</option>
	                <option value="4">Sandra</option>
	                <option value="18">DWIFA</option>
	                <option value="11">Pipit</option>
	            </select>
	        </div>
	    </div>
	    <hr/>

	    <div class="form-row">
	        <div class="form-group col-md-4">
	        	<?php 
	        	echo form_label('Nama', 'nama');
	        	echo form_input('nama', set_value('nama'), ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'nama pelanggan', 'required' => '']);
	        	?>
	        </div>
	    </div>
	    <div class="form-row">
	        <div class="form-group col-sm-4">
	        	<?php 
	        	echo form_label('Hp1', 'hp1');
	        	echo form_input('hp[]', set_value('hp[]'), ['class' => 'form-control', 'id' => 'hp1', 'placeholder' => '08xxxxxxxxx', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'required' => '']);
	        	?>
	        </div>
	        <div class="form-group col-sm-4">
	        	<?php 
	        	echo form_label('Hp2', 'hp2');
	        	echo form_input('hp[]', set_value('hp[]'), ['class' => 'form-control', 'id' => 'hp2', 'placeholder' => '08xxxxxxxxx (opsional)', 'pattern' => '^(0[2-9])[0-9]{8,}$']);
	        	?>
	        </div>
	    </div>

	    <div class="custom-control custom-switch my-3">
			<?php 
			echo form_checkbox('switchAlamat', '', FALSE, array('id' => 'alamatSwitch', 'class' => 'custom-control-input'));
			echo form_label('C.O.D', 'alamatSwitch', array('class' => 'custom-control-label'));
			?>
		</div>

		<div class="form-row collapse show" id="kolomAlamat">
			<div class="col-sm-9">
				<div class="form-group">
					<?php 
					echo form_label('Alamat lengkap', 'nama_jalan');
					echo form_textarea(['name' => 'nama_jalan','id' => 'nama_jalan', 'class' => 'form-control', 'rows' => 2, 'placeholder' => 'alamat: nama jalan, desa dll'])
					?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-row">
					<div class="col-sm-3">
						<div class="form-group">
							<?php 

							$prov = json_decode(file_get_contents(site_url('ongkir/provinsi')));
							$provinsi[''] = 'Pilih Provinsi';

							foreach ($prov as $key) {
								$provinsi[$key->province_id] = $key->province;
							}

							echo form_label('Provinsi', 'provinsi');
							echo form_dropdown('provinsi', $provinsi, '', array('id' => 'provinsi', 'class' => 'custom-select'));
							?>
						</div>
					</div>

					<div class="col-sm-3">				
						<div class="form-group">
							<?php 
							$Kabupaten = array(
								'' => 'Mohon pilih Provinisi dahulu'
							);
							echo form_label('Kota/Kab.', 'kota');
							echo form_dropdown('kota', $Kabupaten, '', array('id' => 'kota', 'class' => 'custom-select'));
							?>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<?php 
							$kecamatan = array(
								'' => 'Mohon pilih Kota/Kab dahulu'
							);
							echo form_label('Kecamatan', 'kecamatan');
							echo form_dropdown('kecamatan', $kecamatan, '', array('id' => 'kecamatan', 'class' => 'custom-select'));
							?>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<?php 
							echo form_label('Kode pos', 'kodepos');
							echo form_input(array('name' => 'kodepos', 'id' => 'kodepos', 'class' => 'form-control', 'placeholder' => '550000'));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

	    <hr/>

	    <div class="form-group" id="ngok">
	        <label for="kode">Produk dipesan</label>
	        <div class="mb-2 cloning-me" id="dup" data-prod="1">
	            <div class="form-row" id="main-form">
	                <div class="col mb-2">
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Kode</span></div>
	                        <input type="text" name="produk[1][kode]" value="" id="kode" class="form-control kode" placeholder="kode" required="required">
	                    </div>
	                </div>
	                <div class="col mb-2">
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Harga @</span></div>
	                        <input type="number" name="produk[1][harga]" value="0" id="harga" class="form-control calc harga" placeholder="250000" pattern="^(?:[1-9]\d*|0)$" required="" min="0">
	                    </div>
	                </div>
	                <div class="col-sm-3 mb-2">
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Ukuran</span></div>
	                        <select name="produk[1][ukuran]" id="ukuran" class="custom-select ukuran" required="">
	                            <option value="" selected="selected">-- pilih ukuran --</option>
	                            <option value="XS">XS</option>
	                            <option value="S">S</option>
	                            <option value="M">M</option>
	                            <option value="L">L</option>
	                            <option value="XL">XL</option>
	                            <option value="XXL">XXL</option>
	                            <option value="XXXL">XXXL</option>
	                            <option value="Custom">Custom</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="col-sm-2 mb-2">
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Jumlah</span></div>
	                        <input type="number" name="produk[1][jumlah]" value="1" id="jumlah" class="form-control calc jumlah" placeholder="1" min="1" pattern="^\d+$" required="">
	                    </div>
	                </div>
	                <div class="col-sm-1 mb-2">
	                    <button type="button" class="btn btn-success btnAdd"><svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
	                        </svg><!-- <i class="fas fa-plus"></i> --></button>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>
	    <div class="row">
	        <div class="col-sm-7 mb-3">
	            <div class="card bg-light">
	                <div class="card-body">
	                    <div class="form-row">
	                        <div class="form-group col-sm-4">
	                            <label for="diskon">Diskon</label><input type="number" name="diskon" value="0" id="diskon" class="form-control diskon calc" min="0" required="">
	                        </div>
	                        <div class="form-group col-sm-4">
	                            <label for="ongkir">Tarif Ongkir</label><input type="number" name="ongkir" value="0" id="ongkir" class="form-control ongkir calc" min="0" required="">
	                        </div>
	                        <div class="form-group col-sm-4">
	                            <label for="unik">3 digit angka unik</label><input type="number" name="unik" value="0" id="unik" class="form-control unik calc" min="0" required="">
	                        </div>
	                    </div>
	                    <small class="text-muted">3 digit angka unik diisi otomatis, dambil dari 3 digit angka hp terakhir, beri angka 0 jika tidak dibutuhkan</small>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-5 mb-3">
	            <h6>Ulasan Biaya</h6>
	            <div class="lead">
	                <div>Total Harga Produk <span class="float-right total_harga_produk">0</span></div>
	                <div>Tarif Ongkir <span class="float-right tarif_ongkir">0</span></div>
	                <div>Angka Unik <span class="float-right angka_unik">0</span></div>
	                <div>Diskon <span class="float-right total_diskon">0</span></div>
	                <div>Biaya Wajib Dibayar <span class="float-right wajib_dibayar">0</span></div>
	            </div>
	        </div>
	    </div>
	    <div class="form-row">
	        <div class="form-group col-sm-5">
	            <label for="marketplace_">Pesanan Marketplace?</label>
	            <div class="input-group ">
	                <div class="input-group-prepend">
	                    <div class="input-group-text">
	                        <input type="checkbox" name="marketplace_" id="marketplace_">
	                    </div>
	                </div>
	                <input type="text" name="marketplace" value="" class="form-control" placeholder="misal: Tokopedia, Shopee, ..." disabled="" required="">
	            </div>
	        </div>
	        <div class="form-group col-sm-3">
	            <label for="status_paket">Status Paket</label> <select name="status_paket" class="custom-select" id="status_paket">
	                <option value="0">Belum Diproses</option>
	                <option value="1">Diproses</option>
	                <option value="2">Dibatalkan</option>
	            </select>
	        </div>
	    </div>
	    <div class="custom-control custom-switch mb-2">
	        <input type="checkbox" name="pembayaran_" value="ya" checked="checked" id="pembayaran_" class="custom-control-input">
	        <label for="pembayaran_" class="custom-control-label">Menunggu pembayaran/pencairan?</label> </div>
	    <div class="card bg-light mb-3 collapse" id="dataPembayaran" style="">
	        <div class="card-body">
	            <div id="multiBayar">
	                <label for="rekening">Data Pembayaran</label>
	                <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="0">
	                    <div class="form-row mb-0 pb-0" id="formTransfer">
	                        <div class="input-group mb-3 col">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Rek?</span>
	                            </div>
	                            <input type="text" name="pembayaran[0][rekening]" value="" id="rekening" class="form-control rekening bankir" placeholder="Cash / Bank" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col-sm-3">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
	                            </div>
	                            <input type="date" name="pembayaran[0][tanggal]" value="2020-04-26" id="tanggal_transfer" class="form-control tanggal_transfer bankir" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Jumlah</span>
	                            </div>
	                            <input type="number" name="pembayaran[0][jumlah]" value="0" id="jumlah_transfer" class="form-control transfer bankir" min="0" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col-sm-3">
	                            <div class="input-group-prepend">
	                                <div class="input-group-text">
	                                    <div class="form-check">
	                                        <input type="checkbox" name="pembayaran[0][sudah_cek]" value="ya" id="sudah_cek-0" class="form-check-input sudah_cek mt-2">
	                                        <label for="sudah_cek-0" class="form-check-label">Ada</label> </div>
	                                </div>
	                            </div>
	                            <input type="date" name="pembayaran[0][cek]" value="" id="tanggal_cek" class="form-control sudah_cek-0 tanggal_cek" disabled="">
	                        </div>
	                        <div class="form-group col-2 col-sm-1">
	                            <button type="button" class="btn btn-success btnAddTransfer bankir" disabled=""><svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
	                                    <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
	                                </svg><!-- <i class="fas fa-plus"></i> --></button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <small class="text-muted">Pembayaran DP / Kredit cukup masukkan dana awal, sisanya nanti dapat diperbarui</small>
	        </div>
	    </div>
	    <div class="custom-control custom-switch mb-2">
	        <input type="checkbox" name="pengiriman_" value="ya" id="pengiriman_" class="custom-control-input" disabled="">
	        <label for="pengiriman_" class="custom-control-label">Sudah dikirim/ diambil?</label> </div>
	    <div class="card bg-light collapse" id="dataPengiriman">
	        <div class="card-body">
	            <div id="multiKirim">
	                <label for="rekening">Data Pengiriman</label>
	                <div class="listPengiriman" id="pengiriman" data-kirim="0">
	                    <div class="form-row mb-0 pb-0" id="formkirim">
	                        <div class="input-group mb-3 col">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Kurir</span>
	                            </div>
	                            <input type="text" name="pengiriman[0][kurir]" value="" id="kurir" class="form-control kurir carry" placeholder="kurir" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col-sm-3">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Resi</span>
	                            </div>
	                            <input type="text" name="pengiriman[0][resi]" value="" id="resi" class="form-control resi carry" placeholder="nomor resi" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Ongkir</span>
	                            </div>
	                            <input type="number" name="pengiriman[0][ongkir]" value="0" id="ongkir_fix" class="form-control transfer carry" min="0" required="" disabled="">
	                        </div>
	                        <div class="input-group mb-3 col-sm-3">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text" id="basic-addon1">Tggl Kirim</span>
	                            </div>
	                            <input type="date" name="pengiriman[0][tanggal_kirim]" value="2020-04-26" id="tanggal_kirim" class="form-control tanggal_kirim carry" required="" disabled="">
	                        </div>
	                        <div class="form-group col-2 col-sm-1">
	                            <button type="button" class="btn btn-success btnAddKirim carry"><svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
	                                    <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
	                                </svg><!-- <i class="fas fa-plus"></i> --></button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="custom-control custom-switch mb-2">
	                <input type="checkbox" name="pengiriman_selesai" value="ya" checked="checked" id="pengiriman_selesai" class="custom-control-input" disabled="">
	                <label for="pengiriman_selesai" class="custom-control-label">Sudah dikirim semua?</label> </div>
	        </div>
	    </div>
	    <hr>
	    <div class="form-group">
	        <label for="keterangan">Keterangan</label><textarea name="keterangan" cols="40" rows="3" id="keterangan" class="form-control" placeholder="keterangan tambahan"></textarea>
	    </div>
	    <div class="form-group">
	        <label for="customgambar">Custom Gambar</label>
	        <div class="tombol-picker">
	            <button type="button" class="btn btn-dark" id="DOCS_IMAGES">Pilih / Unggah Gambar</button>
	        </div>
	        <div class="table-responsive">
	            <table class="table table-hover">
	                <tbody id="result"></tbody>
	            </table>
	        </div>
	    </div>
	    <hr>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?= $this->endSection() ?>