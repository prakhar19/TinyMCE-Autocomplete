<?php

/*
 * Plugin Name: AutoComplete For TinyMCE
 * Description: AutoComplete support for Wordpress TinyMCE Editor.
 * Version: 1.0
 * Author: Prakhar Agarwal
 * License: GPL2
 */

if ( !class_exists(' TinyMCE_AutoComplete' ) ) {
	class TinyMCE_AutoComplete {
		
		function __construct() {
			if(is_admin()) {
				add_action('init', array($this, 'setup_tinymce_autocomplete'));
				add_action('admin_menu', array($this, 'setup_tinymce_menu_page'));
			}
		}
		
		function setup_tinymce_menu_page() {
			add_options_page('Autocomplete for Wordpress', 'Autocomplete', 'manage_options', 'tinymce_autocomplete', array($this, 'display_tinymce_menu_page'));
		}
		
		function display_tinymce_menu_page($a) {
			include('options_menu.php');
		}
		
		function setup_tinymce_autocomplete() {
			if(!current_user_can('edit_posts') && !current_user_can('edit_pages'))
				return;
			
			if (get_user_option('rich_editing') !== 'true')
				return;
			
			add_action('admin_enqueue_scripts', array(&$this, 'add_word_data'));
			add_filter('mce_external_plugins', array(&$this, 'add_tinymce_autocomplete'));
			add_filter('mce_buttons', array(&$this, 'add_tinymce_autocomplete_button'));
		}
		
		function add_word_data() {
			wp_enqueue_script('word_complete_data', plugins_url('/words.js', __FILE__));
			wp_enqueue_script('multi_word_complete_data', plugins_url('/mwords.js', __FILE__));
		}
		
		function add_tinymce_autocomplete($plugins) {
			$plugins['tinymce_autocomplete'] = plugins_url('/plugin/autocomplete.js', __FILE__);
			return $plugins;
		}
		
		function add_tinymce_autocomplete_button($buttons) {
			array_push($buttons, 'tinymce_autocomplete');
			return $buttons;
		}
	
	}
}

$tinyMCE_AutoComplete = new TinyMCE_AutoComplete;