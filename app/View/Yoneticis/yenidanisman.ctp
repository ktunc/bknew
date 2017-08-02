<?php
echo $this->Html->css(array(
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui',
    'yonetici/plugins/filer/jquery.filer',
    'yonetici/plugins/filer/themes/jquery.filer-dragdropbox-theme',
    'yonetici/plugins/select2/select2.min'
));
$iletisimturu = array(1=>'Telefon', 2=>'Mail');
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
                    <h4>Danışman Ekle</h4>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="form-danisman">
                        <div class="form-group"><label class="col-lg-2 control-label">Adı Soyadı:</label>
                            <div class="col-lg-10"><input type="text" name="isim" placeholder="Adı Soyadı" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Hakkında:</label>
                            <div class="col-lg-10">
                                <textarea name="hakkinda" class="summernote"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">İletişim:</label>
                            <div class="col-lg-10" id="iletisimDiv">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <select class="select2" name="iletisimturu[]">
                                            <?php
                                            foreach($iletisimturu as $k=>$v){
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="iletisim[]" placeholder="İletişim" />
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-sm btn-danger iletisimsil"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="button" class="btn btn-sm btn-success" id="iletisimekle"><i class="fa fa-plus"></i> İletişim Ekle</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="danismandetaykaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                        </div>
                        <input type="hidden" name="danismanId" value="0" />
                    </form>
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
    '../plugin/elfinder/js/i18n/elfinder.tr'
));
?>
    <script type="text/javascript">
        var iletisimtxt = '<div class="row"> <div class="col-lg-2"> <select class="select2" name="iletisimturu[]"><?php foreach($iletisimturu as $k=>$v){ echo '<option value="'.$k.'">'.$v.'</option>';}?></select> </div> <div class="col-lg-9"> <input type="text" class="form-control" name="iletisim[]" placeholder="İletişim" /> </div><div class="col-lg-1"> <button type="button" class="btn btn-sm btn-danger iletisimsil"><i class="fa fa-trash"></i></button> </div> </div>';
        $(document).ready(function(){
            $('.select2').select2({width:'100%'});

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

            $('button#iletisimekle').on('click',function(){
                $('div#iletisimDiv').append(iletisimtxt);
                $('.select2').select2({width:'100%'});
            });

            $('div#iletisimDiv').on('click','button.iletisimsil',function () {
                $(this).closest('div.row').remove();
            });

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