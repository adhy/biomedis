<div class="container container-table">
    <section class="content">
        <div class="row vertical-center-row">
            <div class="col-xs-12">
                <div class="box box-success box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DAFTAR RUMAH TANGGA NKS <?=$this->session->userdata('nmnks')?> KAB/KOTA  <?=$this->session->userdata('publickab')?> <?=$this->session->userdata('nmkab')?> PROVINSI <?=$this->session->userdata('publicprov');?> <?=$this->session->userdata('nmprov')?></h3>
                    </div>
                    <section class="content-header">
                    <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Index</a></li>
                    <li><a href="<?=base_url($this->session->userdata('urlv1'))?>">Koordinator Wilayah</a></li>
                    <li><a href="<?=base_url('korwil1/'.$this->session->userdata('urlv2'))?>">Provinsi</a></li>
                    <li><a href="<?=base_url('korwil1/'.$this->session->userdata('urlv3'))?>">Kab/Kota</a></li>
                    <li class="active">NKS</li>
                    </ol>
                    </section><br>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Nama Kepala RuTa</th>
            <th>Jumlah ART</th>
            <th>Jumlah Balita</th>
            <th>Jumlah WUS</th>
		    <th>Status Entri</th>
		    <th>Nama Enum 1</th>
		    <th>Waktu Perubahan Terakhir</th>
		    <!--<th width="200px">Action</th>-->
                </tr>
            </thead>

           <!-- <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>-->
        </tfoot>
	    
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
        <style type="text/css">
h1 {color:red;}
tfoot>tr> th.kec_td.nm_krt_td{ color: transparent !important; }
</style> 
        
        
        <script type="text/javascript">
            $(document).ready(function() {
//                 jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
//     return this.flatten().reduce( function ( a, b ) {
//         if ( typeof a === 'string' ) {
//             a = a.replace(/[^\d.-]/g, '') * 1;
//         }
//         if ( typeof b === 'string' ) {
//             b = b.replace(/[^\d.-]/g, '') * 1;
//         }

//         return a + b;
//     }, 0 );
// } );
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
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json',
                },
    //                 drawCallback: function () {
    //     var api = this.api();
    //     $( 'tfoot th' ).html('Total: ' + 
    //       api.column( 4, {page:'current'} ).data().sum() + '<br>'
    //     );
    //   },

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
                   // bLengthChange: false,
                    searching:false ,
                    deferRender: true,
                    lengthMenu: [
                                [ 20, -1],
                                [ 20, 'All'],
                            ],
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?=base_url()?>korwil2/jsonnks", "type": "POST","async": true},
                    columns: [
                        {
                            "data": "caseids",
                            "orderable": false
                        }
                ,{"data": "krt","className":"nm_krt_td",
                            "render": function (data, type, full, meta) {
                    var nm_krt = "";if (data) {var nm_krt = data.replaceAll('"', '');}
                    return nm_krt;
                }
            },
                {"data": "jmh_art"},{"data": "jmh_balita"},{"data": "jmh_wus"},{"data": "status"},{"data": "nm_entry"},{"data": "modified_time"},
                //         {
                //             "data" : "action",
                //             "orderable": false,
                //             "className" : "text-center",
                //             "render": function (masuk, type, full, meta) {
                //     var url_linklihat = "";if (masuk) {
                //         var lihat = $('.nm_krt_td').text().trim();
                //         var url_linklihat = masuk.replaceAll('#lihat', window.nm_krt);}
                //     return url_linklihat;
                // }
                //         }
                    ],
                    ordering: false,
                    //rowGroup: {dataSrc: ['kec']},
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>

