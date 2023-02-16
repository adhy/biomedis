<div class="container container-table">
    <section class="content">
        <div class="row vertical-center-row">
            <div class="col-xs-7">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DATA MONITORING BIOMEDIS KORWIL</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'></div>
        <table class="table table-bordered table-striped" id="mytable">
            <?php $data1=korwil('1');$data2=korwil('2');$data3=korwil('3');?>
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Koordinator Wilayah</th>
		    <th>Jumlah RT</th>
		    <th>Jumlah RT Pada Server</th>
                </tr>
            </thead>
            <tbody>
                <!--korwil1-->
            <tr>
                <td>1</td>
                <td><a href="<?php echo base_url($data1['url']);?>" class="font-weight-bold"><?php echo $data1['nm'];?></a></td>
                <td><?php $data=korwil('1'); echo $data1['jmh'];?></td>
                <td><span id="dsrevr">Proses di server</span></td>
            </tr>
                <!--korwil2-->
            <tr>
                <td>1</td>
                <td><a href="<?php echo base_url($data2['url']);?>" class="font-weight-bold"><?php echo $data2['nm'];?></a></td>
                <td><?php $data=korwil('1'); echo $data2['jmh'];?></td>
                <td><?php $data=korwil('1'); echo $data2['jmh'];?></td>
            </tr>
                <!--korwil3-->
            <tr>
                <td>1</td>
                <td><a href="<?php echo base_url($data3['url']);?>" class="font-weight-bold"><?php echo $data3['nm'];?></a></td>
                <td><?php echo $data3['jmh'];?></td>
                <td><?php echo $data3['jmh'];?></td>
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
                        $('#dsrevr').text(dsrevr); 
                        console.log(dsrevr);
                            
                    }
                });
            });
        </script>