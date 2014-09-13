/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Registrasi = (function(REG) {

    REG.Index = function() {
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

    REG.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        jQuery("#status").change(function(e){
            if(parseInt(jQuery(this).val()) == 1) {
                jQuery("#surat_ijin_keluarga_group").prop("disabled", false).show();
            } else {
                jQuery("#surat_ijin_keluarga_group").prop("disabled", true).hide();
            }
        });

        jQuery("#status").change();

        jQuery.ajax()

        jQuery("#umur").val(calculateAge());
        jQuery("#tahun_lahir,#bulan_lahir,#tanggal_lahir").change(function(){
            $("#umur").val(calculateAge());
        });




        /*
         * Trigger Submit Form
         */

        jQuery('button#submit').click(function() {
//            alert("test");
//            $.ajax({
//                type: "POST",
//                dataType: "json",
//                url: baseUrl + "/captcha",
//                success: function (d) {
//                    alert(d);
//                    // replace div's content with returned data
////                $('#loading').html(d);
//                }
//            });

            $('#registrasi-form').submit();
        });

//        jQuery('button#submit').on('click', function() {
//            $('#registrasi-form').submit();
//        });


        var rules = {
                'nama_lengkap': 'required',
                'password': 'required',
                'password_confirmation': {
                    required: true
//                    equalTo: '#password'
                },
                'email': {
                    required: true,
                    email: true
                },
                'unit_kerja': 'required',
                'tlp_kantor': {
                    required: true
                },
                'handphone': {
                    required: true
                },
                'nip': {
                    required: true,
                    number: true
                },
                'jabatan': {
                    required: true
                },
                'bagian': {
                    required: true,
                    number: true
                },
                'sub_bagian': {
                    required: true,
                    number: true
                },
                'tgl_lahir': {
                    required: true,
                    date: true
                },
                'pekerjaan': {
                    required: true
                },
                'alamat_kantor': {
                    required: true
                },
                'captcha': {
                    required: true
                }


            };

        if(jQuery("#lampiran_foto").length != 0) rules.foto.required = false;
        if(jQuery("#lampiran_ijazah").length != 0) rules.ijazah_terakhir.required = false;
        if(jQuery("#lampiran_transkrip").length != 0) rules.transkrip_nilai.required = false;
        if(jQuery("#lampiran_ktp").length != 0) rules.ktp.required = false;
        if(jQuery("#lampiran_lamaran").length != 0) rules.lamaran.required = false;
        if(jQuery("#lampiran_cv").length != 0) rules.cv.required = false;
        if(jQuery("#lampiran_ket_sehat").length != 0) rules.ket_sehat.required = false;
        if(jQuery("#lampiran_ket_bebas_narkoba").length != 0) rules.ket_bebas_narkoba.required = false;
        if(jQuery("#lampiran_skck").length != 0) rules.ket_catatan_kepolisian.required = false;
        if(jQuery("#lampiran_sik").length != 0) rules.surat_ijin_keluarga.required = false;

        jQuery("#user-register-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'password': 'Password tidak boleh kosong!.',
                'password_confirmation': {
                    required: 'Konfirmasi Password wajib diisi!.'
//                    equalTo: 'Konfirmasi password tidak sesuai.'
                },
                'nama_lengkap': 'Nama lengkap wajib diisi.',
                'tgl_lahir': 'Tanggal lahir wajib diisi.',
                'email': {
                    required: 'Alamat E-Mail wajib diisi.',
                    email: 'Format email tidak benar'
                },
                'alamat_kantor': "Alamat kantor wajib diisi.",
                'unit_kerja': 'Unit Kerja wajib diisi',
                'tlp_kantor': {
                    required: 'Nomor telepon wajib diisi.',
                },
                'handphone': {
                    required: 'Nomor handphone wajib diisi.',
                },
                'pekerjaan': {
                    required: 'Pekerjaan wajib diisi.'
                },
                'sub_bagian': {
                    required: 'Sub Bagian wajib diisi.'
                },
                'bagian': {
                    required: 'Bagian wajib diisi.'
                },
                'jabatan': {
                    required: 'Jabatan wajib diisi.'
                },
                'nip': {
                    required: 'NIP wajib diisi.'
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

        jQuery("#registrasi-form input[type='file']").change(function(e){
            jQuery(this).validate();
                $controlGroup = jQuery(this).parents('div.control-group');
                if(jQuery(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })

        /*
         * Add Karir
         */
        jQuery('#add-karir').on('click', function() {
            var $this = jQuery(this);
            $this.prev('.block-karir').clone().insertBefore($this);
            ReIndexKarir();

            $parent = jQuery("#karir");
                // Cleare textbox
            $parent.find('.perusahaan:last').val('');
            $parent.find('.jabatan:last').val('');
            $parent.find('.uraian_singkat:last').val('');
            $parent.find('.karir_bulan_awal:last').val('');
            $parent.find('.karir_tahun_awal:last').val('');
            $parent.find('.karir_bulan_akhir:last').val('');
            $parent.find('.karir_tahun_akhir:last').val('');
        });
        /*
         * Add Organisasi
         */
        jQuery('#add-organisasi').on('click', function() {
            var $this = jQuery(this);
            $this.prev('.block-organisasi').clone().insertBefore($this);
            ReIndexOrganisasi();

            var $parent = jQuery('#pengalaman-organisasi');
             // Cleare textbox
            $parent.find('.org_organisasi:last').val('');
            $parent.find('.org_jabatan:last').val('');
            $parent.find('.org_uraian_singkat:last').val('');
            $parent.find('.org_karir_bulan_awal:last').val('');
            $parent.find('.org_karir_tahun_awal:last').val('');
            $parent.find('.org_karir_bulan_akhir:last').val('');
            $parent.find('.org_karir_tahun_akhir:last').val('');
        });
        /*
         * Add Organisasi
         */
        jQuery('#add-prestasi').on('click', function() {
            var $this = jQuery(this);
            $this.prev('.block-prestasi').clone().insertBefore($this);
            ReIndexPrestasi();

            var $parent = jQuery("#prestasi");

            $parent.find('.nama_prestasi:last').val('');
            $parent.find('.tahun_prestasi:last').val('');
        });

        jQuery(document).on('click', '.delete_karir', function(){
            if(jQuery("#karir .block-karir").length == 1) {
                $parent = jQuery("#karir");
                // Cleare textbox
                $parent.find('.perusahaan:last').val('');
                $parent.find('.jabatan:last').val('');
                $parent.find('.uraian_singkat:last').val('');
                $parent.find('.karir_bulan_awal').val('');
                $parent.find('.karir_tahun_awal').val('');
                $parent.find('.karir_bulan_akhir').val('');
                $parent.find('.karir_tahun_akhir').val('');

                return;
            }

            jQuery(this).parents('.block-karir').remove();
            ReIndexKarir();
        });

        jQuery(document).on('click', '.delete_organisasi', function(){
            if(jQuery("#pengalaman-organisasi .block-organisasi").length == 1) {
                var $parent = jQuery('#pengalaman-organisasi');
                // Cleare textbox
                $parent.find('.org_organisasi').val('');
                $parent.find('.org_jabatan').val('');
                $parent.find('.org_uraian_singkat').val('');
                $parent.find('.org_karir_bulan_awal').val('');
                $parent.find('.org_karir_tahun_awal').val('');
                $parent.find('.org_karir_bulan_akhir').val('');
                $parent.find('.org_karir_tahun_akhir').val('');

                return;
            }

            jQuery(this).parents('.block-organisasi').remove();
            ReIndexOrganisasi();
        });

        jQuery(document).on('click', '.delete_prestasi', function(){
            if(jQuery("#prestasi .block-prestasi").length == 1) {
                var $parent = jQuery('#prestasi');
                // Cleare textbox
                $parent.find('.nama_prestasi:last').val('');
                $parent.find('.tahun_prestasi:last').val(''); 

                return;
            }

            jQuery(this).parents('.block-prestasi').remove();
            ReIndexPrestasi();
        });


        /*
         * Re Index Dom Karir
         */
        function ReIndexKarir() {
            var $parent = jQuery('#karir');
            $parent.find('.block-karir').each(function(i) {
                var $this = jQuery(this);
                $this.find('.label-subject').html('Karir/Riwayat pekerjaan (' + (i + 1) + ') <a class="delete_karir">Hapus</a>');
                $this.find('.perusahaan').attr('name', 'karir[' + i + '][perusahaan]');
                $this.find('.jabatan').attr('name', 'karir[' + i + '][jabatan]');
                $this.find('.uraian_singkat').attr('name', 'karir[' + i + '][uraian_singkat]');
                $this.find('.karir_bulan_awal').attr('name', 'karir[' + i + '][bulan_awal]');
                $this.find('.karir_tahun_awal').attr('name', 'karir[' + i + '][tahun_awal]');
                $this.find('.karir_bulan_akhir').attr('name', 'karir[' + i + '][bulan_akhir]');
                $this.find('.karir_tahun_akhir').attr('name', 'karir[' + i + '][tahun_akhir]');
            });

        }
        /*
         * Re Index Dom Organisasi
         */
        function ReIndexOrganisasi() {
            var $parent = jQuery('#pengalaman-organisasi');
            $parent.find('.block-organisasi').each(function(i) {
                var $this = jQuery(this);
                $this.find('.label-subject').html('Pengalaman organisasi (' + (i + 1) + ') <a class="delete_organisasi">Hapus</a>');
                $this.find('.org_organisasi').attr('name', 'organisasi[' + i + '][organisasi]');
                $this.find('.org_jabatan').attr('name', 'organisasi[' + i + '][jabatan]');
                $this.find('.org_uraian_singkat').attr('name', 'organisasi[' + i + '][uraian_singkat]');
                $this.find('.org_karir_bulan_awal').attr('name', 'organisasi[' + i + '][bulan_awal]');
                $this.find('.org_karir_tahun_awal').attr('name', 'organisasi[' + i + '][tahun_awal]');
                $this.find('.org_karir_bulan_akhir').attr('name', 'organisasi[' + i + '][bulan_akhir]');
                $this.find('.org_karir_tahun_akhir').attr('name', 'organisasi[' + i + '][tahun_akhir]');
            });
        }
        /*
         * Re Index Dom Prestasi
         */
        function ReIndexPrestasi() {
            var $parent = jQuery('#prestasi');
            $parent.find('.block-prestasi').each(function(i) {
                var $this = jQuery(this);
                $this.find('.label-subject').html('Prestasi (' + (i + 1) + ') <a class="delete_prestasi">Hapus</a>');
                $this.find('.nama_prestasi').attr('name', 'prestasi[' + i + '][nama_prestasi]');
                $this.find('.tahun_prestasi').attr('name', 'prestasi[' + i + '][periode]');
            });

        }

        // fungsi untuk menggenare umur.
        function calculateAge() {
            var tahun = jQuery("#tahun_lahir").val();
            var bulan = jQuery("#bulan_lahir").val();
            var tgl = jQuery("#tanggal_lahir").val();

            if("" == tahun || "" == bulan || "" == tgl)
                return "";

            var today = new Date();
            var birthDate = new Date(tahun, bulan - 1, tgl);
            console.log(birthDate);

            var age = today.getFullYear() - birthDate.getFullYear();
            var hasBirthday = (today.getMonth() > birthDate.getMonth()) 
                || ((today.getMonth() == birthDate.getMonth()) && today.getDate() >= birthDate.getDate());

            if(hasBirthday)
                return age;
            else
                return --age;
        }


    };

    return REG;
}(Registrasi || {}));