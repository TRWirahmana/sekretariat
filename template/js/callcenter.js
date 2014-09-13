var callcenter = (function(REG) {

    REG.Form = function() {
    	$('button#submit').on('click', function() {
            $('#callcenter-form').submit();
        });

        var rules = {
            'telp': 'required',
            'email': {
                    required: true,
                    email: true
                }
            };

       $("#callcenter-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'email': {
                    required: 'Email wajib diisi.'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('div.controls'));
            },
            invalidHandler: function(event, validator) {
                $("div.control-group.error").removeClass('error');
                $('div.controls .error[name]').parents('div.control-group').addClass('error');
            },
            onfocusout: function(elem, event) {
                $(elem).validate();
                $controlGroup = $(elem).parents('div.control-group');
                if($(elem).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
            }
        });

	    };	
 
    return REG;
}(callcenter || {}));
