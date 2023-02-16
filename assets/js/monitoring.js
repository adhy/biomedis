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
        ajax: {"url": "monitoring/json", "type": "POST"},
        columns: [
            {
                "data": "caseids",
                "orderable": false
            },{"data": "kode_p"},{"data": "prov", "className":"prov_td"},{"data": "modified_time"},{"data": "created_time"},
            {
                "data" : "action",
                "orderable": false,
                "className" : "text-center"
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
    $('#mytable tbody > tr > td.prov_td').each(function(key, ini){
    
    // Getting Original Value
    var original_val = $(ini).text().trim();
    
    // You can change your logic here to modify text
    //var result = original_val.replaceAll('"', '');
    var result = original_val+' susah';
    
    // Replacing new value
    $(ini).text(result);
    console.log(result);
});
});