<div id="map_canvas" class="mapcanvas"></div>
<div class="mapContent" id="mapContent">
    <div class="div40 map-ilan-img text-center" id="map-ilan-img"></div>
    <div class="div60 font10 map-ilan-content" id="map-ilan-content"></div>
</div>
<div id="mapSearch" style="display:inline-block;
    background-color: transparent;
border-radius: 5px;margin-right: 10px; margin-bottom:10px;text-align: right">
    <img class="mapIcon" alt="batikapigayrimenkul_gmapuydu_icon" src="<?php echo $this->webroot;?>img/uydu45.png" onclick="FuncMapTypeChange()"/><br>
    <img class="mapIcon" alt="batikapigayrimenkul_gmapkelsearch_icon" src="<?php echo $this->webroot;?>img/kel45.png" onclick="FuncMapTextSearch()"/><br>
    <img class="mapIcon" alt="batikapigayrimenkul_gmapfilter_icon" src="<?php echo $this->webroot;?>img/filter45.png" onclick="FuncDetSearch()"/><br>
<!--    <a href="--><?php //echo $this->Html->url('/').'users/arama'.$this->requestAction(array('controller'=>'users','action'=>'GetPagUrl'),$pagg);?><!--"><img class="mapIcon" alt="batikapigayrimenkul_gmaplisteleme_icon" src="--><?php //echo $this->webroot;?><!--img/listele45.png"/></a>-->
    <!-- <button type="button" class="btn btn-xs btn-primary" onclick="FuncSetNowPosition()" style="margin-top:5px;"><i class="fa fa-2x fa-compass"></i></button> -->
</div>
<div id="mapSearch2" style="display:inline-block;
    background-color: transparent;
border-radius: 5px;margin-right: 10px; margin-bottom:10px;text-align: right">
    <a href="<?php echo $this->Html->url('/');?>sayfas/index/tur:1"><img class="mapIcon" alt="batikapigayrimenkul_gmapkonut_icon" src="<?php echo $this->webroot;?>img/kon45.png"/></a><br>
    <a href="<?php echo $this->Html->url('/');?>sayfas/index/tur:2"><img class="mapIcon" alt="batikapigayrimenkul_gmapisyeri_icon" src="<?php echo $this->webroot;?>img/isyer45.png"/></a><br>
    <a href="<?php echo $this->Html->url('/');?>sayfas/index/tur:3"><img class="mapIcon" alt="batikapigayrimenkul_gmaparsa_icon" src="<?php echo $this->webroot;?>img/arsa45.png"/></a><br>
    <a href="<?php echo $this->Html->url('/');?>"><img class="mapIcon" alt="batikapigayrimenkul_gmaphepsi_icon" src="<?php echo $this->webroot;?>img/hep45.png"/></a>
    <!-- <button type="button" class="btn btn-xs btn-primary" onclick="FuncSetNowPosition()" style="margin-top:5px;"><i class="fa fa-2x fa-compass"></i></button> -->
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&libraries=places&sensor=false" type="text/javascript"></script>
<?php
echo $this->Html->css('site/jquery.bxslider.min');
echo $this->Html->script('site/jquery.bxslider.min');
?>

<script type="text/javascript">
    var getLocFunc = false;
    var zoomMap = true;
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    if(isMobile.any()){
        zoomMap = false;
    }

    var locationstest = <?php echo $ilanlar; ?>;
    var map;
    var markers = [];
    var infowindow;

    $(document).ready(function(){
        $('#mapContent').on('click','#CloseMapContent',function(e){
            e.preventDefault();
            clearAnimation();
            $('#mapContent').hide();
        });

        $('.mapcanvas').height($(window).height()*0.93);
        $('body>div.container').css('padding','0');
        $('body>div.container').css('width','100%');

        google.maps.event.addDomListener(window, 'load', init);
    });

    //    var locations = [
    //      ['Maroubra Beach', 39.75901413964756, 32.42751260876469, 0],
    //      ['Manly Beach', -33.80010128657071, 151.28747820854187, 1],
    //      ['Cronulla Beach', -34.028249, 151.157507, 2],
    //      ['Bondi Beach', -33.890542, 151.274856, 3],
    //      ['Coogee Beach', -33.923036, 151.259052, 'test']
    //    ];


    function init(){
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 10,
            zoomControl: zoomMap,
            center: new google.maps.LatLng(39.868584,32.639159),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            streetViewControl: false,
            scaleControl: false,
            rotateControl: false
        });

//        if(<?php //echo $dd;?>//){
//            var geolocate = new google.maps.LatLng(locationstest[0]['lat'], locationstest[0]['lon']);
//            map.setCenter(geolocate);
//        }
        /*else{
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(geolocate);
        });
    }*/

        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('mapContent'));
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(document.getElementById('mapSearch2'));
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('mapSearch'));
//        map.addListener('center_changed',function(){
//            $('#testdiv').hide();
//        });

        var iconmyloc = {
            url: '<?php echo $this->webroot;?>img/mapmy.png', // url
            scaledSize: new google.maps.Size(30, 30), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(10, 30) // anchor
        };
        markers[-11] = new google.maps.Marker({
            position: {lat:39.87426820323075, lng:32.64915393991237},
            map: map,
            icon: iconmyloc,
            zIndex:99999999,
            id: -11
        });
        markers[-11].addListener('click', function() {
            $('#mapContent').hide();
            toggleBounce(-11);
            FuncGetMapBatiInfo();
        });

        var num_markers = locationstest.length;
        for (var i = 0; i < num_markers; i++) {
            var iconurl = '<?php echo $this->webroot;?>img/';
            if(locationstest[i]['turu'] == 1){
                iconurl += 'konutmarker.png';
            }else if(locationstest[i]['turu'] == 2){
                iconurl += 'isyerimarker.png';
            }else if(locationstest[i]['turu'] == 3){
                iconurl += 'arsamarker.png';
            }
            var iconmar = {
                url: iconurl, // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(10, 30) // anchor
            };
            markers[i] = new google.maps.Marker({
                position: {lat:parseFloat(locationstest[i]['latitude']), lng:parseFloat(locationstest[i]['longitude'])},
                map: map,
                icon: iconmar,
                html: '<a target="_blank" href="http://google.com">'+locationstest[i]['baslik']+'</a>',
                id: i
            });

            markers[i].addListener('click', function() {
                $('#mapContent').hide();
                toggleBounce(this.id);
                FuncGetMapIlanInfo(locationstest[this.id]['id'],locationstest[this.id]['turu'],parseFloat(locationstest[this.id]['latitude']),parseFloat(locationstest[this.id]['longitude']));
            });
        }

        if(navigator.geolocation) {
            getLocFunc = true;
            navigator.geolocation.getCurrentPosition(function(position) {
                //var geoLoc = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                var iconLoc = {
                    url: '<?php echo $this->webroot;?>img/myloc3.png', // url
                    //size: new google.maps.Size(35, 35),
                    scaledSize: new google.maps.Size(20, 20), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(10, 20) // anchor
                };
                markers[-10] = new google.maps.Marker({
                    position: {lat:position.coords.latitude, lng:position.coords.longitude},
                    map: map,
                    icon: iconLoc,
                    id: -10
                });
                //var AlertLocInterval = setInterval(Funcalert, 2000);
                var getLocInterval = setInterval(FuncGetLoc, 2000);
            });
        }

    }

    function FuncGetLoc(){
        if(getLocFunc){
            navigator.geolocation.getCurrentPosition(function(position) {
                var geoLoc = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                markers[-10].setPosition(geoLoc);
                markers[-10].setVisible(false);
                setTimeout(function(){markers[-10].setVisible(true);},1000);
            });
        }
    }

    function handleNoGeolocation(){
        alert("Tarayıcınız google map'i desteklemiyor yada ");
    }

    function clearAnimation(){
        markers[-11].setAnimation(null);
        for (var i = 0; i < markers.length; i++) {
            markers[i].setAnimation(null);
        }
    }

    function toggleBounce(mar) {
        if (markers[mar].getAnimation() !== null) {
            markers[mar].setAnimation(null);
        } else {
            clearAnimation();
            markers[mar].setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function FuncGetMapIlanInfo(ilanId, ilanTip, lat, lon){
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        setTimeout(
            function () {
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?php echo $this->Html->url('/');?>sayfas/AjaxGetMapIlanInfo",
                    data: {'ilanId':ilanId}
                }).done(function(data){
                    var dat = $.parseJSON(data);
                    if(dat['hata']){
                        $.unblockUI();
                        swal({
                            title: "Hata!!!",
                            text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                            type: "error"
                        });
                        return false;
                    }else{
                        // Seçilen marker'ı merkez olarak set ediyor
                        /*var geolocate = new google.maps.LatLng(lat, lon);
                        map.setCenter(geolocate);*/

                        var ilanLink = "<?php echo $this->Html->url('/');?>ilan/ilan:"+dat['ilan']['Ilan']['id']+'/ilanNo:'+dat['ilan']['Ilan']['ilan_no'];
                        var textColor = "";
                        var content = '<div class="anaDivMapFlex fontBold"><div class="div85"><a href="'+ilanLink+'" class="text-black fontBold mapH1">'+dat['ilan']['Ilan']['baslik']+'</a></div>';
                        content += '<div class="div15 text-danger mapHNo text-right">'+dat['ilan']['ilanNo']+'</div></div>';
                        content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-danger mapH1 fontItalic'+textColor+'"><i class="fa fa-try fa-lg"></i> '+number_format(dat['ilan']['Ilan']['fiyat'])+'</a></div>';
                        content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-black mapHalt'+textColor+'" style="text-transform: capitalize;">';
                        var ildet = dat['ilan']['Sehir']['sehir_adi'];
                        if(dat['ilan']['Ilce']['ilce_id'] != '' && dat['ilan']['Ilce']['lice_id'] != null){
                            ildet += dat['ilan']['Ilce']['ilce_adi'];
                        }
                        if(dat['ilan']['Semt']['semt_id'] != '' && dat['ilan']['Semt']['semt_id'] != null){
                            ildet += dat['ilan']['Semt']['semt_adi'];
                        }
                        if(dat['ilan']['Mahalle']['mahalle_id'] != '' && dat['ilan']['Mahalle']['mahalle_id'] != null){
                            ildet += dat['ilan']['Mahalle']['mahalle_adi'];
                        }
                        content += ildet.turkishToLower()+'</a></div>';
                        content += '<div class="anaDivMap"><div class="divYan fLeft"><a target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr='+lat+','+lon+'"><img class="MapDircetioIcon" alt="map_direction_icon" src="<?php echo $this->webroot;?>img/mapdirect.png" /></a></div><div class="divYan fRight mapHNo" id="CloseMapContent"><i class="fa fa-times fa-2x text-danger" style="margin-right: 5px;cursor: pointer"></i></div>';

                        if($(window).width() > 767){
                            var imgCon = '<div class="SliderClass">';
                            var say = 1;
                            $(dat['ilan']['IlanResim']).each(function(key,vall){
                                imgCon += '<div class="slide"><a href="'+ilanLink+'"><img alt="'+dat['ilan']['Ilan']['ilan_no']+'_'+say+'" src="<?php echo $this->Html->url('/');?>'+vall['paththumb']+'" /></a></div>';
                                say++;
                            });
                            imgCon += "</div>";
                        }else{
                            var imgCon = '<a href="'+ilanLink+'"><img src="<?php echo $this->Html->url('/');?>'+dat['img'][0]+'" /></a>';
                        }


                        $('#mapContent #map-ilan-content').html(content);
                        $('#mapContent #map-ilan-img').html(imgCon);
                        $('#mapContent').show();
                        $('#mapContent').css('display','inline-flex');
                        if($(window).width() > 767){
                            $('.SliderClass').bxSlider({
                                auto: true,
                                pager: false,
                                slideWidth: 200,
                                minSlides: 1,
                                maxSlides: 5,
                                moveSlides: 1,
                                slideMargin: 10
                            });
                        }
                        $.unblockUI();
                    }
                });
            },500
        );
    }

    function FuncGetMapBatiInfo(){
        $.blockUI({ css: { backgroundColor: 'transparent', border: 'none'},message: $('#LoaderBlock') });
        $.ajax({
            //async: false,
            type: 'POST',
            url: "<?php echo $this->Html->url('/');?>users/AjaxGetBatiInfo",
            data: 'ilanId=1'
        }).done(function(data){
            var dat = $.parseJSON(data);
            if(dat['hata']){
                $.unblockUI();
                swal({
                    title: "Hata!!!",
                    text: "Bir hata meydana geldi. Daha sonra tekrar deneyin.",
                    type: "error"
                });
                return false;
            }else{
                var ilanLink = "<?php echo $this->Html->url('/');?>users/iletisim";
                var content = '<div class="anaDivMapFlex fontBold"><a href="'+ilanLink+'" class="text-black fontBold mapH1">BATIKAPI Gayrimenkul A.Ş. </a></div>';
                content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-danger mapHalt fontItalic" style="text-transform: capitalize;">'+dat['adres']+'</a></div>';
                content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-black mapHalt">'+dat['tel']+'</a></div>';
                content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-black mapHalt">'+dat['mail']+'</a></div>';
                content += '<div class="anaDivMap text-right mapHNo" id="CloseMapContent"><i class="fa fa-times fa-2x text-danger" style="margin-right: 5px;cursor: pointer"></i></div>';
                $('#mapContent #map-ilan-content').html(content);
                $('#mapContent #map-ilan-img').html('<a href="'+ilanLink+'"><img src="<?php echo $this->Html->url('/');?>img/bmo.jpg" /></a>');
                $('#mapContent').show();
                $('#mapContent').css('display','inline-flex');
                $.unblockUI();
            }
        });
    }

    function FuncMapTypeChange(){
        if(map.mapTypeId == "hybrid"){
            map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
        }else{
            map.setMapTypeId(google.maps.MapTypeId.HYBRID);
        }
    }

    function FuncMapTextSearch(){
        $('#MapTextModal').modal({
            keyboard:false,
            backdrop:'static'
        });
        return false;
    }
    function FuncDetSearch(){
        $('#DetSearchModal').modal({
            keyboard:false,
            backdrop:'static'
        });
        return false;
    }

    function FuncSetNowPosition(){
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(geolocate);
        });
    }
    function number_format(number, decimals, dec_point, thousands_sep) {
        //  discuss at: http://phpjs.org/functions/number_format/
        // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // improved by: davook
        // improved by: Brett Zamir (http://brett-zamir.me)
        // improved by: Brett Zamir (http://brett-zamir.me)
        // improved by: Theriault
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // bugfixed by: Michael White (http://getsprink.com)
        // bugfixed by: Benjamin Lupton
        // bugfixed by: Allan Jensen (http://www.winternet.no)
        // bugfixed by: Howard Yeend
        // bugfixed by: Diogo Resende
        // bugfixed by: Rival
        // bugfixed by: Brett Zamir (http://brett-zamir.me)
        //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        //  revised by: Luke Smith (http://lucassmith.name)
        //    input by: Kheang Hok Chin (http://www.distantia.ca/)
        //    input by: Jay Klehr
        //    input by: Amir Habibi (http://www.residence-mixte.com/)
        //    input by: Amirouche
        //   example 1: number_format(1234.56);
        //   returns 1: '1,235'
        //   example 2: number_format(1234.56, 2, ',', ' ');
        //   returns 2: '1 234,56'
        //   example 3: number_format(1234.5678, 2, '.', '');
        //   returns 3: '1234.57'
        //   example 4: number_format(67, 2, ',', '.');
        //   returns 4: '67,00'
        //   example 5: number_format(1000);
        //   returns 5: '1,000'
        //   example 6: number_format(67.311, 2);
        //   returns 6: '67.31'
        //   example 7: number_format(1000.55, 1);
        //   returns 7: '1,000.6'
        //   example 8: number_format(67000, 5, ',', '.');
        //   returns 8: '67.000,00000'
        //   example 9: number_format(0.9, 0);
        //   returns 9: '1'
        //  example 10: number_format('1.20', 2);
        //  returns 10: '1.20'
        //  example 11: number_format('1.20', 4);
        //  returns 11: '1.2000'
        //  example 12: number_format('1.2000', 3);
        //  returns 12: '1.200'
        //  example 13: number_format('1 000,50', 2, '.', ' ');
        //  returns 13: '100 050.00'
        //  example 14: number_format(1e-8, 8, '.', '');
        //  returns 14: '0.00000001'

        number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    String.prototype.turkishToLower = function(){
        var string = this;
        var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
        string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; });
        return string.toLowerCase();
    };

    function Funcalert(){
        markers[-10].setVisible(false);
        setTimeout(function(){markers[-10].setVisible(true);},1000);
    }
</script>