
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?> h-100">
		<div class="row h-100">
            <div class="col-md-6 col-sm-12 my-auto text-white">
                
                <?php the_sub_field('content') ?>               
        
            </div>
            <div class="col-md-6 col-sm-12 map">
                
            </div>
	    </div>
	</div>
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=Worldwide Clinical Trials, Northeast Interstate 410 Loop, San Antonio, TX, United States, &t=&z=14&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
    </div>
<?php /* TODO
    <script>
        var map; //<-- This is now available to both event listeners and the initialize() function
        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(40.5472,12.282715),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center); 
        });
    </script> */ ?>
</<?php echo $tag ?>>
