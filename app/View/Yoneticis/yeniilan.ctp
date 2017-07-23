<?php
echo $this->Html->css(array(
    'yonetici/plugins/iCheck/custom',
    'yonetici/plugins/steps/jquery.steps',
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3',
    '../plugin/elfinder/css/elfinder.min',
    'yonetici/plugins/jQueryUI/jquery-ui'
));
?>
<style>
    .dialogelfinder {
        z-index: 2000;
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
                            <form class="form-horizontal" method="post" id="form-ilan" action="<?php echo $this->Html->url('/');?>yoneticis/test" enctype="multipart/form-data">
                                <div class="form-group"><label class="col-lg-2 control-label">Başlık</label>
                                    <div class="col-lg-10"><input type="text" name="baslik" placeholder="Başlık" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">İçerik</label>
                                    <div class="col-lg-10">
                                        <textarea name="aciklama" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"><label class=""> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><i></i> Remember me </label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                                    </div>
                                </div>
                                <div class="form-group"><button type="submit" onclick="alert($('.summernote').summernote('code'))">Gonder</button></div>
                            </form>
                        <?php
                        }else if($tur == 2){
                        ?>
                            <form class="form-horizontal" id="form-ilan">
                                <p>Sign in today for more expirience.</p>
                                <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                    <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control"> <span class="help-block m-b-none">Example block-level help text here.</span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Password</label>

                                    <div class="col-lg-10"><input type="password" placeholder="Password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"><label class=""> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><i></i> Remember me </label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }else {
                        ?>
                            <form class="form-horizontal" id="form-ilan">
                                <p>Sign in today for more expirience.</p>
                                <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                    <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control"> <span class="help-block m-b-none">Example block-level help text here.</span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Password</label>

                                    <div class="col-lg-10"><input type="password" placeholder="Password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"><label class=""> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><i></i> Remember me </label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>

                    <h1>İlan Resimleri</h1>
                    <div class="step-content">

                    </div>

                    <h1>Third Step</h1>
                    <div class="step-content">

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
    'yonetici/plugins/jquery-ui/jquery-ui.min',
    '../plugin/elfinder/js/elfinder.min',
    'yonetici/plugins/steps/jquery.steps.min'
));
?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#wizard").steps({
            enableFinishButton:false,
            labels: {
                next: "İleri",
                previous: "Geri"
            },
            onInit: function (event, currentIndex) {
                $('#wizard .actions').addClass('hidden');
                $('.summernote').summernote({
                    toolbar: [
                        ['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['elfinder','link','video','table','hr','picture']]
                    ]
                });
            }
        });
    });

//    function elfinderDialog() {
//        var fm = $('<div/>').dialogelfinder({
//            url : 'http://bk.dev/plugin/elfinder/connector.minimal.php', // change with the url of your connector
//            lang : 'en',
//            width : 840,
//            height: 450,
//            destroyOnClose : true,
//            getFileCallback : function(files, fm) {
//                console.log(files);
//                $('.editor').summernote('editor.insertImage', files.url);
//            },
//            commandsOptions : {
//                getfile : {
//                    oncomplete : 'close',
//                    folders : false
//                }
//            }
//        }).dialogelfinder('instance');
//    }

    function elfinderDialog(id,t,c){
        var fm=$('<div/>').dialogelfinder({
            url:'http://bk.dev/plugin/elfinder/php/connector.minimal.php',
            lang:'en',
            width:840,
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