/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin repo: https://github.com/tristandenyer/Clone-section-of-form-using-jQuery
*/
$(function () {
	$('#btnAdd_2').click(function () {
		var num     = $('.clonedInput_2').length,
		newNum  = new Number(num + 1), 
		maxNum  = 2,
		newElem = $('#phone' + num).clone().attr('id', 'phone' + newNum).fadeIn('slow');

		newElem.find('.number_phone').attr('id', 'ID' + newNum + '_phone_number').attr('name', 'ID' + newNum + '_phone_number').val('');

		$('#phone' + num).after(newElem);
		$('#ID' + newNum + '_title').focus();

		$('#btnDel_2').attr('disabled', false).show('slow');

		if (newNum == maxNum)
			$('#btnAdd_2').attr('disabled', true).hide('slow');
	});

	$('#btnDel_2').click(function () {
		if (confirm("Kamu yakin akan menghapus kolom HP ?")) {
			var num = $('.clonedInput_2').length;
			$('#phone' + num).slideUp('slow', function () {
				$(this).remove();
				if (num -1 === 1)
					$('#btnDel_2').attr('disabled', true).hide('slow');
				$('#btnAdd_2').attr('disabled', false).show('slow');
			});
		}
		return false;
	});
	$('#btnAdd_2').attr('disabled', false).show('slow');
	$('#btnDel_2').attr('disabled', true).hide('slow');


	///////////////////// PESANAN /////////////////////

	$('#btnAdd').click(function () {
		var num     = $('.clonedInput').length,
			newNum  = new Number(num + 1),
			newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow');

		$('#entry' + num).after(newElem);
		$('#btnDel').attr('disabled', false).show('slow');

		newElem.find('.select_ttl').attr('id', 'ID' + newNum + '_title').attr('name', 'ID' + newNum + '_title').val('');

		/*
		if (newNum == 5)
			$('#btnAdd').attr('disabled', true).hide('slow');
		*/
	});

	$('#btnDel').click(function () {
		if (confirm("Are you sure you wish to remove this section? This cannot be undone.")) {
			var num = $('.clonedInput').length;
			$('#entry' + num).slideUp('slow', function () {
				$(this).remove();

				if (num -1 === 1)
					$('#btnDel').attr('disabled', true).hide('slow');

				$('#btnAdd').attr('disabled', false).show('slow');
			});
		}
		return false;
	});

	$('#btnAdd').attr('disabled', false).show('slow');
	$('#btnDel').attr('disabled', true).hide('slow');
});