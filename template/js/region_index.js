$(document).ready(function(){
	var dom = {
		$tbl_region: $("#tbl_region"),
		$btn_tambah: $("#btn_tambah")
	}

	dom.$tbl_region.dataTable({
		bProcessing: true,
		bServerSide: true,
		bSort: false,
		sAjaxSource: document.URL,
		aoColumns: [
			{
				mData: null,
				sWidth: '10%',
				sClass: 'control',
				sDefaultContent: '<img src="'+baseUrl+'/assets/images/details_open.png" title="open" style="cursor: pointer;" />'
			},
			{
				mData: 'kode',
				sWidth: '15%',
				sClass: 'editable'
			}, {
				mData: 'nama',
				sWidth: '75%',
				sClass: 'editable'
			}, {
				mData: 'id',
				sWidth: '10%',
				mRender: function(id){
					return '<a href="'+baseUrl+'/admin/region/'+id+'" title="hapus" class="btn_hapus"><i class="icon-trash"></i></a>';
				}
			}],
		fnDrawCallback: function() {
			$('td.editable', this.fnGetNodes()).editable(baseUrl + '/admin/region/update', {
				method: "PUT",
				tooltip: 'Klik untuk ubah...',
				callback: function(sValue, y){ 
					var aPos = dom.$tbl_region.fnGetPosition(this);
					dom.$tbl_region.fnUpdate(sValue, aPos[0], aPos[1]);
				},
				submitdata: function(value, settings) {
					var data = dom.$tbl_region.fnGetData(this.parentNode);
					return {
						id: data.id,
						column: dom.$tbl_region.fnGetPosition(this)[2]
					}
				}
			});
		}
	});

	$(document).on('click', '.btn_hapus', function(e){
		if(confirm('Apakah anda yakin?')) {
			$.ajax({
				url: $(this).attr('href'),
				type: "DELETE",
				success: function(response){
					dom.$tbl_region.fnReloadAjax();
				}
			});
		}
		return false;
	});

	dom.$btn_tambah.click(function(event) {
 		$.post(document.URL, null, function(data, textStatus, xhr) {
 			dom.$tbl_region.fnReloadAjax();
	 	});
	});

	dom.$tbl_region.on('click', 'tr td.control', function(e){
		var nTr = this.parentNode;
		if(dom.$tbl_region.fnIsOpen(nTr)) {
			$('img', this).attr('src', baseUrl + '/assets/images/details_open.png');
			dom.$tbl_region.fnClose(nTr)
		} else {
			$('img', this).attr('src', baseUrl + 	'/assets/images/details_close.png');

			var data = dom.$tbl_region.fnGetData(nTr);
			var id = "tbl_provinsi_" + data.id;
			dom.$tbl_region.fnOpen(
				nTr, "<button data-id="+data.id+" class='btn_tambah_provinsi'>Tambah Provinsi</button>"
				+"<table id=" + id + "></table>", 'info_row');

			$tbl_provinsi = $("#" + id).dataTable({
				sDom: "",
				bServerSide: true,
				sAjaxSource: baseUrl+ "/admin/provinsi",
				bSort: false,
				fnServerParams: function(aoData){
					aoData.push({"name": "id", "value": data.id})
				},
				aoColumns: [
					{
						mData: null,
						sWidth: '10%'
					},
					{
						mData: 'kode',
						sClass: 'editable',
						sWidth: '15%'
					}, 
					{
						mData: 'nama',
						sClass: 'editable',
						sWidth: '40%'
					},
					{
						mData: 'bpnb_id',
						sClass: 'select_editable',
						sWidth: '35%',
						mRender: function(data, type, full) {
							if(null != data && "" != data)
								return full.bpnb.nama;
							return "-- Bpnb belum ditentukan --";
						}
					},
					{
						mData: 'id',
						sWidth: '10%',
						mRender: function(id) {
							return '<a href="'+baseUrl+'/admin/provinsi/'+id+'" title="hapus" class="btn_hapus_provinsi"><i class="icon-trash"></i></a>';
						}
					}
				],
				fnDrawCallback: function() {
					$('td.editable', this.fnGetNodes()).editable(baseUrl + '/admin/provinsi/update', {
						method: "PUT",
						tooltip: 'Klik untuk ubah...',
						callback: function(sValue, y){ 
							var aPos = $tbl_provinsi.fnGetPosition(this);
							$tbl_provinsi.fnUpdate(sValue, aPos[0], aPos[1]);
						},
						submitdata: function(value, settings) {
							var data = $tbl_provinsi.fnGetData(this.parentNode);
							return {
								id: data.id,
								column: $tbl_provinsi.fnGetPosition(this)[2]
							}
						}
					});

					 $('td.select_editable').editable(baseUrl + '/saveBpnb', { 
					     loadurl : baseUrl + '/getBpnb',
					     type    : 'select',
					     submit  : 'OK',
					     style   : 'display: inline',
					     loaddata: function(value, settings) {
							var data = $tbl_provinsi.fnGetData(this.parentNode);
							return {id: data.id}
						 },
						 submitdata: function(value, settings) {
							var data = $tbl_provinsi.fnGetData(this.parentNode);
							return { id: data.id }
						 }
 					 });
				}

			});

			

			$tbl_provinsi.on('click', '.btn_hapus_provinsi', function(e){
				if(confirm('Apakah anda yakin?')) {
					$.ajax({
						url: $(this).attr('href'),
						type: "DELETE",
						success: function(response){
							$tbl_provinsi.fnReloadAjax();
						}
					});
				}
				return false;
			});


		}
	});


$(document).on('click','.btn_tambah_provinsi', function(e){
				$.post(baseUrl + '/admin/provinsi', {id: $(this).data('id')}, function(data, textStatus, xhr) {
						$tbl_provinsi.fnReloadAjax();
				});
			});

});	


