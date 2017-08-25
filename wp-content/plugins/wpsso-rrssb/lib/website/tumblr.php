<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoRrssbSubmenuWebsiteTumblr' ) ) {

	class WpssoRrssbSubmenuWebsiteTumblr {

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			$this->p->util->add_plugin_filters( $this, array(
				'rrssb_website_tumblr_rows' => 3,	// $table_rows, $form, $submenu
			) );
		}

		public function filter_rrssb_website_tumblr_rows( $table_rows, $form, $submenu ) {

			$table_rows[] = $form->get_th_html( _x( 'Show Button in', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$submenu->show_on_checkboxes( 'tumblr' ).'</td>';

			$table_rows[] = $form->get_th_html( _x( 'Preferred Order', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_select( 'tumblr_order', range( 1, count( $submenu->website ) ) ).'</td>';

			if ( $this->p->avail['*']['vary_ua'] ) {
				$table_rows[] = '<tr class="hide_in_basic">'.
				$form->get_th_html( _x( 'Allow for Platform', 'option label', 'wpsso-rrssb' ) ).
				'<td>'.$form->get_select( 'tumblr_platform', $this->p->cf['sharing']['platform'] ).'</td>';
			}

			$table_rows[] = '<tr class="hide_in_basic">'.
                        $form->get_th_html( _x( 'Summary Text Length', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_input( 'tumblr_cap_len', 'short' ).' '.
				_x( 'characters or less', 'option comment', 'wpsso-rrssb' ).'</td>';

			$table_rows[] = '<tr class="hide_in_basic">'.
			$form->get_th_html( _x( 'Append Hashtags to Summary', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_select( 'tumblr_cap_hashtags',
				range( 0, $this->p->cf['form']['max_hashtags'] ), 'short', null, true ).' '.
					_x( 'tag names', 'option comment', 'wpsso-rrssb' ).'</td>';

			$table_rows[] = '<tr class="hide_in_basic">'.
			'<td colspan="2">'.$form->get_textarea( 'tumblr_rrssb_html', 'average code' ).'</td>';

			return $table_rows;
		}
	}
}

if ( ! class_exists( 'WpssoRrssbWebsiteTumblr' ) ) {

	class WpssoRrssbWebsiteTumblr {

		private static $cf = array(
			'opt' => array(				// options
				'defaults' => array(
					'tumblr_order' => 9,
					'tumblr_on_content' => 0,
					'tumblr_on_excerpt' => 0,
					'tumblr_on_sidebar' => 0,
					'tumblr_on_admin_edit' => 0,
					'tumblr_platform' => 'any',
					'tumblr_cap_len' => 300,
					'tumblr_cap_hashtags' => 0,
					'tumblr_rrssb_html' => '<li class="rrssb-tumblr">
	<a href="http://tumblr.com/share/link?url=%%sharing_url%%&amp;name=%%tumblr_title%%&amp;description=%%tumblr_summary%%" class="popup">
		<span class="rrssb-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
				<path d="M18.02 21.842c-2.03.052-2.422-1.396-2.44-2.446v-7.294h4.73V7.874H15.6V1.592h-3.714s-.167.053-.182.186c-.218 1.935-1.144 5.33-4.988 6.688v3.637h2.927v7.677c0 2.8 1.7 6.7 7.3 6.6 1.863-.03 3.934-.795 4.392-1.453l-1.22-3.54c-.52.213-1.415.413-2.115.455z" />
			</svg>
		</span>
		<span class="rrssb-text">tumblr</span>
	</a>
</li><!-- .rrssb-tumblr -->',
				),
			),
		);

		protected $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			$this->p->util->add_plugin_filters( $this, array( 
				'get_defaults' => 1,
			) );
		}

		public function filter_get_defaults( $def_opts ) {
			return array_merge( $def_opts, self::$cf['opt']['defaults'] );
		}

		public function get_html( array $atts, array $opts, array $mod ) {
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			$atts['add_hashtags'] = empty( $this->p->options['tumblr_cap_hashtags'] ) ?
				false : $this->p->options['tumblr_cap_hashtags'];

			return $this->p->util->replace_inline_vars( '<!-- Tumblr Button -->'.
				$this->p->options['tumblr_rrssb_html'], $mod, $atts, array(
				 	'tumblr_title' => rawurlencode( $this->p->page->get_caption( 'title', 0,
						$mod, true, false, false, 'tumblr_title', 'tumblr' ) ),
				 	'tumblr_summary' => rawurlencode( $this->p->page->get_caption( 'excerpt', $opts['tumblr_cap_len'],
						$mod, true, $atts['add_hashtags'], false, 'tumblr_desc', 'tumblr' ) ),
				 )
			 );
		}
	}
}

?>
