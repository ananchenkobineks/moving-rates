<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTS_Tabs {

	public function display( $tab_name, $post_meta ) {

		$tab_meta = false;
		$is_data = false;

		if( $tab_meta = $post_meta[ '_'.$tab_name ][0] ) {

			$tab_meta = unserialize($tab_meta);
			$is_data = true;
		}
	?>

		<ul>
			<?php for( $num=1; $num<=6; $num++ ): ?>
			<li>
				<a href="#stage-<?php echo $num ?>"><span>Stage #<?php echo $num ?></span></a>
			</li>
			<?php endfor; ?>
		</ul>

		<?php for( $num=1; $num<=6; $num++ ): ?>

			<?php 
				if( $num == 1 || $num == 4 ) {
					$size = "Small Size";
				} elseif( $num == 2 || $num == 5 ) {
					$size = "Medium Size";
				} else {
					$size = "Large Size";
				}
			?>

		<div id="stage-<?php echo $num ?>" class="panel">
			<div class="options_group">
				<h4 class="form-title">Top Sliding Data</h4>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-house-size-title-<?php echo $num ?>"><?php echo esc_html('House size', 'int-rates'); ?></label>

					<input type="text" id="<?php echo $tab_name ?>-house-size-title-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][house-size-title]" value="<?php echo ($is_data ? $tab_meta[$num]['house-size-title'] : ''); ?>">

					<input type="hidden" name="<?php echo $tab_name ?>[<?php echo $num ?>][house-size]" value="<?php echo $size; ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-house-sf-<?php echo $num ?>"><?php echo esc_html('House sf', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-house-sf-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][house-sf]" value="<?php echo ($is_data ? $tab_meta[$num]['house-sf'] : ''); ?>">
				</p>
			</div>
			<div class="options_group">
				<h4 class="form-title">Bottom Sliding Data</h4>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-results-for-<?php echo $num ?>"><?php echo esc_html('Results for', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-results-for-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][results-for]" value="<?php echo ($is_data ? $tab_meta[$num]['results-for'] : ''); ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-cost-<?php echo $num ?>"><?php echo esc_html('Cost', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-cost-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][cost]" value="<?php echo ($is_data ? $tab_meta[$num]['cost'] : ''); ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-movers-<?php echo $num ?>"><?php echo esc_html('Movers', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-movers-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][movers]" value="<?php echo ($is_data ? $tab_meta[$num]['movers'] : ''); ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-truck-<?php echo $num ?>"><?php echo esc_html('Truck', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-truck-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][truck]" value="<?php echo ($is_data ? $tab_meta[$num]['truck'] : ''); ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-additional-movers-<?php echo $num ?>"><?php echo esc_html('Additional movers', 'int-rates'); ?></label>
					<input type="text" id="<?php echo $tab_name ?>-additional-movers-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][additional-movers]" value="<?php echo ($is_data ? $tab_meta[$num]['additional-movers'] : ''); ?>">
				</p>
				<p class="form-field">
					<label for="<?php echo $tab_name ?>-details-<?php echo $num ?>"><?php echo esc_html('Details', 'int-rates'); ?></label>
					<textarea id="<?php echo $tab_name ?>-details-<?php echo $num ?>" name="<?php echo $tab_name ?>[<?php echo $num ?>][details]" rows="12"><?php echo ($is_data ? $tab_meta[$num]['details'] : ''); ?></textarea>
				</p>
			</div>
		</div>

		<?php endfor; ?>
	<?php
	}

}