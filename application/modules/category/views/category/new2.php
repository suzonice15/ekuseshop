<?php
//=========================================================================================
//GENERAL FUNCTIONS
//=========================================================================================
function isValidURL($url)
{
	if(substr($url, 0, 7)!="http://") $url = "http://".$url;
	if(filter_var($url, FILTER_VALIDATE_URL))
	{return true;} else {return false;}
}

function MakeValidURL($url)
{
	if($url)
	{
		if(substr($url, 0, 7)!="http://" and substr($url, 0, 8)!="https://") $url = "http://".$url;
		return $url;
	}
	else
		return "";
}


function random_code()
{
	$cod1 = md5(uniqid(rand(), true));
	$cod2 = substr($cod1, 0, 8);
	return $cod2;
}


function random_code_captcha($length)
{
	if($length==0 or !$length or !isset($length)) $length = 6;
	$possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
	while ($i < $length)
	{
		$rand_string .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
		$i++;
	}
	return $rand_string	;
}


function RewriteUrl ($string){
	$diacritics_table = array(
		'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c', 'ć'=>'c', 'Ć'=>'C',
		'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'ą'=>'a', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ę'=>'E',
		'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
		'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'Ł'=>'L', 'ł'=>'l',
		'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
		'ê'=>'e', 'ë'=>'e', 'ě'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'Ó'=>'O', 'ó'=>'o',
		'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
		'ÿ'=>'y', 'R'=>'R', 'r'=>'r', 'č'=>'c', 'ť'=>'t', 'Č'=>'C', 'ö'=>'o', 'ş'=>'s', 'ı'=>'i', 'ń'=>'n',
		'ğ'=>'g', 'ü'=>'u', 'ș'=>'s', 'ț'=>'t', 'ă'=>'a', 'Ă'=>'A', 'Ș'=>'S', 'Ț'=>'T', 'Ğ'=>'G', 'İ'=>'I',
		'Ş'=>'s', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'İ'=>'I', 'Ż'=>'Z', 'ż'=>'z'
	);

	$string = str_replace("\'", "", $string);
	$string2 = strtr($string, $diacritics_table);
	$return = strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string2),"-"));
	if($return=="") $return = random_code();
	return $return;
}

function RewriteLangKey ($string){
	//return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "_", $string),"-"));
	return trim(strip_tags($string));
}

function RewriteFile ($string){
	return strtolower(trim(preg_replace("/[^0-9a-zA-Z.]+/", "-", $string),"-"));
}

function RewriteStopWord ($string){
	return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string),"-"));
}

function Secure ($string){
	//$out = addslashes($string);
	//$string = htmlentities($string, ENT_QUOTES);
	//$string = str_replace(array('/','\\'), '', $string);
	$string = addslashes(htmlspecialchars($string));
	$string = strip_tags($string);
	return trim($string);
}


function Secure2 ($string){
	$out = addslashes($string);
	$string = htmlentities($string, ENT_QUOTES, "UTF-8");
	$string = str_replace(array('/','\\'), '', $string);
	return trim($string);
}


function ScriptDomain()
{
	//$domain = '//'.$_SERVER['HTTP_HOST'];
	//return $domain;
	if(isset($_SERVER['HTTPS'])){
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	}
	else{
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

function Base ($string){
	return trim(base64_decode($string));
}

function getTopDomain($url)
{
	if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE)
	{
		return false;
	}
	$parts = parse_url($url);
	return $parts['scheme'].'://'.$parts['host'];
}

function getHost($url)
{
	return str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
}

function input($in)
{
	$out = htmlentities(stripslashes($in));
	$out = str_replace(array('/','\\'), '', $out);
	return $out;
}



function footer()
{
	global $conn;
	global $database_table_prefix;
	date_default_timezone_set( 'Europe/Paris');

	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name = 'config_footer_analytics_code' AND type = 'global' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$config_footer_analytics_code = $row['value'];
	return addslashes($config_footer_analytics_code);
}



function getActiveContentStatusID()
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."content_status WHERE status = 'active' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$activeContentStatusID = $row['id'];
	return $activeContentStatusID;
}


function getPendingContentStatusID()
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."content_status WHERE status = 'pending' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$pendingContentStatusID = $row['id'];
	return $pendingContentStatusID;
}


function getDraftContentStatusID()
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."content_status WHERE status = 'draft' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$draftContentStatusID = $row['id'];
	return $draftContentStatusID;
}



function getSuperadminRoleId (){
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."users_roles WHERE role LIKE 'super_admin' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$super_admin_role_id = $row['id'];
	return (int)$super_admin_role_id;
}

function getUserRoleId (){
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."users_roles WHERE role LIKE 'user' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$user_role_id = $row['id'];
	return (int)$user_role_id;
}



function getParentCategIDFromCategID($categ_id)
{
	global $conn;
	global $database_table_prefix;

	$sql = "SELECT parent_id FROM ".$database_table_prefix."categories WHERE id = '$categ_id'";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$parent_id = $row['parent_id'];

	return $parent_id;
}


function getRootCategIDFromCategID($categ_id, $root_id=0)
{
	global $conn;
	global $database_table_prefix;
	$item_list = array();

	$sql = "SELECT id, parent_id FROM ".$database_table_prefix."categories";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	while ($row = $rs->fetch_assoc())
	{
		$id = $row['id'];
		$parent_id = $row['parent_id'];
		$item_list[$id] = $parent_id;
	}

	$current_category = $categ_id;

	while(TRUE) {
		if ($item_list[$current_category] == $root_id) {
			return $current_category;
		} else {
			$current_category = $item_list[$current_category];
		}
	}

}

/*
function getRootCategIDFromCategID ($categ_id){
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT root_categ_id FROM ".$database_table_prefix."categories WHERE id = '$categ_id' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$root_categ_id = $row['root_categ_id'];
	return (int)$root_categ_id;
}
*/

function get_child_categ($parent, $level = 1) {
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id, parent_id, title FROM ".$database_table_prefix."categories WHERE parent_id = '$parent' ORDER BY title DESC";
	$rs = $conn->query($sql);
	if($rs->num_rows > 0) {
		#start the list
		//echo '<ul>';
		while ($row = $rs->fetch_assoc())
		{
			$id = $row['id'];
			$parent_id = $row['parent_id'];
			$title = stripslashes($row['title']);
			?>
			<option value="<?php echo $id;?>"> <?php for ($i=0; $i<$level; $i++) echo "---";?> <?php echo $title;?></option>
			<?php
			#this function calls it self, so its recursive
			get_child_categ($id, $level+1);
		}
		#close the list
		//echo '</ul>';
	}
}

function get_child_categ_edit($parent, $categ_id_edited, $level = 1) {
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id, parent_id, title FROM ".$database_table_prefix."categories WHERE parent_id = '$parent' ORDER BY title DESC";
	$rs = $conn->query($sql);
	if($rs->num_rows > 0) {
		#start the list
		//echo '<ul>';
		while ($row =$rs->fetch_assoc())
		{
			$id = $row['id'];
			?>
			<option <?php if ($id == $categ_id_edited) echo 'selected="selected"';?> value="<?php echo $row['id'];?>"> <?php for ($i=0; $i<$level; $i++) echo "---";?> <?php echo stripslashes($row['title']);?></option>
			<?php
			#this function calls it self, so its recursive
			get_child_categ($row['id'], $categ_id_edited, $level+1);
		}
		#close the list
		//echo '</ul>';
	}
}


function display_child_nodes($parent_id, $parent_id_edited, $level)
{
	global $data, $index;
	$parent_id = $parent_id == 0 ? 0 : $parent_id;
	if (isset($index[$parent_id])) {
		foreach ($index[$parent_id] as $id) {
			?>
			<option <?php if ($id == $parent_id_edited) echo 'selected="selected"';?>  value="<?php echo $id;?>"> <?php echo str_repeat("----", $level);?> <?php echo $data[$id]["title"];?></option>
			<?php
			display_child_nodes($id, $parent_id_edited, $level + 1);
		}
	}
}

function get_child_categ_admin_details($parent, $level = 1) {
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id, parent_id, title, position, image_type, image FROM ".$database_table_prefix."categories WHERE parent_id = '$parent' ORDER BY position DESC";
	$rs = $conn->query($sql);
	if($rs->num_rows > 0) {
		while ($row =$rs->fetch_assoc())
		{
			$image_type = $row['image_type'];
			$image = $row['image'];
			?>
			<?php for ($i=0; $i<$level; $i++) echo "---";?> <?php echo stripslashes($row['title']);?> <small>(#<?php echo $row['position'];?> | ID: <?php echo $row['id'];?>)</small> <a href="account.php?page=categ_edit&id=<?php echo $row['id'];?>"><i class="fa fa-edit fa-fw"></i>Edit</a>
			<a href="javascript:deleteRecord_<?php echo $row['id'];?>('<?php echo $row['id'];?>');"><i class="fa fa-trash-o fa-fw"></i>Delete</a>
			<script language="javascript" type="text/javascript">
				function deleteRecord_<?php echo $row['id'];?>(RecordId)
				{
					if (confirm('Confirm delete')) {
						window.location.href = 'categ_delete.php?id=<?php echo $row['id'];?>';
					}
				}
			</script>
			<?php if ($image_type=="upload") { ?> <img style="max-height:20px; max-width:50px; height:auto; width:auto; margin-left:10px;" src="../content/media/img/<?php echo $image;?>" /> <?php } else echo html_entity_decode($image);?>
			<div class="clear"></div>
			<?php
			#function calls it self (recursive)
			get_child_categ_admin_details($row['id'], $level+1);
			echo '<div class="clear"></div>';
		}
	}
}

function display_status_box($status_id)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT status, button_value FROM ".$database_table_prefix."content_status WHERE id = '$status_id' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$status = stripslashes($row['status']);
	$button_value = stripslashes($row['button_value']);
	$class = "default"; $text = $button_value;
	if($status=='active') { $class = "active"; $text = "Active"; }
	if($status=='draft') { $class = "draft"; $text = "Draft"; }
	if($status=='pending') { $class = "pending"; $text = "Pending review"; }
	echo '<span class="status_box_'.$class.'">'.$text.'</span>';
}


function createPath_plain($categ_id) {
	global $conn;
	global $database_table_prefix;

	$q = "SELECT id, title, parent_id FROM ".$database_table_prefix."categories WHERE id = '$categ_id'";
	$rs_b = $conn->query($q);
	$row = $rs_b->fetch_assoc();

	if($row['parent_id'] == 0) {
		return $row['title'];
	} else {
		return createPath_plain($row['parent_id']).' &#187; '.$row['title'];
	}
}


function createSubcategories_string($categ_id) {
	global $conn;
	global $database_table_prefix;

	$subcategs_array = array();
	array_push($subcategs_array, $categ_id);
	$q = "SELECT id, parent_id FROM ".$database_table_prefix."categories WHERE parent_id = '$categ_id'";
	$rs_b = $conn->query($q);
	while ($row = $rs_b->fetch_assoc())
	{
		$categ_id = $row['id'];
		$parent_id = $row['parent_id'];
		array_push($subcategs_array, $categ_id);
	}
	$str = implode (", ", $subcategs_array);
	return $str;

}



//Remove an item from a comma-separated string (remove a cated ID from a list of categories)
function removeFromString($str, $item) {
	$parts = explode(',', $str);

	while(($i = array_search($item, $parts)) !== false) {
		unset($parts[$i]);
	}

	return implode(',', $parts);
}


function checkIfValueInList($value, $list) {
	$list_items = explode(',',$list);
	if (in_array($value, $list_items)) {
		return 1;
	} else {
		return 0;
	}
}

function getUrls($text) {
	preg_match_all(
		"#([\"']?)("
		. "(?:([\w-]+:)?//?)"
		. "[^\s()<>]+"
		. "[.]"
		. "(?:"
		. "\([\w\d]+\)|"
		. "(?:"
		. "[^`!()\[\]{};:'\".,<>«»“”‘’\s]|"
		. "(?:[:]\d+)?/?"
		. ")+"
		. ")"
		. ")\\1#",
		$text,
		$all_links
	);
	$all_links = array_unique(array_map('html_entity_decode', $all_links[2]));
	return array_values($all_links);
}




function getContentComments($content_id, $approved) // $approved: 1 (active comments), 0 (pending comments)
{
	global $conn;
	global $database_table_prefix;

	$sql = "SELECT COUNT(id) AS numb FROM ".$database_table_prefix."comments WHERE approved = '$approved' AND content_id = '$content_id'";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$numb_comments = $row['numb'];
	return $numb_comments;
}



// *******************************************************************************
// DATE and TIME functions
// *******************************************************************************

function Now()
{
	$now = date("Y-m-d H:i:s");
	return $now;
}

function DateFormat_form($date)
{
	$date = new DateTime($date);
	return $date->format('m/d/Y');
}


function DateFormat($date)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name = 'config_date_format' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$date_format = $row['value'];
	if($date_format=="") $date_format = "d M Y";

	if($date=='0000-00-00')
		return "-";
	else
	{
		date_default_timezone_set('Europe/London');
		$datetime = date_create($date);
		return $datetime->format($date_format);
	}
}


function DateTimeFormat($date)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name = 'config_date_format' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$date_format = $row['value'];
	if($date_format=="") $date_format = "d M Y";


	if($date=='0000-00-00 00:00:00')
		return "-";
	else
	{
		date_default_timezone_set('Europe/London');
		$datetime = date_create($date);
		return $datetime->format($date_format.', H:i');
	}
}


function TimeFormat($date)
{
	date_default_timezone_set('Europe/London');
	$datetime = date_create($date);
	return $datetime->format('H:i');
}


function xDaysAgo($days)
{
	return date("Y-m-d", strtotime("-$days day"));
}


//=========================================================================================
//PASSWORD FUNCTIONS
//=========================================================================================

function generateSaltPassword () {
	return base64_encode(random_bytes(12));
}


function generateHashPassword ($password, $salt) {
	$string = $salt.$password;
	$hash = hash('sha1', $string);
	return $hash;
}

function checkPassword ($email, $password) {
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT salt, password FROM ".$database_table_prefix."users WHERE email = '$email' AND email != '' LIMIT 1";
	$rs = $conn->query($sql);
	$exist = $rs->num_rows;
	if($exist==1)
	{
		while($row = $rs->fetch_assoc())
		{
			$db_salt = $row['salt'];
			$db_password = $row['password'];
		}
		$string = $db_salt.$password;
		$hash = hash('sha1', $string);
		if($hash == $db_password) return true;
		else return false;
	}
	else
		return false;
}




//=========================================================================================
//DATABASE FUNCTIONS
//=========================================================================================

function addSettings ($name, $value, $type, $protected)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."settings WHERE name = '$name' LIMIT 1";
	$rs = $conn->query($sql);
	if($conn->query($sql) === false) {
		trigger_error('Error: '.$conn->error, E_USER_ERROR);
	}

	$exist = $rs->num_rows;
	if($exist==0)
	{
		// insert
		$query = "INSERT INTO ".$database_table_prefix."settings (id, name, value, type, protected) VALUES (NULL, '$name', '$value', '$type', '$protected')";
		$rs = $conn->query($query);
		$last_inserted_id = $conn->insert_id;
		$affected_rows = $conn->affected_rows;
	}
	else
	{
		// update
		$query = "UPDATE ".$database_table_prefix."settings SET value = '$value' WHERE name = '$name' LIMIT 1";
		$rs = $conn->query($query);
		$affected_rows = $conn->affected_rows;
	}
}



function addSettingsNotUnique ($name, $value, $type, $protected)
{
	global $conn;
	global $database_table_prefix;

	// insert
	$query = "INSERT INTO ".$database_table_prefix."settings (id, name, value, type, protected) VALUES (NULL, '$name', '$value', '$type', '$protected')";
	$rs = $conn->query($query);
	$last_inserted_id = $conn->insert_id;
	$affected_rows = $conn->affected_rows;
}


function addCategExtraUnique ($categ_id, $name, $value)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."categories_extra WHERE name = '$name' AND categ_id = '$categ_id' LIMIT 1";
	$rs = $conn->query($sql);
	if($conn->query($sql) === false) {
		trigger_error('Error: '.$conn->error, E_USER_ERROR);
	}

	$exist = $rs->num_rows;
	if($value!="")
	{
		if($exist==0)
		{
			// insert
			$query = "INSERT INTO ".$database_table_prefix."categories_extra (id, categ_id, name, value) VALUES (NULL, '$categ_id', '$name', '$value')";
			$rs = $conn->query($query);
			$last_inserted_id = $conn->insert_id;
			$affected_rows = $conn->affected_rows;
		}
		else
		{
			// update
			$query = "UPDATE ".$database_table_prefix."categories_extra SET value = '$value' WHERE name = '$name' AND categ_id = '$categ_id' LIMIT 1";
			$rs = $conn->query($query);
			$affected_rows = $conn->affected_rows;
		}
	}
}



function addContentExtraUnique ($content_id, $name, $value)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."content_extra WHERE name = '$name' AND content_id = '$content_id' LIMIT 1";
	$rs = $conn->query($sql);
	if($conn->query($sql) === false) {
		trigger_error('Error: '.$conn->error, E_USER_ERROR);
	}
	$exist = $rs->num_rows;
	if($exist==0)
	{
		$query = "INSERT INTO ".$database_table_prefix."content_extra (id, content_id, name, value) VALUES (NULL, '$content_id', '$name', '$value')";
		if($conn->query($query) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR); }
		else { $last_inserted_id = $conn->insert_id; $affected_rows = $conn->affected_rows;	}
	}
	else
	{
		$query = "UPDATE ".$database_table_prefix."content_extra SET value = '$value' WHERE name = '$name' AND content_id = '$content_id' LIMIT 1";
		$rs = $conn->query($query);
		$affected_rows = $conn->affected_rows;
	}
}



function addCommentExtraUnique ($comment_id, $content_id, $name, $value)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."comments_extra WHERE name = '$name' AND comment_id = '$comment_id' LIMIT 1";
	$rs = $conn->query($sql);
	if($conn->query($sql) === false) {
		trigger_error('Error: '.$conn->error, E_USER_ERROR);
	}
	$exist = $rs->num_rows;
	if($value!="")
	{
		if($exist==0)
		{
			$query = "INSERT INTO ".$database_table_prefix."comments_extra (id, comment_id, content_id, name, value) VALUES (NULL, '$comment_id', '$content_id', '$name', '$value')";
			if($conn->query($query) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR); }
			else { $last_inserted_id = $conn->insert_id; $affected_rows = $conn->affected_rows;	}
		}
		else
		{
			$query = "UPDATE ".$database_table_prefix."comments_extra SET value = '$value' WHERE name = '$name' AND comment_id = '$comment_id' LIMIT 1";
			$rs = $conn->query($query);
			$affected_rows = $conn->affected_rows;
		}
	}
}



function addUsersExtraUnique ($user_id, $name, $value)
{
	global $conn;
	global $database_table_prefix;
	$sql = "SELECT id FROM ".$database_table_prefix."users_extra WHERE name = '$name' AND user_id = '$user_id' LIMIT 1";
	$rs = $conn->query($sql);
	if($conn->query($sql) === false) {
		trigger_error('Error: '.$conn->error, E_USER_ERROR);
	}
	$exist = $rs->num_rows;
	if($value!="")
	{
		if($exist==0)
		{
			$query = "INSERT INTO ".$database_table_prefix."users_extra (id, user_id, name, value) VALUES (NULL, '$user_id', '$name', '$value')";
			$rs = $conn->query($query);
			$last_inserted_id = $conn->insert_id;
			$affected_rows = $conn->affected_rows;
		}
		else
		{
			$query = "UPDATE ".$database_table_prefix."users_extra SET value = '$value' WHERE name = '$name' AND user_id = '$user_id' LIMIT 1";
			$rs = $conn->query($query);
			$affected_rows = $conn->affected_rows;
		}
	}
}


function addTags ($content_id, $tags)
{
	global $conn;
	global $database_table_prefix;

	// delete all content tags
	$sql = "DELETE FROM ".$database_table_prefix."tags WHERE content_id = '$content_id'";
	$rs = $conn->query($sql);

	// insert new tags
	$tags = explode(",", $tags);
	for ($i = 0; $i < count($tags); ++$i)
	{
		$tag = trim($tags[$i]);
		$tag = addslashes($tag);
		$tag_permalink = RewriteUrl($tag);

		$query = "INSERT INTO ".$database_table_prefix."tags (id, content_id, tag, permalink) VALUES (NULL, '$content_id', '$tag', '$tag_permalink')";
		if($conn->query($query) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR); }
		else { $last_inserted_id = $conn->insert_id; $affected_rows = $conn->affected_rows;	}
	} // end for
}


function returnPrice ($price){
	global $conn;
	global $database_table_prefix;

	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name LIKE 'config_currency_symbol' AND type LIKE 'global' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$config_currency_symbol = $row['value'];

	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name LIKE 'config_currency_name' AND type LIKE 'global' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$config_currency_name = stripslashes($row['value']);

	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name LIKE 'config_currency_display_style' AND type LIKE 'global' LIMIT 1";
	$rs = $conn->query($sql);
	if($rs === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs->fetch_assoc();
	$config_currency_display_style = $row['value'];

	switch ($config_currency_display_style)
	{
		case "name_value":
			return $config_currency_name." ".$price;
			break;

		case "value_name":
			return $price." ".$config_currency_name;
			break;

		case "symbol_value":
			return $config_currency_symbol." ".$price;
			break;

		case "value_symbol":
			return $price." ".$config_currency_symbol;
			break;

		default:
			return $price." ".$config_currency_name;
			break;
	}
}



function getUserDetailsArray($user_id)
{
	global $conn;
	global $database_table_prefix;
	$UserDetailsArray = array();

	$sql_db = "SELECT email, name, avatar, role_id, active FROM ".$database_table_prefix."users WHERE id = '$user_id' LIMIT 1";
	$rs_db = $conn->query($sql_db);
	if($conn->query($sql_db) === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs_db->fetch_assoc();

	$user_email = $row['email'];
	$user_name = stripslashes($row['name']);
	$user_avatar = $row['avatar'];
	$user_role_id = $row['role_id'];
	$user_is_active = $row['active'];
	if(!$user_avatar) $user_avatar = "no_avatar.png";

	$query_user_role = "SELECT role, title FROM ".$database_table_prefix."users_roles WHERE id = '$user_role_id' LIMIT 1";
	$rs_user_role = $conn->query($query_user_role);
	$row = $rs_user_role->fetch_assoc();
	$user_role = stripslashes($row['role']);
	$user_role_title = stripslashes($row['title']);

	$UserDetailsArray = array("email" => $user_email, "name" => $user_name, "avatar" => $user_avatar, "role_id" => $user_role_id, "role" => $user_role, "role_title" => $user_role_title, "is_active" => $user_is_active);

	return $UserDetailsArray;
}


function getCategDetailsArray($categ_id)
{
	global $conn;
	global $database_table_prefix;
	$CategDetailsArray = array();

	$sql_db = "SELECT title, permalink FROM ".$database_table_prefix."categories WHERE id = '$categ_id' LIMIT 1";
	$rs_db = $conn->query($sql_db);
	if($conn->query($sql_db) === false) {trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	$row = $rs_db->fetch_assoc();

	$categ_title = stripslashes($row['title']);
	$categ_permalink = stripslashes($row['permalink']);

	$CategDetailsArray = array("title" => $categ_title, "permalink" => $categ_permalink);

	return $CategDetailsArray;
}



function generateSitemap ()
{
	global $conn;
	global $database_table_prefix;
	$activeContentStatusID = getActiveContentStatusID();

	$sql = "SELECT value FROM ".$database_table_prefix."settings WHERE name = 'config_site_url' AND type = 'global' LIMIT 1";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$site_url = $row['value'];


	$file_xml = "../sitemap.xml";
	$fp = fopen($file_xml,'w');

	$data_header = '<?xml version="1.0" encoding="UTF-8"?> <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	fwrite($fp,$data_header);


	// First page
	$data = "
			<url>
				<loc>".$site_url."</loc>
				<changefreq>daily</changefreq>
				<priority>1</priority>
			</url>
							
			";
	fwrite($fp,$data);

	// root categories
	$sql = "SELECT id, permalink FROM ".$database_table_prefix."categories WHERE active = '1' AND parent_id = '0' ORDER BY id DESC";
	$rs = $conn->query($sql);
	while ($row = $rs->fetch_assoc())
	{
		$id = $row['id'];
		$permalink = $row['permalink'];

		$url = $site_url."/".$permalink."/";
		$data = "
				<url>
					<loc>".$url."</loc>
					<changefreq>daily</changefreq>
					<priority>0.6</priority>
				</url>
								
				";
		fwrite($fp,$data);

		// subcategories
		$sql_subcateg = "SELECT id, permalink FROM ".$database_table_prefix."categories WHERE active = '1' AND parent_id = '$id' ORDER BY id DESC";
		$rs_subcateg = $conn->query($sql_subcateg);
		while ($row = $rs_subcateg->fetch_assoc())
		{
			$id_subcateg = $row['id'];
			$permalink_subcateg = $row['permalink'];

			$url_subcateg = $site_url."/".$permalink."/".$permalink_subcateg."/";
			$data_subcateg = "
				<url>
					<loc>".$url_subcateg."</loc>
					<changefreq>daily</changefreq>
					<priority>0.6</priority>
				</url>	
											
				";
			fwrite($fp,$data_subcateg);
		}

	}


	// content items
	$sql = "SELECT id, categ_id, permalink FROM ".$database_table_prefix."content WHERE status_id = '$activeContentStatusID' ORDER BY id DESC";
	$rs = $conn->query($sql);
	while ($row = $rs->fetch_assoc())
	{
		$id = $row['id'];
		$categ_id = $row['categ_id'];
		$permalink = $row['permalink'];

		$sql_categ = "SELECT permalink FROM ".$database_table_prefix."categories WHERE id = '$categ_id' LIMIT 1";
		$rs_categ = $conn->query($sql_categ);
		$row = $rs_categ->fetch_assoc();
		$categ_permalink = $row['permalink'];

		$url = $site_url."/".$categ_permalink."/".$permalink."-".$id.".html";
		$url_prices = $site_url."/".$categ_permalink."/".$permalink."-".$id."-prices.html";
		$url_media = $site_url."/".$categ_permalink."/".$permalink."-".$id."-media.html";
		$url_opinions = $site_url."/".$categ_permalink."/".$permalink."-".$id."-opinions.html";

		$data = "
				<url>
					<loc>".$url."</loc>
					<changefreq>weekly</changefreq>
					<priority>0.6</priority>
				</url>
						
				<url>
					<loc>".$url_prices."</loc>
					<changefreq>monthly</changefreq>
					<priority>0.8</priority>
				</url>
				
				<url>
					<loc>".$url_media."</loc>
					<changefreq>monthly</changefreq>
					<priority>0.8</priority>
				</url>
				
				<url>
					<loc>".$url_opinions."</loc>
					<changefreq>monthly</changefreq>
					<priority>0.8</priority>
				</url>
				";
		fwrite($fp,$data);
	}


	$data_footer = '</urlset>';
	fwrite($fp,$data_footer);
	fclose ($fp);

}



//**************************************************************************************************
// Return Star Rating value
function returnStarRatingValue($content_id)
{
	global $conn;
	global $database_table_prefix;

	$query = "SELECT COUNT(id) AS numb_ratings, SUM(value) AS total_rating FROM ".$database_table_prefix."content_extra WHERE name = 'star_rating' AND content_id = '$content_id'";
	$rs = $conn->query($query);
	$row = $rs->fetch_assoc();
	$numb_ratings = $row['numb_ratings'];
	$total_rating = $row['total_rating'];

	if($numb_ratings!=0)
	{
		$rating_value = $total_rating / $numb_ratings;
		return round($rating_value, 2);
	}
	else
	{
		$rating_value = "";
		return "";
	}
}


//**************************************************************************************************
// Return number of star ratings
function returnNumberStarRatings($content_id)
{
	global $conn;
	global $database_table_prefix;

	$query = "SELECT id FROM ".$database_table_prefix."content_extra WHERE name = 'star_rating' AND content_id = '$content_id'";
	$rs = $conn->query($query);
	$number = $rs->num_rows;
	return (int)$number;
}


//**************************************************************************************************
// Update content rating
function updateContentRating($content_id)
{
	global $conn;
	global $database_table_prefix;

	$value = returnStarRatingValue($content_id);
	$ratings = returnNumberStarRatings($content_id);

	$query = "UPDATE ".$database_table_prefix."content SET rating_value = '$value', rating_ratings = '$ratings' WHERE id = '$content_id' LIMIT 1";
	$rs = $conn->query($query);
	$affected_rows = $conn->affected_rows;
}



//**************************************************************************************************
// Update release date (for mobiles)
function updateReleaseDate($content_id)
{
	global $conn;
	global $database_table_prefix;

	$group_id = 5;
	$cf_id = 8;

	$announced = "";
	$year = "0000";
	$default_month = "06";
	$month = "";

	$query2 = "SELECT value FROM ".$database_table_prefix."cf_values WHERE group_id = '$group_id' AND cf_id = '$cf_id' AND content_id = '$content_id' ORDER BY id DESC LIMIT 1";
	$rs2 = $conn->query($query2);
	$row = $rs2->fetch_assoc();
	$announced = $row['value'];

	// grab last number (year) from string
	if (preg_match_all('/\b\d{4}\b/', $announced, $matches))
		$year = end($matches[0]);

	// grab month

	if (preg_match_all('/January/', $announced, $matches))
		$month = "01";
	if (preg_match_all('/February/', $announced, $matches))
		$month = "02";
	if (preg_match_all('/March/', $announced, $matches))
		$month = "03";
	if (preg_match_all('/April/', $announced, $matches))
		$month = "04";
	if (preg_match_all('/May/', $announced, $matches))
		$month = "05";
	if (preg_match_all('/June/', $announced, $matches))
		$month = "06";
	if (preg_match_all('/July/', $announced, $matches))
		$month = "07";
	if (preg_match_all('/August/', $announced, $matches))
		$month = "08";
	if (preg_match_all('/September/', $announced, $matches))
		$month = "09";
	if (preg_match_all('/October/', $announced, $matches))
		$month = "10";
	if (preg_match_all('/November/', $announced, $matches))
		$month = "11";
	if (preg_match_all('/December/', $announced, $matches))
		$month = "12";

	if (preg_match_all('/Q1/', $announced, $matches) or preg_match_all('/1Q/', $announced, $matches)) // 01 02 03
		$month = "02";
	if (preg_match_all('/Q2/', $announced, $matches) or preg_match_all('/2Q/', $announced, $matches)) // 04 05 06
		$month = "05";
	if (preg_match_all('/Q3/', $announced, $matches) or preg_match_all('/3Q/', $announced, $matches)) // 07 08 09
		$month = "08";
	if (preg_match_all('/Q4/', $announced, $matches) or preg_match_all('/4Q/', $announced, $matches)) // 10 11 12
		$month = "11";

	if($month=="") $month = $default_month;
	$release_date = $year."-".$month."-01";

	if($year!="0000")
	{
		$query_update = "UPDATE ".$database_table_prefix."content SET mobile_release_date = '$release_date' WHERE id = '$content_id' LIMIT 1";
		if($conn->query($query_update) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR);}
		else {  $last_inserted_id = $conn->insert_id;  $affected_rows = $conn->affected_rows; }
	}
}



//**************************************************************************************************
// Update search terms
function updateSearchTerms($content_id)
{
	global $conn;
	global $database_table_prefix;

	$query = "SELECT title, categ_id FROM ".$database_table_prefix."content WHERE id = '$content_id' LIMIT 1";
	$rs = $conn->query($query);
	$row = $rs->fetch_assoc();
	$title = Secure($row['title']);
	$categ_id = $row['categ_id'];

	$query2 = "SELECT title FROM ".$database_table_prefix."categories WHERE id = '$categ_id' LIMIT 1";
	$rs2 = $conn->query($query2);
	$row = $rs2->fetch_assoc();
	$categ_title = Secure($row['title']);

	$search_terms = $categ_title." ".$title;

	$query_update = "UPDATE ".$database_table_prefix."content SET search_terms = '$search_terms' WHERE id = '$content_id' LIMIT 1";
	if($conn->query($query_update) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	else {  $last_inserted_id = $conn->insert_id;  $affected_rows = $conn->affected_rows; }
}



//**************************************************************************************************
// Update specs array
function updateSpecsArray($content_id)
{
	global $conn;
	global $database_table_prefix;
	global $mobiles_categ_id;
	global $mobiles_cf_group_id;

	/*
	$sql = "SET NAMES 'utf8'";
	$conn->query($sql);

	$sql = "SET CHARACTER 'utf8'";
	$conn->query($sql);
	*/

	$specs_array = array();

	$query = "SELECT id, title FROM ".$database_table_prefix."cf_sections WHERE group_id = '$mobiles_cf_group_id' AND active = 1 ORDER BY position DESC";
	$rs = $conn->query($query);
	while ($row = $rs->fetch_assoc())
	{
		$section_id = $row['id'];
		$section_title = stripslashes($row['title']);

		$query_cf = "SELECT id, title, type, show_in_specs FROM ".$database_table_prefix."cf WHERE group_id = '$mobiles_cf_group_id' AND section_id = '$section_id' AND active = 1 ORDER BY position DESC";
		$rs_cf = $conn->query($query_cf);
		while ($row = $rs_cf->fetch_assoc())
		{
			$cf_id = $row['id'];
			$cf_title = stripslashes($row['title']);
			$cf_type = $row['type'];
			$cf_show_in_specs = $row['show_in_specs'];

			$query_cf_values = "SELECT value, extra FROM ".$database_table_prefix."cf_values WHERE content_id = '$content_id' AND cf_id = '$cf_id' AND group_id = '$mobiles_cf_group_id' ORDER BY id DESC LIMIT 1";
			$rs_cf_values = $conn->query($query_cf_values);
			$row = $rs_cf_values->fetch_assoc();

			$edited_cf_value = Secure($row['value']);
			$edited_cf_extra = Secure($row['extra']);

			if($cf_type == "defined")
			{
				$query_cf_defined = "SELECT title FROM ".$database_table_prefix."cf_defined WHERE id = '$edited_cf_value' LIMIT 1";
				$rs_cf_defined = $conn->query($query_cf_defined);
				$row_defined = $rs_cf_defined->fetch_assoc();
				$edited_cf_value = $row_defined['title'];
			}

			if($cf_show_in_specs==0) $cf_value = ""; else $cf_value = $edited_cf_value." ";
			if($edited_cf_extra) $cf_text = $edited_cf_value.$edited_cf_extra; else $cf_text = $edited_cf_value;
			$cf_text = trim($cf_text);
			if($cf_text!="")
				$specs_array[$section_title][$cf_title] = $cf_text;
		}
	}

	$cf_array = serialize($specs_array);

	$query_update = "UPDATE ".$database_table_prefix."content SET cf_array = '$cf_array' WHERE id = '$content_id' LIMIT 1";
	if($conn->query($query_update) === false) { trigger_error('Error: '.$conn->error, E_USER_ERROR);}
	else {  $last_inserted_id = $conn->insert_id;  $affected_rows = $conn->affected_rows; }

}




//**************************************************************************************************
// Check permission for authors:
// - CHECK IF CONTENT IS OWN CONTENT
// - AUTHORS CAN NOT EDIT DELETE CONTENT IF IT IS ACTIVE
function authorPermissionOK($content_id, $logged_user_id)
{
	global $conn;
	global $database_table_prefix;
	$permision_ok = 1;

	$query = "SELECT role_id FROM ".$database_table_prefix."users WHERE id = '$logged_user_id' LIMIT 1";
	$rs = $conn->query($query);
	$row = $rs->fetch_assoc();
	$user_role_id = $row['role_id'];

	$query = "SELECT role FROM ".$database_table_prefix."users_roles WHERE id = '$user_role_id' LIMIT 1";
	$rs = $conn->query($query);
	$row = $rs->fetch_assoc();
	$user_role = $row['role'];

	if($user_role=="author")
	{
		// CHECK PERMISSION (OWN CONTENT)
		$query = "SELECT id FROM ".$database_table_prefix."content WHERE id = '$content_id' AND user_id = '$logged_user_id' LIMIT 1";
		$rs = $conn->query($query);
		$rows = $rs->num_rows;
		if($rows==0) $permision_ok = 0;

		// AUTHORS CAN NOT EDIT / DELETE CONTENT IF IT IS ACTIVE
		$status_id_active = getActiveContentStatusID();
		$query = "SELECT status_id FROM ".$database_table_prefix."content WHERE id = '$content_id' AND user_id = '$logged_user_id' LIMIT 1";
		$rs = $conn->query($query);
		$row = $rs->fetch_assoc();
		$status_id_db = $row['status_id'];
		if($status_id_db==$status_id_active) $permision_ok = 0;
	}

	return $permision_ok;
}



function MobileSpecsSummary($content_id)
{
	global $conn;
	global $database_table_prefix;
	global $mobiles_cf_group_id;

	$specs_summary_array = array();

	$cf_section_id_Launch = 1;
	$cf_section_id_Display = 5;
	$cf_section_id_Platform = 6;
	$cf_section_id_Memory = 7;
	$cf_section_id_Camera = 8;
	$cf_section_id_Battery = 14;

	$cf_id_Status = 9;
	$cf_id_Size = 19;
	$cf_id_OS = 23;
	$cf_id_CPU = 25;
	$cf_id_Internal = 29;
	$cf_id_Primary = 30;
	$cf_id_Battery = 52;

	$query_specs = "SELECT cf_array FROM ".$database_table_prefix."content WHERE id = '$content_id' LIMIT 1";
	$rs_specs = $conn->query($query_specs);
	$row = $rs_specs->fetch_assoc();
	$specs_array = unserialize($row['cf_array']);

	$query_sections = "SELECT id, title FROM ".$database_table_prefix."cf_sections WHERE group_id = '$mobiles_cf_group_id' AND active = 1";
	$rs_sections = $conn->query($query_sections);
	while ($row = $rs_sections->fetch_assoc())
	{
		$cf_section_id = $row['id'];
		$cf_section_title = stripslashes($row['title']);

		if($cf_section_id == $cf_section_id_Launch) $cf_section_title_Launch = $cf_section_title;
		if($cf_section_id == $cf_section_id_Display) $cf_section_title_Display = $cf_section_title;
		if($cf_section_id == $cf_section_id_Platform) $cf_section_title_Platform = $cf_section_title;
		if($cf_section_id == $cf_section_id_Memory) $cf_section_title_Memory = $cf_section_title;
		if($cf_section_id == $cf_section_id_Camera) $cf_section_title_Camera = $cf_section_title;
		if($cf_section_id == $cf_section_id_Battery) $cf_section_title_Battery = $cf_section_title;

		$query_cf = "SELECT id, title FROM ".$database_table_prefix."cf WHERE group_id = '$mobiles_cf_group_id' AND section_id = '$cf_section_id' AND active = 1";
		$rs_cf = $conn->query($query_cf);
		while ($row = $rs_cf->fetch_assoc())
		{
			$cf_id = $row['id'];
			$cf_title = stripslashes($row['title']);

			if($cf_id == $cf_id_Status) $cf_title_Status = $cf_title;
			if($cf_id == $cf_id_Size) $cf_title_Size = $cf_title;
			if($cf_id == $cf_id_OS) $cf_title_OS = $cf_title;
			if($cf_id == $cf_id_CPU) $cf_title_CPU = $cf_title;
			if($cf_id == $cf_id_Internal) $cf_title_Internal = $cf_title;
			if($cf_id == $cf_id_Primary) $cf_title_Primary = $cf_title;
			if($cf_id == $cf_id_Battery) $cf_title_Battery = $cf_title;
		}
	}

	//print_r($specs_array);
	//echo "<br>".$cf_section_title_Launch." ".$cf_title_Status;
	//echo "<br>".$cf_section_title_Display." ".$cf_title_Size;
	//echo "<br>".$specs_array["$cf_section_id_Display"]["$cf_title_Size"];

	$specs_summary_array['status'] = $specs_array["$cf_section_title_Launch"]["$cf_title_Status"];
	$specs_summary_array['display'] = $specs_array["$cf_section_title_Display"]["$cf_title_Size"];
	$specs_summary_array['os'] = $specs_array["$cf_section_title_Platform"]["$cf_title_OS"];
	$specs_summary_array['cpu'] = $specs_array["$cf_section_title_Platform"]["$cf_title_CPU"];
	$specs_summary_array['memory'] = $specs_array["$cf_section_title_Memory"]["$cf_title_Internal"];
	$specs_summary_array['camera'] = $specs_array["$cf_section_title_Camera"]["$cf_title_Primary"];
	$specs_summary_array['battery'] = $specs_array["$cf_section_title_Battery"]["$cf_title_Battery"];

	return $specs_summary_array;

}
