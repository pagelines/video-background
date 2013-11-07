<?php
/*
	Section: Video Background
	Author: Aleksander Hansson
	Author URI: http://ahansson.com
	Demo: http://videobackground.ahansson.com
	Description: A section that makes it possible to have YouTube videos as background on a page-by-page basis. 7 customization options and pure awesomeness!
	Class Name: VideoBackground
	Cloning: false
	v3: true
	Filter: layout
*/

class VideoBackground extends PageLinesSection {

	function section_styles() {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'jquery-vb-ytplayer', $this->base_url.'/js/jquery.mb.YTPlayer.js' );

	}

	function section_head() {

		$video_mp4 = ( $this->opt( 'vb_mp4' ) ) ? $this->opt( 'vb_mp4' ) : '';

		if ( $this->opt( 'vb_loop' ) == 'n') {
			$loop_setting = 'false';
		} else {
			$loop_setting = 'true';
		}

		$loop = sprintf('doLoop:%s', $loop_setting);


		?>
			<script type="text/javascript">

				jQuery(document).ready(function() {

					jQuery.mbYTPlayer.controls.play ='<i class="icon-play"></i>';
					jQuery.mbYTPlayer.controls.pause ='<i class="icon-pause"></i>';
					jQuery.mbYTPlayer.controls.mute ='<i class="icon-volume-up"></i>';
					jQuery.mbYTPlayer.controls.unmute ='<i class="icon-volume-off"></i>';
					jQuery.mbYTPlayer.controls.ytLogo ='';
					jQuery.mbYTPlayer.controls.onlyYT ='<i class="icon-fullscreen"></i>';

					jQuery(".videobackground").mb_YTPlayer();

				});

			</script>

		<?php

	}

	function section_template() {

		$vb_youtube = ( $this->opt( 'vb_youtube' ) ) ? $this->opt( 'vb_youtube' ) : '';

		$vb_startat = ( $this->opt( 'vb_startat' ) ) ? $this->opt( 'vb_startat' ) : '0';

		$vb_opacity = ( $this->opt( 'vb_opacity' ) ) ? $this->opt( 'vb_opacity' ) : '1.0';


		if ( $this->opt( 'vb_autoplay' ) == 'n') {
			$vb_autoplay = 'false';
		} else {
			$vb_autoplay = 'true';
		}

		if ( $this->opt( 'vb_mute' ) == 'y' || pl_draft_mode() ) {
			$vb_mute = 'true';
		} else {
			$vb_mute = 'false';
		}

		if ( $this->opt( 'vb_loop' ) == 'n') {
			$vb_loop = 'false';
		} else {
			$vb_loop = 'true';
		}

		if ( $this->opt( 'vb_showcontrols' ) == 'n' || pl_draft_mode() ) {
			$vb_showcontrols = 'false';
		} else {
			$vb_showcontrols = 'true';
		}

		if ($vb_youtube) {
			printf('<a class="videobackground" data-property="{videoURL:\'%s\', autoPlay:%s, mute:%s, startAt:%s, opacity:%s, loop:%s, showControls:%s, showYTLogo:false, printUrl: false}"></a>', $vb_youtube, $vb_autoplay, $vb_mute, $vb_startat, $vb_opacity, $vb_loop, $vb_showcontrols ) ;
		} else {
			echo setup_section_notify($this, __('Please set up Video Background.', 'video-background'));
		}

	}

	function section_opts() {

		$options = array();

		$how_to_use = __( '
		<strong>Read the instructions below before asking for additional help:</strong>
		</br></br>
		<strong>1.</strong> Copy the link of the YouTube video that you want as a background and paste it into link field.
		</br></br>
		<strong>2.</strong> Customize it by editing the other settings.
		</br></br>
		<strong>3.</strong> When you are done, hit "Publish" and refresh to see changes.
		</br></br>
		<div class="row zmb">
				<div class="span6 tac zmb">
					<a class="btn btn-info" href="http://forum.pagelines.com/71-products-by-aleksander-hansson/" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-ambulance"></i>          Forum</a>
				</div>
				<div class="span6 tac zmb">
					<a class="btn btn-info" href="http://betterdms.com" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-align-justify"></i>          Better DMS</a>
				</div>
			</div>
			<div class="row zmb" style="margin-top:4px;">
				<div class="span12 tac zmb">
					<a class="btn btn-success" href="http://shop.ahansson.com" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-shopping-cart" ></i>          My Shop</a>
				</div>
			</div>
		', 'split-slider' );

		$options[] = array(
			'key' => 'vb_help',
			'type'     => 'template',
			'template'      => do_shortcode( $how_to_use ),
			'title' =>__( 'How to use:', 'video-background' ) ,
		);

		$options[] = array(

			'key'	=> 'vb_options',
			'title' => __( 'Video Background Options', 'video-background' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'	=>	'vb_youtube',
					'label'  => __( 'YouTube video link:', 'video-background' ),
					'type'   => 'text',
					'help'   => __( 'Link to the YouTube video you wish to use as background.', 'video-background' )
				),

				array(
					'key'	=>		'vb_startat',
					'title'   => __( 'Start video at', 'video-background' ),
					'label'  => __( 'After how many seconds should the video start? (Default: 0)', 'video-background' ),
					'type'   => 'text',
				),

				array(
					'key'	=>		'vb_showcontrols',
					'label' => __('Show Controls? (Default: Yes)', 'video-background'),
					'help' => __('Controls is always hidden when editor is in draft mode', 'video-background'),
					'type' => 'select',
					'default' => 'y',
					'opts' => array(
						'y'   => array( 'name' => __('Yes'	, 'video-background' )),
						'n'   => array( 'name' => __('No'	, 'video-background' )),
					)
				),

				array(
					'key'	=>		'vb_autoplay',
					'label' => __('Autoplay video? (Default: Yes)', 'video-background'),
					'type' => 'select',
					'default' => 'y',
					'opts' => array(
						'y'   => array( 'name' => __('Yes'	, 'video-background' )),
						'n'   => array( 'name' => __('No'	, 'video-background' )),
					)
				),

				array(
					'key'	=>	'vb_mute',
					'label' => __('Mute video? (Default: Yes)', 'video-background'),
					'help' => __('Videos is always muted when editor is in draft mode', 'video-background'),
					'type' => 'select',
					'default' => 'y',
					'opts' => array(
						'y'   => array( 'name' => __('Yes'	, 'video-background' )),
						'n'   => array( 'name' => __('No'	, 'video-background' )),
					)
				),

				array(
					'key'	=>		'vb_loop',
					'label' => __('Loop video at end? (Default: Yes)', 'video-background'),
					'type' => 'select',
					'default' => 'y',
					'opts' => array(
						'y'   => array( 'name' => __('Yes'	, 'video-background' )),
						'n'   => array( 'name' => __('No'	, 'video-background' )),
					)
				),

				array(
					'key'	=>		'vb_opacity',
					'label' => __('Opacity? (Default: 1.0)', 'video-background'),
					'type'    =>  'select',
					'opts'     => array(
						'.0' => array( 'name' => __( '0.0'	, 'video-background' )),
						'.1' => array( 'name' => __( '0.1'	, 'video-background' )),
						'.2' => array( 'name' => __( '0.2'	, 'video-background' )),
						'.3' => array( 'name' => __( '0.3'	, 'video-background' )),
						'.4' => array( 'name' => __( '0.4'	, 'video-background' )),
						'.5' => array( 'name' => __( '0.5'	, 'video-background' )),
						'.6' => array( 'name' => __( '0.6'	, 'video-background' )),
						'.7' => array( 'name' => __( '0.7'	, 'video-background' )),
						'.8' => array( 'name' => __( '0.8'	, 'video-background' )),
						'.9' => array( 'name' => __( '0.9'	, 'video-background' )),
						'1'	 => array( 'name' => __( '1.0'	, 'video-background' ))
					)
				),
			),
		);

		return $options;
	}

}