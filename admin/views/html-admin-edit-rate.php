<?php 
	if ( ! defined( 'ABSPATH' ) ) { exit; }

	$post = get_post( $post_id );

	if( $post ) {
		$post_meta = get_post_meta( $post_id );	
	} else {
		$post_meta = null;
	}
?>

<div class="wrap">

	<h1 class="wp-heading-inline">
		<?php echo esc_html( __( 'Add New Rates', 'int-rates' ) ); ?>		
	</h1>

	<form method="post" action="<?php echo esc_url( add_query_arg( array( 'post' => $post_id ) ) ); ?>">
		<?php wp_nonce_field( 'save-int-rate' ); ?>

		<input type="hidden" id="post_ID" name="post_ID" value="<?php echo (int) $post_id; ?>">
		<input type="hidden" id="hiddenaction" name="action" value="<?php echo ($_REQUEST['action'] == 'edit' ? 'edit' : 'save'); ?>">

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">

				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<input type="text" name="post_title" value="<?php echo $post->post_title; ?>" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="<?php echo esc_html( __( 'Enter title here', 'int-rates' ) ); ?>">
						</div>
					</div>
				</div>

				<div id="postbox-container-1" class="postbox-container rates-postbox">

					<div id="submitdiv" class="postbox">
						<h2 class="hndle ui-sortable-handle"><span><?php echo esc_html( __( 'Status', 'int-rates' ) ); ?></span></h2>
						<div class="inside">
							<div class="submitbox" id="submitpost">

								<div id="major-publishing-actions">
									<div id="publishing-action">
										<span class="spinner"></span>
										<input type="submit" class="button-primary" name="" value="Save">
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="container-image postbox">
						<?php 
							$image = "";
							$image_link = 0;

							if( $post_meta && $post_meta['_truck_img'][0] ) {
								$image_link = $post_meta['_truck_img'][0];
								$image = "<p class='postbox-img'><img src='{$image_link}'></p>";
							}
						?>
						<h2 class="hndle"><span>Truck image</span></h2>
						<div class="inside">
							<?php echo $image; ?>
							<p class="hide-if-no-js">
								<a href="#" class="postbox-upload" data-img="_truck_img">Set image</a>
								<a href="#" class="image-remove" data-img="_truck_img">Remove image</a>
							</p>
							<input type="hidden" name="_truck_img" value="<?php echo $image_link; ?>">
						</div>
					</div>

					<div class="mover-image postbox">
						<?php 
							$image = "";
							$image_link = 0;

							if( $post_meta && $post_meta['_mover_img'][0] ) {
								$image_link = $post_meta['_mover_img'][0];
								$image = "<p class='postbox-img'><img src='{$image_link}'></p>";
							}
						?>
						<h2 class="hndle"><span>Mover image</span></h2>
						<div class="inside">
							<?php echo $image; ?>
							<p class="hide-if-no-js">
								<a href="#" class="postbox-upload" data-img="_mover_img">Set image</a>
								<a href="#" class="image-remove" data-img="_mover_img">Remove image</a>
							</p>
							<input type="hidden" name="_mover_img" value="<?php echo $image_link; ?>">
						</div>
					</div>

					<div class="houses_background postbox">
						<?php 
							$image = "";
							$image_link = 0;

							if( $post_meta && $post_meta['_houses_background'][0] ) {
								$image_link = $post_meta['_houses_background'][0];
								$image = "<p class='postbox-img'><img src='{$image_link}'></p>";
							}
						?>
						<h2 class="hndle"><span>Houses background</span></h2>
						<div class="inside">
							<?php echo $image; ?>
							<p class="hide-if-no-js">
								<a href="#" class="postbox-upload" data-img="_houses_background">Set image</a>
								<a href="#" class="image-remove" data-img="_houses_background">Remove image</a>
							</p>
							<input type="hidden" name="_houses_background" value="<?php echo $image_link; ?>">
						</div>
					</div>

					<div class="foreground postbox">
						<?php 
							$image = "";
							$image_link = 0;

							if( $post_meta && $post_meta['_foreground'][0] ) {
								$image_link = $post_meta['_foreground'][0];
								$image = "<p class='postbox-img'><img src='{$image_link}'></p>";
							}
						?>
						<h2 class="hndle"><span>Foreground</span></h2>
						<div class="inside">
							<?php echo $image; ?>
							<p class="hide-if-no-js">
								<a href="#" class="postbox-upload" data-img="_foreground">Set image</a>
								<a href="#" class="image-remove" data-img="_foreground">Remove image</a>
							</p>
							<input type="hidden" name="_foreground" value="<?php echo $image_link; ?>">
						</div>
					</div>

				</div>


				<div id="postbox-container-2" class="postbox-container">
					<div id="rates-form-editor">
						<div id="rates-data" class="postbox">
							<h2 class="hndle ui-sortable-handle">
								<span><?php echo esc_html( __( 'Rates data', 'int-rates' ) ); ?>
									<span class="type_box"> —
										<label for="rates-type">
											<select id="rates-type" name="rates-type">
												<optgroup label="Type">
													<option value="local-moves" <?php echo $post_meta['_rates_type'][0] == 'local-moves' ? 'selected' : ''; ?>><?php echo esc_html( __( 'Local Moves', 'int-rates' ) ); ?></option>
													<option value="storage" <?php echo $post_meta['_rates_type'][0] == 'storage' ? 'selected' : ''; ?>><?php echo esc_html( __( 'Long Distances', 'int-rates' ) ); ?></option>
												</optgroup>
											</select>
										</label>
									</span>
								</span>
							</h2>

							<div id="top-tabs">
								
								<ul>
									<li>
										<a href="#weekdays-panel"><?php echo esc_html( __( 'Weekdays', 'int-rates' ) ); ?></a>
									</li>
									<li>
										<a href="#weekends-panel"><?php echo esc_html( __( 'Weekends', 'int-rates' ) ); ?></a>
									</li>
								</ul>
									
								<div class="inside">

									<div id="weekdays-panel" class="rates-panel-wrap">

										<?php $tabs = new RTS_Tabs(); ?>
										<?php $tabs->display('weekdays', $post_meta); ?>

										<div class="clear"></div>
									</div>

									<div id="weekends-panel" class="rates-panel-wrap">

										<?php $tabs->display('weekends', $post_meta); ?>

										<div class="clear"></div>
									</div>

								</div>

							</div>

						</div>
					</div>
					<p class="submit"><input type="submit" class="button-primary" name="" value="Save"></p>
				</div>

			</div>
		</div>

	</form>
</div>
