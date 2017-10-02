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
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui',
    'yonetici/plugins/jasny/jasny-bootstrap.min',
    'yonetici/plugins/iCheck/custom',
    'yonetici/plugins/blueimp/css/blueimp-gallery.min',
    'sortable',
    'yonetici/plugins/filer/jquery.filer',
    'yonetici/plugins/filer/themes/jquery.filer-dragdropbox-theme'
));
$yayinda = "";
if($haber['Haber']['yayinda'] == 1){
    $yayinda = ' checked="checked"';
}
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
                <h4>(<?php echo $haber['Haber']['id']; ?>) Haber Düzenle</h4>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="form-haber">
                    <div class="form-group"><label class="col-lg-2 control-label">Yayında:</label>
                        <div class="col-lg-10"><div class="i-checks"><label> <input type="checkbox" name="yayinda" <?php echo $yayinda; ?> > <i></i> </label></div></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Başlık:</label>
                        <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control" value="<?php echo $haber['Haber']['baslik']; ?>"></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">İçerik:</label>
                        <div class="col-lg-10">
                            <textarea name="icerik" class="summernote"><?php echo $haber['Haber']['icerik']; ?></textarea>
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
                        <div class="col-xs-12">
                            <hr>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="lightBoxGallery">
                                <section class="sortableblock">
                                    <div id="items" class="sortable">
                                        <?php foreach($haber['HaberResim'] as $row){
                                            echo '<div class="col-xs-12 col-sm-3 sortdata" data-haber-id="'.$row['haber_id'].'" data-resim-id="'.$row['id'].'">';
                                            echo '<div class="thumbnail">';
                                            echo '<a href="'.$this->Html->url('/').$row['path'].'" data-gallery="" ><img src="'.$this->Html->url('/').$row['paththumb'].'" width="100%"></a>';
                                            echo '<div class="caption">';
                                            echo '<i onclick="FuncDeleteHaberResim('.$row['id'].')" class="fa fa-trash fa-lg text-danger"></i>';
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
                        <div class="col-lg-10"><button type="button" class="btn btn-outline btn-sm btn-primary dim" id="haberkaydet"><i class="fa fa-check"></i> Kaydet</button></div>
                    </div>
                    <input type="hidden" name="haberId" value="<?php echo $haber['Haber']['id']; ?>" />
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
    'yonetici/plugins/Sortable-master/Sortable',
    'site/jquery.sortable.min',
    'yonetici/plugins/blueimp/jquery.blueimp-gallery.min',
    'yonetici/plugins/filer/jquery.filer.min',
    'yonetici/plugins/filer/jquery.filer.custom'
));
?>
<script type="text/javascript">
    $(document).ready(function(){
        var el = document.getElementById('items');
        var sortable = Sortable.create(el,{
            // Element dragging ended
            onEnd: function (/**Event*/evt) {
//                                alert(evt.oldIndex+1);  // element's old index within parent
//                                alert(evt.newIndex+1);  // element's new index within parent
//                                var ilanId = evt.item.dataset.ilanId;
//                                var resId = evt.item.dataset.resimId;
                FuncHaberResimSirala();
            }
        });

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

        $('#haberkaydet').on('click',function(){
            $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
            var formdata = new FormData($('form#form-haber').get(0));
            setTimeout(function(){
                $.ajax({
                    async:false,
                    type:'POST',
                    url:'<?php echo $this->Html->url('/');?>yoneticis/haberkaydet',
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
                            text: "haber kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyin.",
                            type: "error"
                        });
                        $.unblockUI();
                    }else{
                        $('form#form-haber input[name="haberId"]').val(dat['HaberId']);
                        swal({
                            title: "Başarılı",
                            text: "Haber Başarıyla Kaydedildi.",
                            type: "success",
                            confirmButtonText: 'Tamam'
                        });
                        $.unblockUI();
                    }
                }).fail(function(){
                    swal({
                        title: "Hata",
                        text: "haber kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyin.",
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

    function FuncDeleteHaberResim(resId){
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
                url:'<?php echo $this->Html->url('/');?>yoneticis/haberresimsil',
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

    function FuncHaberResimSirala(){
        var resArr = [];
        $('div#items .sortdata').each(function () {
            resArr.push({'haber-id':$(this).data('haber-id'), 'resim-id':$(this).data('resim-id')});
        });
        $.ajax({
            type:'POST',
            url:'<?php echo $this->Html->url('/');?>yoneticis/haberresimsirala',
            data: {'resimler':resArr}
        }).done(function (data) {

        }).fail(function () {

        });
    }
</script>