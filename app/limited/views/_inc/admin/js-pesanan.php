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
	$.getJSON(uri + "a/json/juragan/" + a, function(a) {
		var b = '<a href="'+uri+'a/faktur/lihat/' + a.slug + '">' + a.nama + "</a>";
		a = '<hr/><span class="text-muted small">CS: ' + a.nama_cs + "</span>";
		$(c).empty().append(b + a);
		e();
	});
}

// load "status", "pesanan", "pembayaran" column
function load_pembayaran(c, a, e, b, m) {
	$.getJSON(uri + "a/json/pembayaran/" + b, function(b) {
		var f = "", v = "", n = "", w = "", x = "", y = "";
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
		var d = '<div class="mn" id="buttoncollect-' + b.id_faktur + '" data-statustransfer="' + b.status_transfer + '" data-kurang="0" data-statuskirim="'+ b.status_kirim +'" data-faktur="' + b.seri_faktur + '" data-id="' + b.id_faktur + '">';
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
			r = "cset_kirim";
			t = "dibatalkan";
			break;
		default:
			g = "text-warning", h = "fa-times", k = "fa-box-open", l = "Pesanan Belum diproses", r = "cant_kirim", t = "belumproses";
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
		d += '<a href="' + uri + 'a/faktur/sunting/' + b.seri_faktur + '" class="dropdown-item">Sunting</a>';
		d += '<button class="dropdown-item text-danger hapus_pesanan">Hapus</button>';
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
	$.getJSON(uri + "a/json/keterangan/" + a, function(a) {
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
	$.ajax({type:"GET", url:uri + "a/json/get_pembayaran", data:{id:c}, dataType:"json", success:function(e) {
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
				a += '<label class="list-group-item list-group-item-action">';
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
				a += '<div class="dropdown" data-id="' + b.id + '">';
				a += '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mm-' + i + '" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-down"></i></button>';
				a += '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="mm-' + i + '">';
				a += '<button class="dropdown-item suntingBayar">Sunting</button>';
				a += '<button class="dropdown-item hapusBayar">Hapus</button>';
				a += "</div>";
				a += "</div>";
				a += "</div>";
				a += "</label>";
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
	c += '<div class="col-6 form-group">';
	c += '<label for="tanggal_cek">Dana ada?</label>';
	c += '<div class="input-group mb-2 mr-sm-2">';
	c += '<div class="input-group-prepend">';
	c += '<div class="input-group-text">';
	c += '<input type="checkbox" name="ada_dana" value="ya">';
	c += "</div>";
	c += "</div>";
	c += '<input type="date" id="tanggal_cek" name="tanggal_cek" value="' + tanggal_sekarang + '" class="form-control" disabled="" required="">';
	c += "</div>";
	c += "</div>";
	c += "</div>";
	c += '<hr/><button type="button" class="btn btn-primary submitMe">Tambah</button>';
	c += "</form>";
	$("#nav-tambah-tab").html(c);
}

// load form edit pembayaran, modal inside
function load_data_suntingPembayaran(c) {
	var a = "", e = uri + "a/json/edit_pembayaran/" + c;
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
	a += '<div class="col-6 form-group">';
	a += '<label for="tanggal_cek">Dana ada?</label>';
	a += '<div class="input-group mb-2 mr-sm-2">';
	a += '<div class="input-group-prepend">';
	a += '<div class="input-group-text">';
	a += '<input type="checkbox" name="ada_dana" value="ya">';
	a += "</div>";
	a += "</div>";
	a += '<input type="date" id="tanggal_cek" name="tanggal_cek" value="' + tanggal_sekarang + '" class="form-control" disabled="" required="">';
	a += "</div>";
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
	var b = '<nav><div data-id="' + c + '" class="nav nav-tabs" id="nav-tab" role="tablist"><a class="nav-item nav-link active" id="nav-cek" data-toggle="tab" data-inf="tab_bayar" href="#nav-cek-tab" role="tab" aria-controls="nav-cek-tab" aria-selected="true">Cek</a><a class="nav-item nav-link" id="nav-tambah" data-toggle="tab" data-inf="tab_bayar" href="#nav-tambah-tab" role="tab" aria-controls="nav-tambah-tab" aria-selected="">Tambah</a>';
	b += '<a class="nav-item nav-link d-none" id="nav-sunting" data-toggle="tab" data-inf="tab_bayar" href="#nav-sunting-tab" role="tab" aria-controls="nav-sunting-tab" aria-selected="true">Sunting</a></div></nav>';
	b += '<div class="tab-content" id="nav-tabContent">';
	b += '<div class="tab-pane fade show active" id="nav-cek-tab" role="tabpanel" aria-labelledby="nav-cek-tab"></div>';
	b += '<div class="tab-pane fade" id="nav-tambah-tab" role="tabpanel" aria-labelledby="nav-tambah-tab"></div>';
	b += '<div class="tab-pane fade" id="nav-sunting-tab" role="tabpanel" aria-labelledby="nav-sunting-tab"></div>';
	b += "</div>";
	doModal("Pembayaran " + e, b, "moodal_status_pembayaran");
	"0" === a ? ($("#nav-tambah").tab("show"), load_data_tambahPembayaran(c)) : ($("#nav-cek").tab("show"), load_data_pembayaran(c));
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

// switch check dana, modal inside
$(document).on("keyup change", '[name="ada_dana"]', function() {
	this.checked ? $('[name="tanggal_cek"]').prop("disabled", !1) : $('[name="tanggal_cek"]').prop("disabled", !0);
});

// save new pembayaran
$(document).on("click", ".submitMe", function(c) {
	c.preventDefault();
	c.stopPropagation();
	var a = $(this);
	c = a.closest("form").serialize();
	a.prop("disabled", !0).html(spinner_btn);

	$.ajax({type:"POST", url:uri + "a/json/add_pembayaran", data:c, dataType:"json", success:function(a) {
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

// check or uncheck 
$(document).on("keyup change", "#nav-cek-tab .sbm", function() {
	var c = $(this);
	id_pembayaran = c.attr("data-id");
	id_faktur = $('#nav-cek-tab [name="faktur"]').val();
	checking = "";
	checking = this.checked ? "ya" : "tidak";
	c.prop("disabled", !0);
	$.post(uri + "a/json/check_pembayaran", {id_faktur:id_faktur, id_pembayaran:id_pembayaran, check:checking}, function(a, c) {
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
	$.ajax({type:"POST", url:uri + "a/json/update_pembayaran", data:c, dataType:"json", success:function(a) {
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
	$.post(uri + "a/json/delete_pembayaran", {idpembayaran:c}, function(a, c) {
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
	var konten = '';

	konten += '<div id="'+id+'" data-faktur="'+faktur+'" data-current="'+status+'" class="button-radios d-flex text-light justify-content-center">';
		konten += '<div data-status="belumproses" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+ (status === 'belumproses' ? 'bg-warning': 'bg-dark') +'" data-value="0"><span>Belum diproses</span></div>';
		konten += '<div data-status="diproses" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+(status === 'diproses'? 'bg-success': 'bg-dark')+'" data-value="1"><span>Diproses</span></div>';
		konten += '<div data-status="dibatalkan" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+(status === 'dibatalkan'? 'bg-danger': 'bg-dark')+'" data-value="2"><span>Dibatalkan</span></div>';
	konten += '</div>';

	doModal('Atur status paket '+ faktur, konten);
});

// when clicked radio button status paket
$(document).on("click", ".button-radios .radio", function(e){
	var status = $(this).attr('data-value'),
		status_text = $(this).attr('data-status'),
		faktur_id = $(this).parent().attr('id'),
		current = $(this).parent().attr('data-current'),
		faktur = $(this).parent().attr('data-faktur'),
		b = "#pesanan-" + faktur_id;

	$("#dynamicModal").modal('hide');
	if(current !== status_text) {
		$.post('<?php echo site_url("a/json/ubah_paket") ?>', {faktur_id: faktur_id, status: status}, function(response) {
			$(b + " .pesanan").html(spinner);
			$(b + " .status").html(spinner);
			$(b + " .pembayaran").html(spinner);
			$(b + " .keterangan").html(spinner);
			load_pembayaran(b + " .pesanan", b + " .status", b + " .pembayaran", faktur_id, function() {
				load_tooltips();
			});
			load_keterangan(b + " .keterangan", faktur_id);

			createToast(response.title, response.alert);
		});
	}
});

// set kirim
$(document).on("click", ".cant_kirim", function(e){
	e.preventDefault();
	var $div = $(this).closest(".mn");
	var id = $div.attr('data-id');
	var faktur = $div.attr('data-faktur');
	var tm = makeid();
	createToast('Atur Pengiriman', 'Pesanan '+faktur+' belum dapat di-set kirim karena belum diproses ');
});

// 
$(document).on("click", ".set_kirim", function(e){
	e.preventDefault();
	var a = $(this).closest(".mn");
	c = a.attr("data-id");
	var e = a.attr("data-faktur");
	a = a.attr("data-statuskirim");
	var b = '<nav><div data-id="' + c + '" class="nav nav-tabs" id="nav-tab" role="tablist">';
	b += '<a class="nav-item nav-link active" id="nav-cek-kirim" data-toggle="tab" data-inf="tab_kirim" href="#nav-cek-kirim-tab" role="tab" aria-controls="nav-cek-kirim-tab" aria-selected="true">Cek</a><a class="nav-item nav-link" id="nav-tambah-kirim" data-toggle="tab" data-inf="tab_kirim" href="#nav-tambah-kirim-tab" role="tab" aria-controls="nav-tambah-kirim-tab" aria-selected="">Tambah</a>';
	b += '<a class="nav-item nav-link d-none" id="nav-sunting-kirim" data-toggle="tab" data-inf="tab_kirim" href="#nav-sunting-kirim-tab" role="tab" aria-controls="nav-sunting-kirim-tab" aria-selected="true">Sunting</a></div></nav>';
	b += '<div class="tab-content" id="nav-tabContent">';
	b += '<div class="tab-pane fade show active" id="nav-cek-kirim-tab" role="tabpanel" aria-labelledby="nav-cek-kirim-tab"></div>';
	b += '<div class="tab-pane fade" id="nav-tambah-kirim-tab" role="tabpanel" aria-labelledby="nav-tambah-kirim-tab"></div>';
	b += '<div class="tab-pane fade" id="nav-sunting-kirim-tab" role="tabpanel" aria-labelledby="nav-sunting-kirim-tab"></div>';
	b += "</div>";
	doModal("Pengiriman " + e, b);

	if (a !== "0") {
		$("#nav-cek-kirim").tab("show");
		load_data_pengiriman(c);
	}
	else {
		$("#nav-tambah-kirim").tab("show");
		load_data_tambah_pengiriman(c);
	}
});

//
function load_data_pengiriman(id) {
	var a = "";
	$('#nav-cek-kirim-tab').html(spinner);
	$.ajax({type:"GET", url:uri + "a/json/get_pengiriman", data:{id:id}, dataType:"json", success:function(e) {
		a += '<div class="pt-3">';
		if (0 === e.length) {
			a += '<p class="alert alert-danger">Tidak ditemukan data pengiriman</p>';
		} else {
			a += '<input name="faktur" type="hidden" value="' + c + '"/>';
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
				a += '<div class="dropdown" data-id="' + b.id + '">';
				a += '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mm-' + i + '" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-down"></i></button>';
				a += '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="mm-' + i + '">';
				a += '<button class="dropdown-item suntingKirim">Sunting</button>';
				a += '<button class="dropdown-item hapusKirim">Hapus</button>';
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

//
function load_data_tambah_pengiriman(id) {
	var kurir = <?php echo $this->config->item("list_kurir") ?>,
		option = '',
		konten = '';

	$.each(kurir, function(i,v){
		option += '<option value="'+v+'">'+v+'</option>';
	});

	konten += '<form>';

	konten += '<input name="faktur_id" type="hidden" value="'+id+'"/>';
	konten += '<div class="form-row">';
		konten += '<div class="col-sm-4">';
			konten += '<div class="form-group">';
				konten += '<label for="kurir_list">Kurir</label>';
				konten += '<select name="kurir" class="custom-select" id="kurir_list">';
				konten += '<option selected="" disabled="" value="">Pilih Kurir</option>';
				konten += option;
				konten += '<option value="lainnya">Lainnya</option></select>';
			konten += '</div>';
		konten += '</div>';

		konten += '<div class="col-sm-8">';
			konten += '<div class="form-group">';
				konten += '<label for="lainnya">Kurir Lain</label>';
				konten += '<input type="text" name="lainnya" disabled="" required="" value="" id="lainnya" class="form-control" placeholder="kurir lainnya" />';
			konten += '</div>';
		konten += '</div>';
	konten += '</div>';

	konten += '<div class="form-group">';
		konten += '<label for="resi">No Resi</label>';
		konten += '<input type="text" name="resi" value="" required="" id="resi" class="form-control" placeholder="JOG98798777" />';
	konten += '</div>';

	konten += '<div class="form-row">';
		konten += '<div class="col-sm-4">';
			konten += '<div class="form-group">';
				konten += '<label for="tanggal_kirim">Tanggal Kirim</label>';
				konten += '<input type="date" name="tanggal_kirim" required="" value="<?php echo mdate("%Y-%m-%d", now()); ?>" id="tanggal_kirim" class="form-control" placeholder="" />';                       
			konten += '</div>';
		konten += '</div>';

		konten += '<div class="col-sm-8">';
			konten += '<div class="form-group">';
				konten += '<label for="ongkir">Biaya Ongkir</label>';
				konten += '<input type="number" min="0" name="ongkir" required="" value="0" id="ongkir" class="form-control" placeholder="9000" />';
			konten += '</div>';
		konten += '</div>';
	konten += '</div>';

	konten += '<div class="custom-control custom-checkbox">';
		konten += '<input type="checkbox" checked="" class="custom-control-input" name="cek" value="ya" id="cek_satu">';
		konten += '<label class="custom-control-label" for="cek_satu">Pesanan ini sudah selesai dikirim</label>';
	konten += '</div>';

	konten += '<hr/><button type="button" class="btn btn-primary tambahKirim">Tambah</button>';
	konten += '</form>';

	$('#nav-tambah-kirim-tab').html(konten);

	$("#kurir_list").change(function() {
		if ($(this).val() === "lainnya") {
			$('#lainnya').attr('disabled', false);
			$('#lainnya').attr('required', true);
		} else {
			$('#lainnya').attr('disabled', true);
		}

		if ($(this).val() === "COD") {
			$('#resi').val('COD<?php echo date("dmY") ?>');
		} else {
			$('#resi').val('');
		}
	});
}

function load_data_sunting_pengiriman(id) {
	var kurir = <?php echo $this->config->item("list_kurir") ?>,
		option = '',
		konten = '';

	$.each(kurir, function(i,v){
		option += '<option value="'+v+'">'+v+'</option>';
	});

	$.ajax({type:"GET", url:uri + "a/json/edit_pengiriman", data:{id:id}, dataType:"json", success:function(e) {
		konten += '<form>';

		konten += '<input name="faktur_id" type="hidden" value="'+e.faktur_id+'"/>';
		konten += '<input name="id_pengiriman" type="hidden" value="'+id+'"/>';
		konten += '<div class="form-row">';
			konten += '<div class="col-sm-4">';
				konten += '<div class="form-group">';
					konten += '<label for="kurir_list">Kurir</label>';
					konten += '<select name="kurir" class="custom-select" id="kurir_list">';
					konten += '<option value="" disabled="">Pilih Kurir</option>';
					konten += option;
					konten += '<option value="lainnya">Lainnya</option></select>';
				konten += '</div>';
			konten += '</div>';

			konten += '<div class="col-sm-8">';
				konten += '<div class="form-group">';
					konten += '<label for="lainnya">Kurir Lain</label>';
					konten += '<input type="text" name="lainnya" disabled="" required="" value="" id="lainnya" class="form-control" placeholder="kurir lainnya" />';
				konten += '</div>';
			konten += '</div>';
		konten += '</div>';

		konten += '<div class="form-group">';
			konten += '<label for="resi">No Resi</label>';
			konten += '<input type="text" name="resi" value="'+e.resi+'" required="" id="resi" class="form-control" placeholder="JOG98798777" />';
		konten += '</div>';

		konten += '<div class="form-row">';
			konten += '<div class="col-sm-4">';
				konten += '<div class="form-group">';
					konten += '<label for="tanggal_kirim">Tanggal Kirim</label>';
					konten += '<input type="date" name="tanggal_kirim" required="" value="'+e.tanggal_kirim+'" id="tanggal_kirim" class="form-control" placeholder="" />';                       
				konten += '</div>';
			konten += '</div>';

			konten += '<div class="col-sm-8">';
				konten += '<div class="form-group">';
					konten += '<label for="ongkir">Biaya Ongkir</label>';
					konten += '<input type="number" min="0" name="ongkir" required="" value="'+e.ongkir+'" id="ongkir" class="form-control" placeholder="9000" />';
				konten += '</div>';
			konten += '</div>';
		konten += '</div>';

		konten += '<hr/><button type="button" class="btn btn-primary SimpanSuntingKirim">Simpan</button>';
		konten += '</form>';

		$('#nav-sunting-kirim-tab').html(konten);

		$("#kurir_list").change(function() {
			if ($(this).val() === "lainnya") {
				$('#lainnya').attr('disabled', false);
				$('#lainnya').attr('required', true);
			} else {
				$('#lainnya').attr('disabled', true);
			}
		});

		if($.inArray( e.kurir, kurir ) > -1) {
			$('[name="kurir"]').val(e.kurir);
		}
		else {
			$('[name="lainnya"]').attr('disabled', false).val(e.kurir);
			$('[name="kurir"]').val('lainnya');
		}
	}
	});
}

// 
$(document).on("click", ".suntingKirim", function(c) {
	c.preventDefault();
	c = $(this).closest(".dropdown").attr("data-id");
	$("#nav-sunting-kirim").tab("show");
	$("#nav-tabContent").attr("data-id", c);
});

$(document).on("click", ".SimpanSuntingKirim", function(c) {
	c.preventDefault();
	c.stopPropagation();
	var a = $(this);
	c = a.closest("form").serialize();
	a.prop("disabled", !0).html(spinner_btn);
	$.ajax({type:"POST", url:uri + "a/json/update_pengiriman", data:c, dataType:"json", success:function(a) {
		if (a.status) {
			$("#nav-cek-kirim").tab("show");
			var b = "#pesanan-" + a.faktur_id;
			$(b + " .keterangan").html(spinner);
			$(b + " .status").html(spinner);

			load_keterangan(b + " .keterangan", a.faktur_id, function() {
			});
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

// simpan data kirim baru
$(document).on("click", ".tambahKirim", function(c) {
	c.preventDefault();
	c.stopPropagation();
	var a = $(this);
	c = a.closest("form").serialize();
	a.prop("disabled", !0).html(spinner_btn);
	$.ajax({type:"POST", url:uri + "a/json/add_pengiriman", data:c, dataType:"json", success:function(a) {
		if (a.status) {
			$("#nav-cek-kirim").tab("show");
			var b = "#pesanan-" + a.faktur_id;
			$(b + " .keterangan").html(spinner);
			$(b + " .status").html(spinner);
			
			load_keterangan(b + " .keterangan", a.faktur_id, function() {
			});
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

// 
$(document).on("shown.bs.tab", 'a[data-inf="tab_kirim"]', function(c) {
	var a = $(c.target);
	c = a.closest("div").data("id");
	a = a.attr("id");
	$("#" + a + "-tab").html(spinner);

	switch (a) {
		case 'nav-tambah-kirim':
			load_data_tambah_pengiriman(c);
			 $("#nav-sunting-kirim").addClass("d-none");
			break;
		
		case 'nav-cek-kirim':
			load_data_pengiriman(c);
			 $("#nav-sunting-kirim").addClass("d-none");
			break;
	
		case 'nav-sunting-kirim':
			$("#nav-sunting-kirim").removeClass("d-none");

			var tab = $('#nav-tabContent').data('id');
			load_data_sunting_pengiriman(tab);
			break;
	}
});

// delete pengiriman
$(document).on("click", ".hapusKirim", function(c) {
	c.preventDefault();
	c = $(this).closest(".dropdown").attr("data-id");
	$.post(uri + "a/json/delete_pengiriman", {idpengiriman:c}, function(a) {
		var b = "#pesanan-" + a.faktur_id;
		$(b + " .keterangan").html(spinner);
		$(b + " .status").html(spinner);
		
		load_keterangan(b + " .keterangan", a.faktur_id, function() {
		});
		load_pembayaran(b + " .pesanan", b + " .status", b + " .pembayaran", a.faktur_id, function() {
			load_tooltips();
		});
		load_data_pengiriman(a.faktur_id);
		createToast(a.title, a.alert);
	});
});

// delete pesanan
$(document).on("click", ".hapus_pesanan", function(c) {
	c.preventDefault();

	c = $(this).closest(".mn");
	var seri_faktur = c.attr('data-faktur'),
		id_faktur = c.attr('data-id');
	// console.log(seri_faktur);
	if (confirm("Hapus data pesanan "+ id_faktur +"?" )) {
		// your deletion code
		$.post(uri + "a/faktur/delete", {id_faktur:id_faktur}, function(a) {
			if(a.status) {
				location.reload();
			}
		});
	}
	return false;
})

$(document).on("keyup change", '[name="cari[cek_tanggal]"]',function(){
    if(this.checked) {
        //Do stuff
        $('[name="cari[tanggal]"]').prop('disabled', false);
    }
    else {
        $('[name="cari[tanggal]"]').prop('disabled', true);
    }
});

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