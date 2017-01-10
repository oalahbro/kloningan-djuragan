<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Alba - Bootstrap 4 Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?php echo $title; ?></title>

    <?php echo link_tag('assets/css/font-awesome.min.css'); ?>
    <?php echo link_tag('assets/css/simple-line-icons.css'); ?>

    <!-- Main styles for this application -->
    <?php echo link_tag('assets/css/style.css'); ?>

</head>

<!-- BODY options, add following classes to body to change options
        1. 'compact-nav'          - Switch sidebar to minified version (width 50px)
        2. 'sidebar-nav'          - Navigation on the left
            2.1. 'sidebar-off-canvas'   - Off-Canvas
                2.1.1 'sidebar-off-canvas-push' - Off-Canvas which move content
                2.1.2 'sidebar-off-canvas-with-shadow'  - Add shadow to body elements
        3. 'fixed-nav'            - Fixed navigation
        4. 'navbar-fixed'         - Fixed navbar
        5. 'footer-fixed'         - Fixed navbar
    -->

<body class="navbar-fixed sidebar-navt fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">☰</button>
            <?php echo anchor('admin/dashboard', '&nbsp;', array('class' => 'navbar-brand')); ?>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">☰</a>
                </li>
                <li class="nav-item  px-1 dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                        Pesanan <span class="icon-options-vertical"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg">
                        <?php 
                        echo anchor('admin/pesanan/lihat/semua/semua', 'Semua', array('class' => 'dropdown-item'));
                        echo anchor('admin/pesanan/lihat/semua/terkirim', 'Terkirim', array('class' => 'dropdown-item'));
                        echo anchor('admin/pesanan/lihat/semua/pending', 'Pending', array('class' => 'dropdown-item'));
                        ?>
                    </div>
                </li>

                <li class="nav-item px-1">
                    <a class="nav-link" href="#">Statistik</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="#">Stock</a>
                </li>

            </ul>
        </div>
    </header>

    <div class="sidebar">

        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">
                    Dashboard
                </li>

                <?php 
                foreach ($this->juragan->anbil_data()->result() as $j) {
                    echo '<li class="nav-item">';
                    echo anchor('admin/pesanan/lihat/' . $j->nama_alias, '<i class="icon-user"></i>' . $j->nama, array('class' => 'nav-link'));
                    echo '</li>';
                }
                ?>
            </ul>
        </nav>
    </div>