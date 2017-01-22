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
    .dataTables_filter {
        display: none;
    }
</style>
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
            <div class="row">
                <div class="col">

                    <div class="card">
                        <div class="card-header">
                            User Baru
                        </div>
                        <div class="card-block">
                        <div class="row">
                                <div class="col">
                                    <select name='length_change' id='length_change' class="form-control">
                                        <option value='5'>5 data</option>
                                        <option value='25' selected="">25 data</option>
                                        <option value='50'>50 data</option>
                                        <option value='75'>75 data</option>
                                        <option value='100'>100 data</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="cari data" id="myInputTextField">
                                        <span id="searchclear" class="icon-close"></span>
                                    </div>
                                </div>
                            </div>
                            <table id="userbaru" class="table table-border table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Daftar</th>
                                        <th>Login</th>                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col">

                    <div class="card">
                        <div class="card-header">
                            User Aktif
                        </div>
                        <div class="card-block">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat.
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!-- /.conainer-fluid -->
    </main>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="http://localhost/dataTabls-css-for-bootstrap4/dataTables.bootstrap4.js"></script>

     <script type='text/javascript'>//<![CDATA[
        window.onload=function(){
            $(document).ready(function() {

                var oldStart = 0;
                var oTable = $('#userbaru').DataTable({
                    "serverSide": true,
                    "ordering": false,
                    "ajax": "<?php echo site_url('json/pengguna/baru/'); ?>",
                    "columns": [
                        {
                            "data": "id",
                            /*"createdCell": function (td, cellData, rowData, row, col) {
                                if ( rowData.tanggal.cek_kirim == null ) {
                                    $(td).addClass('bg-warning')
                                }
                            }*/
                        },
                        { "data": "nama" },
                        { "data": "username" },
                        { "data": "email" },
                        { "data": "daftar" },
                        { "data": "login" }
                    ],
                    "bLengthChange": false,
                    "pageLength": 25,
                    "fnDrawCallback": function (o) {
                        if ( o._iDisplayStart != oldStart ) {
                            var targetOffset = $('#userbaru').offset().top;
                            $('html,body').animate({scrollTop: targetOffset}, 500);
                            oldStart = o._iDisplayStart;
                        }
                    }
                });

                $('#searchclear').hide();
                $("#searchclear").click(function(){
                    $("#myInputTextField").val('');
                    $(this).hide();
                    oTable.search('').draw();
                });

                $('#myInputTextField').bind('keyup',function(){
                    oTable.search($(this).val()).draw() ;

                    if( ! $(this).val()){
                        $('#searchclear').hide();
                    }
                    else {
                        $('#searchclear').show();
                    }
                });

                $('#length_change').change( function() { 
                    oTable.page.len( $(this).val() ).draw();
                });

            } );

        }//]]> 
    </script>
