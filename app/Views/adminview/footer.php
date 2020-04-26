			</div>
		</div>
	</div>
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script defer src="https://kit.fontawesome.com/859e035253.js" data-auto-replace-svg="nest" crossorigin="anonymous"></script>

	<script type="text/javascript">
		var popOverSettings = {
			trigger: 'focus',
		    placement: 'right',
		    container: 'body',
			html: true,
		    selector: '[data-toggle="popHarga"]',
			template: '<div class="popover shadow" role="tooltip"><div class="arrow"></div><div class="popover-body"></div></div>'
		}

		$('body').popover(popOverSettings);
	</script>

  </body>
</html>