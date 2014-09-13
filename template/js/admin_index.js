jQuery(document).ready(function(e){
    var dom = {
        $table_admin: jQuery("#table_admin"),
        $select_role: jQuery("#select_role")

    };
    dom.$table_admin.dataTable({
        bServerSide: true,
        bFilter:true,
        bProcessing: true,
        bPaginate: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Akun",
            "sEmptyTable": "Data Kosong",
            "sZeroRecords" : "Pencarian Tidak Ditemukan",
            "sSearch":       "Cari:",
            "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
            "sProcessing": 'Memproses...',
            "oPaginate": {
                "sNext": '<span class="rulycon-forward-3"></span>',
                "sPrevious": "<span class='rulycon-backward-2'></span>"
            },
            "sLengthMenu": 'Tampilkan <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '</select> Akun'
        },
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "nama_lengkap"
            },
            {
                mData: "email"
            }
            ,
            {
                mData: "role_id",
                mRender: function(role_id) {
                    switch(parseInt(role_id)){
                        case 1 :
                            return "Kepala Biro";
                        break;
                        case 2 :
                            return "Pengguna";
                            break;
                        case 3 :
                            return "Super Admin";
                            break;
                        case 4 :
                            return "Kepala Bagian";
                            break;
                        case 5 :
                            return "Kepala Sub Bagian";
                            break;
                        case 6 :
                            return "Admin Peraturan Perundang-Undangan";
                            break;
                        case 7 :
                            return "Admin Pelembagaan";
                            break;
                        case 8 :
                            return "Admin Bantuan Hukum";
                            break;
                        case 9 :
                            return "Admin Ketatalaksanaan";
                            break;
                    }

                }
            },
            {
                mData: "user_id",
                mRender: function(id) {
                    return "<a href='"+baseUrl+"/admin/account/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                        + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/account/"+id+"'>"
                        + "<i class='icon-trash'></i></a>";
                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "role_id", value: dom.$select_role.val()});
        },
        fnDrawCallback: function() {

//            dom.$table_admin.fnSetColumnVis( 3,  (dom.$select_role.val() == 0 || dom.$select_role.val() == 3 || dom.$select_role.val() == 2));
        }
    });

    dom.$table_admin.on('click', '.btn_delete', function(e){
        var delkodel = jQuery(this);
        jQuery('#dialog').dialog({
            width: 500,
            modal: true,
            buttons: {
                "Hapus" : function(){
                    jQuery.post(delkodel.attr('href'), {_method: 'delete'}, function(r){
                        dom.$table_admin.fnReloadAjax();
                    });
                    jQuery(this).dialog("close");
                },
                "Batal" : function() {
                    jQuery(this).dialog("close");
                }
            }
        });
        e.preventDefault();
    });


    jQuery("#select_role").change(function(){
        dom.$table_admin.fnReloadAjax();
    });

});