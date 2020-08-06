<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Update</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

<?php 
echo form_open();
foreach ($q->result() as $key) { 
echo form_hidden('id[]' ,$key->id);

$kodes = str_replace('(', ',', $key->kode);
$kodes2 = str_replace(')', ',', $kodes);

$kode = str_replace(' ', ',', $kodes2) . ',' . $key->jumlah;
	?>

<div class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Kode</label>
    <?php echo form_input(array('name' => 'kode[]', 'class' => 'form-control'), $key->kode ) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Pesanan</label>
    <?php echo form_textarea(array('name' => 'pesanan[]', 'class' => 'form-control', 'rows' => '2'), reduce_multiples($kode,',') ) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">keterangan</label>
    <?php echo form_textarea(array('name' => 'keterangan[]', 'class' => 'form-control', 'rows' => '3'), $key->keterangan ) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputName2">Jumlah</label>
    <?php echo form_input(array('name' => 'jumlah[]', 'class' => 'form-control'), $key->jumlah ) ?>
  </div>
  </div>
  <hr/>

<?php 
	
}
echo form_button(array('type' => 'submit', 'content' => 'update', 'class' => 'btn  btn-primary'));
echo form_close();

?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
  </body>
</html>