<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$truck_img = $data['_truck_img'][0];
$mover_img = $data['_mover_img'][0];
$houses_background = $data['_houses_background'][0];
$foreground = $data['_foreground'][0];
?>

<div class="interactive-rates rate_data_<?php echo $atts['id']; ?>">
	
	<style type="text/css">
		.rate_data_<?php echo $atts['id']; ?> .house-motion {
			background-image: url(<?php echo ( !empty( $houses_background ) ) ? $houses_background : RTS_PLUGIN_DIR_URL.'assets/img/1331x375.jpg' ?>);
		}
		.rate_data_<?php echo $atts['id']; ?> .front-objects {
			/*background-image: url(<?php echo ( !empty( $foreground ) ) ? $foreground : RTS_PLUGIN_DIR_URL.'assets/img/1331x375.jpg' ?>);*/
		}
	</style>

	<div class="interactive-container">
		<div class="display-layout">
			<img class="set-resizing" src="<?php echo RTS_PLUGIN_DIR_URL ?>assets/img/resizing.gif">
			<div class="house-motion"></div>
			<div class="interactive-images">

				<?php if( $data['_rates_type'][0] == 'storage' ): ?>
					<img class="rate-image" id="sliding-container-truck" src="<?php echo ( !empty($truck_img) ? $truck_img : RTS_PLUGIN_DIR_URL ."assets/img/787x270.jpg" ); ?>">
					<img class="rate-image-2" id="sliding-with-boxes-2" src="<?php echo ( !empty($mover_img) ? $mover_img : RTS_PLUGIN_DIR_URL ."assets/img/88x96.jpg" ); ?>">
				<?php else: ?>
					<img class="rate-image-1" id="sliding-truck" src="<?php echo ( !empty($truck_img) ? $truck_img : RTS_PLUGIN_DIR_URL ."assets/img/320x138.jpg" ); ?>">
					<img class="rate-image-1" id="sliding-with-boxes" src="<?php echo ( !empty($mover_img) ? $mover_img : RTS_PLUGIN_DIR_URL ."assets/img/88x96.jpg" ); ?>">

				<?php endif; ?>

			</div>
      	</div>
		<ul class="list-info">
			<li class="select-day">
				<input type="radio" name="selected-type" id="day-type-1" value="day_type_1" checked="checked"><label for="day-type-1">Weekdays</label>
				<input type="radio" name="selected-type" id="day-type-2" value="day_type_2"><label for="day-type-2">Weekends</label>
			</li>
		</ul>
		<div class="house-message">
			<dl>
				<dt class="size-message"></dt>
				<dd class="sf-message"></dd>
			</dl>
		</div>
		<div class="walker">
        	<div class="walker-container">

        		<div class="point-for-slide"><img src="<?php echo RTS_PLUGIN_DIR_URL ?>assets/img/slide-here.png"></div>

				<div class="interactive-rates-slider"></div>
        	</div>
        	<div class="clearfix"></div>
		</div>
		<div class="more-less-buttons">
			<div class="less">pay less</div>
			<div class="more">get more</div>
		</div>
	</div>

	<div class="bottom-feature">		
		<table border="0">
    		<tbody>
        		<tr class="feature-results">
          			<td class="header">Results for</td>
          			<td class="content"></td>
        		</tr>
        		<tr class="feature-cost">
          			<td class="header">Cost</td>
          			<td class="content"></td>
        		</tr>
        		<tr class="feature-movers">
          			<td class="header">Movers</td>
          			<td class="content"></td>
        		</tr>
				<tr class="feature-truck">
					<td class="header">Truck</td>
					<td class="content"></td>
				</tr>
				<tr class="feature-worker">
					<td class="header">Additional movers</td>
					<td class="content"></td>
				</tr>
				<tr class="feature-details">
					<td class="header">Details</td>
					<td class="content"></td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<script>
	var <?php echo 'rate_data_'.$atts['id']; ?> = <?php echo json_encode($rate_list); ?>;
</script>