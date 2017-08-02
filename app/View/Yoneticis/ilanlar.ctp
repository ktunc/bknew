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
                            <th width="5%">İlan ID</th>
                            <th>Başlık</th>
                            <th>Yer</th>
                            <th>Satılık-Kiralık</th>
                            <th>Tür</th>
                            <th width="5%">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($ilanlar as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Ilan']['id'].'</td>';
                            echo '<td>'.$row['Ilan']['baslik'].'</td>';
                            echo '<td>'.$row['Sehir']['sehir_adi'].'</td>';
                            echo '<td>'.($row['Ilan']['satkir']==1?"Satılık":"Kiralık").'</td>';
                            if($row['Ilan']['turu'] == 1){
                                echo '<td>Konut</td>';
                            }else if($row['Ilan']['turu'] == 2){
                                echo '<td>İşyeri</td>';
                            }else {
                                echo '<td>Arsa</td>';
                            }
                            echo '<td><a href="'.$this->Html->url('/').'yoneticis/ilanedit/ilan:'.$row['Ilan']['id'].'"><i class="fa fa-edit fa-lg text-success"></i></a> <i class="fa fa-times fa-lg text-danger"></i></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>İlan ID</th>
                            <th>Başlık</th>
                            <th>Yer</th>
                            <th>Satılık-Kiralık</th>
                            <th>Tür</th>
                            <th>İşlem</th>
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