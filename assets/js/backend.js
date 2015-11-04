(function(){
    "use strict";
    function getWebTitle(title){
        title = title.replace(/\s/g, '-');
        title = title.replace(/[^\w\-~\.]/g, '');
        title = title.replace(/\-{2,}/g, '');
        title = title.replace(/^-+/, '');
        title = title.replace(/-+$/, '');
        title = title.toLowerCase();

        return title;
    }

    // Give a preview of the url.
    $('#title').on('keydown input', function(){
        $('#title-preview').text(getWebTitle($(this).val()));
    });

    $('.btn-danger').click(function(e){
        var confirm = window.confirm('Weet u het zeker?');

        return confirm ? null : e.preventDefault();
    });

    // Confirm navigation
    var changed = false;
    $('form').submit(function(){
        // Remove navigate check
        window.onbeforeunload = null;
    }).find('input').one('input', function(){
        changed = true;
    });

    window.onbeforeunload = function(){
        if(changed){
            return 'De wijzigingen gaan verloren als u niet eerst opslaat.'
        }
    }

    $(".remote-submit").click(function(){
        $("#signups-form").submit();
    });

    $('.toggle-all').click(function(){
        $(this).parents('form')
            .find('input[type="checkbox"]')
            .prop("checked", $(this).prop("checked"));
    });
})();