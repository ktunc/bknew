<?php
echo $this->Html->css(array(
    'yonetici/plugins/iCheck/custom',
    'yonetici/plugins/steps/jquery.steps',
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui',
    'yonetici/plugins/filer/jquery.filer',
    'yonetici/plugins/filer/themes/jquery.filer-dragdropbox-theme',
    'yonetici/plugins/select2/select2.min'
));
$satkir = array(1=>'Satılık',2=>'Kiralık');
?>
<style>
.dialogelfinder{
    z-index: 20000;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4><?php echo $ilanHeader; ?></h4>
            </div>
            <div class="ibox-content">
                <div id="wizard" class="wizard wizard-big clearfix">
                    <h1>İlan Bilgileri</h1>
                    <div class="step-content">
                        <?php
                        if($tur == 1){
                        ?>
                            <form class="form-horizontal" id="form-ilan">
                                <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                                    <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                                    <div class="col-lg-10">
                                        <textarea name="icerik" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Satılık-Kiralık:</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="satkir">
                                            <?php
                                            foreach ($satkir as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Bulunduğu Kat:</label>
                                    <div class="col-lg-10"><input type="text" name="kat" placeholder="Bulunduğu Kat" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Bina Kat:</label>
                                    <div class="col-lg-10"><input type="text" name="bina_kat" placeholder="Bina Kat" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Oda:</label>
                                    <div class="col-lg-10"><input type="text" name="oda" placeholder="Oda" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                    <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                    <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilandetaykaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="turu" value="1" />
                                <input type="hidden" name="ilanId" value="0" />
                            </form>
                        <?php
                        }else if($tur == 2){
                        ?>
                            <form class="form-horizontal" id="form-ilan">
                                <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                                    <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                                    <div class="col-lg-10">
                                        <textarea name="icerik" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Satılık-Kiralık:</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="satkir">
                                            <?php
                                            foreach ($satkir as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Bulunduğu Kat:</label>
                                    <div class="col-lg-10"><input type="text" name="kat" placeholder="Bulunduğu Kat" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Bina Kat:</label>
                                    <div class="col-lg-10"><input type="text" name="bina_kat" placeholder="Bina Kat" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Oda:</label>
                                    <div class="col-lg-10"><input type="text" name="oda" placeholder="Oda" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                    <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                    <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilandetaykaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="turu" value="2" />
                                <input type="hidden" name="ilanId" value="0" />
                            </form>
                        <?php
                        }else {
                        ?>
                            <form class="form-horizontal" id="form-ilan">
                                <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                                    <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                                    <div class="col-lg-10">
                                        <textarea name="icerik" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Satılık-Kiralık:</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="satkir">
                                            <?php
                                            foreach ($satkir as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İmar Durumu:</label>
                                    <div class="col-lg-10"><input type="text" name="imar" placeholder="İmar Durumu" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Ada:</label>
                                    <div class="col-lg-10"><input type="text" name="ada" placeholder="Ada" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Parsel:</label>
                                    <div class="col-lg-10"><input type="text" name="parsel" placeholder="Parsel" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Tapu:</label>
                                    <div class="col-lg-10"><input type="text" name="Tapu" placeholder="Tapu" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                    <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                    <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilandetaykaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="turu" value="3" />
                                <input type="hidden" name="ilanId" class="ilanId" value="0" />
                            </form>
                        <?php
                        }
                        ?>
                    </div>

                    <h1>İlan Resimleri</h1>
                    <div class="step-content">
                        <form class="form-horizontal" id="form-ilan-resim">
                            <div class="form-group">
                                <div id="content">

                                    <!-- Example 2 -->
                                    <input type="file" name="files[]" id="filer_input2" multiple="multiple" accept="image/*">
                                    <!-- end of Example 2 -->

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilanresimkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                            </div>
                            <input type="hidden" name="ilanId" class="ilanId" value="0"/>
                        </form>
                    </div>

                    <h1>İlan Lokasyonu</h1>
                    <div class="step-content">
                        <form class="form-horizontal" id="form-ilan-location">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Şehir</label>
                                <div class="col-lg-10">
                                    <select class="select2" name="sehir">
                                        <option value="-1">Seçiniz</option>
                                        <?php
                                        foreach($sehir as $cow){
                                            echo '<option value="'.$cow['Sehir']['id'].'">'.$cow['Sehir']['sehir_adi'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">İlçe</label>
                                <div class="col-lg-10">
                                    <select class="select2" name="ilce"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Semt</label>
                                <div class="col-lg-10">
                                    <select class="select2" name="semt"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mahalle</label>
                                <div class="col-lg-10">
                                    <select class="select2" name="mahalle"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Adres</label>
                                <div class="col-lg-10">
                                    <textarea rows="5" name="adres" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilanlocationkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                            </div>
                            <input type="hidden" name="ilanId" class="ilanId" value="0"/>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array(
    'yonetici/plugins/summernote/summernote.min',
    'yonetici/plugins/summernote/summernote-ext-elfinder',
    'yonetici/plugins/summernote/summernote-tr-TR.min',
    'yonetici/plugins/jquery-ui/jquery-ui.min',
    '../plugin/elfinder/js/elfinder.min',
    '../plugin/elfinder/js/i18n/elfinder.tr',
    'yonetici/plugins/steps/jquery.steps.min'
));
?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#wizard").steps({
            enableFinishButton:false,
            enableKeyNavigation: false,
            labels: {
                next: "İleri",
                previous: "Geri"
            },
            onInit: function (event, currentIndex) {
                $('#wizard .actions').addClass('hidden');
                $('.summernote').summernote({
                    height: 300,
                    minHeight: 300,
                    lang: 'tr-TR',
                    toolbar: [
                        ['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['link','video','table','hr']],
                        ['elfinder', ['elfinder']]
                    ]
                });
            }
        });

        $('.select2').select2({width:'100%'});

        $('#ilandetaykaydet').on('click',function(){
//            swal({
//                title: "Başarılı",
//                text: "İlan Başarıyla Kaydedildi.",
//                type: "success",
//                showCancelButton: false,
//                confirmButtonClass: 'fa fa-check',
//                confirmButtonText: 'Tamam',
//                closeOnConfirm: false
//            }, function () {
//                swal("Deleted!", "Your imaginary file has been deleted.", "success");
//            });
            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
            var formdata = new FormData($('form#form-ilan').get(0));
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ilankaydet',
                    enctype: 'multipart/form-data',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){

                    }else{
                        $('form#form-ilan input[name="ilanId"]').val(dat['ilanId']);
                        $('form#form-ilan-resim input[name="ilanId"]').val(dat['ilanId']);
                        $('form#form-ilan-location input[name="ilanId"]').val(dat['ilanId']);
                        swal({
                            title: "Başarılı",
                            text: "İlan Başarıyla Kaydedildi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        });
                        $('#wizard .actions').removeClass('hidden');
                        $.unblockUI();
                    }
                }).fail(function(){

                });
            },500);
        });

        $('#ilanresimkaydet').on('click',function(){
            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
            var formdata = new FormData($('form#form-ilan-resim').get(0));
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ilanresimkaydet',
                    enctype: 'multipart/form-data',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){

                    }else{
                        swal({
                            title: "Başarılı",
                            text: "İlan Resimleri Başarıyla Kaydedildi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        });
                        $('#wizard .actions').removeClass('hidden');
                        $.unblockUI();
                    }
                }).fail(function(){

                });
            },500);
        });

        $('#ilanlocationkaydet').on('click',function(){
            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
            var formdata = new FormData($('form#form-ilan-location').get(0));
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ilanlocationkaydet',
                    enctype: 'multipart/form-data',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){

                    }else{
                        swal({
                            title: "Başarılı",
                            text: "İlan Adres ve Lokasyonu Başarıyla Kaydedildi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        });
                        $('#wizard .actions').removeClass('hidden');
                        $.unblockUI();
                    }
                }).fail(function(){

                });
            },500);
        });

        $('select[name="sehir"]').on('change',function(){
            $.blockUI();
            var sehir = $(this).val();
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ajaxIlceBySehir',
                    data:{'sehir':sehir}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['select'] == false){
                        $.unblockUI();
                        $('select[name="ilce"]').html('').select2({width:"100%"});
                        $('select[name="semt"]').html('').select2({width:"100%"});
                        $('select[name="mahalle"]').html('').select2({width:"100%"});
                    }else{
                        $('select[name="ilce"]').html(dat['select']).select2({width:"100%"});
                        $('select[name="semt"]').html('').select2({width:"100%"});
                        $('select[name="mahalle"]').html('').select2({width:"100%"});
                        $.unblockUI();
                    }
                }).fail(function(){
                    $.unblockUI();
                    $('select[name="ilce"]').html('').select2({width:"100%"});
                    $('select[name="semt"]').html('').select2({width:"100%"});
                    $('select[name="mahalle"]').html('').select2({width:"100%"});
                });
            },500);
        });

        $('select[name="ilce"]').on('change',function(){
            $.blockUI();
            var ilce = $(this).val();
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ajaxSemtByIlce',
                    data:{'ilce':ilce}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['select'] == false){
                        $.unblockUI();
                        $('select[name="semt"]').html('').select2({width:"100%"});
                        $('select[name="mahalle"]').html('').select2({width:"100%"});
                    }else{
                        $('select[name="semt"]').html(dat['select']).select2({width:"100%"});
                        $('select[name="mahalle"]').html('').select2({width:"100%"});
                        $.unblockUI();
                    }
                }).fail(function(){
                    $.unblockUI();
                    $('select[name="semt"]').html('').select2({width:"100%"});
                    $('select[name="mahalle"]').html('').select2({width:"100%"});
                });
            },500);
        });

        $('select[name="semt"]').on('change',function(){
            $.blockUI();
            var semt = $(this).val();
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/ajaxMahalleBySemt',
                    data:{'semt':semt}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['select'] == false){
                        $.unblockUI();
                        $('select[name="mahalle"]').html('').select2({width:"100%"});
                    }else{
                        $('select[name="mahalle"]').html(dat['select']).select2({width:"100%"});
                        $.unblockUI();
                    }
                }).fail(function(){
                    $.unblockUI();
                    $('select[name="mahalle"]').html('').select2({width:"100%"});
                });
            },500);
        });

    });

    function elfinderDialog(id,t,c){
        var fm=$('<div/>').dialogelfinder({
            url:'http://bk.dev/plugin/elfinder/php/connector.minimal.php',
            lang:'tr',
            width:900,
            height:450,
            destroyOnClose:true,
            getFileCallback:function(files,fm){
                if(id>0){
                    $('#block').css({display:'block'});
                    $('#'+c).val(files.url);
                    $('#'+c+'image').attr('src',files.url);
                    update(id,t,c,files.url);
                }else{
                    $('.summernote').summernote('editor.insertImage',files.url);
                }
            },
            commandsOptions:{
                getfile:{
                    oncomplete:'close',
                    folders:false
                }
            }
        }).dialogelfinder('instance');
    }
</script>
<?php
echo $this->Html->script(array(
        'yonetici/plugins/filer/jquery.filer.min',
    'yonetici/plugins/filer/jquery.filer.custom',
    'yonetici/plugins/select2/select2.full.min'
));
?>