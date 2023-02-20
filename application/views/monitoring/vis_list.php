
<div class="content">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DATA MONITORING BIOMEDIS</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Kode Provinsi</th>
		    <th>Provinsi</th>
		    <th>Jumlah RuTa</th>
		    <th>Modified Time</th>
		    <th>Created Time</th>
		    <th width="200px">Action</th>
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
        <!--<script src="<?php echo base_url('assets/js/monitoring.js') ?>"></script>-->
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
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ajax: {"url": "monitoring/json", "type": "POST"},
                    columns: [
                        {
                            "data": "caseids",
                            "orderable": false
                        },{"data": "kode_p","className":"kode_p_td"
                //             "render": function (data, type, full, meta) {
                //     var url_link = "";if (data) {
                //         var kode_p= data;
                //         var url_link = data.replaceAll(data, '<a href="http://localhost/biomedis/monitoring/read/'+data+'" class="lihat"><i class="fa fa-eye" aria-hidden="true"></i>'+data+'</a>');}
                //     return url_link;
                // }
            },{"data": "prov", "className":"prov_td",
                            "render": function (data, type, full, meta) {
                    var prov_ = "";if (data) {var prov_ = data.replaceAll('"', '');}
                    return prov_;
                }},{"data": "jmh_ruta"},{"data": "modified_time"},{"data": "created_time"},
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

