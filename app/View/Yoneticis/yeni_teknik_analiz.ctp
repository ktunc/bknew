<?php
echo $this->Html->css(array(
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui',
    'yonetici/plugins/jasny/jasny-bootstrap.min',
    'yonetici/plugins/iCheck/custom',
    'yonetici/plugins/filer/jquery.filer',
    'yonetici/plugins/filer/themes/jquery.filer-dragdropbox-theme'
));
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
                    <h4>Teknik Analiz Ekle</h4>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="form-haber">
                        <div class="form-group"><label class="col-lg-2 control-label">Yayında:</label>
                            <div class="col-lg-10"><div class="i-checks"><label> <input type="checkbox" name="yayinda" checked="checked" > <i></i> </label></div></div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                            <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                            <div class="col-lg-10">
                                <textarea name="icerik" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Resimler:</label>
                            <div class="col-lg-10">
                                <div id="content">

                                    <!-- Example 2 -->
                                    <input type="file" name="files[]" id="filer_input2" multiple="multiple" accept="image/*">
                                    <!-- end of Example 2 -->

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="teknikanalizkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                        </div>
                        <input type="hidden" name="taId" value="0" />
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
    '../plugin/elfinder/js/i18n/elfinder.tr',
    'yonetici/plugins/jasny/jasny-bootstrap.min',
    'yonetici/plugins/iCheck/icheck.min',
    'yonetici/plugins/filer/jquery.filer.min',
    'yonetici/plugins/filer/jquery.filer.custom'
));
?>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

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

            $('#teknikanalizkaydet').on('click',function(){
                $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
                var formdata = new FormData($('form#form-haber').get(0));
                setTimeout(function(){
                    $.ajax({
                        async:false,
                        type:'POST',
                        url:'<?php echo $this->Html->url('/');?>yoneticis/teknikanalizkaydet',
                        enctype: 'multipart/form-data',
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false
                    }).done(function(data){
                        var dat = $.parseJSON(data);
                        if(dat['hata']){
                            swal({
                                title: "Hata",
                                text: "Teknik Analiz kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                                type: "error"
                            });
                            $.unblockUI();
                        }else{
                            $('form#form-haber input[name="taId"]').val(dat['taId']);
                            swal({
                                title: "Başarılı",
                                text: "Teknik Analiz Başarıyla Kaydedildi.",
                                type: "success",
                                confirmButtonText: 'Tamam'
                            }).then(function(){
                                window.location.href = "<?php echo $this->Html->url('/');?>yoneticis/teknikanalizedit/taId:"+dat['taId'];
                            });
                            $.unblockUI();
                        }
                    }).fail(function(){
                        swal({
                            title: "Hata",
                            text: "Teknik Analiz kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                            type: "error"
                        });
                        $.unblockUI();
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