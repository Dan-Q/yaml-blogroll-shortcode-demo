<?php
/*
Plugin Name: Dan Q's Blogroll
Description: Basic [blogroll] shortcode demonstration for Kev Quirk.
Version:     1.0
Author:      Dan Q
Author URI:  http://danq.me/
License:     The Unlicense
*/
require_once( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' );

class DanQBlogroll {
	public static function danq_blogroll_shortcode() {
		// Check the blogroll.yml file exists:
		$filename = plugin_dir_path( __FILE__ ) . 'blogroll.yml';
		if( ! file_exists( $filename ) ) {
			return "<p><strong>Blogroll file missing:</strong> {$filename}</p>";
			return;
		}

		// Use Symfony's YAML parser to parse it:
		$blogs = \Symfony\Component\Yaml\Yaml::parseFile( plugin_dir_path( __FILE__ ) . 'blogroll.yml' );
		$html = '';

		// Iterate through the blogs from the YAML and return some HTML:
		foreach ($blogs as $blog ) {
			// A little escaping to prevent accidental self-XSS:
			$link = esc_attr( $blog['link'] );
			$rss = esc_attr( $blog['rss'] );
			$name = esc_html( $blog['name'] );
			$html .= "
				<li>
					<a target=\"_blank\" href=\"{$link}\">{$name}</a>
					(<a href=\"{$rss}\">RSS feed</a>)
				</li>
			";
		}
		return "<ul class=\"danq-blogroll\">{$html}</ul>";
	}
}

// Set up the [blogroll] shortcode:
add_shortcode( 'blogroll', [ 'DanQBlogroll', 'danq_blogroll_shortcode' ] );
