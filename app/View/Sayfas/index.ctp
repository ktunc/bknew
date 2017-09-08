<div id="map_canvas" class="mapcanvas"></div>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&libraries=places&callback=initMap" type="text/javascript"></script>
<?php
//echo $this->Html->css('jquery.bxslider.min');
//echo $this->Html->script('jquery.bxslider.min');
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
    $(document).ready(function(){
        $('#mapContent').on('click','#CloseMapContent',function(e){
            e.preventDefault();
            clearAnimation();
            $('#mapContent').hide();
        });

        $('.mapcanvas').height($(window).height()*0.97);
        $('body>div.container').css('padding','0');
        $('body>div.container').css('width','100%');
    });

    //    var locations = [
    //      ['Maroubra Beach', 39.75901413964756, 32.42751260876469, 0],
    //      ['Manly Beach', -33.80010128657071, 151.28747820854187, 1],
    //      ['Cronulla Beach', -34.028249, 151.157507, 2],
    //      ['Bondi Beach', -33.890542, 151.274856, 3],
    //      ['Coogee Beach', -33.923036, 151.259052, 'test']
    //    ];
    var map;
    var markers = [];
    var infowindow;

    function initMap(){
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
        $.ajax({
            //async: false,
            type: 'POST',
            url: "<?php echo $this->Html->url('/');?>users/AjaxGetMapIlanInfo",
            data: 'ilanId='+ilanId+'&ilanTip='+ilanTip
        }).done(function(data){
            var dat = $.parseJSON(data);
            if(dat['hata']){
                $.unblockUI();
                $('#UyariModal #UyariContent').html('Bir hata meydana geldi. Lütfen sayfayı yenileyerek tekrar deneyiniz.');
                $('#UyariModal').modal({
                    keyboard:false,
                    backdrop:'static'
                });
                return false;
            }else{
                // Seçilen marker'ı merkez olarak set ediyor
                /*var geolocate = new google.maps.LatLng(lat, lon);
                map.setCenter(geolocate);*/

                var ilanLink = "<?php echo $this->Html->url('/');?>";
                var textColor = "";
                if(ilanTip == 1){
                    //textColor = " text-danger";
                    ilanLink += "konut/ilanNo:"+dat['ilanNo'];
                }else if(ilanTip == 2){
                    ilanLink += "isyeri/ilanNo:"+dat['ilanNo'];
                }else if(ilanTip == 3){
                    //textColor = " text-success";
                    ilanLink += "arsa/ilanNo:"+dat['ilanNo'];
                }
                var content = '<div class="anaDivMapFlex fontBold"><div class="div85"><a href="'+ilanLink+'" class="text-black fontBold mapH1'+textColor+'">'+dat['baslik']+'</a></div>';
                content += '<div class="div15 text-danger mapHNo text-right">'+dat['ilanNo']+'</div></div>';
                content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-danger mapH1 fontItalic'+textColor+'">'+number_format(dat['fiyat'])+' '+dat['fiyat_birim']+'</a></div>';
                content += '<div class="anaDivMap"><a href="'+ilanLink+'" class="fontBold text-black mapHalt'+textColor+'" style="text-transform: capitalize;">';
                var ildet = dat['il'];
                if(dat['ilce'] != '' && dat['ilce'] != null){
                    ildet = dat['ilce'];
                }
                if(dat['semt'] != '' && dat['semt'] != null){
                    ildet = dat['semt'];
                }
                if(dat['mahalled'] != '' && dat['mahalle'] != null){
                    ildet = dat['mahalle'];
                }
                content += ildet.turkishToLower()+'</a></div>';
                content += '<div class="anaDivMap"><div class="divYan fLeft"><a target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr='+lat+','+lon+'"><img class="MapDircetioIcon" alt="map_direction_icon" src="<?php echo $this->webroot;?>img/mapdirect.png" /></a></div><div class="divYan fRight mapHNo" id="CloseMapContent"><i class="fa fa-times fa-2x text-danger" style="margin-right: 5px;cursor: pointer"></i></div>';

                if($(window).width() > 767){
                    var imgCon = '<div class="SliderClass">';
                    var say = 1;
                    $(dat['img']).each(function(key,vall){
                        imgCon += '<div class="slide"><a href="'+ilanLink+'"><img alt="'+dat['ilanNo']+'_'+say+'" src="<?php echo $this->Html->url('/');?>'+vall+'" /></a></div>';
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
                $('#UyariModal #UyariContent').html('Bir hata meydana geldi. Lütfen sayfayı yenileyerek tekrar deneyiniz.');
                $('#UyariModal').modal({
                    keyboard:false,
                    backdrop:'static'
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