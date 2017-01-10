<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	#searchclear {
    position: absolute;
    right: 25px;
    top: 10px;
    cursor: pointer;
    color: #ccc;
}
#searchclear:hover {
	color: #222;
}

</style>
    <!-- Main content -->
    <main class="main">
    	<ol class="breadcrumb" id="tableH">
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
        		<div class="card-block">
	        		<div class="row">
	        			<div class="col-sm-2">
	        				<select name='length_change' id='length_change' class="form-control">
		        				<option value='5'>5 data</option>
		        				<option value='25' selected="">25 data</option>
	        					<option value='50'>50 data</option>
	        					<option value='75'>75 data</option>
	        					<option value='100'>100 data</option>
	        				</select>
	        			</div>
	        			<div class="col-sm-3 offset-sm-7">
		        			<div class="form-group">
		        				<input type="text" class="form-control" placeholder="cari data" id="myInputTextField">
		        				<span id="searchclear" class="icon-close"></span>
	        				</div>
	        			</div>
	        		</div>
        			<table id="example" class="table table-border table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Juragan</th>
								<th>Tanggal</th>
								<th>Pemesan</th>
								<th>Pesanan</th>
								<th>Biaya</th>
								<th>Keterangan</th>
								<th>Resi</th>
								
							</tr>
						</thead>
					</table>
        		</div>
        	</div>


        </div>
        <!-- /.conainer-fluid -->
    </main>


   