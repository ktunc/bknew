<?php
$sehirler = $this->requestaction('sayfas/sehirler');
?>
<!-- Detayli Arama MODAL -->
<div class="modal inmodal" id="DetayliAramaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detaylı Arama</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-detayli-arama" action="<?php echo $this->Html->url('/'); ?>sayfas/ilanlar" method="post">
                    <div class="form-group"><label class="col-lg-3 control-label">Sözcük:</label>
                        <div class="col-lg-9">
                            <input type="text" name="aramatext" class="form-control" placeholder="Arama Sözcüğü"/>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Arama Türü:</label>
                        <div class="col-lg-9">
                            <select name="tur" class="form-control">
                                <option value="0">Hepsi</option>
                                <option value="1">Konut</option>
                                <option value="2">İşyeri</option>
                                <option value="3">Arsa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Satılık-Kiralık:</label>
                        <div class="col-lg-9">
                            <select name="satkir" class="form-control">
                                <option value="0">Hepsi</option>
                                <option value="1">Satılık</option>
                                <option value="2">Kiralık</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Şehir:</label>
                        <div class="col-lg-9">
                            <select name="sehir_id" class="form-control">
                                <option value="0">Hepsi</option>
                                <?php
                                foreach ($sehirler as $row){
                                    echo '<option value="'.$row['Sehir']['id'].'">'.$row['Sehir']['sehir_adi'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">İlçe:</label>
                        <div class="col-lg-9">
                            <select name="ilce_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Semt:</label>
                        <div class="col-lg-9">
                            <select name="semt_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Mahalle:</label>
                        <div class="col-lg-9">
                            <select name="mahalle_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Fiyat:</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="number" class="form-control" placeholder="Min" name="fiy1">
                                </div>
                                <div class="col-xs-6">
                                    <input type="number" class="form-control" placeholder="Max" name="fiy2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Metre Kare:</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="number" class="form-control" placeholder="Min" name="m1">
                                </div>
                                <div class="col-xs-6">
                                    <input type="number" class="form-control" placeholder="Max" name="m2">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary" id="detayliara">Ara</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#DetayliAramaModal').on('click','button#detayliara',function () {
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        $('#DetayliAramaModal form#form-detayli-arama').submit();
    });

    $('#DetayliAramaModal').on('change','select[name="sehir_id"]',function () {
        $('#DetayliAramaModal select[name="ilce_id"]').html('');
        $('#DetayliAramaModal select[name="semt_id"]').html('');
        $('#DetayliAramaModal select[name="mahalle_id"]').html('');
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        setTimeout(function () {
            $.ajax({
                async:false,
                type:'POST',
                url:'<?php echo $this->Html->url('/');?>sayfas/ilceler',
                data:{'sehir_id':$('#DetayliAramaModal select[name="sehir_id"]').val()}
            }).done(function (data) {
                var dat = $.parseJSON(data);
                if(dat['hata']){
                    $.unblockUI();
                    swal({
                        title: "Hata!!!",
                        text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                        type: "error"
                    });
                }else{
                    $('#DetayliAramaModal select[name="ilce_id"]').html(dat['ilceselect']);
                    $.unblockUI();
                }
            }).fail(function () {
                $.unblockUI();
                swal({
                    title: "Hata!!!",
                    text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                    type: "error"
                });
            });
        },500);
    });

    $('#DetayliAramaModal').on('change','select[name="ilce_id"]',function () {
        $('#DetayliAramaModal select[name="semt_id"]').html('');
        $('#DetayliAramaModal select[name="mahalle_id"]').html('');
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        setTimeout(function () {
            $.ajax({
                async:false,
                type:'POST',
                url:'<?php echo $this->Html->url('/');?>sayfas/semtler',
                data:{'ilce_id':$('#DetayliAramaModal select[name="ilce_id"]').val()}
            }).done(function (data) {
                var dat = $.parseJSON(data);
                if(dat['hata']){
                    $.unblockUI();
                    swal({
                        title: "Hata!!!",
                        text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                        type: "error"
                    });
                }else{
                    $('#DetayliAramaModal select[name="semt_id"]').html(dat['semtselect']);
                    $.unblockUI();
                }
            }).fail(function () {
                $.unblockUI();
                swal({
                    title: "Hata!!!",
                    text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                    type: "error"
                });
            });
        },500);
    });

    $('#DetayliAramaModal').on('change','select[name="semt_id"]',function () {
        $('#DetayliAramaModal select[name="mahalle_id"]').html('');
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        setTimeout(function () {
            $.ajax({
                async:false,
                type:'POST',
                url:'<?php echo $this->Html->url('/');?>sayfas/mahalleler',
                data:{'semt_id':$('#DetayliAramaModal select[name="semt_id"]').val()}
            }).done(function (data) {
                var dat = $.parseJSON(data);
                if(dat['hata']){
                    $.unblockUI();
                    swal({
                        title: "Hata!!!",
                        text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                        type: "error"
                    });
                }else{
                    $('#DetayliAramaModal select[name="mahalle_id"]').html(dat['mahalleselect']);
                    $.unblockUI();
                }
            }).fail(function () {
                $.unblockUI();
                swal({
                    title: "Hata!!!",
                    text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                    type: "error"
                });
            });
        },500);
    });
});

</script>