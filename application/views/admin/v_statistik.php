<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- Main content -->
    <main class="main">
    	<ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <?php 
            $i = 0;
            $act = '';
            foreach ($breadcrumb as $key => $value) {
            	$i++;
            	if($i === count($breadcrumb)) {
            		$act = ' active';
            	}
            	echo '<li class="breadcrumb-item' . $act . '">'.anchor($key, $value).'</li>';
            }
            ?>
        </ol>

        <div class="container-fluid">

        	<div class="card">
        		<div class="card-header">
        			Card title
        		</div>
        		<div class="card-block">
        			Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
        			ea commodo consequat.
        		</div>
        	</div>


        </div>
        <!-- /.conainer-fluid -->
    </main>
