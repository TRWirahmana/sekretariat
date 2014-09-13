/*
 * File      : pelembagaan.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * edited by : taofik.ridwan@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Pelembagaan = (function(PLM) {

    PLM.Form = function() {
        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            $('#pelembagaan-form').submit();
        });

        var rules = {
                'jenis_usulan': 'required',
                'perihal': 'required',
                'nip': 'required',
                'nama_pemohon': 'required',
                'alamat_kantor': 'required',
                'telp_kantor': 'required',
                'hp': 'required',
                'catatan': 'required',
                'password_confirmation': 'required',
                'email': {
                    required: true,
                    email: true
                },
                'lampiran': 'required'
            };

        $("#pelembagaan-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'jenis_usulan': {
                    required: 'Silahkan Pilih Jenis Usulan.'
                },                
                'perihal': {
                    required: 'Pelembagaan Harus diisi.'
                },
                'lampiran': {
                    required: 'Lampiran wajib diisi.'
                },
                'catatan': {
                    required: 'Catatan wajib diisi.'
                },
                'email': {
                    required: 'Alamat E-Mail wajib diisi.',
                    email: 'Format email tidak benar'
                },
                'nama_pemohon': {
                    required: 'Nama Pemohon tidak boleh kosong.'
                },
                'alamat_kantor': {
                    required: 'alamat kantor Harus diisi.'
                },
                'telp_kantor': {
                    required: 'telepon harus diisi.'
                },
                'hp': {
                    required: 'Nomor handphone Harus diisi.'
                },
                'nip': {
                    required: 'NIP harus diisi.'
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

        $("#pelembagaan-form input[type='file']").change(function(e){
            $(this).validate();
                $controlGroup = $(this).parents('div.control-group');
                if($(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })

    //   $("#pelembagaan-form input[type='file']").fileValidator({
    //        onValidation: function(files){ $(this).attr('class','error'); },
    //        onInValid: function(type, file){ $(this).addClass('invalid '+type)}
    //        maxSize: '1m' 
    //     });
    // };

    // $.validator.addMethod('filesize', function(value, element, param) {
    //     // param = size (en bytes) 
    //     // element = element to validate (<input>)
    //     // value = value of the element (file name)
    //     return this.optional(element) || (element.files[0].size <= param) 
    // });

    // $('#pelembagaan-form input[type='file']').validate({
    //     rules: { lampiran: { required: true, accept: "png|jpe?g|gif", filesize: 1048576  }},
    //     messages: { lampiran: "File must be JPG, GIF or PNG, less than 1MB" }
    // });


    PLM.Update = function() {
        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            $('#pelembagaan-update').submit();
        });

        var rules = {
                'status': 'required',
                'catatan': 'required',
                'ket_lampiran': 'required'
        };

        $("#pelembagaan-update").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'status': {
                    required: 'Pelembagaan Harus diisi.'
                },
                'ket_lampiran': {
                    required: 'Keterangan Lampiran Harus diisi.'
                //},'lampiran': {
                //    required: 'Lampiran wajib diisi.'
                },
                'catatan': {
                    required: 'Catatan wajib diisi.'
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

        $("#pelembagaan-update input[type='file']").change(function(e){
            $(this).validate();
                $controlGroup = $(this).parents('div.control-group');
                if($(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })
    }

    };


    return PLM;
}(Pelembagaan || {}));
