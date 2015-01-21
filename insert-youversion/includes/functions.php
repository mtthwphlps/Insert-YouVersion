<?php
function Insert_YouVersion_VersionDropdown() {
	$insert_youversion_versions = Insert_YouVersion_Versions();;
	$defaultversion = explode('.', get_option('insert_youversion_settings_defaults', 'NIV.new'));
	$defaultversion = $defaultversion[0];
	$versionlist = '';
	foreach($insert_youversion_versions as $version) {
		$versionlist .= '<option value="'.$version['Short'].'"';
		if($defaultversion == $version['Short']) {
			$versionlist .= ' selected';
		}
		$versionlist .= '>'.$version['Name'].'</option>
';
	}
	echo $versionlist;
}

function Insert_YouVersion_BookDropdown() {
	$insert_youversion_books = Insert_YouVersion_Books();
	$booklist = '';
	foreach($insert_youversion_books as $bookshort => $booklong) {
		$booklist .= '<option value="'.$bookshort.'">'.$booklong.'</option>
';
	}
	echo $booklist;
}

function Insert_Youversion_FormFields($version,$book,$chapter,$verse,$target,$nametype,$prefix) {
	if($nametype == 'array') {
		$fieldnames = array(
			"version" => $prefix."insert_youversion[version]",
			"book" => $prefix."insert_youversion[book]",
			"chapter" => $prefix."insert_youversion[chapter]",
			"verse" => $prefix."insert_youversion[verse]",
			"target" => $prefix."insert_youversion[target]"
		);
	} elseif($nametype == 'single') {
		$fieldnames = array(
			"version" => $prefix."insert_youversion_version",
			"book" => $prefix."insert_youversion_book",
			"chapter" => $prefix."insert_youversion_chapter",
			"verse" => $prefix."insert_youversion_verse",
			"target" => $prefix."insert_youversion_target"
		);
	}
	if($version != 0) { ?>
		<?php if($version == 1) { ?>Version<br /><?php } ?>
		<select id="<?php echo $fieldnames['version']; ?>" name="<?php echo $fieldnames['version']; ?>"><?php Insert_YouVersion_VersionDropdown(); ?></select><br />
	<?php }
	if($book != 0) { ?>
		<?php if($book == 1) { ?>Book<br /><?php } ?>
		<select id="<?php echo $fieldnames['book']; ?>" name="<?php echo $fieldnames['book']; ?>"><?php Insert_YouVersion_BookDropdown(); ?></select><br />
	<?php }
	if($chapter != 0) { ?>
		<?php if($chapter == 1) { ?>Chapter<br /><?php } ?>
		<input id="<?php echo $fieldnames['chapter']; ?>" name="<?php echo $fieldnames['chapter']; ?>" type="text" /><br />
	<?php }
	if($verse != 0) { ?>
		<?php if($verse == 1) { ?>Verse<br /><?php } ?>
		<input id="<?php echo $fieldnames['verse']; ?>" name="<?php echo $fieldnames['verse']; ?>" type="text" /><br />
	<?php }
	if($target != 0) { ?>
		<?php if($target == 1) { ?>Target<br /><?php } 
		$defaulttarget = explode('.', get_option('insert_youversion_settings_defaults', 'NIV.new'));
		$defaulttarget = $defaulttarget[1]; ?>
		<select id="<?php echo $fieldnames['target']; ?>" name="<?php echo $fieldnames['target']; ?>">
			<option value="new"<?php if($defaulttarget == 'new') { ?> selected<?php } ?>>New Window</option>
			<option value="self"<?php if($defaulttarget == 'self') { ?> selected<?php } ?>>Same Window</option>
		</select><br />
	<?php }
}
?>