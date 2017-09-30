<div class="container-fluid bg-white">
    <div class="col-sm-12 col-md-9">
        <div class="row">
            <div class="col-xs-5">
                <img src="<?php echo $this->Html->url('/').$danisman['Danisman']['resim']; ?>" width="100%">
            </div>
            <div class="col-xs-7">
                <p class="IlanDanismanIsim"><?php echo $danisman['Danisman']['isim']; ?></p>
                <?php
                foreach($danisman['DanismanIletisim'] as $row){
                    echo '<p>';
                    if($row['turu'] == 1){
                        echo '<i class="fa fa-2x fa-phone-square text-success"></i> ';
                    }else if($row['turu'] == 2){
                        echo '<i class="fa fa-2x fa-envelope text-warning"></i> ';
                    }
                    echo $row['Iletisim'];
                    echo '</p>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <?php echo $danisman['Danisman']['hakkinda']; ?>
        </div>

        <div class="row">
            <!-- İlanlar -->
            <?php
            foreach($danisman['Ilan'] as $row){
                echo '<div class="col-xs-12 col-sm-4">';
                echo '<a class="thumbnail" href="'.$this->Html->url('/').'sayfas/ilan/ilan:'.$row['id'].'">';
                echo '<img src="'.$this->Html->url('/').$row['paththumb'].'" width="100%"/>';
                echo '<div class="caption">';
                echo '<p class="IlanHeader2">'.$row['baslik'].'</p>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="hidden-xs hidden-sm col-md-3">
        <?php
        foreach($danismanlar as $row){
            echo '<a class="row thumbnail margin-rl-0" href="'.$this->Html->url('/').'sayfas/danisman/dId:'.$row['Danisman']['id'].'">';
            if(!empty($row['Danisman']['resim'])){
                echo '<img src="'.$this->Html->url('/').$row['Danisman']['resim'].'" width="100%"/>';
            }else{
                echo '<img src="'.$this->Html->url('/').'img/logo-xxs.png" width="100%"/>';
            }
            echo '<p class="IlanHeader2">'.$row['Danisman']['isim'].'</p>';
            echo '</a>';
        }
        ?>
    </div>
</div>
