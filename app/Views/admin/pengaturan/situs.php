<?php
use CodeIgniter\I18n\Time;
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>
<?= $this->section('content') ?>
<div class="container-xxl">
    <h1 class="h3 mt-5">Pengaturan Situs</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <?= anchor('', 'Dasbor'); ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 110px">Logo</th>
                                <th colspan="2">Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($banks as $bank) { ?>
                                <tr>
                                    <td>
                                        <?= logo_bank($bank->nama_bank); ?>
                                    </td>
                                    <td>
                                        <h5 class="mb-0"><?= $bank->rekening; ?></h5>
                                        <div class="text-muted"><?= $bank->atas_nama; ?></div>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-secondary"><i class="fad fa-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <span class="nav-link active" aria-current="true">Tambah Bank</span>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <?= form_open('settings/save_bank'); ?>
                    <div class="mb-3">
                        <?= form_label('Nama Bank', 'nama_bank', ['class' => 'form-label']); ?>
                        <select name="nama_bank" id="nama_bank" class="form-select" required="">
                            <option value="" selected="selected" disabled="">Pilih bank</option>
                            <option value="bca">BCA</option>
                            <option value="bni">BNI</option>
                            <option value="bri">BRI</option>
                            <option value="mandiri">Mandiri</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Nomor Rekening', 'nomor_rekening', ['class' => 'form-label']); ?>
                        <?= form_input('nomor_rekening', '', ['class' => 'form-control', 'id' => 'nomor_rekening', 'required' => '']); ?>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Atas Nama', 'atas_nama', ['class' => 'form-label']); ?>
                        <?= form_input('atas_nama', '', ['class' => 'form-control', 'id' => 'atas_nama', 'required' => '']); ?>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-block btn-primary" type="submit"><i class="fad fa-save"></i> Tambahkan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>