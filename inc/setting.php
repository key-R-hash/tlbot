<?php
function settings_init(){
	register_setting(PLUGIN_NAME,'telegram-insert-bot');
	$opts = get_option('telegram-insert-bot');
	
	add_settings_section(
		'settings-sections',
		__('Settings telegram insert bot','post-submitter'),
		'settings_section_telegram_insert_bot',
		PLUGIN_NAME
	);
	
	add_settings_field(
		'telegram-insert-bot',
		__('if you whant insert post with telegram check this box','telegram-insert-bot'),
		'settings_telegram_insert_bot',
		PLUGIN_NAME,
		'settings-sections',
		[
			'name' => 'telegram-insert-bot',
			'label_for' => 'telegram-insert-bot-settings',
			'class' => 'telegram insert bot-settings',
			'options' => $opts
		]
	);
}
add_action('admin_init','settings_init');
function settings_section_telegram_insert_bot(){
	_e('telegram insert bot','telegram-insert-bot');
}
function settings_telegram_insert_bot($args){
	// print_r($args['options']);
	// print_r(wp_login('kiarash','k3691215','wp_signon()'));
	$connection = new mysqli('localhost','kiarash','Skills39','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $query_str = 'SELECT `b` FROM `variable`';
    $query = $connection->query($query_str);
    $data = $query->fetch_assoc();
    ?>
    <div class="ticker-colors-html-metabox">
	<p>
		<input type="checkbox" name="telegram-insert-bot[<?php echo $args['name'] ?>]" id="<?php echo $args['label_for'] ?>" <?php checked($args['options']['telegram-insert-bot'],'on'); ?>>
		<label for="<?php echo $args['label_for'] ?>"><?php esc_html_e('check it', 'telegram-insert-bot'); ?></label>
	</p>
			
    <?php
	if($args['options']['telegram-insert-bot'] == 'on' && $data['b'] == 0){
		$query_str = 'UPDATE `variable` SET `b`= 1';
		$query = $connection->query($query_str);
	}else{
		$query_str = 'UPDATE `variable` SET `b`= 0';
		$query = $connection->query($query_str);
	}
}
function settingspage(){
    ?>
    <form action="options.php" method="post">
        <?php
        settings_fields(PLUGIN_NAME); 
        do_settings_sections(PLUGIN_NAME); 
        submit_button(__('Save Settings','telegram-insert-bot'),'telegram-insert-bot');
        ?>
        
    </form>
    <?php
    }