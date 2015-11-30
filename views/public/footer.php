<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * public/footer.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		1.x.x
 */

?>
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	
	<script>
		$(".alert").fadeTo(3000, 500).slideUp(500, function(){
			$(".alert").alert('close');
		});
		setInterval("my_function();",10000);
		function my_function(){
			$('#bs-example-navbar-collapse-1').load(location.href + ' #menus');
		}
	</script>
</body>
</html>