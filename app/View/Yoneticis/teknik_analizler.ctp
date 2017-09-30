<?php
echo $this->Html->css(array('yonetici/plugins/dataTables/datatables.min'));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Teknik Analizler</h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th width="5%">Teknik Analiz ID</th>
                            <th>Başlık</th>
                            <th width="5%">Yayında</th>
                            <th width="5%">Düzenle</th>
                            <th width="5%">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($teknik_analizler as $row){
                            echo '<tr>';
                            echo '<td>'.$row['TeknikAnaliz']['id'].'</td>';
                            echo '<td>'.$row['TeknikAnaliz']['baslik'].'</td>';
                            if($row['TeknikAnaliz']['yayinda'] == 1){
                                echo '<td class="text-center text-primary"><i class="fa fa-check fa-lg"></i></td>';
                            }else {
                                echo '<td class="text-center text-danger"><i class="fa fa-times fa-lg"></i></td>';
                            }
                            echo '<td class="text-center"><a href="'.$this->Html->url('/').'yoneticis/teknikanalizedit/taId:'.$row['TeknikAnaliz']['id'].'"><i class="fa fa-edit fa-lg text-success"></i></a></td>';
                            echo '<td class="text-center"><i class="fa fa-times fa-lg text-danger" onclick="FuncTeknikAnalizSil('.$row['TeknikAnaliz']['id'].')"></i></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th width="5%">Tekni kAnaliz ID</th>
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

    function FuncTeknikAnalizSil(taId){
        swal({
            title: 'Teknik Analizi silmek istediğinizden emin misiniz?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-trash"></i> Sil'
        }).then(function () {
            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/teknikanalizsil',
                    data: {'taId':taId}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){
                        swal({
                            title: "Hata",
                            text: "Teknik Analiz silinirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                            type: "error"
                        });
                        $.unblockUI();
                    }else{
                        $.unblockUI();
                        swal({
                            title: "Başarılı",
                            text: "Teknik Analiz başarıyla silindi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        }).then(function(){
                            window.location.href = "<?php echo $this->Html->url('/');?>yoneticis/teknik_analizler";
                            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
                        });

                    }
                }).fail(function(){
                    swal({
                        title: "Hata",
                        text: "Teknik Analiz silinirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                        type: "error"
                    });
                    $.unblockUI();
                });
            },500);
        });
    }
</script>