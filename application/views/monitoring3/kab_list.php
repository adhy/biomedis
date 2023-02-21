<div class="container container-table">
    <section class="content">
        <div class="row vertical-center-row">
            <div class="col-xs-12">
                <div class="box box-success box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DATA MONITORING BIOMEDIS KAB/KOTA  <?=$this->session->userdata('publickab')?> <?=$this->session->userdata('nmkab')?> PROVINSI <?=$this->session->userdata('nmprov')?></h3>
                    </div>
                    <section class="content-header">
                    <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Index</a></li>
                    <li><a href="<?=base_url($this->session->userdata('urlv1'))?>">Koordinator Wilayah</a></li>
                    <li><a href="<?=base_url('korwil2/'.$this->session->userdata('urlv2'))?>">Provinsi</a></li>
                    <li class="active">Kab/Kota</li>
                    </ol>
                    </section><br>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Kecamatan</th>
		    <th>Kode NKS</th>
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
                    lengthMenu: [
                                [ 20, -1],
                                [ 20, 'All'],
                            ],
                           // bLengthChange: false,
                           //pageLength: 20,
                    searching:false ,
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ajax: {"url": "<?=base_url()?>korwil3/jsonkab", "type": "POST","async": true},
                    columns: [
                        {
                            "data": "caseids",
                            "orderable": false
                        },{"data": "kec","className":"kec_td", "visible": false,
                            "render": function (data, type, full, meta) {
                    var kec_ = "";if (data) {var kec_ = data.replaceAll('"', '');}
                    return kec_;
                }}
                ,{"data": "kode_nks"
            },
            // {"data": "kode_nks","className":"kode_nks_td",
            //                 "render": function (data, type, full, meta) {
            //         var kode_nks = "";if (data) {var kode_nks = data.replaceAll('"', '');}
            //         return kode_nks;
            //     }
            // },
                {"data": "jmh_ruta"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center",
                            "render": function (masuk, type, full, meta) {
                    var url_linklihat = "";if (masuk) {
                        var lihat = $('.kode_nks_td').text().trim();
                        var url_linklihat = masuk.replaceAll('#lihat', window.kode_nks);}
                    return url_linklihat;
                }
                        }
                    ],
                    ordering: false,
                    rowGroup: {dataSrc: ['kec']},
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

