jQuery(document).ready(function(e){
    var dom = {
        $table_news: jQuery("#table_news")

    };
    dom.$table_news.dataTable({
        bServerSide: true,
        bProcessing: true,
        bPaginate: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Berita",
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
                '</select> Berita'
        },
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "judul"
            },
            {
                mData: "nama_kategori"
            },
            {
                mData: "tgl_penulisan"
            },
            {
                mData: "id",
                mRender: function(id) {
                    if(role == 3){
                        return "<a href='"+baseUrl+"/admin/berita/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                            + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/berita/"+id+"'>"
                            + "<i class='icon-trash'></i></a>";
                    }else{
                        return null;
                    }

                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "filter", value: 1});
        },
        fnDrawCallback: function() {
//            var role = '<?php echo Auth::user()->role_id; ?>' ;
//            dom.$table_news.fnSetColumnVis( 2,  role == 3 );
        }
    });

    dom.$table_news.on('click', '.btn_delete', function(e){
        var delkodel = jQuery(this);
        jQuery('#dialog').dialog({
            width: 500,
            modal: true,
            buttons: {
                "Hapus" : function(){
                    jQuery.post(delkodel.attr('href'), {_method: 'delete'}, function(r) {
                        dom.$table_news.fnReloadAjax();
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