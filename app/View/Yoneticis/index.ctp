<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6wy1FSr2ms69Cy7BSuZQLOB9-EPIkIA&libraries=places" type="text/javascript"></script>-->
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
</script>
