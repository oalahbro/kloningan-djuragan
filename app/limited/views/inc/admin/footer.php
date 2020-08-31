	<div id="manual"></div>
	<footer>
		<div class="containet-fluid">
			<div class="credit">
				<?php $year = mdate("%Y", now()); $year_plus = ''; if($year > 2014) {$year_plus = ' - '. $year; } echo '&copy; 2014'. $year_plus . ' ' . title('name'); ?> <?php echo '<span class="text-muted">by Toto</span>'; ?>
			</div>
		</div>
	</footer>
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>
	
	<script type="text/javascript">
<?php if(is_login()) { $bulan_today = mdate("%Y-%m", now()); $date_today = mdate("%Y-%m-%d", now());?>
	(function ($) {
		$('.manual').click(function(event) {
			event.preventDefault();
			var ID = $(this).attr('id');
			$("#manual").load(this.href, { id: ID }); 
		});
		$(".alert").fadeTo(3000, 500).slideUp(500, function(){
			$(".alert").alert('close');
		});
		$('.btn-remove-kurir').click(function(event){
			event.preventDefault();
			var UID = $(this).attr('id');
			var data = 'kurir';

			hapus_modal(UID, data);
		});
		$('.btn-remove-size').click(function(event){
			event.preventDefault();
			var UID = $(this).attr('id');
			var data = 'size';
			
			hapus_modal(UID, data);
		});

		function hapus_modal(UID, data)
		{
			$( "span.delid" ).text( UID );
			$( "input[name=id]" ).val( UID );
			$( "input[name=data]" ).val( data );

			$('#hapus_alert').modal({
				show: true
			});
		}
		$('.enable').click(function(){
		   $('input.disable').attr('readonly',!this.checked)
		});

	    $('#datetimepicker9').datetimepicker({
	    	pickTime: false,
	    	maxDate: new Date("<?php echo $date_today; ?>")
	    });
	    $('#datetimepicker10').datetimepicker({
	    	pickTime: false,
	    	maxDate: new Date("<?php echo $date_today; ?>")
	    });
	    $("#datetimepicker9").on("dp.change",function (e) {
	       $('#datetimepicker10').data("DateTimePicker").setMinDate(e.date);
	    });
	    $("#datetimepicker10").on("dp.change",function (e) {
	       $('#datetimepicker9').data("DateTimePicker").setMaxDate(e.date);
	    });
	<?php $url = $this->uri->segment(2);
	if(empty($url) || $url === 'index' ) {
		$date_today = mdate("%Y-%m-%d", now());
	?>
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
			$( '#loader' ).html('<p class="text-center"><img src="<?php echo base_url('assets/img/loading.gif') ?>" /></p>');
			$( '#loader' ).load( '<?php echo site_url('administrator/lihat_data/'.$halaman .'/'.$juragan) ?>', 'submit=yes&juragan=<?php echo $juragan ?>&cari='+ cari).hide().fadeIn('slow');
		}
	<?php } elseif($url === 'tambah' || $url === 'tambah_member'  || $url === 'edit_pesanan') {?>
	  		var typeaheadSettings = {
		  		source: function (typeahead, query) {
		  			return <?php echo json_encode(get_product()); ?> ;
		  		},
		  		items: 12
		  	};

		  	$('.kode').typeahead(typeaheadSettings); /* init first input */

	  		$(function () {
	  			var addFormGroup = function (event) {
	  				event.preventDefault();

	  				var $formGroup = $(this).closest('.entry');
	  				var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
	  				var $formGroupClone = $formGroup.clone();

	  				$(this)
	  				.toggleClass('btn-default btn-add btn-danger btn-remove')
	  				.html('<i class="glyphicon glyphicon-minus"></i>');

	  				var $lastFormGroupLast = $multipleFormGroup.find('.entry:last');
	  				if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
	  					$lastFormGroupLast.find('.btn-add').attr('disabled', true);
	  				}

	  				$formGroupClone.find('input').val('');
	  				$formGroupClone.insertAfter($formGroup);
	  				$('.kode').trigger('added');
	  			};

	  			var removeFormGroup = function (event) {
	  				event.preventDefault();

	  				var $formGroup = $(this).closest('.entry');
	  				var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

	  				var $lastFormGroupLast = $multipleFormGroup.find('.entry:last');
	  				if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
	  					$lastFormGroupLast.find('.btn-add').attr('disabled', false);
	  				}

	  				$formGroup.remove();
	  			};

	  			var countFormGroup = function ($form) {
	  				return $form.find('.multiple-form-group').length;
	  			};

	  			$(document).on('click', '.btn-add', addFormGroup);
	  			$(document).on('click', '.btn-remove', removeFormGroup);
	  		});

			$('.kode').on('added', function () {
				$('.kode').typeahead(typeaheadSettings);
			});
	<?php } ?>
	})(jQuery);
	setInterval("my_function();",10000);
	function my_function(){
		$('#menu_navbar').load(location.href + ' #menus');
	}
<?php } ?>
	</script>
</body>
</html>