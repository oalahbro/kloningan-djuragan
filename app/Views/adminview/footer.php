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

		$('#editJuragan').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var id = button.data('id')
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Sunting ' + recipient)
			modal.find('.modal-body input[name="nama"]').val(recipient)
			modal.find('.modal-body input[name="id"]').val(id)
		});

		$('body').popover(popOverSettings);
	</script>

  </body>
</html>