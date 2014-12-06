<?php $location=LocationGps::model()->find();?>
<section id="location">
<div class="text-center">
    <h2>Location</h2>
    <hr class="star-primary">
</div>
 <?php $this->widget('ext.widgets.gmap.GShowLocation',array(
        'lat'=>$location->map_address_lat,
        'lng'=>$location->map_address_lng,
        'width'=>'100%',
        'height'=>'500',
        'zoom'=>'8',
    ));?>
</section>