<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
if($searchCustomValues) {
			echo ($searchCustomValues);
		}
$virtuemart_category_id = $_REQUEST['virtuemart_category_id'];
echo "<p class='virtuemart_category_id'>".$virtuemart_category_id."</p>";

?>