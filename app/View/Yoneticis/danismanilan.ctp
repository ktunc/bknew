<?php

$iletisimturu = array(1=>'Telefon', 2=>'Mail');
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h4>Danışman</h4>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="form-danisman">
                        <?php
                        if(!empty($danisman['Danisman']['resim'])){
                        ?>
                        <div class="form-group"><label class="col-lg-2 control-label">Resim:</label>
                            <div class="col-lg-10">
                                <div class="row danismanresim">
                                    <img src="<?php echo $this->Html->url('/').$danisman['Danisman']['resim'];?>" />
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="form-group"><label class="col-lg-2 control-label">Adı Soyadı:</label>
                            <div class="col-lg-10"><?php echo $danisman['Danisman']['isim']; ?></div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Hakkında:</label>
                            <div class="col-lg-10">
                                <?php echo $danisman['Danisman']['hakkinda']; ?>
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
                                        echo $iletisimturu[$cow['turu']].':';
                                        echo '</div>';
                                        echo '<div class="col-lg-10">';
                                        echo $cow['iletisim'];
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <?php
                                foreach ($danisman['Ilan'] as $cow) {
                                    echo '<div class="col-xs-3">';
                                    echo '<div class="thumbnail">';
                                    echo '<img src="'.$this->Html->url('/').$cow['paththumb'].'" style="width:100%;">';
                                    echo '<div class="caption">
                                    <h4 class="media-heading">'.CakeText::truncate($cow['baslik'],50).'</h4>
                                    <div class="text-right">
                                        <a class="btn btn-xs btn-primary" href="'.$this->Html->url('/').'yoneticis/ilanedit/ilan:'.$cow['id'].'" target="_blank">İncele</a>
                                    </div>
                                </div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
