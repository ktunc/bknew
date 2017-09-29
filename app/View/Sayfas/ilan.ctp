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
            <!-- Danışman Bilgisi -->
            <div class="col-xs-12 col-sm-5">
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-xs-6">
                            <img src="<?php echo $this->Html->url('/').$ilan['Danisman']['resim']; ?>" width="100%"/>
                        </div>
                        <div class="col-xs-6">
                            <p class="IlanDanismanIsim"><?php echo $ilan['Danisman']['isim']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-2x fa-phone-square text-success"></i>
                        </div>
                        <div class="col-xs-4">
                            <i class="fa fa-2x fa-envelope text-warning"></i>
                        </div>
                        <div class="col-xs-4">
                            <i class="fa fa-2x fa-list text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- İlan Bilgisi -->
            <div class="col-xs-12 col-sm-7">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <td width="50%">İlan NO:</td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%">İlan Tarihi:</td>
                            <td width="50%"><?php echo $ilan['Ilan']['duzenlenme_tarihi'];?></td>
                        </tr>
                        <tr>
                            <td width="50%">Emlak Tipi:</td>
                            <td width="50%"><?php
                                if($ilan['Ilan']['turu'] == 1){
                                    echo 'Konut';
                                }else if($ilan['Ilan']['turu'] == 2){
                                    echo 'İş Yeri';
                                }else{
                                    echo 'Arsa';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        if($ilan['Ilan']['turu'] == 1){
                        ?>
                            <tr>
                                <td width="50%">Bulunduğu Kat:</td>
                                <td width="50%"><?php echo $ilan['IlanKonut']['kat'];?></td>
                            </tr>
                            <tr>
                                <td width="50%">Kat Sayısı:</td>
                                <td width="50%"><?php echo $ilan['IlanKonut']['bina_kat'];?></td>
                            </tr>
                            <tr>
                                <td width="50%">Oda Sayısı:</td>
                                <td width="50%"><?php echo $ilan['IlanKonut']['oda'];?></td>
                            </tr>
                            <tr>
                                <td width="50%">m<sup>2</sup></td>
                                <td width="50%"><?php echo $ilan['IlanKonut']['mkare'];?></td>
                            </tr>
                            <tr>
                                <td width="50%">Krediye Uygunluk:</td>
                                <td width="50%"></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <?php echo $ilan['Ilan']['icerik']; ?>
        </div>
        <?php pr($ilan); ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3">
        <?php
        foreach($ilanlar as $row){
            echo '<a class="row thumbnail margin-rl-0" href="'.$this->Html->url('/').'ilan/ilan:'.$row['Ilan']['id'].'">';
            if(!empty($row['IlanResim'])){
                echo '<img src="'.$this->Html->url('/').$row['IlanResim'][0]['paththumb'].'" width="100%"/>';
                echo '<p class="IlanHeader2">'.$row['Ilan']['baslik'].'</p>';
            }else{
                echo '<img src="'.$this->Html->url('/').'img/logo-xxs.png" width="100%"/>';
                echo '<p class="IlanHeader2">'.$row['Ilan']['baslik'].'</p>';
            }
            echo '<p class="IlanAdres2">'.(!empty($row['Mahalle']['id'])?$row['Mahalle']['mahalle_adi'].' / ':'').(!empty($row['Semt']['id'])?$row['Semt']['semt_adi'].' / ':'').(!empty($row['Ilce']['id'])?$row['Ilce']['ilce_adi'].' / ':'').(!empty($row['Sehir']['id'])?$row['Sehir']['sehir_adi']:'').'</p>';
            $ilanturu = $satkir = "";
            if($row['Ilan']['satkir'] == 1){
                $satkir = "Satılık";
            }else{
                $satkir = "Kiralık";
            }

            if($row['Ilan']['turu'] == 1){
                $ilanturu = "Konut";
            }else if($row['Ilan']['turu'] == 2){
                $ilanturu = "İş Yeri";
            }else{
                $ilanturu = "Arsa";
            }
            echo '<p class="IlanAdres2">'.$satkir.' '.$ilanturu.'</p>';
            echo '</a>';
        }
        ?>
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