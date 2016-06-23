<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>

	<script type="text/javascript">
		(function ($) {
			$('.subnav').affix({
				offset: {
					top: $('.page-header').height()
				}
			});	

			setInterval(function() {
		        $(".bootstrap-flash").fadeOut("slow", function() {
	                $( 'div' ).remove('.bootstrap-flash');
	            })
		    }, 5000);

		})(jQuery);
	</script>
	
</body>
</html>