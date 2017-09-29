<?php
echo $this->Html->css(array('yonetici/plugins/dataTables/datatables.min'));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Haberler</h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th width="5%">Haber ID</th>
                            <th>Başlık</th>
                            <th width="5%">Yayında</th>
                            <th width="5%">Düzenle</th>
                            <th width="5%">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($haberler as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Haber']['id'].'</td>';
                            echo '<td>'.$row['Haber']['baslik'].'</td>';
                            if($row['Haber']['yayinda'] == 1){
                                echo '<td class="text-center text-primary"><i class="fa fa-check fa-lg"></i></td>';
                            }else {
                                echo '<td class="text-center text-danger"><i class="fa fa-times fa-lg"></i></td>';
                            }
                            echo '<td class="text-center"><a href="'.$this->Html->url('/').'yoneticis/haberedit/hId:'.$row['Haber']['id'].'"><i class="fa fa-edit fa-lg text-success"></i></a></td>';
                            echo '<td class="text-center"><i class="fa fa-times fa-lg text-danger" onclick="FuncHaberSil('.$row['Haber']['id'].')"></i></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th width="5%">Haber ID</th>
                            <th>Başlık</th>
                            <th width="5%">Yayında</th>
                            <th width="5%">Düzenle</th>
                            <th width="5%">Sil</th>
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