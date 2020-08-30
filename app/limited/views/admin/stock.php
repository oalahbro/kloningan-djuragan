<?php
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
?>
=======
?>

<div class="content-full">
	<iframe class="" src="https://docs.google.com/spreadsheet/pub?key=0Au7cP9NP6Bs-dE94V0ktRVZqNzk5Mi03azlhVUdkZGc&output=html&widget=true"></iframe>
</div>



<script type="text/javascript">
	scaleVideoContainer();

	function scaleVideoContainer() {
		var navbarHeight = $('.navbar').height() + 10 + 'px',
			height = $(window).height() - $('.navbar').height() -10,
			unitHeight = parseInt(height) + 'px';

		$('.content-full iframe').css({
			'margin-top': navbarHeight,
			'height': unitHeight,
			'width': '100%'
		});

		$('body').css('overflow','hidden');
	}
</script>
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
