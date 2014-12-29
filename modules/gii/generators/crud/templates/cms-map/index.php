<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$module=Yii::app()->getModule('gii');
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
//Funciones Mapa

/*-------------------------INICIALIZACIÓN DEL MAPA---------------------------*/
var map;
var polygons = [];
var markers = [];
var infowindow = new google.maps.InfoWindow({
    content: ''
});

function initialize() {


    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(4.659634, -74.062035),
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
        },
        // panControl: false,
        // zoomControl: false
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    /*ESTILOS DEL MAPA*/
    var mapPeepStyle = [{
            stylers: [{
                    lightness: 1
                }, {
                    saturation: -48
                }, {
                    hue: "#005eff"
                }]
        }];

    var styledMapOptions = {
        name: '<?=r()->name?> Map'
    };

    var colMapStyle = new google.maps.StyledMapType(mapPeepStyle, styledMapOptions);

    map.mapTypes.set('usroadatlas', colMapStyle);
    map.setMapTypeId('usroadatlas');

    /*MARKERS*/
    var markersCollection = <?php echo "<?php echo CJSON::encode(\$models)?>"?>;

    /*POLIGONOS*/
    // var polygonsCollection = {};
    
    // addMarkerColor(new google.maps.LatLng(4.663056, -74.066713), "ccc");
    createMarkers(markersCollection, map);
    // createPolygons(polygonsCollection, map);
}

/*FUNCIONES CON POLUGONOS*/
function createPolygons(polygonsCollection, parentMap) {
    if (polygonsCollection.length > 0) {
    	var color = '#46D6AC';

        for (var i = 0; i < polygonsCollection.length; i++) {

            var polygonCoords = [];

        	var color = polygonsCollection[i][0].color;
        	var onePoint = new google.maps.LatLng(polygonsCollection[i][0].lat, polygonsCollection[i][0].lng);
            for (var j = 0; j < polygonsCollection[i].length; j++) {
                var polygonCoord = new google.maps.LatLng(polygonsCollection[i][j].lat, polygonsCollection[i][j].lng);
                polygonCoords.push(polygonCoord);
			}
            ;

            var myPolygon = new google.maps.Polygon({
                paths: polygonCoords,
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35,
                map: parentMap
            });

            // google.maps.event.addListener(myPolygon, 'click', function(polygon) {
            //     console.log(polygon);
            // });

			(function(polygon, contenido, onePoint){                       
			    google.maps.event.addListener(polygon, 'click', function() {
			        infowindow.setContent(contenido);
			        infowindow.open(map);
			        infowindow.setPosition(onePoint);
			    });
			})(myPolygon,polygonsCollection[i][0].content_event,onePoint);


            polygons.push(myPolygon);
        }
    }
}


// Sets the map on all polygons in the array.
function setAllPolygonsMap(map) {
    for (var i = 0; i < polygons.length; i++) {
        polygons[i].setMap(map);
    }
}

// Removes the polygons from the map, but keeps them in the array.
function clearPolygons() {
    setAllPolygonsMap(null);
}

// Shows any polygons currently in the array.
function showPolygons() {
    setAllPolygonsMap(map);
}

// Deletes all polygons in the array by removing references to them.
function deletePolygons() {
    clearPolygons();
    polygons = [];
}

/*FUNCIONES CON MARKERS*/
function createMarkers(markersCollection, parentMap) {
    if (markersCollection.length > 0) {

        for (var i = 0; i < markersCollection.length; i++) {

            var markerCoords = new google.maps.LatLng(markersCollection[i].lat, markersCollection[i].lng);

            var pinColor = markersCollection[i].color;
			var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
			    new google.maps.Size(21, 34),
			    new google.maps.Point(0,0),
			    new google.maps.Point(10, 34));
			var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
			    new google.maps.Size(40, 37),
			    new google.maps.Point(0, 0),
			    new google.maps.Point(12, 35));
	

            var myMarker = new google.maps.Marker({
                position: markerCoords,
                draggable: false,
             //    icon: pinImage,
	            // shadow: pinShadow,
                icon: '<?php echo "<?=r()->request->baseUrl?>"?>/img/etiqueta.png',
                map: map
            });

            myMarker.setMap(parentMap);

			(function(marker, contenido){                       
			    google.maps.event.addListener(marker, 'click', function() {
			        infowindow.setContent(contenido);
			        infowindow.open(map, marker);
			    });
			})(myMarker,markersCollection[i].content_event);

            markers.push(myMarker);
        }
    }
}

// Add a marker to the map and push to the array.
function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        draggable: true,
        title: 'Arrastrame',
        icon: '<?php echo "<?=r()->request->baseUrl?>"?>/img/etiqueta.png',
        map: map
    });

    markers.push(marker);
}

// Add a marker to the map and push to the array.
function addMarkerColor(location, color) {

    var pinColor = color;
	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
	    new google.maps.Size(21, 34),
	    new google.maps.Point(0,0),
	    new google.maps.Point(10, 34));
	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
	    new google.maps.Size(40, 37),
	    new google.maps.Point(0, 0),
	    new google.maps.Point(12, 35));
	var marker = new google.maps.Marker({
	            position: location, 
	            map: map,
	            icon: pinImage,
	            shadow: pinShadow
	        });
	markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMarkersMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setAllMarkersMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setAllMarkersMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}
$(function(){

	$(document).on('submit','#search-form',function(){
		$.fn.updateMap($('#search-form').serialize());
		return false;
	});
	$(document).on('click','#search-form-button',function(e){
		e.preventDefault();
		$.fn.updateMap($('#search-form').serialize());
	});

	$.fn.updateMap = function (data) {
		$.ajax({
			type:'GET',
			url:'<?php echo "<?=r()->createUrl(\$this->route)?>"?>',
			dataType: 'json',
			data: data,
			success: function(data) {
				deleteMarkers();
				// deletePolygons();
				createMarkers(data.models, map);
				// createPolygons(data.pol, map);
			},
		});
	};

	$(document).on('click','#all',function(e) {
		e.preventDefault();
		$('#search-form').each(function(){
			this.reset();
		});
		$.fn.updateMap({});
	});
})
</script>
<script>google.maps.event.addDomListener(window, 'load', initialize);</script>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
<?php echo "<?php"; ?> $form=$this->beginWidget('CActiveForm',array(
    'id'=>'search-form',
	'action'=>r()->createUrl($this->route),
	'method'=>'get',
)); ?>
		<div class="row">
		<?php foreach($this->tableSchema->columns as $column):
			$tangaColumn=$module->getParamsField($column);
			
			if($tangaColumn['type']=='map')
				continue;
			
			$columnLat=explode('_', $column->name);
			if(isset($columnLat[0]) and isset($columnLat[2]) and $columnLat[0]=='map' and ($columnLat[2]=='lat' or $columnLat[2]=='lng'))
				continue; 
			
			?>
			<div class="col-lg-2 mbm">
				<?php if($tangaColumn['type']=='select'):
					$modelName='NameModelRelated';
					if($tangaColumn['table']!==null) {
						$modelName=$module->generateClassName($tangaColumn['table']);
						$listData="{$modelName}::listData()";
					}
					else
						$listData="array('1'=>'Value 1','2'=>'Value 2')";
		
				?>
					<?php echo "<?php echo \$form->dropDownList(\$model,'{$column->name}',{$listData},array('empty'=>\$model->getAttributeLabel('{$column->name}').' ...','class'=>'form-control')); ?>\n"?>
				<?php else:?>
					<?php echo "<?php echo \$form->textField(\$model,'{$column->name}',array('placeholder'=>\$model->getAttributeLabel('{$column->name}').' ...','class'=>'form-control')); ?>\n"?>
				<?php endif;?>
			</div>
		<?php endforeach;?>
			<div class="col-lg-2 mbm pull-right">
				<?php echo "<?php echo CHtml::link('<i class=\"fa fa-search\"></i>','#',array('class'=>'btn btn-default','id'=>'search-form-button'))?>\n"?>
				<?php echo "<?php echo CHtml::link('<i class=\"fa fa-refresh\"></i> '.r('app','Ver todos'),'#',array('class'=>'btn btn-default','id'=>'all'))?>\n"?>
			</div>
		</div>
<?php echo "<?php \$this->endWidget(); ?>\n"?>
		</div>
    </div>
</section>
<div style="width:100%;height: 410px" id="map"></div>