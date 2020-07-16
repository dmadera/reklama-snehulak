$(function() {
    $('.button-add').click(function() {
        const form = $(this).parent('form');
        form.find('input[type="file"]').trigger('click');
        form.find('input[type="file"]').change(function(e) {
            if (this.value != "") {
                form.submit();
            }
        });
    });
});