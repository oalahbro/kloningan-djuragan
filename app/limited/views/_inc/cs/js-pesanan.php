<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
var row = $("#main-table tbody tr"), tanggal_sekarang = "<?php echo mdate('%Y-%m-%d', now()); ?>", spinner = '<div class="text-center"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>', spinner_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...', i = 0, cmd, totalCommands = row.length, uri = "<?php echo site_url(); ?>/";

function loadingData(c, a) {
	if (!(c >= totalCommands)) {
		cmd = row.eq(c);
		var e = $(cmd).attr("id"), b = e.split("-");
		load_juragan("#" + e + " .juragan", b[1], function() {
			c++;
			loadingData(c, function() {
			});
		});
		load_pembayaran("#" + e + " .pesanan", "#" + e + " .status", "#" + e + " .pembayaran", b[1], function() {
			load_tooltips();
		});
		load_keterangan("#" + e + " .keterangan", b[1]);
		a();
	}
}
// run first
loadingData(0, function() {
});

// tooltips
function load_tooltips() {
	$(document).find('[data-toggle="tooltip"]').tooltip();
}

// load "juragan" column
function load_juragan(c, a, e) {
	$.getJSON(uri + "faktur/json_juragan/" + a, function(a) {
		var b = '<a href="'+uri+'faktur/data/' + a.slug + '">' + a.nama + "</a>";
		a = '<hr/><span class="text-muted small">CS: ' + a.nama_cs + "</span>";
		$(c).empty().append(b + a);
		e();
	});
}

// load "status", "pesanan", "pembayaran" column
function load_pembayaran(c, a, e, b, m) {
	$.getJSON(uri + "faktur/json_pembayaran/" + b, function(b) {
		var f = "", v = "", n = "", w = "", x = "", y = "";
		var $stt = false;
		switch (b.status_transfer) {
			case "3": // sudah lunas
			case "4": // lebih
				$stt = false;
				break;
			default:
				$stt = true;
		}

		switch(b.status) {
		case 1:
			var p = "border-warning", q = "Kredit";
			break;
		case 2:
			p = "border-success";
			q = "Lunas";
			break;
		case 3:
			p = "border-primary";
			q = "Kelebihan";
			break;
		case 4:
			p = "border-danger", q = "Belum Lunas";
		}
		p = '<span id="status_pesan" class="d-block text-center border ' + p + ' text-uppercase py-1 font-weight-bold rounded">' + q + "</span>";
		q = '<span class="d-block text-right">harga produk : <span class="badge badge-info">' + b.harga_produk + "</span></span>";
		"undefined" != typeof b.ongkir && (v = '<span class="d-block text-right">tarif ongkir : <span class="badge badge-dark">' + b.ongkir + "</span></span>");
		"undefined" != typeof b.unik && (f = '<span class="d-block text-right">digit unik : <span class="badge badge-secondary">' + b.unik + "</span></span>");
		"undefined" != typeof b.diskon && (n = '<span class="d-block text-right">diskon : <span class="badge badge-warning">-' + b.diskon + "</span></span>");
		var z = '<span class="d-block text-right">wajib bayar : <span class="badge badge-success">' + b.wajib_bayar + "</span></span>";
		"undefined" != typeof b.terbayar && (x = '<span class="d-block text-right">dibayar : <span class="badge badge-danger">' + b.terbayar + "</span></span>");
		var d = '<div class="mn" id="buttoncollect" data-statustransfer="' + b.status_transfer + '" data-kurang="0" data-statuskirim="'+ b.status_kirim +'" data-faktur="' + b.seri_faktur + '" data-id="' + b.id_faktur + '">';
		switch(b.status_transfer) {
		case "3":
			var g = "text-success";
			var k = "fa-check-double";
			var l = "Pembayaran Lunas";
			break;
		case "4":
			g = "text-info";
			k = "fa-plus";
			l = "Pembayaran Lunas & memiliki kelebihan";
			break;
		case "2":
			g = "text-warning";
			k = "fa-ellipsis-h";
			l = "Pembayaran belum lunas";
			break;
		case "1":
			g = "text-primary";
			k = "fa-redo fa-spin";
			l = "Pembayaran ada yang perlu dicek";
			break;
		default:
			g = "text-danger", k = "fa-times", l = "Pembayaran Belum ada";
		}
		d = d + ('<div class="fa-2x d-inline-block ckbyr" data-toggle="tooltip" data-placement="top" title="' + l + '">') + '<span class="fa-layers fa-fw"><i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
		d += '<i class="fas fa-wallet text-secondary" data-fa-transform="shrink-6"></i>';
		d += '<span class="fa-layers fa-fw">';
		d += '<i class="fas fa-circle ' + g + '" data-fa-transform="shrink-8 down-1 right-5"></i>';
		d += '<i class="fas ' + k + ' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
		d += "</span>";
		d += "</span>";
		d += "</div>";
		switch(b.status_paket) {
		case "1":
			g = "text-success";
			var h = "fa-check-double";
			k = "fa-box";
			l = "Pesanan diproses";
			var r = "set_kirim";
			var t = "diproses";
			break;
		case "2":
			g = "text-danger";
			h = "fa-ban";
			k = "fa-box";
			l = "Pesanan dibatalkan";
			r = "set_kirim";
			t = "dibatalkan";
			break;
		default:
			g = "text-warning", h = "fa-times", k = "fa-box-open", l = "Pesanan Belum diproses", r = "set_kirim", t = "belumproses";
		}
		d += '<div class="fa-2x d-inline-block set_paket" data-status="' + t + '" data-toggle="tooltip" data-placement="top" title="' + l + '">';
		d += '<span class="fa-layers fa-fw">';
		d += '<i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
		d += '<i class="fas ' + k + ' text-secondary" data-fa-transform="shrink-6"></i>';
		d += '<span class="fa-layers fa-fw">';
		d += '<i class="fas fa-circle ' + g + '" data-fa-transform="shrink-8 down-1 right-5"></i>';
		d += '<i class="fas ' + h + ' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
		d += "</span>";
		d += "</span>";
		d += "</div>";
		switch(!0) {
		case "2" === b.status_kirim && "2" === b.status_kiriman:
			$c_krm = "text-success";
			$i_krm = "fa-check-double";
			$mi_krm = "fa-plane-departure";
			$t_krm = "Pesanan telah dikirim";
			break;
		case "2" === b.status_kirim && "1" === b.status_kiriman:
			$c_krm = "text-success";
			$i_krm = "fa-check-double";
			$mi_krm = "fa-people-carry";
			$t_krm = "Pesanan diambil";
			break;
		case "1" === b.status_kirim:
			$c_krm = "text-warning";
			$i_krm = "fa-ellipsis-h";
			$mi_krm = "fa-cubes";
			$t_krm = "Pesanan telah dikirim sebagian";
			break;
		default:
			$c_krm = "text-danger", $i_krm = "fa-times", $mi_krm = "fa-cubes", $t_krm = "Pesanan Belum dikirim";
		}

		d += '<div class="fa-2x d-inline-block ' + r + '" data-toggle="tooltip" data-placement="top" title="' + $t_krm + '">';
		d += '<span class="fa-layers fa-fw">';
		d += '<i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
		d += '<i class="fas ' + $mi_krm + ' text-secondary" data-fa-transform="shrink-6"></i>';
		d += '<span class="fa-layers fa-fw">';
		d += '<i class="fas fa-circle ' + $c_krm + '" data-fa-transform="shrink-8 down-1 right-5"></i>';
		d += '<i class="fas ' + $i_krm + ' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
		d += "</span>";
		d += "</span>";
		d += "</div>";
		d += '<div class="dropdown dropright">';
		d += '<button class="btn btn-outline-primary btn-sm btn-block" type="button" id="setting-' + b.id_faktur + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog fa-spin"></i></button>';
		d += '<div class="dropdown-menu"aria-labelledby="setting-' + b.id_faktur + '">';
		d += '<h6 class="dropdown-header">Atur</h6>';
		d += '<button class="ckbyr dropdown-item">Pembayaran</button>';
		d += '<button class="set_paket dropdown-item" data-status="' + t + '">Status Paket</button>';
		d += '<button class="' + r + ' dropdown-item">Pengiriman</button>';
		d += '<div class="dropdown-divider"></div>';
		d += '<h6 class="dropdown-header">Lainnya</h6>';
		d += '<a class="dropdown-item" href="' + uri + 'faktur/pdf/' + b.seri_faktur + '">Unduh PDF</a>';

		if(b.status_paket === '0' && $stt) {
			d += '<a href="' + uri + 'faktur/sunting/' + b.seri_faktur + '" class="dropdown-item">Sunting</a>';
		}
		if(b.status_transfer === '0') {
			d += '<button class="dropdown-item text-danger hapus_pesanan">Hapus</button>';
		}

		d += "</div>";
		d += "</div>";
		d += "</div>";

		"undefined" != typeof b.tipe && (w = '<span class="d-block text-uppercase py-1 text-center text-light font-weight-bold border border-danger bg-danger rounded px-2 mb-1">' + b.tipe + "</span>");
		for (i = 0; i < b.produk.length; i++) {
		y += "<div>" + b.produk[i].c + " (" + b.produk[i].s + ") = " + b.produk[i].q + "pcs <button data-toggle='popHarga' data-content='harga satuan: <strong>"+b.produk[i].h+"</strong><br/>harga total: <strong>"+b.produk[i].t+"</strong>' class='btn-help text-secondary'><i class='fas fa-info-circle'></i></button></div>";
		}
		b = '<hr/><em>total: <span class="badge badge-dark">' + b.total + "</span> pcs</em>";
		$(c).empty().append(w + y + b);
		$(a).empty().append(d);
		$(e).empty().append(p + q + v + f + n + z + x);
		m();		
	});
}

// load "keterangan" column
function load_keterangan(c, a) {
	var e = "", b = "", m = "", f = "", u = "show";
	$.getJSON(uri + "faktur/json_keterangan/" + a, function(a) {
		if ("undefined" !== typeof a.ket || "undefined" !== typeof a.gambar) {
		e = '<button class="btn btn-outline-info dropdown-toggle btn-sm mb-1 mr-1" type="button" data-toggle="collapse" data-target="#collapseKeterangan-' + a.id + '" aria-expanded="false" aria-controls="collapseKeterangan-' + a.id + '"><i class="fas fa-scroll"></i> Keterangan</button>';
		}
		if ("undefined" !== typeof a.pengiriman && 0 < a.pengiriman.length) {
			u = "";
			m = '<button class="btn btn-outline-dark btn-sm dropdown-toggle mb-1" type="button" data-toggle="collapse" data-target="#collapseResi-' + a.id + '" aria-expanded="false" aria-controls="collapseResi-' + a.id + '"><i class="fas fa-receipt"></i> Resi Kirim</button>';
			f = '<div class="collapse show" id="collapseResi-' + a.id + '">';
			f += '<div class="bg-light border border-dark p-1 mt-2 rounded amplop">';
			f += "<h6>Pengiriman : </h6>";
			f += '<ul class="ml-0 pl-3">';
			for (i = 0; i < a.pengiriman.length; i++) {
				f += '<li><span class="font-weight-bold">' + a.pengiriman[i].c + "</span>", f += "<br/>" + a.pengiriman[i].r, null !== a.pengiriman[i].o && (f += '<br/>ongkir: <span class="badge badge-secondary">' + a.pengiriman[i].o + "</span>"), f += '<br/><small class="text-muted">tanggal: ' + a.pengiriman[i].d + "</small>", f += "</li>";
			}
			f += "</ul>";
			f += "</div>";
			f += "</div>";
		}
		if ("undefined" !== typeof a.ket || "undefined" !== typeof a.gambar) {
			b += '<div class="collapse ' + u + '" id="collapseKeterangan-' + a.id + '">';
			"undefined" !== typeof a.ket && (b += '<p class="text-break" style="max-width:200px;">' + a.ket + "</p>");
			if ("undefined" !== typeof a.gambar) {
				b += '<div class="dropdown mt-3">';
				b += '<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="customGambar-' + a.id + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gambar </button>';
				b += '<div class="dropdown-menu" aria-labelledby="customGambar-' + a.id + '">';
				for (var n = 0; n < a.gambar.length; n++) {
				b += '<a class="dropdown-item" target="_blank" href="' + a.gambar[n] + '">Custom Gambar 1</a>';
				}
				b += "</div>";
				b += "</div>";
			}
			b += "</div>";
		}
		$(c).empty().append(e + m + f + b);
	});
}

// load data pembayaran, modal inside
function load_data_pembayaran(c) {
	var a = "";
	$.ajax({type:"GET", url:uri + "faktur/ambil_pembayaran", data:{id:c}, dataType:"json", success:function(e) {
		a += '<div class="pt-3">';
		if (0 === e.length) {
			a += '<p class="alert alert-danger">Tidak ditemukan data pembayaran</p>';
		} else {
			a += '<input name="faktur" type="hidden" value="' + c + '"/>';
			a += '<div id="list_pembayaran" class="list-group">';
			for (i = 0; i < e.length; i++) {
				var b = e[i];
				if (null === b.tanggal_cek) {
					var m = "", f = "times-circle text-danger";
				} else {
					m = "<br/>dicek ada/masuk pada " + b.tanggal_cek, f = "check-circle text-success";
				}
				a += '<div class="list-group-item list-group-item-action">';
				a += '<div class="d-flex justify-content-between">';
				a += '<div class="d-flex w-100 justify-content-start">';
				a += '<div class="mr-3 d-flex align-items-center">';
				a += '<i class="fas fa-' + f + ' fa-2x"></i>';
				a += "</div>";
				a += "<div>";
				a += '<input name="pembayaran[' + b.id + ']" type="hidden" value="tidak"/>';
				a += '<input type="checkbox" name="pembayaran[' + b.id + ']" data-id="' + b.id + '" value="ya" class="d-none sbm" id="check' + i + '" ' + (null === b.tanggal_cek ? "/>" : ' checked=""/>');
				a += '<h5 class="mb-1 text-uppercase">' + b.rekening + ' <span class="badge badge-warning">' + b.jumlah + "</span></h5>";
				a += '<p class="mb-1">dibayar  pada ' + b.tanggal_bayar + m + "</p>";
				a += "</div>";
				a += "</div>";
				if(null === b.tanggal_cek) {
					a += '<div class="dropdown" data-id="' + b.id + '">';
					a += '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mm-' + i + '" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-down"></i></button>';
					a += '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="mm-' + i + '">';
					a += '<button class="dropdown-item suntingBayar">Sunting</button>';
					a += '<button class="dropdown-item hapusBayar">Hapus</button>';
					
					a += "</div>";
					a += "</div>";
				}
				a += "</div>";
				a += "</div>";
			}
			a += "</div>";
		}
		a += "</div>";
		$("#nav-cek-tab").html(a);
	}
	});
}

// load form pembayaran, modal inside 
function load_data_tambahPembayaran(c) {
	c = '<form class="mt-3" method="post" accept-charset="utf-8">' + ('<input name="faktur_id" type="hidden" value="' + c + '"/>') + '<div class="form-row mb-0"><div class="col-6 form-group">';
	c += '<label for="rekening">Tujuan Bayar</label>';
	c += '<input class="form-control" id="rekening" type="text" name="rek" placeholder="mis: cash, mandiri, bca, bni, ..." required="">';
	c += "</div>";
	c += '<div class="col-6 form-group">';
	c += '<label for="tanggal_bayar">Tanggal Bayar</label>';
	c += '<input class="form-control" id="tanggal_bayar" type="date" name="tanggal_bayar" value="' + tanggal_sekarang + '" required="">';
	c += "</div>";
	c += '<div class="col-6 form-group">';
	c += '<label for="nominal">Jumlah Dana</label>';
	c += '<input class="form-control" id="nominal" type="number" min="0" name="nominal" placeholder="mis: 350000" required="">';
	c += "</div>";
	c += "</div>";
	c += '<hr/><button type="button" class="btn btn-primary submitMe">Tambah</button>';
	c += "</form>";
	$("#nav-tambah-tab").html(c);
}

// load form edit pembayaran, modal inside
function load_data_suntingPembayaran(c) {
	var a = "", e = uri + "faktur/detail_pembayaran/" + c;
	$("#nav-sunting-tab").html("");
	
	a += '<form class="mt-3" method="post" accept-charset="utf-8">';
	a += '<input name="id_pembayaran" type="hidden" value=""/>';
	a += '<input name="faktur_id" type="hidden" value=""/>';
	a += '<div class="form-row mb-0">';
	a += '<div class="col-6 form-group">';
	a += '<label for="rekening">Tujuan Bayar</label>';
	a += '<input class="form-control" value="" id="rekening" type="text" name="rek" placeholder="mis: cash, mandiri, bca, bni, ..." required="">';
	a += "</div>";
	a += '<div class="col-6 form-group">';
	a += '<label for="tanggal_bayar">Tanggal Bayar</label>';
	a += '<input class="form-control" id="tanggal_bayar" type="date" name="tanggal_bayar" value="" required="">';
	a += "</div>";
	a += '<div class="col-6 form-group">';
	a += '<label for="nominal">Jumlah Dana</label>';
	a += '<input class="form-control" id="nominal" type="number" min="0" name="nominal" placeholder="mis: 350000" value="" required="">';
	a += "</div>";
	a += "</div>";
	a += '<hr/><button type="button" class="btn btn-primary simpanSuntingBayar">Simpan</button>';
	a += "</form>";
	$("#nav-sunting-tab").html(a);
	
	$.getJSON(e, function(b) {
		$('#nav-sunting-tab [name="id_pembayaran"]').val(c);
		$('#nav-sunting-tab [name="faktur_id"]').val(b.faktur_id);
		$('#nav-sunting-tab [name="rek"]').val(b.rekening);
		$('#nav-sunting-tab [name="tanggal_bayar"]').val(b.tanggal_bayar);
		$('#nav-sunting-tab [name="nominal"]').val(b.jumlah);

		if (b.tanggal_cek !== null) {
			$('#nav-sunting-tab [name="tanggal_cek"]').val(b.tanggal_cek).prop('disabled', false);
			$('#nav-sunting-tab [name="ada_dana"]').prop('checked', true);			
		}
	});
}

// load/launch modal pembayaran 
$(document).on("click", ".ckbyr", function(c) {
	c.preventDefault();
	var a = $(this).closest(".mn");
	c = a.attr("data-id");
	var e = a.attr("data-faktur");
	a = a.attr("data-statustransfer");
	var $stt = true;
	switch (a) {
		case "3": // sudah lunas
		case "4": // lebih
			$stt = false;
			break;
		default:
			$stt = true;
	}
	
	var b = '<nav><div data-id="' + c + '" class="nav nav-tabs" id="nav-tab" role="tablist">';
	b += '<a class="nav-item nav-link active" id="nav-cek" data-toggle="tab" data-inf="tab_bayar" href="#nav-cek-tab" role="tab" aria-controls="nav-cek-tab" aria-selected="true">Cek</a>';
	if($stt) {
		b += '<a class="nav-item nav-link" id="nav-tambah" data-toggle="tab" data-inf="tab_bayar" href="#nav-tambah-tab" role="tab" aria-controls="nav-tambah-tab" aria-selected="">Tambah</a>';
		b += '<a class="nav-item nav-link d-none" id="nav-sunting" data-toggle="tab" data-inf="tab_bayar" href="#nav-sunting-tab" role="tab" aria-controls="nav-sunting-tab" aria-selected="true">Sunting</a>';
	}

	b += '</div></nav>';
	b += '<div class="tab-content" id="nav-tabContent">';
	b += '<div class="tab-pane fade show active" id="nav-cek-tab" role="tabpanel" aria-labelledby="nav-cek-tab"></div>';
	if($stt) {
		b += '<div class="tab-pane fade" id="nav-tambah-tab" role="tabpanel" aria-labelledby="nav-tambah-tab"></div>';
		b += '<div class="tab-pane fade" id="nav-sunting-tab" role="tabpanel" aria-labelledby="nav-sunting-tab"></div>';
	}

	b += "</div>";
	doModal("Pembayaran " + e, b, "moodal_status_pembayaran");
	if($stt) {
		$("#nav-tambah").tab("show");
		load_data_tambahPembayaran(c);
	}
	else {
		$("#nav-cek").tab("show");
		load_data_pembayaran(c);
	}
});

// moving tab pembayaran, modal inside
$(document).on("shown.bs.tab", 'a[data-inf="tab_bayar"]', function(c) {
	var a = $(c.target);
	c = a.closest("div").data("id");
	a = a.attr("id");
	$("#" + a + "-tab").html(spinner);

	switch (a) {
		case 'nav-tambah':
			load_data_tambahPembayaran(c);
			 $("#nav-sunting").addClass("d-none");
			break;
		
		case 'nav-cek':
			load_data_pembayaran(c);
			 $("#nav-sunting").addClass("d-none");
			break;
	
		case 'nav-sunting':
			$("#nav-sunting").removeClass("d-none");

			var tab = $('#nav-tabContent').data('id');
			load_data_suntingPembayaran(tab);
			break;
	}

	console.log(a);
});

// save new pembayaran
$(document).on("click", ".submitMe", function(c) {
	c.preventDefault();
	c.stopPropagation();
	var a = $(this);
	c = a.closest("form").serialize();
	a.prop("disabled", !0).html(spinner_btn);

	$.ajax({type:"POST", url:uri + "faktur/tambah_pembayaran", data:c, dataType:"json", success:function(a) {
		if (a.status) {
			$("#nav-cek").tab("show");
			var b = "#pesanan-" + a.faktur_id;
			$(b + " .pesanan").html(spinner);
			$(b + " .status").html(spinner);
			$(b + " .pembayaran").html(spinner);
			load_pembayaran(b + " .pesanan", b + " .status", b + " .pembayaran", a.faktur_id, function() {
				load_tooltips();
			});
			createToast(a.title, a.alert);
		}
	}, error:function() {
		createToast("Error", "Pastikan form diisi dengan benar.");
		a.prop("disabled", !1).html("Tambah");
	}
	});
});

// jump to tab sunting pembayaran
$(document).on("click", ".suntingBayar", function(c) {
	c.preventDefault();
	c = $(this).closest(".dropdown").attr("data-id");
	$("#nav-sunting").tab("show");
	$("#nav-tabContent").attr("data-id", c);
});

// save sunting pembayaran
$(document).on("click", ".simpanSuntingBayar", function(c) {
	c.preventDefault();
	c.stopPropagation();
	var a = $(this);
	c = a.closest("form").serialize();
	a.prop("disabled", !0).html(spinner_btn);
	$.ajax({type:"POST", url:uri + "faktur/simpan_pembayaran", data:c, dataType:"json", success:function(a) {
		if (a.status) {
			$("#nav-cek").tab("show");
			var b = "#pesanan-" + a.faktur_id;
			$(b + " .pesanan").html(spinner);
			$(b + " .status").html(spinner);
			$(b + " .pembayaran").html(spinner);
			load_pembayaran(b + " .pesanan", b + " .status", b + " .pembayaran", a.faktur_id, function() {
				load_tooltips();
			});
			createToast(a.title, a.alert);
		}
	}, error:function() {
		createToast("Error", "Pastikan form diisi dengan benar.");
		a.prop("disabled", !1).html("Tambah");
	}
	});
});

// delete pembayaran
$(document).on("click", ".hapusBayar", function(c) {
	c.preventDefault();
	c = $(this).closest(".dropdown").attr("data-id");
	$.post(uri + "faktur/hapus_pembayaran", {idpembayaran:c}, function(a, c) {
		var b = "#pesanan-" + a.faktur_id;
		$(b + " .pesanan").html(spinner);
		$(b + " .status").html(spinner);
		$(b + " .pembayaran").html(spinner);
		load_pembayaran(b + " .pesanan", b + " .status", b + " .pembayaran", a.faktur_id, function() {
			load_tooltips();
		});
		load_data_pembayaran(a.faktur_id);
		createToast(a.title, a.alert);
	});
});

// set paket
$(document).on("click", ".set_paket", function(e){
	e.preventDefault();
	var $div = $(e.target).closest( ".mn" );
	var id = $div.attr('data-id');
	var status = $(this).attr('data-status');
	var faktur = $div.attr('data-faktur');
	var text = 'Belum Diproses';

	if (status === 'diproses') {
		text = 'Diproses';		
	} 
	else if (status === 'dibatalkan') {
		text = 'Dibatalkan';
	}
	createToast('Status Pesanan', 'Status Pesanan '+faktur+' saat ini "' + text + '"');
});

// 
$(document).on("click", ".set_kirim", function(e){
	e.preventDefault();
	var a = $(this).closest(".mn");
	c = a.attr("data-id");
	var e = a.attr("data-faktur");
	a = a.attr("data-statuskirim");
	var b = '<nav><div data-id="' + c + '" class="nav nav-tabs" id="nav-tab" role="tablist">';
	b += '<a class="nav-item nav-link active" id="nav-cek-kirim" data-toggle="tab" data-inf="tab_kirim" href="#nav-cek-kirim-tab" role="tab" aria-controls="nav-cek-kirim-tab" aria-selected="true">Cek</a>';
	b += '</div></nav>';
	b += '<div class="tab-content" id="nav-tabContent">';
	b += '<div class="tab-pane fade show active" id="nav-cek-kirim-tab" role="tabpanel" aria-labelledby="nav-cek-kirim-tab"></div>';
	b += "</div>";
	doModal("Pengiriman " + e, b);

	$("#nav-cek-kirim").tab("show");
	load_data_pengiriman(c);

});

//
function load_data_pengiriman(id) {
	var a = "";
	$('#nav-cek-kirim-tab').html(spinner);
	$.ajax({type:"GET", url:uri + "faktur/ambil_pengiriman", data:{id:id}, dataType:"json", success:function(e) {
		a += '<div class="pt-3">';
		if (0 === e.length) {
			a += '<p class="alert alert-danger">Tidak ditemukan data pengiriman</p>';
		} else {
			a += '<div id="list_pembayaran" class="list-group">';
			for (i = 0; i < e.length; i++) {
				var b = e[i],
					m = '';
				if (null !== b.ongkir) {
					m = '<br/>ongkir: <span class="badge badge-success">' + b.ongkir + '</span>';
				}
				a += '<div class="list-group-item list-group-item-action">';
				a += '<div class="d-flex justify-content-between">';
				a += '<div class="d-flex w-100 justify-content-start">';
				a += "<div>";
				a += '<h5 class="mb-1 text-uppercase">' + b.kurir + ' <span class="badge badge-secondary">' + b.resi + "</span></h5>";
				a += '<p class="mb-1">dikirim  pada ' + b.tanggal_kirim + m + "</p>";
				a += "</div>";
				a += "</div>";
				a += "</div>";
				a += "</div>";
			}
			a += "</div>";
		}
		a += "</div>";
		$('#nav-cek-kirim-tab').html(a);
	}
	});	
}

var popOverSettings = {
	trigger: 'focus',
    placement: 'right',
    container: 'body',
	html: true,
    selector: '[data-toggle="popHarga"]',
	template: '<div class="popover shadow" role="tooltip"><div class="arrow"></div><div class="popover-body"></div></div>'
}

$('body').popover(popOverSettings);

</script>