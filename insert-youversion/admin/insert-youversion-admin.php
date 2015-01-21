<?php
// Register the TinyMCE buttons
add_action( 'init', 'insert_youversion_buttons' );
function insert_youversion_buttons() {
    add_filter( "mce_external_plugins", "insert_youversion_add_buttons" );
    add_filter( 'mce_buttons', 'insert_youversion_register_buttons' );
}
function insert_youversion_add_buttons( $plugin_array ) {
    $plugin_array['insert_youversion'] = plugins_url( 'tinymceplugin.js' , __FILE__ );
    return $plugin_array;
}
function insert_youversion_register_buttons( $buttons ) {
    array_push( $buttons, 'insert-youversion' );
    return $buttons;
}

// Set up the target for the TinyMCE plugin AJAX function
add_action('wp_ajax_iyv_ajax', 'insert_youversion_ajax');
function insert_youversion_ajax() {
	header('Content-Type: text/html; charset=' . get_option('blog_charset')); ?>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Insert YouVersion</title>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script type='text/javascript'>
			function insert_youversion_InsertShortcode() {
				var insert_youversion_version = jQuery("#insert_youversion_version").val().toLowerCase();
				var insert_youversion_book = jQuery("#insert_youversion_book").val().toLowerCase();
				var insert_youversion_chapter = jQuery("#insert_youversion_chapter").val();
				var insert_youversion_verse = jQuery("#insert_youversion_verse").val();
				var insert_youversion_target = jQuery("#insert_youversion_target").val();
				return_text = '[insert-youversion ref=' + insert_youversion_version + '.' + insert_youversion_book + '.' + insert_youversion_chapter + '.' + insert_youversion_verse + ' target=' + insert_youversion_target + ']';
				tinymce.activeEditor.execCommand('mceInsertContent', false, return_text);
				tinyMCEPopup.editor.execCommand('mceRepaint');
				tinyMCEPopup.close();
			}
		</script>
	</head>
	<body>
	<form method="post" action="#" id="scep-tinymce-form">
		<?php Insert_Youversion_FormFields(1,1,1,1,1,'single',''); ?>
		<br />
		<button onClick="insert_youversion_InsertShortcode();">Insert</button>
	</form>
	</body>
	</html>
<?php die();
}

// Set up the target for the settings update AJAX function
add_action('wp_ajax_iyv_ajax_update', 'insert_youversion_ajax_update');
function insert_youversion_ajax_update() {
	header('Content-Type: text/html; charset=' . get_option('blog_charset'));
	global $select_options;
	$insert_youversion_version = filter_input(INPUT_POST, 'ver', FILTER_SANITIZE_STRING);
	$insert_youversion_target = filter_input(INPUT_POST, 'tar', FILTER_SANITIZE_STRING);
	update_option( 'insert_youversion_settings_defaults', $insert_youversion_version.'.'.$insert_youversion_target );
	echo 'done';
	die();
}



// Add the settings page
function insert_youversion_settings() {
	if(!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	} ?>
	<div class="wrap">
		<h2>Insert YouVersion Settings</h2>
		<div id="insert-youversion-updated" class="updated settings-error" style="display: none;">
			<p>
				<strong>Settings updated.</strong>
			</p>
		</div>
		<?php settings_errors(); ?>
		<style type="text/css">
		.insert-youversion-row {
			margin: 0 0 10px 0;
		}
		.insert-youversion-title {
			display: inline-block;
			width: 125px;
			font-size: 14px;
		}
		.insert-youversion-field {
			display: inline-block;
		}
		</style>
		<script type="text/javascript">
		function Insert_YouVersion_AJAX_Update() {
			var version = jQuery("#insert_youversion_settings_defaults_version").val();
			var target = jQuery("#insert_youversion_settings_defaults_target").val();
			jQuery("#insert-youversion-submit").attr("disabled", "disabled");
			jQuery("#insert-youversion-updated").css("display", "none");
			console.log('version ' + version + ' target ' + target);
			console.log('starting AJAX...');
			jQuery.post(ajaxurl + '?action=iyv_ajax_update', {ver: version, tar: target}, function() {
				jQuery("#insert-youversion-updated").css("display", "block");
				jQuery("#insert-youversion-submit").removeAttr("disabled");  
			});
			return false;
		}
		</script>
		<form name="">
			<div class="insert-youversion-row">
				<div class="insert-youversion-title">
					Default Version
				</div>
				<div class="insert-youversion-field">
					<select id="insert_youversion_settings_defaults_version"><?php Insert_YouVersion_VersionDropdown(); ?></select><br />
				</div>
			</div>
			<div class="insert-youversion-row">
				<div class="insert-youversion-title">
					Default Target
				</div>
				<div class="insert-youversion-field">
					<?php $defaulttarget = explode('.', get_option('insert_youversion_settings_defaults', 'NIV.new'));
					$defaulttarget = $defaulttarget[1]; ?>
					<select id="insert_youversion_settings_defaults_target">
						<option value="new"<?php if($defaulttarget == 'new') { ?> selected<?php } ?>>New Window</option>
						<option value="self"<?php if($defaulttarget == 'self') { ?> selected<?php } ?>>Same Window</option>
					</select>
				</div>
			</div>
			<div class="insert-youversion-row">
				<div class="insert-youversion-title">
					<button id="insert-youversion-submit" class="button button-primary" onClick="Insert_YouVersion_AJAX_Update();">Save Changes</button>
				</div>
				<div class="insert-youversion-field">
				</div>
			</div>
		</form>
	</div>
<?php }
add_action( 'admin_menu', 'insert_youversion_add_page' );
function insert_youversion_add_page() {
	add_options_page( 'Insert YouVersion Settings', 'Insert YouVersion', 'edit_plugins', 'insert_youversion_settings', 'insert_youversion_settings');
}
add_action( 'admin_init', 'insert_youversion_init' );
function insert_youversion_init(){
	register_setting( 'insert_youversion_settings_defaults', 'insert_youversion' );
}


?>