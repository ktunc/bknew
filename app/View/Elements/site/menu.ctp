<?php
$ilansay = $this->requestAction('/sayfas/ilansayilar');
?>

<div class="row padding-tb-5">
    <div class="col-xs-4 padding-rl-2">
        <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:1')">
            <div class="menu1img">
                <img src="<?php echo $this->Html->url('/');?>img/menu/konut.png" width="100%"/>
            </div>
            <h2>Konut</h2>
            <h3><?php echo $ilansay['konut']; ?></h3>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:2')">
            <div class="menu1img"><img src="<?php echo $this->Html->url('/');?>img/menu/isyeri.png" width="100%"/></div>
            <h2>İşyeri</h2>
            <h3><?php echo $ilansay['isyeri']; ?></h3>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:3')">
            <div class="menu1img"><img src="<?php echo $this->Html->url('/');?>img/menu/arsa.png" width="100%"/></div>
            <h2>Arsa</h2>
            <h3><?php echo $ilansay['arsa']; ?></h3>
        </div>
    </div>
</div>
<div class="row padding-tb-5">
    <div class="col-xs-4 padding-rl-2">
        <div class="row">
            <div class="col-xs-12">
                <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:1')">
                    <div class="menu1img">
                        <img src="<?php echo $this->Html->url('/');?>img/menu/projeler.png" width="100%"/>
                    </div>
                    <h4>PROJELER</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:1')">
                    <div class="menu1img">
                        <img src="<?php echo $this->Html->url('/');?>img/menu/teknik_analiz.png" width="100%"/>
                    </div>
                    <h4>TEKNİK ANALİZ</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-8 padding-rl-2">
        <div class="menu1 padding-tb-10 text-center pointer borderGri" onclick="FuncGoLink('sayfas/ilanlar/tur:2')">
            <div class="menu1img"><img src="<?php echo $this->Html->url('/');?>img/menu/harita.png" width="100%"/></div>
        </div>
    </div>
</div>
<div class="row padding-tb-5">
    <div class="col-xs-12 padding-rl-2">
        <iframe id="videoframe" width="100%" height="315" src="https://www.youtube.com/embed/videoseries?list=UUZXNUXvKTHj7siaGdBFkEag&autoplay=1&loop=1&index=<?php echo rand(1,60); ?>" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
<div class="row padding-tb-5">
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-warning padding-tb-5 text-center menu3">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/kelime_arama.png" width="100%"/></div>
            <div><h4>KELİME ARAMA</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-detayli padding-tb-5 text-center menu3 pointer" onclick="FuncDetayliArama()">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/arama.png" width="100%"/></div>
            <div><h4>DETAYLI ARAMA</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-danger padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/projeler')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/projeler.png" width="100%"/></div>
            <div><h4>PROJELER</h4></div>
        </div>
    </div>
</div>
<div class="row padding-tb-5">
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-kurumsal padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/kurumsal')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/kurumsal.png" width="100%"/></div>
            <div><h4>KURUMSAL</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-danismanlar padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/danismanlar')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/danismanlar.png" width="100%"/></div>
            <div><h4>DANIŞMAN</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-analiz padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/teknik_analizler')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/teknik_analiz.png" width="100%"/></div>
            <div><h4>TEKNİK ANALİZ</h4></div>
        </div>
    </div>
</div>
<div class="row padding-tb-5">
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-info padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/haberler')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/haberler.png" width="100%"/></div>
            <div><h4>HABERLER</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="bg-warning padding-tb-5 text-center menu3 pointer" onclick="FuncGoLink('sayfas/formlar')">
            <div class="menu3img"><img src="<?php echo $this->Html->url('/');?>img/menu/formlar.png" width="100%"/></div>
            <div><h4>FORMLAR</h4></div>
        </div>
    </div>
    <div class="col-xs-4 padding-rl-2">
        <div class="text-center menu3">
            <div class="row margin-rl-0 padding-tb-5">
                <div class="col-xs-6 spad-rl"><img src="<?php echo $this->Html->url('/');?>img/menu/face.png" width="100%"/></div>
                <div class="col-xs-6 spad-rl"><img src="<?php echo $this->Html->url('/');?>img/menu/youtube.png" width="100%"/></div>
            </div>
            <div class="row margin-rl-0 padding-tb-5">
                <div class="col-xs-6 spad-rl"><img src="<?php echo $this->Html->url('/');?>img/menu/instagram.png" width="100%"/></div>
                <div class="col-xs-6 spad-rl"><img src="<?php echo $this->Html->url('/');?>img/menu/gplus.png" width="100%"/></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    $('#videoframe').height($('#haritaimg').height());
});
$(window).resize(function () {
    $('#videoframe').height($('#haritaimg').height());
});
function FuncDetayliArama() {
    $('#DetayliAramaModal').modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function FuncGoLink(link) {
    window.location.href="<?php echo $this->Html->url('/');?>"+link;
}
</script>