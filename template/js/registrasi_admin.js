/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Admin = (function(ADM) {

    ADM.Index = function() {
        /* Filter Daerah Registrasi */
        jQuery('#filter-registrasi').on('change', function() {
            var $this = jQuery(this);
            if($this.val() != '') {
                var ACTION = baseUrl + '/Manage?rid=' + $this.val();
                // console.log(ACTION);
                window.location = ACTION;
            }
        });
    };

    ADM.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        jQuery('#bagian').live('change',function(e){
            var bagian_id = e.target.value;
            getSubbagian(bagian_id);
//            alert(menu_id);
        });

        /*
         * Trigger Submit Form
         */
        jQuery('button#submit').on('click', function() {
            jQuery('#reg_admin_a').submit();
        });

        var rules = {
            'nip': 'required',
            'nama_lengkap': 'required',
            'password': 'required',
//            'bagian': 'required',
//            'sub_bagian': 'required',
            'password_confirmation': 'required',
            'email': {
                required: true,
                email: true
            }
        };

        jQuery("#reg_admin").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'password': 'Password tidak boleh kosong!.',
                'password_confirmation': 'Konfirmasi Password wajib diisi!.',
                'nama_lengkap': 'Nama lengkap wajib diisi.',
                'nip': 'NIP wajib diisi.',
                'email': {
                    required: 'Alamat E-Mail wajib diisi.',
                    email: 'Format email tidak benar'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('div.controls'));
            },
            invalidHandler: function(event, validator) {
                jQuery("div.control-group.error").removeClass('error');
                jQuery('div.controls .error[name]').parents('div.control-group').addClass('error');
            },
            onfocusout: function(elem, event) {
                jQuery(elem).validate();
                $controlGroup = jQuery(elem).parents('div.control-group');
                if(jQuery(elem).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
            }
        });


        function getSubbagian(bagian_id) {
            jQuery.getJSON(baseUrl + "/admin/subbagians", {bagian_id: bagian_id}, function(data) {
                jQuery("#sub_bagian")
                    .empty()
                    .append(jQuery("<option></option>", {
                        text: "-- Pilih Sub Bagian --",
                        value: ""
                    }));
                jQuery.each(data.data, function(i, e) {
//                    console.log(e);
                    jQuery("#sub_bagian").append(jQuery("<option></option>", {
                        value: e.id,
                        text: e.nama_sub_bagian
                    }));
                });
            });
        }

    };

    return ADM;
}(Admin || {}));