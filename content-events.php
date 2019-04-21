<?php
/**
 * Single post partial template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header"><h1><?php echo the_title(); ?></h1></header><!-- .entry-header -->

  <hr>

  <div class="row">

    <div class="col-md-8">

      <?php
      $location = get_field('event_location');
      /*
      print_r ($location);
      echo 'Location: '.$location['address'];
      echo 'Lat: '.$location['lat'];
      echo 'Lng: '.$location['lng'];
      */
      ?>

      <strong>Date/Time</strong><br>
      <?php the_field('event_date'); ?><br>
      <?php the_field('event_time'); ?><br>
      <br>

      <strong>Location</strong><br>
      <?php the_field('event_host'); ?><br>
      <?php echo $location['address']; ?><br>
      <br>

      <style>
        #map, #pano {
  	      width: 100%;
  	      height: 200px;
        }
      </style>

      <script>
        function initialize() {
          var location = {lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?>};
          var map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom: 14
          });
          var panorama = new google.maps.StreetViewPanorama(
              document.getElementById('pano'), {
                position: location,
                pov: {
                  heading: 34,
                  pitch: 10
                }
              });
          map.setStreetView(panorama);
        }
      </script>

      <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=GoogleMapAPIKey&callback=initialize">
      </script>

      <div class="entry-content"><?php the_content(); ?></div>

      <hr><h3 align="center" style="color:#77043D;"><b>Register!</b></h3><hr>

      <?php echo do_shortcode('[contact-form-7 id="283" title="Events"]'); ?>

    </div>

    <div class="col-md-4">
      <div id="pano"></div>
      <br>
      <div id="map"></div>
    </div>

  </div>

</article><!-- #post-## -->
