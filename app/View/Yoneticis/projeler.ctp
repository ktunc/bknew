<?php
echo $this->Html->css(array('yonetici/plugins/dataTables/datatables.min'));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Projeler</h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th width="5%">Proje ID</th>
                            <th>Başlık</th>
                            <th width="5%">Yayında</th>
                            <th width="5%">Düzenle</th>
                            <th width="5%">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($projeler as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Proje']['id'].'</td>';
                            echo '<td>'.$row['Proje']['baslik'].'</td>';
                            if($row['Proje']['yayinda'] == 1){
                                echo '<td class="text-center text-primary"><i class="fa fa-check fa-lg"></i></td>';
                            }else {
                                echo '<td class="text-center text-danger"><i class="fa fa-times fa-lg"></i></td>';
                            }
                            echo '<td class="text-center"><a href="'.$this->Html->url('/').'yoneticis/projeedit/pId:'.$row['Proje']['id'].'"><i class="fa fa-edit fa-lg text-success"></i></a></td>';
                            echo '<td class="text-center"><i class="fa fa-times fa-lg text-danger" onclick="FuncProjeSil('.$row['Proje']['id'].')"></i></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th width="5%">Proje ID</th>
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

    function FuncProjeSil(pId){
        swal({
            title: 'Projeyi silmek istediğinizden emin misiniz?',
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
                    url:'<?php echo $this->Html->url('/');?>yoneticis/projesil',
                    data: {'pId':pId}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){
                        swal({
                            title: "Hata",
                            text: "Proje silinirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                            type: "error"
                        });
                        $.unblockUI();
                    }else{
                        $.unblockUI();
                        swal({
                            title: "Başarılı",
                            text: "Proje başarıyla silindi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        }).then(function(){
                            window.location.href = "<?php echo $this->Html->url('/');?>yoneticis/projeler";
                            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
                        });

                    }
                }).fail(function(){
                    swal({
                        title: "Hata",
                        text: "Proje silinirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                        type: "error"
                    });
                    $.unblockUI();
                });
            },500);
        });
    }
</script>