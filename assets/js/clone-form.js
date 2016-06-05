$(function () {
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value

        newElem.find('.kode').attr('id', 'kode' + newNum).val('');
        newElem.find('.size').attr('id', 'kode' + newNum);
        newElem.find('.jumlah').attr('id', 'jumlah' + newNum).val('');

        $('#entry' + num).after(newElem);
        $('#kode' + newNum).focus();

        $('#btnDel').addClass('show').fade('slow');

        if (newNum == 5)
        $('#btnAdd').attr('disabled', true).html('Udah Mentok bos'); // value here updates the text in the 'add' button when the limit is reached 
    });

    $('#btnDel').click(function () {
        if (confirm("Yakin form terakhir mau dihapus ?")) {
                var num = $('.clonedInput').length;
                $('#entry' + num).slideUp('slow', function () {$(this).remove();
                    if (num -1 === 1)
                $('#btnDel').addClass('hide').removeClass('show');
                $('#btnAdd').attr('disabled', false).html('<i class="glyphicon glyphicon-plus"></i>');});
            }
        return false;
    });
    $('#btnAdd').attr('disabled', false);
    $('#btnDel').addClass('hide');
});