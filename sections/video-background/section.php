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

		$video_mp4 = ( $this->opt( 'vb_mp4', $this->oset ) ) ? $this->opt( 'vb_mp4', $this->oset ) : '';

		if ( $this->opt( 'vb_loop', $this->oset ) == 'n') {
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

		$vb_youtube = ( $this->opt( 'vb_youtube', $this->oset ) ) ? $this->opt( 'vb_youtube', $this->oset ) : '';

		$vb_startat = ( $this->opt( 'vb_startat', $this->oset ) ) ? $this->opt( 'vb_startat', $this->oset ) : '0';

		$vb_opacity = ( $this->opt( 'vb_opacity', $this->oset ) ) ? $this->opt( 'vb_opacity', $this->oset ) : '1.0';


		if ( $this->opt( 'vb_autoplay', $this->oset ) == 'n') {
			$vb_autoplay = 'false';
		} else {
			$vb_autoplay = 'true';
		}

		if ( $this->opt( 'vb_mute', $this->oset ) == 'y' || pl_draft_mode() ) {
			$vb_mute = 'true';
		} else {
			$vb_mute = 'false';
		}

		if ( $this->opt( 'vb_loop', $this->oset ) == 'n') {
			$vb_loop = 'false';
		} else {
			$vb_loop = 'true';
		}

		if ( $this->opt( 'vb_showcontrols', $this->oset ) == 'n' || pl_draft_mode() ) {
			$vb_showcontrols = 'false';
		} else {
			$vb_showcontrols = 'true';
		}

		if ($vb_youtube) {
			printf('<a class="videobackground" data-property="{videoURL:\'%s\', autoPlay:%s, mute:%s, startAt:%s, opacity:%s, loop:%s, showControls:%s, showYTLogo:false, printUrl: false}"></a>', $vb_youtube, $vb_autoplay, $vb_mute, $vb_startat, $vb_opacity, $vb_loop, $vb_showcontrols ) ;
		} else {
			echo setup_section_notify($this, __('Please set up Video Background.', 'VideoBackground'));
		}

	}


	function section_optionator( $settings ){

		$settings = wp_parse_args($settings, $this->optionator_default);

		$options = array(

			'vb_options' => array(
				'type' => 'multi_option',
				'title' => __('Video Background Options', 'VideoBackground'),
				'shortexp' => __('Settings for Video Background goes here.', 'VideoBackground'),
				'selectvalues' => array(

					'vb_youtube'  => array(
						'inputlabel'  => __( 'YouTube video link:', 'VideoBackground' ),
						'title'   => __( 'YouTube Video Link', 'VideoBackground' ),
						'type'   => 'text',
						'shortexp'   => __( 'Link to the YouTube video you wish to use as background.', 'VideoBackground' )
					),

					'vb_startat'  => array(
						'title'   => __( 'Start video at', 'VideoBackground' ),
						'inputlabel'  => __( 'After how many seconds should the video start? (Default: 0)', 'VideoBackground' ),
						'type'   => 'text',
					),

					'vb_showcontrols'  => array(
						'title'   => __( 'Controls', 'VideoBackground' ),
						'inputlabel' => __('Show Controls? (Default: Yes)', 'VideoBackground'),
						'exp' => __('Controls is always hidden when editor is in draft mode', 'VideoBackground'),
						'type' => 'select',
						'selectvalues' => array(
							'y'   => array( 'name' => __('Yes'	, 'VideoBackground' )),
							'n'   => array( 'name' => __('No'	, 'VideoBackground' )),
						)
					),

					'vb_autoplay'  => array(
						'title'   => __( 'Autoplay', 'VideoBackground' ),
						'inputlabel' => __('Autoplay video? (Default: Yes)', 'VideoBackground'),
						'type' => 'select',
						'selectvalues' => array(
							'y'   => array( 'name' => __('Yes'	, 'VideoBackground' )),
							'n'   => array( 'name' => __('No'	, 'VideoBackground' )),
						)
					),

					'vb_mute'  => array(
						'title'   => __( 'Mute', 'VideoBackground' ),
						'inputlabel' => __('Mute video? (Default: Yes)', 'VideoBackground'),
						'exp' => __('Videos is always muted when editor is in draft mode', 'VideoBackground'),
						'type' => 'select',
						'selectvalues' => array(
							'y'   => array( 'name' => __('Yes'	, 'VideoBackground' )),
							'n'   => array( 'name' => __('No'	, 'VideoBackground' )),
						)
					),

					'vb_loop'  => array(
						'title'   => __( 'Loop', 'VideoBackground' ),
						'inputlabel' => __('Loop video at end? (Default: Yes)', 'VideoBackground'),
						'type' => 'select',
						'selectvalues' => array(
							'y'   => array( 'name' => __('Yes'	, 'VideoBackground' )),
							'n'   => array( 'name' => __('No'	, 'VideoBackground' )),
						)
					),

					'vb_opacity' =>  array(
						'title'   => __( 'Opacity', 'VideoBackground' ),
						'inputlabel' => __('Opacity? (Default: 1.0)', 'VideoBackground'),
						'type'    =>  'select',
						'selectvalues'     => array(
							'.0' => array( 'name' => __( '0.0'	, 'VideoBackground' )),
							'.1' => array( 'name' => __( '0.1'	, 'VideoBackground' )),
							'.2' => array( 'name' => __( '0.2'	, 'VideoBackground' )),
							'.3' => array( 'name' => __( '0.3'	, 'VideoBackground' )),
							'.4' => array( 'name' => __( '0.4'	, 'VideoBackground' )),
							'.5' => array( 'name' => __( '0.5'	, 'VideoBackground' )),
							'.6' => array( 'name' => __( '0.6'	, 'VideoBackground' )),
							'.7' => array( 'name' => __( '0.7'	, 'VideoBackground' )),
							'.8' => array( 'name' => __( '0.8'	, 'VideoBackground' )),
							'.9' => array( 'name' => __( '0.9'	, 'VideoBackground' )),
							'1'	 => array( 'name' => __( '1.0'	, 'VideoBackground' ))
						)
					),
				),
			),

		);

		$tab_settings = array(

			'id'		=> 'vidobackground-options',
			'name'		=> 'Video Background',
			'icon'		=> $this->icon,
			'clone_id'	=> $settings['clone_id'],
			'active'	=> $settings['active']
		);


		register_metatab($tab_settings, $options, $this->class_name);


	}

}