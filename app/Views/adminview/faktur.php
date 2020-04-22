<?php
use CodeIgniter\I18n\Time;
?>
<div class="wrapper">
    <nav id="sidebar" class="bg-dark collapse" style="">
        <div class="sidebar" id="listJuragan">
            <h6 class="dropdown-header">Pilih Juragan</h6>
            <ul class="list-unstyled" id="listLi">
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan">
                        <svg class="svg-inline--fa fa-users fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="users" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path>
                        </svg>
                        <!-- <i class="fas fa-users"></i> -->Semua Juragan</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/f4acdd10d99ae0db5dc7d84e87967f52cc028f9b">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Blazer Jaket</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/3dd239573c69034ee59e32917af7143f60659d55">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Custom Juragan</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/fd7ca78cec2c0e23e562af5f9cb68b5845a19b2f">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Dayat</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/fb6b50d82d52a317c7d49f75fdcc872b8c8ae700">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->DistroKorea.com</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/c24e478be38171a73eaf49f5b5b35f93f549ac8a">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Fashion Cowok</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/8fdd3935f6d38bfdeff266bc9c32041e9ae655b8">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Fashion Lelaki</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/f84f7201d42f739346f5c5791ff38297205b5f92">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Indonesia Shop</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/8aafc86dd00d77347baf4743d2c28a1e4e707e2d">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Jaket Anime</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/20d775ae223933aa32f362a6f96bcec69ea36060">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Jaket Korean</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/53b444fc767fdfc35c921f61c1ee0e5aa692d283">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Joker</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/dcb04dbb7ed071fa08ae16b1d7d8c769dd2eba2f">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Juragan Jaket</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/b838e6659f5e8ebac8e12191577d2efa73249388">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Juragan Jaket 2</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/09df3b75f869e33a80950ed4976c9d7d011420a8">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Korea Hunter</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/23276c77d251d86d4eaa0e2a396e00ca65b3a646">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Limited Shoping</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/6c973e8803b3fbaabfb09dd916e295ed24da1d43">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->No Rules</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/b1bbba32759b15be469977e4879ec38b7198256g">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->RA</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/27d0178da19e7f05f397d901545a0e5de8b2a98e">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Reseller</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/3b1658d8d3c5a6e4df1b822f2e415c929cb9c855">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Reseller Nine</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/403d3ddc6f70385f9ce228cdd0e50ac4f5b007c1">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->SayCleo</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/3ffeb39fe3773285105b7048192123337929a8ab">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Seven Domu</a>
                </li>
                <li>
                    <a href="https://djuragan.com/new/index.php/faktur/data/b1bbba32759b15be469977e4879ec38b71982551">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                        </svg>
                        <!-- <i class="fas fa-user-circle"></i> -->Suit Men tailor</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex align-items-stretch">
        <div class="konten" id="konten">
            <div class="jumbotron jumbotron-fluid">
                <div class="container-fluid">
                    <h3>Pesanan Semua Juragan</h3>

                </div>
            </div>
            <div class="px-sm-3">
                <form action="https://djuragan.com/new/index.php/faktur/data/s_juragan" class="form-inline px-3 px-sm-0" method="get" accept-charset="utf-8">
                    <select name="cari[pembayaran]" class="custom-select mb-2 mr-sm-2">
                        <option value="" selected="selected">Opsi Pembayaran</option>
                        <option value="belum_transfer">Belum Lunas</option>
                        <option value="b_menunggu">Menuggu Konfirmasi</option>
                        <option value="c_sebagian">Sebagian Lunas / Kredit</option>
                        <option value="d_lunas">Lunas</option>
                        <option value="e_lebih">Ada Kelebihan</option>
                    </select>
                    <select name="cari[paket]" class="custom-select mb-2 mr-sm-2">
                        <option value="" selected="selected">Opsi Paket</option>
                        <option value="diproses">Diproses</option>
                        <option value="belum_diproses">Belum Diproses</option>
                        <option value="batal_proses">Dibatalkan</option>
                    </select>
                    <select name="cari[pengiriman]" class="custom-select mb-2 mr-sm-2">
                        <option value="" selected="selected">Opsi Pengiriman</option>
                        <option value="belum_kirim">Belum Dikirim</option>
                        <option value="d_sebagian">Dikirim Sebagian</option>
                        <option value="dikirim">Dikirim</option>
                    </select>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="cari[cek_tanggal]" value="ya">
                            </div>
                        </div>
                        <input type="date" name="cari[tanggal]" value="2020-04-21" class="form-control" placeholder="tanggal data masuk" disabled="">
                    </div>
                    <div class="form-check mb-2 mr-sm-2">
                        <input type="checkbox" name="cari[marketplace]" value="ya" class="form-check-input" id="marketplace">
                        <label for="marketplace">Marketplace?</label>
                    </div>
                    <input type="text" name="cari[q]" value="" class="form-control mb-2 mr-sm-2" placeholder="cari data">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
                <div id="main-table">
                    <div class="table-responsive" id="table-pesanan">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 120px">Faktur #</th>
                                    <th style="width: 120px">Juragan</th>
                                    <th style="width: 160px">Status</th>
                                    <th>Pemesan</th>
                                    <th style="min-width: 220px">Pesanan</th>
                                    <th style="width: 240px">Biaya</th>
                                    <th style="width: 200px">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesanan as $key ) { ?>
                                <tr id="pesanan-35934">
                                    <td><?php 
                                    $count_juragan = str_word_count(str_replace('-', ' ', $key->juragan));

                                    if( $count_juragan === 1 ) {
                                        $kode = strtoupper(substr($key->juragan, 0, 2));
                                    }
                                    else {
                                        $kode = '';
                                        foreach (explode('-', $key->juragan) as $word) {
                                            $kode .= substr($word, 0, 1);
                                        }
                                        $kode = strtoupper(substr($kode, 0, 2));
                                    }
                              

                                    echo $kode . $key->fktr_dibuat; ?>
                                        <span class="d-block"><?php
                                        $time = Time::createFromTimestamp($key->fktr_dibuat);
                                        echo '<abbr title="'.$time.'">';
                                        echo $time->toLocalizedString('d-MMM-yyyy');
                                        echo '</abbr>';
                                         ?></span> </td>
                                    <td class="juragan">
                                        <?= anchor($key->juragan, $key->nama_jrgn); ?>
                                        <hr><span class="text-muted small">CS: Sandra</span></td>
                                    <td class="status">
                                        <div class="mn" id="buttoncollect-35934" data-statustransfer="0" data-kurang="0" data-statuskirim="0" data-faktur="JK191212135012" data-id="35934">
                                            <div class="fa-2x d-inline-block ckbyr" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pembayaran Belum ada"><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-light" data-fa-transform="grow-2" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(1.125, 1.125)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i> --><svg class="svg-inline--fa fa-wallet fa-w-16 text-secondary" data-fa-transform="shrink-6" aria-hidden="true" data-prefix="fas" data-icon="wallet" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M461.2 128H80c-8.84 0-16-7.16-16-16s7.16-16 16-16h384c8.84 0 16-7.16 16-16 0-26.51-21.49-48-48-48H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h397.2c28.02 0 50.8-21.53 50.8-48V176c0-26.47-22.78-48-50.8-48zM416 336c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-wallet text-secondary" data-fa-transform="shrink-6"></i> --><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-danger" data-fa-transform="shrink-8 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.8125em 0.5625em;"><g transform="translate(256 256)"><g transform="translate(160, 32)  scale(0.5, 0.5)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-danger" data-fa-transform="shrink-8 down-1 right-5"></i> --><svg class="svg-inline--fa fa-times fa-w-11 text-light" data-fa-transform="shrink-10 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="" style="transform-origin: 0.65625em 0.5625em;"><g transform="translate(176 256)"><g transform="translate(160, 32)  scale(0.375, 0.375)  rotate(0 0 0)"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" transform="translate(-176 -256)"></path></g></g></svg><!-- <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i> --></span></span>
                                            </div>
                                            <div class="fa-2x d-inline-block set_paket" data-status="belumproses" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pesanan Belum diproses"><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-light" data-fa-transform="grow-2" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(1.125, 1.125)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i> --><svg class="svg-inline--fa fa-box-open fa-w-20 text-secondary" data-fa-transform="shrink-6" aria-hidden="true" data-prefix="fas" data-icon="box-open" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="" style="transform-origin: 0.625em 0.5em;"><g transform="translate(320 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M53.2 41L1.7 143.8c-4.6 9.2.3 20.2 10.1 23l197.9 56.5c7.1 2 14.7-1 18.5-7.3L320 64 69.8 32.1c-6.9-.8-13.5 2.7-16.6 8.9zm585.1 102.8L586.8 41c-3.1-6.2-9.8-9.8-16.7-8.9L320 64l91.7 152.1c3.8 6.3 11.4 9.3 18.5 7.3l197.9-56.5c9.9-2.9 14.7-13.9 10.2-23.1zM425.7 256c-16.9 0-32.8-9-41.4-23.4L320 126l-64.2 106.6c-8.7 14.5-24.6 23.5-41.5 23.5-4.5 0-9-.6-13.3-1.9L64 215v178c0 14.7 10 27.5 24.2 31l216.2 54.1c10.2 2.5 20.9 2.5 31 0L551.8 424c14.2-3.6 24.2-16.4 24.2-31V215l-137 39.1c-4.3 1.3-8.8 1.9-13.3 1.9z" transform="translate(-320 -256)"></path></g></g></svg><!-- <i class="fas fa-box-open text-secondary" data-fa-transform="shrink-6"></i> --><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-warning" data-fa-transform="shrink-8 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.8125em 0.5625em;"><g transform="translate(256 256)"><g transform="translate(160, 32)  scale(0.5, 0.5)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-warning" data-fa-transform="shrink-8 down-1 right-5"></i> --><svg class="svg-inline--fa fa-times fa-w-11 text-light" data-fa-transform="shrink-10 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="" style="transform-origin: 0.65625em 0.5625em;"><g transform="translate(176 256)"><g transform="translate(160, 32)  scale(0.375, 0.375)  rotate(0 0 0)"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" transform="translate(-176 -256)"></path></g></g></svg><!-- <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i> --></span></span>
                                            </div>
                                            <div class="fa-2x d-inline-block cant_kirim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pesanan Belum dikirim"><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-light" data-fa-transform="grow-2" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(1.125, 1.125)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i> --><svg class="svg-inline--fa fa-cubes fa-w-16 text-secondary" data-fa-transform="shrink-6" aria-hidden="true" data-prefix="fas" data-icon="cubes" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M488.6 250.2L392 214V105.5c0-15-9.3-28.4-23.4-33.7l-100-37.5c-8.1-3.1-17.1-3.1-25.3 0l-100 37.5c-14.1 5.3-23.4 18.7-23.4 33.7V214l-96.6 36.2C9.3 255.5 0 268.9 0 283.9V394c0 13.6 7.7 26.1 19.9 32.2l100 50c10.1 5.1 22.1 5.1 32.2 0l103.9-52 103.9 52c10.1 5.1 22.1 5.1 32.2 0l100-50c12.2-6.1 19.9-18.6 19.9-32.2V283.9c0-15-9.3-28.4-23.4-33.7zM358 214.8l-85 31.9v-68.2l85-37v73.3zM154 104.1l102-38.2 102 38.2v.6l-102 41.4-102-41.4v-.6zm84 291.1l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6zm240 112l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-cubes text-secondary" data-fa-transform="shrink-6"></i> --><span class="fa-layers fa-fw"><svg class="svg-inline--fa fa-circle fa-w-16 text-danger" data-fa-transform="shrink-8 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.8125em 0.5625em;"><g transform="translate(256 256)"><g transform="translate(160, 32)  scale(0.5, 0.5)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z" transform="translate(-256 -256)"></path></g></g></svg><!-- <i class="fas fa-circle text-danger" data-fa-transform="shrink-8 down-1 right-5"></i> --><svg class="svg-inline--fa fa-times fa-w-11 text-light" data-fa-transform="shrink-10 down-1 right-5" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="" style="transform-origin: 0.65625em 0.5625em;"><g transform="translate(176 256)"><g transform="translate(160, 32)  scale(0.375, 0.375)  rotate(0 0 0)"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" transform="translate(-176 -256)"></path></g></g></svg><!-- <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i> --></span></span>
                                            </div>
                                            <div class="dropdown dropright">
                                                <button class="btn btn-outline-primary btn-sm btn-block" type="button" id="setting-35934" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg class="svg-inline--fa fa-cog fa-w-16 fa-spin" aria-hidden="true" data-prefix="fas" data-icon="cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M444.788 291.1l42.616 24.599c4.867 2.809 7.126 8.618 5.459 13.985-11.07 35.642-29.97 67.842-54.689 94.586a12.016 12.016 0 0 1-14.832 2.254l-42.584-24.595a191.577 191.577 0 0 1-60.759 35.13v49.182a12.01 12.01 0 0 1-9.377 11.718c-34.956 7.85-72.499 8.256-109.219.007-5.49-1.233-9.403-6.096-9.403-11.723v-49.184a191.555 191.555 0 0 1-60.759-35.13l-42.584 24.595a12.016 12.016 0 0 1-14.832-2.254c-24.718-26.744-43.619-58.944-54.689-94.586-1.667-5.366.592-11.175 5.459-13.985L67.212 291.1a193.48 193.48 0 0 1 0-70.199l-42.616-24.599c-4.867-2.809-7.126-8.618-5.459-13.985 11.07-35.642 29.97-67.842 54.689-94.586a12.016 12.016 0 0 1 14.832-2.254l42.584 24.595a191.577 191.577 0 0 1 60.759-35.13V25.759a12.01 12.01 0 0 1 9.377-11.718c34.956-7.85 72.499-8.256 109.219-.007 5.49 1.233 9.403 6.096 9.403 11.723v49.184a191.555 191.555 0 0 1 60.759 35.13l42.584-24.595a12.016 12.016 0 0 1 14.832 2.254c24.718 26.744 43.619 58.944 54.689 94.586 1.667 5.366-.592 11.175-5.459 13.985L444.788 220.9a193.485 193.485 0 0 1 0 70.2zM336 256c0-44.112-35.888-80-80-80s-80 35.888-80 80 35.888 80 80 80 80-35.888 80-80z"></path>
                                                    </svg>
                                                    <!-- <i class="fas fa-cog fa-spin"></i> --></button>
                                                <div class="dropdown-menu" aria-labelledby="setting-35934">
                                                    <h6 class="dropdown-header">Atur</h6>
                                                    <button class="ckbyr dropdown-item">Pembayaran</button>
                                                    <button class="set_paket dropdown-item" data-status="belumproses">Status Paket</button>
                                                    <button class="cant_kirim dropdown-item">Pengiriman</button>
                                                    <div class="dropdown-divider"></div>
                                                    <h6 class="dropdown-header">Lainnya</h6><a class="dropdown-item" href="https://djuragan.com/new/index.php/faktur/pdf/JK191212135012">Unduh PDF</a><a href="https://djuragan.com/new/index.php/faktur/sunting/JK191212135012" class="dropdown-item">Sunting</a>
                                                    <button class="dropdown-item text-danger hapus_pesanan">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold"><?= strtoupper($key->nama_plgn) ?></span><br/>
                                        <?php 
                                        $hp_pelanggan = json_decode($key->hp); 
                                        $p = 0;
                                        foreach ($hp_pelanggan as $phone) {
                                            $cl = '';
                                            if($p ===1) {
                                                echo '<span class="sr-only"> / </span>';
                                                $cl = ' ml-1';
                                            }
                                            echo '<span class="badge badge-dark'.$cl.'">' .$phone. '</span>';
                                            $p++;
                                        }

                                        echo '<br/>' . strtoupper($key->alamat);
                                        ?>
                                    </td>
                                    <td class="pesanan">
                                        <div>BK-01 (XL) = 1pcs
                                            <button data-toggle="popHarga" data-content="harga satuan: <strong>Rp 295.000,-</strong><br/>harga total: <strong>Rp 295.000,-</strong>" class="btn-help text-secondary">
                                                <i class="fas fa-info-circle"></i></button>
                                        </div>
                                        <hr><em>total: <span class="badge badge-dark">1</span> pcs</em></td>
                                    <td class="pembayaran"><span id="status_pesan" class="d-block text-center border border-danger text-uppercase py-1 font-weight-bold rounded">Belum Lunas</span><span class="d-block text-right">harga produk : <span class="badge badge-info">Rp 295.000,-</span></span><span class="d-block text-right">tarif ongkir : <span class="badge badge-dark">Rp 17.000,-</span></span><span class="d-block text-right">wajib bayar : <span class="badge badge-success">Rp 312.000,-</span></span>
                                    </td>
                                    <td class="keterangan">
                                        <button class="btn btn-outline-info dropdown-toggle btn-sm mb-1 mr-1" type="button" data-toggle="collapse" data-target="#collapseKeterangan-35934" aria-expanded="false" aria-controls="collapseKeterangan-35934">
                                            <svg class="svg-inline--fa fa-scroll fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="scroll" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M48 0C21.53 0 0 21.53 0 48v64c0 8.84 7.16 16 16 16h80V48C96 21.53 74.47 0 48 0zm208 412.57V352h288V96c0-52.94-43.06-96-96-96H111.59C121.74 13.41 128 29.92 128 48v368c0 38.87 34.65 69.65 74.75 63.12C234.22 474 256 444.46 256 412.57zM288 384v32c0 52.93-43.06 96-96 96h336c61.86 0 112-50.14 112-112 0-8.84-7.16-16-16-16H288z"></path>
                                            </svg>
                                            <!-- <i class="fas fa-scroll"></i> -->Keterangan</button>
                                        <div class="collapse show" id="collapseKeterangan-35934">
                                            <p class="text-break" style="max-width:200px;">JNE Reg
                                                <br> _______________
                                                <br> Belum Transfer</p>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item active"><a class="page-link" href="#!"><span class="sr-only">(current)</span>1</a></li>
                        <li class="page-item"><a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=25" class="page-link" data-ci-pagination-page="2">2</a></li>
                        <li class="page-item"><a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=50" class="page-link" data-ci-pagination-page="3">3</a></li>
                        <li class="page-item">
                            <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=25" class="page-link" data-ci-pagination-page="2" rel="next">
                                <svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                </svg>
                                <!-- <i class="fas fa-angle-right"></i> --></a>
                        </li>
                        <li class="page-item">
                            <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=37350" class="page-link" data-ci-pagination-page="1495">
                                <svg class="svg-inline--fa fa-angle-double-right fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="angle-double-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"></path>
                                </svg>
                                <!-- <i class="fas fa-angle-double-right"></i> --></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php /* ?>

<?php echo $this->load->view("_inc/header", $judul, TRUE) ?>
<?php echo $this->load->view("_inc/".$include."/navbar", '', TRUE) ?>

        <div class="konten" id="konten">
            <div class="jumbotron jumbotron-fluid">
                <div class="container-fluid">
                    <h3><?php echo $judul; ?></h3>
                    <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
                </div>
            </div>

            <div class="px-sm-3">
                <?php 
                    echo form_open('', array('class' => 'form-inline px-3 px-sm-0', 'method' => 'get'));
                    // form pembayaran
                    $opsi_pembayaran = array(
                        ''              => 'Opsi Pembayaran',
                        'belum_transfer' => 'Belum Lunas',
                        'b_menunggu'    => 'Menuggu Konfirmasi',
                        'c_sebagian'    => 'Sebagian Lunas / Kredit',
                        'd_lunas'       => 'Lunas',
                        'e_lebih'       => 'Ada Kelebihan'
                    );
                    echo form_dropdown('cari[pembayaran]', $opsi_pembayaran, $this->input->get('cari[pembayaran]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                    
                    // form paket
                    $opsi_paket = array(
                        ''              => 'Opsi Paket',
                        'diproses'      => 'Diproses',
                        'belum_diproses' => 'Belum Diproses',
                        'batal_proses' => 'Dibatalkan'
                    );

                    echo form_dropdown('cari[paket]', $opsi_paket, $this->input->get('cari[paket]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                    
                    // form pengiriman
                    $opsi_pengiriman = array(
                        ''              => 'Opsi Pengiriman',
                        'belum_kirim'   => 'Belum Dikirim',
                        'd_sebagian'    => 'Dikirim Sebagian',
                        'dikirim'       => 'Dikirim',
                    );

                    echo form_dropdown('cari[pengiriman]', $opsi_pengiriman, $this->input->get('cari[pengiriman]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                    ?>

                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend"> 
                            <div class="input-group-text"> 
                                <?php 
                                if( $this->input->get('cari[cek_tanggal]') === 'ya' ) {
                                    $check_ = TRUE;
                                    $disable_ = array();
                                }
                                else {
                                    $check_ = FALSE;
                                    $disable_ = array('disabled' => '');
                                }

                                echo form_checkbox('cari[cek_tanggal]', 'ya', $check_);

                                $val_tgl = $this->input->get('cari[tanggal]');
                                if( ! isset($val_tgl)) {
                                    $val_tgl = mdate('%Y-%m-%d', now());
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            echo form_input(array_merge(array('class' => 'form-control', 'type' => 'date','name' => 'cari[tanggal]', 'placeholder' => 'tanggal data masuk'), $disable_), $val_tgl);
                        ?>
                    </div>

                    <div class="form-check mb-2 mr-sm-2">
                        <?php
                            if( $this->input->get('cari[marketplace]') === 'ya' ) {
                            $check_m = TRUE;
                        }
                        else {
                            $check_m = FALSE;
                        }
                        echo form_checkbox('cari[marketplace]', 'ya', $check_m, array('class' => 'form-check-input', 'id' => 'marketplace' ));
                        echo form_label('Marketplace?', 'marketplace');
                        ?>
                    </div>

                    <?php
                        echo form_input(array('class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'cari data','name' => 'cari[q]'), $this->input->get('cari[q]'));
                    ?>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                <?php echo form_close(); ?>
                <div id="main-table">
                    <div class="table-responsive" id="table-pesanan">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 120px">Faktur #</th>
                                    <th style="width: 120px">Juragan</th>
                                    <th style="width: 160px">Status</th>
                                    <th>Pemesan</th>
                                    <th style="min-width: 220px">Pesanan</th>
                                    <th style="width: 240px">Biaya</th>
                                    <th style="width: 200px">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($query->num_rows() > 0) { ?>
                                    <?php foreach ($query->result() as $pesanan) { 
                                    ?>
                                    <tr id="pesanan-<?php echo $pesanan->id_faktur; ?>">
                                        <td>
                                            <?php 
                                            echo strtoupper($pesanan->seri_faktur);
                                            echo '<span class="d-block"><abbr title="'.unix_to_human($pesanan->tanggal_dibuat).'"><i class="fas fa-calendar-day"></i> ' . mdate('%d-%M-%y', $pesanan->tanggal_dibuat) . '</abbr></span>';
                                            ?>
                                        </td>
                                        <td class="juragan">
                                            <div class="text-center">
                                                <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="status">
                                            <div class="text-center">
                                                <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<span class="font-weight-bold">' . strtoupper( $pesanan->nama ) . '</span><br/>';
                                            echo '<span class="badge badge-dark">' . $pesanan->hp1 . '</span>' . ($pesanan->hp2 !== NULL? '<span class="sr-only"> / </span><span class="ml-1 badge badge-dark">' . $pesanan->hp2 . '</span>': '') . '<br/>';
                                            echo nl2br(strtoupper($pesanan->alamat));
                                            ?>
                                        </td>
                                        <td class="pesanan">
                                            <div class="text-center">
                                                <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>                                  
                                        </td>
                                        <td class="pembayaran">
                                            <div class="text-center">
                                                <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="keterangan">
                                            <div class="text-center">
                                                <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="7" class="table-warning text-center">Data tidak ada</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>

    </div>
</div>

<?php echo $this->load->view("_inc/".$include."/js-global", '', TRUE); ?>
<?php echo $this->load->view("_inc/".$include."/js-pesanan", '', TRUE); ?>
<?php echo $this->load->view("_inc/footer", '', TRUE); ?>

<?php */ ?>