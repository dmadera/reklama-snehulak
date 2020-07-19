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

    var check_drop = function(source, reps, obj) {
        const regex = /img-([0-9]+)-[0-9]+\.jpg/;
        const found = source.match(regex);
        return $(obj).attr('droppable') == "true" || found[1] >= reps;
    }

    $('.drop').on('dragover', function(event) {
        event.preventDefault();
        const source = event.originalEvent.dataTransfer.getData("source");
        const reps = event.target.attributes['data-reps'].value;
        if (!check_drop(source, reps, this)) return;
        $(this).addClass("hover");
    });

    $('.drop').on('dragleave', function(event) {
        event.preventDefault();
        const source = event.originalEvent.dataTransfer.getData("source");
        const reps = event.target.attributes['data-reps'].value;
        if (!check_drop(source, reps, this)) return;
        $(this).removeClass("hover");
    });

    $('.drop').on('drop', function(event) {
        event.preventDefault();
        const source = event.originalEvent.dataTransfer.getData("source");
        const reps = event.target.attributes['data-reps'].value;
        const position = event.target.attributes['data-position'].value;
        if (!check_drop(source, reps, this)) return;
        $form = $('<form>', { "method": "POST", "action": "copy-handle.php", "enctype": "multipart/form-data" });
        $form.append($("<input>", { "type": "hidden", "name": "reps", "value": reps }));
        $form.append($("<input>", { "type": "hidden", "name": "position", "value": position }));
        $form.append($("<input>", { "type": "hidden", "name": "source", "value": source }));
        $('body').append($form);
        $form.submit();
    });

    $('.thumbnail img').on('dragstart', function(event) {
        event.originalEvent.dataTransfer.setData("source", event.target.attributes.alt.value);
    });
});