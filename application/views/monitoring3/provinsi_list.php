<div class="container container-table">
    <section class="content">
        <div class="row vertical-center-row">
            <div class="col-xs-12">
                <div class="box box-success box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DATA MONITORING BIOMEDIS PROVINSI <?=$this->session->userdata('publicprov');?> - <?=$this->session->userdata('nmprov')?></h3>
                    </div>
                    <section class="content-header">
                    <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Index</a></li>
                    <li><a href="<?=base_url($this->session->userdata('urlv1'))?>">Koordinator Wilayah</a></li>
                    <li class="active">Provinsi</li>
                    </ol>
                    </section>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Kabupaten</th>
		    <th>Kabupaten</th>
		    <th>Jumlah RT Seharusnya</th>
		    <th>Jumlah RT Pada Server</th>
		    <th width="200px">Tindakan</th>
                </tr>
            </thead>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    //bLengthChange: false,
                    searching:false ,
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    lengthMenu: [
                                [ 20, -1],
                                [ 20, 'All'],
                            ],
                    ajax: {"url": "<?=base_url()?>korwil3/jsonprov", "type": "POST","async": true},
                    columns: [
                        {
                            "data": "caseids",
                            "orderable": false
                        },{"data": "kode_p","className":"kode_p_td","orderable": false,
                //             "render": function (data, type, full, meta) {
                //     var url_link = "";if (data) {
                //         var kode_p= data;
                //         var url_link = data.replaceAll(data, '<a href="http://localhost/biomedis/monitoring/read/'+data+'" class="lihat"><i class="fa fa-eye" aria-hidden="true"></i>'+data+'</a>');}
                //     return url_link;
                // }
            },{"data": "kab","orderable": false, "className":"kab_td",
                            "render": function (data, type, full, meta) {
                    var kab_ = "";if (data) {var kab_ = data.replaceAll('"', '');}
                    return kab_;
                }},{"data": "jmhbsbps","orderable": false},{"data": "jmh_ruta","orderable": false,},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center",
                            "render": function (masuk, type, full, meta) {
                    var url_linklihat = "";if (masuk) {
                        var lihat = $('.kode_p_td').text().trim();
                        var url_linklihat = masuk.replaceAll('#lihat', window.kode_p);}
                    return url_linklihat;
                }
                        //     "render": function (data, type, full, meta) {
                        //                 var zone_html = "";
                        //                 if (data) {var zone_html = data.replaceAll('"', '');}
                        //                 return zone_html;
                        //  }
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
                // $('#mytable tbody > tr > td > a.lihat').each(function(key, ini){
                
                // // Getting Original Value
                // var lihat = $('.kode_p_td').text().trim();
                // var original_val = $(ini).attr("href");
                // var result = oldUrl.replace("http://", "https://");
                
                // // You can change your logic here to modify text
                // //var result = original_val.replaceAll('"', '');
                // //var result = original_val+' susah';
                
                // // Replacing new value
                // $(ini).text(result);
                // console.log(zone_html);
            // });
            });
            
        </script>

