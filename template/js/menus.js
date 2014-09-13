/**
 * Created by Sangkuriang on 2/3/14.
 */
/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Menu = (function(MNU) {

    MNU.Index = function() {
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

    MNU.Form = function() {

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
            jQuery('#form_menu').submit();
        });

        var rules = {
            'judul': 'required',
            'berita': 'required',
            'penulis': 'required',
            'gambar': 'required'
        };

        jQuery("#form_menu").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'judul': 'Judul Berita tidak boleh kosong!',
                'berita': 'Isi Berita tidak boleh kosong!',
                'penulis': 'Nama Penulis wajib diisi.',
                'gambar': 'Gambar wajib diisi.'
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

        /*
         * Add Submenu
         */
        jQuery('#add-submenu').on('click', function() {
            var $this = jQuery(this);
            $this.prev('.block-submenu').clone().insertBefore($this);
            ReIndexSubMenu();

            $parent = jQuery("#submenus");
            // Cleare textbox
            $parent.find('.submenu:last').val('');
        });

        jQuery(document).on('click', '.delete_submenu', function(){
            if(jQuery("#submenus .block-submenu").length == 1) {
                var $parent = jQuery('#submenus');
                // Cleare textbox
                $parent.find('.submenu:last').val('');

                return;
            }

            jQuery(this).parents('.block-submenu').remove();
            ReIndexSubMenu();
        });

        /*
         * Re Index Dom Sub Menu
         */
        function ReIndexSubMenu() {
            var $parent = jQuery('#submenus');
            $parent.find('.block-submenu').each(function(i) {
                var $this = jQuery(this);
                $this.find('.label-subject').html('Sub Menu (' + (i + 1) + ') <a class="delete_submenu">Hapus</a>');
                $this.find('.submenu').attr('name', 'submenu[' + i + '][nama_submenu]');
            });

        }

    };

    return MNU;
}(Menu || {}));