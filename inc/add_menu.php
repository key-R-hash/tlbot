<?php
function add_page(){
	add_menu_page(
		__('telegram insert bot','telegram-insert-bot'),
		__('telegram insert bot','telegram-insert-bot'),
		'manage_options',
		'telegram-insert-bot',
		'settingspage',
		PLUGIN_URL.'/'.IMG_DIR.'/icon-post-submitter.png',
		99
	);
	
	add_submenu_page(
		'telegram-insert-bot',
		__('telegram insert bot','telegram-insert-bot'),
		__('Settings telegram insert bot','telegram-insert-bot'),
		'manage_options',
		'telegram-insert-bot',
		'settingspage'
	);

}
add_action('admin_menu','add_page');

function add_action_links($links){
	$links[] = '<a href="'.esc_url(admin_url('admin.php?page='.PLUGIN_NAME)).'">'.esc_html__('Settings','telegram-insert-bot').'</a>';
	return $links;
	
}
add_filter('plugin_action_links_'.BASE_PLUGIN_DIR,'add_action_links');