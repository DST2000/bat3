<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
if($searchCustomValues) 
	{
			echo ($searchCustomValues);
	}
if (!empty($_REQUEST['virtuemart_category_id'])) 
	{
		$virtuemart_category_id = $_REQUEST['virtuemart_category_id'];
	}
else
	{
		$virtuemart_category_id = "category_not_set";
	}
echo "<p class='virtuemart_category_id'>".$virtuemart_category_id."</p>";

?>