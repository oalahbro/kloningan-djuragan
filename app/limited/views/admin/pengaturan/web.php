<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="" id="utamaSetting">
	<div class="page-header">
		<h1>Pengaturan</h1>
	</div>

	<div class="utama">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<?php echo form_open(); ?>
						<div class="form-group">
							<label for="exampleInputEmail1">Kurir</label>
							<?php 
							$kurir_list = json_decode($this->config->item('list_kurir'));
							$dlk = '';
							$i = 1;
							foreach ($kurir_list as $x) {
								$dlk .= $x . (count($kurir_list) === $i ? '': "\n");
								$i++;
							}

							echo form_textarea(array('rows' => 7, 'class' => 'form-control', 'name' => 'kurir'), $dlk)
							?>
							<p class="help-block"><em>Masukkan data perbaris menggunakan <kbd>enter</kbd>.</em></p>
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Size</label>
							<?php 
							$size_list = json_decode($this->config->item('list_size'));
							$sl = '';
							$i = 1;
							foreach ($size_list as $x) {
								$sl .= $x . (count($size_list) === $i ? '': "\n");
								$i++;
							}

							echo form_textarea(array('rows' => 7, 'class' => 'form-control', 'name' => 'size'), $sl)
							?>
							<p class="help-block"><em>Masukkan data perbaris menggunakan <kbd>enter</kbd>.</em></p>
						</div>


						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$.getMultiScripts = function(arr, path) {
			var _arr = $.map(arr, function(scr) {
				return $.getScript( (path||"") + scr );
			});

			_arr.push($.Deferred(function( deferred ){
				$( deferred.resolve );
			}));

			return $.when.apply($, _arr);
		}

		var script_arr = [
		'<?php echo base_url('assets/js/bootstrap.min.js'); ?>', 
		'<?php echo base_url('assets/js/pace.min.js'); ?>'
		];

		$.getMultiScripts(script_arr).done(function() {
            // all scripts loaded
             $('.deropdowen').dropdown();
        });
	});
</script>