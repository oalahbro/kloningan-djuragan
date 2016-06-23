<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
   'submit' => array(
    array(
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required'
        ),
    array(
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'required'
        ),
    array(
        'field' => 'hp',
        'label' => 'Nomer Telepon',
        'rules' => 'required|numeric|min_length[10]|max_length[14]'
        ),
    array(
        'field' => 'kode[]',
        'label' => 'Kode Barang',
        'rules' => 'required|alpha_dash'
        ),
    array(
        'field' => 'jumlah[]',
        'label' => 'Jumlah Pesanan',
        'rules' => 'required|numeric|is_natural_no_zero'
        ),
    array(
        'field' => 'size[]',
        'label' => 'Ukuran Produk',
        'rules' => 'required'
        ),
    array(
        'field' => 'harga',
        'label' => 'Total Harga Barang',
        'rules' => 'required|numeric'
        ),
    array(
        'field' => 'ongkir',
        'label' => 'Tariff Ongkir',
        'rules' => 'required|numeric'
        ),
    array(
        'field' => 'transfer',
        'label' => 'Total transfer',
        'rules' => 'required|numeric'
        ),
    array(
        'field' => 'status',
        'label' => 'Status Pembayaran',
        'rules' => 'required'
        ),
    array(
        'field' => 'bank',
        'label' => 'Bank Tujuan Transfer',
        'rules' => 'required'
        ),
    array(
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => ''
        ),
    array(
        'field' => 'image',
        'label' => 'Custom gambar',
        'rules' => ''
        )
    ),
   'email' => array(
    array(
        'field' => 'emailaddress',
        'label' => 'EmailAddress',
        'rules' => 'required|valid_email'
        ),
    array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required|alpha'
        ),
    array(
        'field' => 'title',
        'label' => 'Title',
        'rules' => 'required'
        ),
    array(
        'field' => 'message',
        'label' => 'MessageBody',
        'rules' => 'required'
        )
    )                          
   );