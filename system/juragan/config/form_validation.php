<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config = array(
                 'submit' => array(
                                    array(
                                            'field' => 'nama',
                                            'label' => 'Nama',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'alamat',
                                            'label' => 'Alamat',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'hp',
                                            'label' => 'Nomer Telepon',
                                            'rules' => 'trim|required|xss_clean|numeric|min_length[10]|max_length[14]'
                                         ),
                                    array(
                                            'field' => 'kode[]',
                                            'label' => 'Kode Barang',
                                            'rules' => 'trim|required|xss_clean|alpha_dash'
                                         ),
                                    array(
                                            'field' => 'jumlah[]',
                                            'label' => 'Jumlah Pesanan',
                                            'rules' => 'trim|required|xss_clean|numeric|is_natural_no_zero'
                                         ),
                                    array(
                                            'field' => 'size[]',
                                            'label' => 'Ukuran Produk',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'harga',
                                            'label' => 'Total Harga Barang',
                                            'rules' => 'trim|required|xss_clean|numeric'
                                         ),
                                    array(
                                            'field' => 'ongkir',
                                            'label' => 'Tariff Ongkir',
                                            'rules' => 'trim|required|xss_clean|numeric'
                                         ),
                                    array(
                                            'field' => 'transfer',
                                            'label' => 'Total transfer',
                                            'rules' => 'trim|required|xss_clean|numeric'
                                         ),
                                    array(
                                            'field' => 'status',
                                            'label' => 'Status Pembayaran',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'bank',
                                            'label' => 'Bank Tujuan Transfer',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'keterangan',
                                            'label' => 'Keterangan',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'image',
                                            'label' => 'Custom gambar',
                                            'rules' => 'trim|xss_clean'
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


/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */