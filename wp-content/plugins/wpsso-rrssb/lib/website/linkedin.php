<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoRrssbSubmenuWebsiteLinkedin' ) ) {

	class WpssoRrssbSubmenuWebsiteLinkedin {

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			$this->p->util->add_plugin_filters( $this, array(
				'rrssb_website_linkedin_rows' => 3,	// $table_rows, $form, $submenu
			) );
		}

		public function filter_rrssb_website_linkedin_rows( $table_rows, $form, $submenu ) {

			$table_rows[] = $form->get_th_html( _x( 'Show Button in', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$submenu->show_on_checkboxes( 'linkedin' ).'</td>';

			$table_rows[] = $form->get_th_html( _x( 'Preferred Order', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_select( 'linkedin_order', range( 1, count( $submenu->website ) ) ).'</td>';

			if ( $this->p->avail['*']['vary_ua'] ) {
				$table_rows[] = '<tr class="hide_in_basic">'.
				$form->get_th_html( _x( 'Allow for Platform', 'option label', 'wpsso-rrssb' ) ).
				'<td>'.$form->get_select( 'linkedin_platform', $this->p->cf['sharing']['platform'] ).'</td>';
			}

			$table_rows[] = '<tr class="hide_in_basic">'.
                        $form->get_th_html( _x( 'Caption Text Length', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_input( 'linkedin_cap_len', 'short' ).' '.
				_x( 'characters or less', 'option comment', 'wpsso-rrssb' ).'</td>';

			$table_rows[] = '<tr class="hide_in_basic">'.
			$form->get_th_html( _x( 'Append Hashtags to Caption', 'option label', 'wpsso-rrssb' ) ).
			'<td>'.$form->get_select( 'linkedin_cap_hashtags',
				range( 0, $this->p->cf['form']['max_hashtags'] ), 'short', null, true ).' '.
					_x( 'tag names', 'option comment', 'wpsso-rrssb' ).'</td>';

			$table_rows[] = '<tr class="hide_in_basic">'.
			'<td colspan="2">'.$form->get_textarea( 'linkedin_rrssb_html', 'average code' ).'</td>';

			return $table_rows;
		}
	}
}

if ( ! class_exists( 'WpssoRrssbWebsiteLinkedin' ) ) {

	class WpssoRrssbWebsiteLinkedin {

		private static $cf = array(
			'opt' => array(				// options
				'defaults' => array(
					'linkedin_order' => 6,
					'linkedin_on_content' => 1,
					'linkedin_on_excerpt' => 0,
					'linkedin_on_sidebar' => 0,
					'linkedin_on_admin_edit' => 1,
					'linkedin_platform' => 'any',
					'linkedin_cap_len' => 300,
					'linkedin_cap_hashtags' => 0,
					'linkedin_rrssb_html' => '<li class="rrssb-linkedin">
	<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=%%sharing_url%%&amp;title=%%linkedin_title%%&amp;summary=%%linkedin_caption%%" class="popup">
		<span class="rrssb-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
				<path d="M25.424 15.887v8.447h-4.896v-7.882c0-1.98-.71-3.33-2.48-3.33-1.354 0-2.158.91-2.514 1.802-.13.315-.162.753-.162 1.194v8.216h-4.9s.067-13.35 0-14.73h4.9v2.087c-.01.017-.023.033-.033.05h.032v-.05c.65-1.002 1.812-2.435 4.414-2.435 3.222 0 5.638 2.106 5.638 6.632zM5.348 2.5c-1.676 0-2.772 1.093-2.772 2.54 0 1.42 1.066 2.538 2.717 2.546h.032c1.71 0 2.77-1.132 2.77-2.546C8.056 3.593 7.02 2.5 5.344 2.5h.005zm-2.48 21.834h4.896V9.604H2.867v14.73z" />
			</svg>
		</span>
		<span class="rrssb-text">linkedin</span>
	</a>
</li><!-- .rrssb-linkedin -->',
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

			$atts['add_hashtags'] = empty( $this->p->options['linkedin_cap_hashtags'] ) ?
				false : $this->p->options['linkedin_cap_hashtags'];

			return $this->p->util->replace_inline_vars( '<!-- LinkedIn Button -->'.
				$this->p->options['linkedin_rrssb_html'], $mod, $atts, array(
				 	'linkedin_title' => rawurlencode( $this->p->page->get_caption( 'title', 0,
						$mod, true, false, false, 'linkedin_title', 'linkedin' ) ),
				 	'linkedin_caption' => rawurlencode( $this->p->page->get_caption( 'excerpt', $opts['linkedin_cap_len'],
						$mod, true, $atts['add_hashtags'], false, 'linkedin_desc', 'linkedin' ) ),
				 )
			 );
		}
	}
}

?>
