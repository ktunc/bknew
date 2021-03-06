<style>
    .sortable-ghost {
        opacity: .2;
    }

    .drag-handle {
        margin-right: 10px;
        font: bold 20px Sans-Serif;
        color: #5F9EDF;
        display: inline-block;
        cursor: move;
        cursor: -webkit-grabbing;  /* overrides 'move' */
    }

</style>
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
    'yonetici/plugins/select2/select2.min',
    'yonetici/plugins/blueimp/css/blueimp-gallery.min',
    'sortable'
));
$satkir = array(1=>'Satılık',2=>'Kiralık');
$danismanSelect = array(0=>'Seçiniz');
foreach ($danismanlar as $row){
    $danismanSelect[$row['Danisman']['id']] = $row['Danisman']['isim'];
}
?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&libraries=places" type="text/javascript"></script>
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
                            <form class="form-horizontal" id="form-ilan">
                                <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                                    <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control" value="<?php echo $ilan['Ilan']['baslik']; ?>"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                                    <div class="col-lg-10">
                                        <textarea name="icerik" class="summernote"><?php echo $ilan['Ilan']['icerik']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Satılık-Kiralık:</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="satkir">
                                            <?php
                                            foreach ($satkir as $k=>$v){
                                                $selected = '';
                                                if($k == $ilan['Ilan']['satkir']){
                                                    $selected = ' selected="selected"';
                                                }
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            if($tur == 1){
                                ?>
                                    <div class="form-group"><label class="col-lg-2 control-label">Bulunduğu Kat:</label>
                                        <div class="col-lg-10"><input type="text" name="kat" placeholder="Bulunduğu Kat" class="form-control" value="<?php echo $ilan['IlanKonut']['kat']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Bina Kat:</label>
                                        <div class="col-lg-10"><input type="text" name="bina_kat" placeholder="Bina Kat" class="form-control" value="<?php echo $ilan['IlanKonut']['bina_kat']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Oda:</label>
                                        <div class="col-lg-10"><input type="text" name="oda" placeholder="Oda" class="form-control" value="<?php echo $ilan['IlanKonut']['oda']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                        <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control" value="<?php echo $ilan['Ilan']['mkare']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                        <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control" value="<?php echo $ilan['Ilan']['fiyat']; ?>"></div>
                                    </div>
                                    <input type="hidden" name="turu" value="1" />

                                <?php
                            }else if($tur == 2){
                                ?>
                                    <div class="form-group"><label class="col-lg-2 control-label">Bulunduğu Kat:</label>
                                        <div class="col-lg-10"><input type="text" name="kat" placeholder="Bulunduğu Kat" class="form-control" value="<?php echo $ilan['IlanIsyeri']['kat']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Bina Kat:</label>
                                        <div class="col-lg-10"><input type="text" name="bina_kat" placeholder="Bina Kat" class="form-control" value="<?php echo $ilan['IlanIsyeri']['bina_kat']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Oda:</label>
                                        <div class="col-lg-10"><input type="text" name="oda" placeholder="Oda" class="form-control" value="<?php echo $ilan['IlanIsyeri']['oda']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                        <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control" value="<?php echo $ilan['Ilan']['mkare']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                        <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control" <?php echo $ilan['Ilan']['fiyat']; ?>></div>
                                    </div>
                                    <input type="hidden" name="turu" value="2" />
                                <?php
                            }else {
                                ?>
                                    <div class="form-group"><label class="col-lg-2 control-label">İmar Durumu:</label>
                                        <div class="col-lg-10"><input type="text" name="imar" placeholder="İmar Durumu" class="form-control" value="<?php echo $ilan['IlanArsa']['imar']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Ada:</label>
                                        <div class="col-lg-10"><input type="text" name="ada" placeholder="Ada" class="form-control" value="<?php echo $ilan['IlanArsa']['ada']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Parsel:</label>
                                        <div class="col-lg-10"><input type="text" name="parsel" placeholder="Parsel" class="form-control" value="<?php echo $ilan['IlanArsa']['parsel']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Tapu:</label>
                                        <div class="col-lg-10"><input type="text" name="Tapu" placeholder="Tapu" class="form-control" value="<?php echo $ilan['IlanArsa']['tapu']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Metre Kare:</label>
                                        <div class="col-lg-10"><input type="text" name="mkare" placeholder="Metre Kare" class="form-control" value="<?php echo $ilan['Ilan']['mkare']; ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Fiyat:</label>
                                        <div class="col-lg-10"><input type="text" name="fiyat" placeholder="Fiyat" class="form-control" value="<?php echo $ilan['Ilan']['fiyat']; ?>"></div>
                                    </div>
                                    <input type="hidden" name="turu" value="3" />
                                <?php
                            }
                            ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Danışman:</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="danisman">
                                            <?php
                                            foreach($danismanSelect as $k=>$v){
                                                $selected = '';
                                                if($k == $ilan['Danisman']['id']){
                                                    $selected = ' selected="selected"';
                                                }
                                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilandetaykaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="ilanId" value="<?php echo $ilan['Ilan']['id']; ?>" />
                            </form>
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
                                    <div class="col-xs-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                    <div class="lightBoxGallery">
                                        <section class="sortableblock">
                                            <div id="items" class="sortable">
                                            <?php foreach($ilan['IlanResim'] as $row){
                                                echo '<div class="col-xs-12 col-sm-3 sortdata" data-ilan-id="'.$row['ilan_id'].'" data-resim-id="'.$row['id'].'">';
                                                echo '<div class="thumbnail">';
                                                echo '<a href="'.$this->Html->url('/').$row['path'].'" data-gallery="" ><img src="'.$this->Html->url('/').$row['paththumb'].'" width="100%"></a>';
                                                echo '<div class="caption">';
                                                echo '<i onclick="FuncDeleteResim('.$row['id'].')" class="fa fa-trash fa-lg text-danger"></i>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                //echo '<li><a href="'.$this->Html->url('/').$row['path'].'" data-gallery="" ><img src="'.$this->Html->url('/').$row['paththumb'].'" width="100%"></a> <br><i onclick="FuncDeleteResim('.$row['id'].')" class="fa fa-trash fa-lg text-danger"></i></li>';
//                                                echo '<li>';
//                                                echo '<div class="thumbnail">';
//                                                echo '<a href="'.$this->Html->url('/').$row['path'].'" data-gallery="" ><img src="'.$this->Html->url('/').$row['paththumb'].'" width="100%"></a>';
//                                                echo '<div class="caption">';
//                                                echo '<i onclick="FuncDeleteResim('.$row['id'].')" class="fa fa-trash fa-lg text-danger"></i>';
//                                                echo '</div>';
//                                                echo '</div>';
//                                                echo '</li>';

                                            } ?>
                                            </div>
                                        </section>

                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                            <div class="slides"></div>
                                            <h3 class="title"></h3>
                                            <a class="prev">‹</a>
                                            <a class="next">›</a>
                                            <a class="close">×</a>
                                            <a class="play-pause"></a>
                                            <ol class="indicator"></ol>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilanresimkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="ilanId" class="ilanId" value="<?php echo $ilan['Ilan']['id']; ?>"/>
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
                                                $selected='';
                                                if($cow['Sehir']['id'] == $ilan['Ilan']['sehir_id']){
                                                    $selected=' selected="selected"';
                                                }
                                                echo '<option value="'.$cow['Sehir']['id'].'" '.$selected.'>'.$cow['Sehir']['sehir_adi'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">İlçe</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="ilce">
                                            <?php
                                            if($ilce){
                                                echo '<option value="-1">Seçiniz</option>';
                                            }
                                            foreach ($ilce as $row){
                                                $selected='';
                                                if($row['Ilce']['id'] == $ilan['Ilan']['ilce_id']){
                                                    $selected=' selected="selected"';
                                                }
                                                echo '<option value="'.$row['Ilce']['id'].'" '.$selected.'>'.$row['Ilce']['ilce_adi'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Semt</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="semt">
                                            <?php
                                            if($semt){
                                                echo '<option value="-1">Seçiniz</option>';
                                            }
                                            foreach ($semt as $row){
                                                $selected='';
                                                if($row['Semt']['id'] == $ilan['Ilan']['semt_id']){
                                                    $selected=' selected="selected"';
                                                }
                                                echo '<option value="'.$row['Semt']['id'].'" '.$selected.'>'.$row['Semt']['semt_adi'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Mahalle</label>
                                    <div class="col-lg-10">
                                        <select class="select2" name="mahalle">
                                            <?php
                                            if($semt){
                                                echo '<option value="-1">Seçiniz</option>';
                                            }
                                            foreach ($mahalle as $row){
                                                $selected='';
                                                if($row['Mahalle']['id'] == $ilan['Ilan']['mahalle_id']){
                                                    $selected=' selected="selected"';
                                                }
                                                echo '<option value="'.$row['Mahalle']['id'].'" '.$selected.'>'.$row['Mahalle']['mahalle_adi'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Adres</label>
                                    <div class="col-lg-10">
                                        <textarea rows="5" name="adres" class="form-control"><?php echo $ilan['Ilan']['adres'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 col-md-2 control-label" for="us2-address">Location</label>
                                    <div class="col-xs-9 col-md-10">
                                        <input type="text" id="us2-address" name="location"  class="form-control"/>
                                    </div>
                                    <input type="hidden" id="us2-lat" name="latitude" />
                                    <input type="hidden" id="us2-lon" name="longitude" />
                                </div>
                                <div class="form-group">
                                    <div id="us2" class="col-lg-10 col-lg-offset-2" style="min-height: 300px;margin-top: 2%;"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="ilanlocationkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                                </div>
                                <input type="hidden" name="ilanId" class="ilanId" value="<?php echo $ilan['Ilan']['id']; ?>"/>
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
    'yonetici/plugins/steps/jquery.steps.min',
    'yonetici/locationpicker.jquery'
));
echo $this->Html->script('yonetici/plugins/Sortable-master/Sortable');
?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#wizard").steps({
                enableAllSteps: true,
                enableFinishButton:false,
                enableKeyNavigation: false,
                labels: {
                    next: "İleri",
                    previous: "Geri"
                },
                onStepChanged: function (event, currentIndex){
                    if(currentIndex == 2){
                        $('#us2').locationpicker({
                            location: {latitude: <?php echo empty($ilan['Ilan']['latitude'])?0:$ilan['Ilan']['latitude'];?>, longitude: <?php echo empty($ilan['Ilan']['longitude'])?0:$ilan['Ilan']['longitude'];?>},
                            //location: {latitude: 39.918012967883385, longitude: 32.85808648203124},
                            radius: 10,
                            inputBinding: {
                                latitudeInput: $('#us2-lat'),
                                longitudeInput: $('#us2-lon'),
                                radiusInput: $('#us2-radius'),
                                locationNameInput: $('#us2-address')
                            },
                            enableAutocomplete: true
                        });
                    }else if(currentIndex == 1){
//                        $('#sort1, #sort2').sortable();
//                        $('.sortable').sortable().bind('sortupdate', function() {
//                            var i = 1;
//                            $('.sortable li').each(function(){
//                                alert(i+' - '+$(this).data('item'));
//                                i++;
//                            });
//                        });
                        var el = document.getElementById('items');
                        var sortable = Sortable.create(el,{
                            // Element dragging ended
                            onEnd: function (/**Event*/evt) {
//                                alert(evt.oldIndex+1);  // element's old index within parent
//                                alert(evt.newIndex+1);  // element's new index within parent
//                                var ilanId = evt.item.dataset.ilanId;
//                                var resId = evt.item.dataset.resimId;
                                FuncResimSirala();
                            }
                        });
                    }
                },
                onInit: function (event, currentIndex) {
//                    $('#wizard .actions').addClass('hidden');
                    $('#wizard li[role="tab"]:not(.current)').addClass('done');
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
                    var step = <?php echo $step; ?>;
                    for(var i = 0; i < step; i++){
                        $("#wizard").steps("next");
                    }

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
                            }).then(function(){
                                var link = '<?php echo $this->Html->url('/');?>yoneticis/ilanedit/ilan:'+$('form#form-ilan-resim input[name="ilanId"]').val()+'/step:1';
                                window.location.href = link;
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

        function FuncDeleteResim(resId){
            swal({
                title: 'Resmi silmek istediğinizden emin misiniz?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: '<i class="fa fa-trash"></i> Sil',
                cancelButtonText: 'İptal'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/resimsil',
                    data:{'resId':resId}
                }).done(function (data) {
                    var dat = $.parseJSON(data);
                    if(dat['hata']){
                        swal(
                            'Hata!!!',
                            'Resim silinirken bir hata meydana geldi. Lütfen tekrar deneyin.',
                            'danger'
                        );
                    }else{
                        $('[data-resim-id="'+dat['resId']+'"]').remove();
                        FuncResimSirala();
                        swal(
                            'Başarılı!!!',
                            'Resim başarıyla silindi.',
                            'success'
                        );
                    }
                }).fail(function () {
                    swal(
                        'Hata!!!',
                        'Resim silinirken bir hata meydana geldi. Lütfen internet bağlantınızı kontrol ederek tekrar deneyin.',
                        'danger'
                    );
                });
            });
        }

        function FuncResimSirala(){
            var resArr = [];
            $('div#items .sortdata').each(function () {
                resArr.push({'ilan-id':$(this).data('ilan-id'), 'resim-id':$(this).data('resim-id')});
            });
            $.ajax({
                type:'POST',
                url:'<?php echo $this->Html->url('/');?>yoneticis/ilanresimsirala',
                data: {'resimler':resArr}
            }).done(function (data) {

            }).fail(function () {

            });
        }
    </script>
<?php
echo $this->Html->script(array(
    'yonetici/plugins/filer/jquery.filer.min',
    'yonetici/plugins/filer/jquery.filer.custom',
    'yonetici/plugins/select2/select2.full.min',
    'yonetici/plugins/blueimp/jquery.blueimp-gallery.min',
    'site/jquery.sortable.min'
));
?>