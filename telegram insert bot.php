<?php
/*
Plugin Name:telegram insert bot
Plugin URI: http://ticker.com
Description: tickers for learn wordpress
Version: 5.0.1
Author: kiarash
Author URI: http://kiarash.com/
Text Domain: ztjalali
Domain Path: /languages
 */
class colorpicker{
    function __construct(){
		register_activation_hook(__FILE__,array($this,'activition'));
		add_action('plugins_loaded',array($this,'defining_constants'),1);
		add_action('plugins_loaded',array($this,'load_textdomain'),1);
        add_action('plugins_loaded',array($this,'set_includes'),1);

    }
    	
	public function activition(){ 
		if(!get_option('telegram-insert-bot')){
			add_option('telegram-insert-bot');
		}
	}
	public function defining_constants(){
        define('PLUGIN_NAME', 'telegram-insert-bot');
        define('VERSION','1.0.0');
        define('BASE_PLUGIN_DIR',PLUGIN_NAME.'/'.PLUGIN_NAME.'.php');
        define('PLUGIN_URL',plugin_dir_url(__FILE__));
        define('LANGUAGES_DIR',PLUGIN_NAME.'/languages');
        define('INC_DIR','inc');
        define('IMG_DIR','assets/images');
        define('CSS_DIR','assets/css');
        define('JS_DIR','assets/js');
    }

	public function load_textdomain(){
		load_plugin_textdomain(PLUGIN_NAME,false,LANGUAGES_DIR);
	}
    public function set_includes(){
        require_once 'inc/add_menu.php';
        require_once 'inc/setting.php';
        require_once 'inc/insert_post.php';

    }
}

new colorpicker();
