/**
 * Created by Sangkuriang on 2/3/14.
 */
/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Layanan = (function(LAY) {

    LAY.Index = function() {
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

    LAY.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        /*
         * Trigger Submit Form
         */
        jQuery('button#submit').on('click', function() {
            jQuery('#layanan-form').submit();
        });

//        getSubmenu(null);
//        jQuery("#submenu option").val(submenus());
//        jQuery('#submenu').disabled();

        jQuery('#menu').live('change',function(e){
            var menu_id = e.target.value;
            getSubmenu(menu_id);
//            alert(menu_id);
        });

        var rules = {
            'layanan[judul_berita]': 'required',
//            'layananlembaga[berita]': 'required',
            'layanan[penanggung_jawab]': 'required'
//            'layananl[image]': 'required'
        };

        jQuery("#layanan_form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'layanan[judul_berita]': 'Judul Berita tidak boleh kosong!',
//                'layananlembaga[berita]': 'Isi Berita tidak boleh kosong!',
                'layanan[penanggung_jawab]': 'Nama Penanggung Jawab wajib diisi.'
//                'layananlembaga[image]': 'Gambar wajib diisi.'
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

        function getSubmenu(menu_id) {
            jQuery.getJSON(baseUrl + "/admin/submenus", {menu_id: menu_id}, function(data) {
                jQuery("#submenu")
                    .empty()
                    .append(jQuery("<option></option>", {
                        text: "-- Pilih Submenu --",
                        value: ""
                    }));
                jQuery.each(data.data, function(i, e) {
                    console.log(e);
                    jQuery("#submenu").append(jQuery("<option></option>", {
                        value: e.id,
                        text: e.nama_submenu
                    }));
                });
            });
        }



    };

    return LAY;
}(Layanan || {}));