<?php
echo $this->Html->css('site/FlexSlider/demo');
echo $this->Html->css('site/FlexSlider/flexslider');
echo $this->Html->script('site/FlexSlider/modernizr');
echo $this->Html->css('site/PhotoSwipe/photoswipe');
?>
<div class="container-fluid bg-white">
    <div class="col-sm-12 col-md-9">
        <div class="row">
            <p class="IlanHeader"><?php echo $ilan['Ilan']['baslik']; ?></p>
            <p class="IlanAdres"><?php echo (!empty($ilan['Mahalle']['id'])?$ilan['Mahalle']['mahalle_adi'].' / ':'').(!empty($ilan['Semt']['id'])?$ilan['Semt']['semt_adi'].' / ':'').(!empty($ilan['Ilce']['id'])?$ilan['Ilce']['ilce_adi'].' / ':'').(!empty($ilan['Sehir']['id'])?$ilan['Sehir']['sehir_adi']:''); ?></p>
            <div class="row">
                <div class="col-xs-6">
                    Navi
                </div>
                <div class="col-xs-6 text-danger font-bold text-right">
                    <i class="fa fa-try"></i> <?php echo number_format($ilan['Ilan']['fiyat'],2,',','.'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides" id="Gallery">
                        <?php
                        foreach($ilan['IlanResim'] as $row){
                            echo '<li>'
                                .'<a href="'.$this->Html->url('/').$row['path8'].'">'
                                . '<img src="'.$this->Html->url('/').$row['path8'].'" alt="'.$ilan['Ilan']['baslik'].' '.$row['id'].'"/>'
                                .'</a>'
                                . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="row">
            <?php echo $ilan['Ilan']['icerik']; ?>
        </div>
        <?php pr($ilan); ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3">
        <?php pr($ilanlar); ?>
    </div>
</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?php
echo $this->Html->script('site/FlexSlider/jquery.flexslider-min');
echo $this->Html->script('site/PhotoSwipe/simple-inheritance.min');
echo $this->Html->script('site/PhotoSwipe/code-photoswipe-1.0.11');
?>

<script type="text/javascript">
    $(function(){
        SyntaxHighlighter.all();
    });
    $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "slide"
        });

        Code.photoSwipe('a', '#Gallery');
    });

</script>

<?php
echo $this->Html->script('site/FlexSlider/shCore');
echo $this->Html->script('site/FlexSlider/shBrushXml');
echo $this->Html->script('site/FlexSlider/shBrushJScript');
echo $this->Html->script('site/FlexSlider/jquery.easing');
echo $this->Html->script('site/FlexSlider/jquery.mousewheel');
echo $this->Html->script('site/FlexSlider/demo');
?>