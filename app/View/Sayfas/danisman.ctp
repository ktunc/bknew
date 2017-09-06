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
                    echo $row['iletisim'];
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
                echo '<div class="thumbnail">';
                //echo '<img src="'.$this->Html->url('/').$row[''].'" width="100%"/>';
                echo '<div class="caption">';
                echo '<p>'.$row['baslik'].'</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <?php pr($danisman); ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3">
        <?php pr($danismanlar); ?>
    </div>
</div>
