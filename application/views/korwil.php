<div class="container container-table">
    <section class="content">
        <div class="row vertical-center-row">
            <div class="col-xs-10">
                <div class="box box-success box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DAFTAR KOORDINATOR WILAYAH (KORWIL)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <?php $data1=korwil('1');$data2=korwil('2');$data3=korwil('3');?>
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Nama Korwil</th>
		    <th>Jumlah RT Seharusnya</th>
		    <th>Jumlah RT Pada Server</th>
		    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <!--korwil1-->
            <tr>
                <td>1</td>
                <td><?php echo $data1['nm'];?></td>
                <td><?php $data=korwil('1'); echo $data1['jmh'];?></td>
                <td><span id="dsrevr">Memuat di server</span></td>
                <td><span id="dsrevr"><a href="<?php echo base_url($data1['url']);?>" class="btn btn-default btn-sm">Lihat Daftar Provinsi</a></span></td>
            </tr>
                <!--korwil2-->
            <tr>
                <td>2</td>
                <td><?php echo $data2['nm'];?></td>
                <td><?php echo $data2['jmh'];?></td>
                <td><span id="dsrevr2">Memuat di server</span></td>
                <td><span id="dsrevr"><a href="<?php echo base_url($data2['url']);?>" class="btn btn-default btn-sm">Lihat Daftar Provinsi</a></span></td>
            </tr>
                <!--korwil3-->
            <tr>
                <td>3</td>
                <td><?php echo $data3['nm'];?></td>
                <td><?php echo $data3['jmh'];?></td>
                <td><span id="dsrevr3">Memuat di server</span></td>
                <td><span id="dsrevr"><a href="<?php echo base_url($data3['url']);?>" class="btn btn-default btn-sm">Lihat Daftar Provinsi</a></span></td>
            </tr>
	    
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
            $(document).ready(function(){
                $.ajax({
                    type    : 'POST',
                    url     : '<?=base_url('korwil/showkor')?>',
                    dataType: 'json',
                    async: true,
                    success : function(response){
                        var dsrevr = response.k1;
                        var dsrevr2 = response.k2;
                        var dsrevr3 = response.k3;
                        $('#dsrevr').text(dsrevr); 
                        $('#dsrevr2').text(dsrevr2); 
                        $('#dsrevr3').text(dsrevr3); 
                            
                    }
                });
            });
        </script>