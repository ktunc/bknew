<?php
echo $this->Html->css(array('yonetici/plugins/dataTables/datatables.min'));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Basic Data Tables example with responsive plugin</h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th width="5%">Danışman ID</th>
                            <th>İsim</th>
                            <th width="5%">İlanları</th>
                            <th width="5%">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($danismanlar as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Danisman']['id'].'</td>';
                            echo '<td>'.$row['Danisman']['isim'].'</td>';
                            echo '<td align="center"><a href="'.$this->Html->url('/').'yoneticis/danismanilan/danisman:'.$row['Danisman']['id'].'" target="_blank" class="btn btn-xs btn-success">İlanları</a></td>';
                            echo '<td align="center"><a href="'.$this->Html->url('/').'yoneticis/danismanedit/danisman:'.$row['Danisman']['id'].'"><i class="fa fa-edit fa-lg text-success"></i></a> <i class="fa fa-times fa-lg text-danger"></i></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th width="5%">Danışman ID</th>
                            <th>İsim</th>
                            <th>İlanları</th>
                            <th width="5%">İşlem</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script(array(
    'yonetici/plugins/dataTables/datatables.min'
));
?>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]]

        });

    });
</script>