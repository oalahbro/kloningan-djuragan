<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $signin = [
        'username' => 'required',
        'password' => 'required',
    ];

    public $signup = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[user.username]|alpha_dash',
        'password' => 'required|min_length[6]',
        'nama'     => 'required|min_length[3]|max_length[50]',
        'email'    => 'required|valid_email|max_length[100]|is_unique[user.email]',
    ];

    public $addBank = [
        'nama_bank'      => 'required|in_list[bri,bni,bca,mandiri,edc]',
        'nomor_rekening' => 'required|max_length[50]|alpha_dash',
        'atas_nama'      => 'required|max_length[50]|alpha_space',
    ];

    public $addJuragan = [
        'nama_juragan' => 'required|min_length[3]|max_length[60]|is_unique[juragan.nama_juragan]',
        'bank'         => 'required',
    ];

    public $editJuragan = [
        'id'           => 'required|integer',
        'nama_juragan' => 'required|min_length[3]|max_length[60]',
        'bank'         => 'required',
    ];

    public $addPengguna = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[user.username]|alpha_dash',
        'password' => 'required|min_length[6]',
        'nama'     => 'required|min_length[3]|max_length[50]',
        'email'    => 'required|valid_email|max_length[100]|is_unique[user.email]',
        'level'    => 'required|in_list[superadmin,admin,cs,viewer,reseller]',
        'status'   => 'required|in_list[pending,inactive,active,blocked]',
    ];

    public $editPengguna = [
        'nama'   => 'required|min_length[3]|max_length[50]',
        'email'  => 'required|valid_email|max_length[100]|is_unique[user.email,id,{id}]',
        'level'  => 'required|in_list[superadmin,admin,cs,viewer,reseller]',
        'status' => 'required|in_list[pending,inactive,active,blocked]',
    ];

    public $addInvoice = [
        'juragan'       => 'required',
        'pengguna'      => 'required',
        'asal_orderan'  => 'required',
        'tanggal_order' => 'required',
        'juragan'       => 'required',
        'id_pemesan'    => 'required',
        'id_kirimKe'    => 'required',
        // 'keterangan' => 'required',
        'produk' => 'required',
        // 'biaya' 		=> 'required'
    ];

    public $updateInvoice = [
        'id_invoice'    => 'required',
        'juragan'       => 'required',
        'pengguna'      => 'required',
        'asal_orderan'  => 'required',
        'tanggal_order' => 'required',
        'juragan'       => 'required',
        'id_pemesan'    => 'required',
        'id_kirimKe'    => 'required',
        // 'keterangan' => 'required',
        'produk' => 'required',
        // 'biaya' 		=> 'required'
    ];

    public $simpanProgress = [
        'id_invoice' => 'required|integer',
        'status'     => 'required',
        'stat'       => 'required',
        // 'keterangan' 	=> 'required'
    ];

    public $tambahPembayaran = [
        'invoice_id'       => 'required|integer',
        'sumber_dana'      => 'required',
        'total_pembayaran' => 'required|integer',
        // 'status' 			=> 'required',
        'tanggal_pembayaran' => 'required',
    ];

    public $updatePembayaran = [
        'id_pembayaran' => 'required|integer',
        'invoice_id'    => 'required|integer',
        'status'        => 'required',
    ];

    public $tambahPengiriman = [
        'invoice_id'    => 'required|integer',
        'kurir'         => 'required',
        'ongkir'        => 'required|integer',
        'qty'           => 'required',
        'resi'          => 'required',
        'tanggal_kirim' => 'required',
    ];
}
