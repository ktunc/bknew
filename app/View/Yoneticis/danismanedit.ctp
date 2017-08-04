<?php
echo $this->Html->css(array(
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui',
    'yonetici/plugins/select2/select2.min',
    'yonetici/plugins/jasny/jasny-bootstrap.min'
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
                        <div class="form-group"><label class="col-lg-2 control-label">Resim:</label>
                            <div class="col-lg-10">
                                <?php
                                if(!empty($danisman['Danisman']['resim'])){
                                ?>
                                    <div class="row danismanresim">
                                        <img src="<?php echo $this->Html->url('/').$danisman['Danisman']['resim'];?>" />
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="row fileresim">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seç</span>
                                        <span class="fileinput-exists">Değiştir</span>
                                        <input type="file" name="danismanresim"/>
                                    </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Adı Soyadı:</label>
                            <div class="col-lg-10"><input type="text" name="isim" placeholder="Adı Soyadı" class="form-control" value="<?php echo $danisman['Danisman']['isim']; ?>"></div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Hakkında:</label>
                            <div class="col-lg-10">
                                <textarea name="hakkinda" class="summernote"><?php echo $danisman['Danisman']['hakkinda']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">İletişim:</label>
                            <div class="col-lg-10" id="iletisimDiv">
                                <?php
                                if(!empty($danisman['DanismanIletisim'])){
                                    foreach($danisman['DanismanIletisim'] as $cow){
                                        echo '<div class="row">';
                                        echo '<div class="col-lg-2">';
                                        echo '<select class="select2" name="iletisimturu[]">';
                                        foreach($iletisimturu as $k=>$v){
                                            $selected="";
                                            if($k == $cow['turu']){
                                                $selected=' selected="selected"';
                                            }
                                            echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                        }
                                        echo '</select>';
                                        echo '</div>';
                                        echo '<div class="col-lg-9">';
                                        echo '<input type="text" class="form-control" name="iletisim[]" placeholder="İletişim" value="'.$cow['iletisim'].'"/>';
                                        echo '</div>';
                                        echo '<div class="col-lg-1"><button type="button" class="btn btn-sm btn-danger iletisimsil"><i class="fa fa-trash"></i></button></div>';
                                        echo '</div>';
                                    }
                                }else{
                                ?>
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
                                <?php } ?>
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="button" class="btn btn-sm btn-success" id="iletisimekle"><i class="fa fa-plus"></i> İletişim Ekle</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="danismankaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                        </div>
                        <input type="hidden" name="danismanId" value="<?php echo $danisman['Danisman']['id']; ?>" />
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
    'yonetici/plugins/jasny/jasny-bootstrap.min'
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

            $('#danismankaydet').on('click',function(){
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
                var formdata = new FormData($('form#form-danisman').get(0));
                setTimeout(function(){
                    $.ajax({
                        async:false,
                        type:'POST',
                        url:'<?php echo $this->Html->url('/');?>yoneticis/danismankaydet',
                        enctype: 'multipart/form-data',
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false
                    }).done(function(data){
                        var dat = $.parseJSON(data);
                        if(dat['hata']){

                        }else{
                            $('form#form-danisman input[name="danismanId"]').val(dat['danismanId']);
                            $('.danismanresim').remove();
                            if(dat['resim']){
                                $('.fileresim').before('<div class="row danismanresim"><img src="'+dat['resim']+'" /></div>');
                            }

                            swal({
                                title: "Başarılı",
                                text: "Danışman Başarıyla Kaydedildi.",
                                type: "success",
                                confirmButtonText: 'Tamam'
                            });
                            $.unblockUI();
                        }
                    }).fail(function(){

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
    'yonetici/plugins/select2/select2.full.min'
));
?>