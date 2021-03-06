<?php
echo $this->Html->css('site/FlexSlider/demo');
echo $this->Html->css('site/FlexSlider/flexslider');
echo $this->Html->script('site/FlexSlider/modernizr');
echo $this->Html->css('site/PhotoSwipe/photoswipe');
?>
    <div class="container-fluid bg-white">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <p class="IlanHeader"><?php echo $proje['Proje']['baslik']; ?></p>
            </div>
            <?php if(!empty($proje['ProjeResim'])){ ?>
                <div class="row">
                    <section class="slider">
                        <div class="flexslider">
                            <ul class="slides" id="Gallery">
                                <?php
                                foreach($proje['ProjeResim'] as $row){
                                    echo '<li>'
                                        .'<a href="'.$this->Html->url('/').$row['path'].'">'
                                        . '<img src="'.$this->Html->url('/').$row['path'].'" alt="'.$proje['Proje']['baslik'].' '.$row['id'].'"/>'
                                        .'</a>'
                                        . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </section>
                </div>
            <?php } ?>
            <div class="row">
                <?php echo $proje['Proje']['icerik']; ?>
            </div>
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