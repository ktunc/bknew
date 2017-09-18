<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&libraries=places" type="text/javascript"></script>-->
<style>
    html {
        background-image: -webkit-linear-gradient(bottom, #F4E2C9 20%, #F4D7C9 100%);
        background-image: -ms-linear-gradient(bottom, #F4E2C9 20%, #F4D7C9 100%);
        background-image: linear-gradient(to bottom, #F4E2C9 20%, #F4D7C9 100%);
    }

    html, body {
        margin: 0;
        padding: 0;
        position: relative;
        color: #464637;
        min-height: 100%;
        font-size: 20px;
        font-family: 'Roboto', sans-serif;
        font-weight: 300;
    }


    h1 {
        color: #FF3F00;
        font-size: 20px;
        font-family: 'Roboto', sans-serif;
        font-weight: 300;
        text-align: center;
    }


    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .container {
        width: 80%;
        margin: auto;
        min-width: 1100px;
        max-width: 1300px;
        position: relative;
    }

    @media (min-width: 750px) and (max-width: 970px){
        .container {
            width: 100%;
            min-width: 750px;
        }
    }


    .sortable-ghost {
        opacity: .2;
    }

    #foo .sortable-drag {
        background: #daf4ff;
    }


    img {
        border: 0;
        vertical-align: middle;
    }


    .logo {
        top: 55px;
        left: 30px;
        position: absolute;
    }


    .title {
        color: #fff;
        padding: 3px 10px;
        display: inline-block;
        position: relative;
        background-color: #FF7373;
        z-index: 1000;
    }
    .title_xl {
        padding: 3px 15px;
        font-size: 40px;
    }



    .tile {
        width: 22%;
        min-width: 245px;
        color: #FF7270;
        padding: 10px 30px;
        text-align: center;
        margin-top: 15px;
        margin-left: 5px;
        margin-right: 30px;
        background-color: #fff;
        display: inline-block;
        vertical-align: top;
    }
    .tile__name {
        cursor: move;
        padding-bottom: 10px;
        border-bottom: 1px solid #FF7373;
    }

    .tile__list {
        margin-top: 10px;
    }
    .tile__list:last-child {
        margin-right: 0;
        min-height: 80px;
    }

    .tile__list img {
        cursor: move;
        margin: 10px;
        border-radius: 100%;
    }



    .block {
        opacity: 1;
        position: absolute;
    }
    .block__list {
        padding: 20px 0;
        max-width: 360px;
        margin-top: -8px;
        margin-left: 5px;
        background-color: #fff;
    }
    .block__list-title {
        margin: -20px 0 0;
        padding: 10px;
        text-align: center;
        background: #5F9EDF;
    }
    .block__list li { cursor: move; }

    .block__list_words li {
        background-color: #fff;
        padding: 10px 40px;
    }
    .block__list_words .sortable-ghost {
        opacity: 0.4;
        background-color: #F4E2C9;
    }

    .block__list_words li:first-letter {
        text-transform: uppercase;
    }

    .block__list_tags {
        padding-left: 30px;
    }

    .block__list_tags:after {
        clear: both;
        content: '';
        display: block;
    }
    .block__list_tags li {
        color: #fff;
        float: left;
        margin: 8px 20px 10px 0;
        padding: 5px 10px;
        min-width: 10px;
        background-color: #5F9EDF;
        text-align: center;
    }
    .block__list_tags li:first-child:first-letter {
        text-transform: uppercase;
    }



    #editable {}
    #editable li {
        position: relative;
    }

    #editable i {
        -webkit-transition: opacity .2s;
        transition: opacity .2s;
        opacity: 0;
        display: block;
        cursor: pointer;
        color: #c00;
        top: 10px;
        right: 40px;
        position: absolute;
        font-style: normal;
    }

    #editable li:hover i {
        opacity: 1;
    }


    #filter {}
    #filter button {
        color: #fff;
        width: 100%;
        border: none;
        outline: 0;
        opacity: .5;
        margin: 10px 0 0;
        transition: opacity .1s ease;
        cursor: pointer;
        background: #5F9EDF;
        padding: 10px 0;
        font-size: 20px;
    }
    #filter button:hover {
        opacity: 1;
    }

    #filter .block__list {
        padding-bottom: 0;
    }

    .drag-handle {
        margin-right: 10px;
        font: bold 20px Sans-Serif;
        color: #5F9EDF;
        display: inline-block;
        cursor: move;
        cursor: -webkit-grabbing;  /* overrides 'move' */
    }

    #todos input {
        padding: 5px;
        font-size: 14px;
        font-family: 'Roboto', sans-serif;
        font-weight: 300;
    }



    #nested ul li {
        background-color: rgba(0,0,0,.05);
    }

</style>
<ul id="items" class="block__list block__list_tags">
    <li>казнить</li>
    <li>,</li>
    <li>нельзя</li>
    <li>помиловать</li>
</ul>

<?= $this->Html->script('http://maps.google.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&sensor=true&libraries=places', false); ?>
<?= $this->Html->script('yonetici/locationpicker.jquery'); ?>
<div class="form-group">
    <label class="col-xs-3 col-md-2 control-label" for="us2-address">Location</label>
    <div class="col-xs-9 col-md-10">
        <input type="text" id="us2-address" name="location"  class="form-control"/>
    </div>
    <input type="hidden" id="us2-lat" name="latitude" />
    <input type="hidden" id="us2-lon" name="longitude" />
</div>
<div class="form-group">
    <div id="us2" class="col-xs-12" style="min-height: 300px;margin-top: 2%;"></div>
</div>
<?php
echo $this->Html->script('yonetici/plugins/Sortable-master/Sortable');
?>
<script>
$(document).ready(function () {
    $('#us2').locationpicker({
        location: {latitude: 39.918012967883385, longitude: 32.85808648203124},
        radius: 10,
        inputBinding: {
            latitudeInput: $('#us2-lat'),
            longitudeInput: $('#us2-lon'),
            radiusInput: $('#us2-radius'),
            locationNameInput: $('#us2-address')
        },
        enableAutocomplete: true
    });
});

var el = document.getElementById('items');
var sortable = Sortable.create(el);
</script>
