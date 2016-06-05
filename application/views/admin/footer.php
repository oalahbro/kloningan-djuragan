<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?></div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>

	<script type="text/javascript">
		(function ($) {
			setInterval(function() {
		        $(".bootstrap-flash").fadeOut("slow", function() {
	                $( 'div' ).remove('.bootstrap-flash');
	            })
		    }, 5000);

			<?php $date_today = mdate("%Y-%m-%d", now()); ?>
			$('#fn').datetimepicker({
		    	pickTime: false,
		    	maxDate: new Date("<?php echo $date_today; ?>"),
		    	showToday: true,
		    	useCurrent: false
		    });
			$("input#fn").bind("keyup", function(e) {
				clearTimeout($.data(this, 'timer'));
				var search_string = $(this).val();
				if (search_string === '') {
					showValues( );
					//return false;
				} else {
					showValues( );
					return false;
					$(this).data('timer', setTimeout(search, 100));
				};
			});

			$( "#search-btn" ).bind( "click", function( event ) {
				showValues( );
				return false;
			});

			$(function() {
				showValues( );
			});

			function showValues() {
				var cari = form.name.value;
				$( '#daftar_pesanan' ).html('<div class="progress jadi-loading"><div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Loading ....</div></div>');
				$( '#daftar_pesanan' ).load( '<?php echo site_url('admin/pesanan/read_ajax/' . $juragan . '/' . $status) ?>', 'submit=yes&cari='+ cari).hide().fadeIn('slow');
			}
		})(jQuery);
	</script>
	
</body>
</html>