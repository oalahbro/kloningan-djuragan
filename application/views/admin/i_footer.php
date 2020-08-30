<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	</div>

	<!-- Bootstrap and necessary plugins -->
	<script src="<?php echo base_url('assets/js/tether.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

	<script type="text/javascript">
		$(".openNav").click(function(){
			// $("body").addClass("sidebar-hidden");
			$( "body" ).toggleClass( "sidebar-hidden" );
			$( ".sidebar-toggler" ).toggleClass( "is-active" );
		}); 

	</script>
</body>
</html>