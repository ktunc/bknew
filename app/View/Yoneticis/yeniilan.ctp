<?php
echo $this->Html->css(array(
    'yonetici/plugins/iCheck/custom',
    'yonetici/plugins/steps/jquery.steps',
    'yonetici/plugins/summernote/summernote',
    'yonetici/plugins/summernote/summernote-bs3'
));
?>

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
                                        <textarea name="aciklama" class="summernote">
                                            <h3>Lorem Ipsum is simply</h3>
                                            dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                            <br/>
                                            <br/>
                                            <ul>
                                                <li>Remaining essentially unchanged</li>
                                                <li>Make a type specimen book</li>
                                                <li>Unknown printer</li>
                                            </ul>
                                        </textarea>
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
                                <div class="form-group"><button type="submit">Gonder</button></div>
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
    'yonetici/plugins/steps/jquery.steps.min'
));
?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#wizard").steps({
            enableFinishButton:false,
            labels: {
                next: "İleri",
                previous: "Geri",
            },
            onInit: function (event, currentIndex) {
                $('#wizard .actions').addClass('hidden');
                $('.summernote').summernote();
            }
        });
    });
</script>