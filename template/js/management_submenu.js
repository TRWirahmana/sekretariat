jQuery(document).ready(function(e){
    var dom = {
        $table_news: jQuery("#table_submenu")

    };
    dom.$table_news.dataTable({
        bServerSide: true,
        bFilter:false,
        bProcessing: true,
        bPaginate: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Submenu",
            "sEmptyTable": "Data Kosong",
            "sZeroRecords" : "Pencarian Tidak Ditemukan",
            "sSearch":       "Cari:",
            "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
            "sProcessing": 'Memproses...',
            "oPaginate": {
                "sNext": "<span class='rulycon-forward-3'></span>",
                "sPrevious": "<span class='rulycon-backward-2'></span>"
            },
            "sLengthMenu": 'Tampilkan <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '</select> Submenu'
        },
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "nama_menu"
            },
            {
                mData: "nama_submenu"
            },
            {
                mData: "id",
                mRender: function(id) {
                    return "<a href='"+baseUrl+"/admin/submenu/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                        + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/submenu/"+id+"'>"
                        + "<i class='icon-trash'></i></a>";
                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "filter", value: 1});
        },
        fnDrawCallback: function() {

//            dom.$table_news.fnSetColumnVis( 3,  (dom.$select_role.val() == 0 || dom.$select_role.val() == 3 || dom.$select_role.val() == 2));
        }
    });

    dom.$table_news.on('click', '.btn_delete', function(e){
        var delkodel = jQuery(this);
        jQuery('#dialog').dialog({
            width: 500,
            modal: true,
            buttons: {
                "Hapus" : function(){
                    jQuery.ajax({
                        url: delkodel.attr('href'),
                        type: 'DELETE',
                        success: function(response) {
                            dom.$table_news.fnReloadAjax();
                        }
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


//    jQuery("#select_role").change(function(){
//        dom.$table_news.fnReloadAjax();
//    });

});