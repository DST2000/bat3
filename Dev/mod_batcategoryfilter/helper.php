<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// Load the view framework
if(!class_exists('VmView'))require(VMPATH_SITE.DS.'helpers'.DS.'vmview.php');


class modBatCategoryFilterHelper extends VmView
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getCategoryList($categorylist)
    {
		$categorylist = "";
		$searchCustomValues = "";
		$db =JFactory::getDBO();
		if (!empty($_REQUEST['virtuemart_category_id'])) 
		{
			$virtuemart_category_id = $_REQUEST['virtuemart_category_id'];
		}
		else
		{
			$virtuemart_category_id = null;
		}

		
		if (isset($virtuemart_category_id)) 
		{
		
		
			$q1= 'SELECT c.* FROM #__virtuemart_customs  as c ';
			if(!empty($virtuemart_category_id)){
				$q1 .= 'INNER JOIN #__virtuemart_product_customfields as pc on (c.virtuemart_custom_id=pc.virtuemart_custom_id)
	INNER JOIN #__virtuemart_product_categories as cat ON (pc.virtuemart_product_id=cat.virtuemart_product_id)';
			}
			$q1 .= ' WHERE';
			if(!empty($virtuemart_category_id)){
				$q1 .= ' virtuemart_category_id="'.$virtuemart_category_id.'" and';
			}
			$q1 .= ' searchable="1" and (field_type="S" or field_type="P") and c.published = 1 GROUP BY c.virtuemart_custom_id';

			$db->setQuery($q1);
			$selectedlist = $db->loadObjectList();
			//vmdebug('getSearchCustom '.str_replace('#__',$db->getPrefix(),$db->getQuery()),$selectedlist);//,$virtuemart_category_id,$selectedlist);
			if($selectedlist) {
				$app = JFactory::getApplication();
				foreach ($selectedlist as $selected) {
					$valueOptions = array();
					if($selected->field_type=="S") {

						//if($selected->is_list) {
							//if($selected->is_list == "1") {
							$q2= 'SELECT pc.* FROM #__virtuemart_product_customfields  as pc ';
							$q2 .= 'INNER JOIN #__virtuemart_products as p on (pc.virtuemart_product_id=p.virtuemart_product_id)';
							if(!empty($virtuemart_category_id)){
								$q2 .= 'INNER JOIN #__virtuemart_product_categories as cat on (pc.virtuemart_product_id=cat.virtuemart_product_id)';
							}
							$q2 .= ' WHERE virtuemart_custom_id="'.$selected->virtuemart_custom_id.'" and p.published="1" ';
							if(!empty($virtuemart_category_id)){
								$q2 .= ' and virtuemart_category_id="'.$virtuemart_category_id.'" ';
							}
							$q2 .= ' GROUP BY `customfield_value`';

							/*$q2 = 'SELECT * FROM `#__virtuemart_product_customfields` WHERE virtuemart_custom_id="'.$selected->virtuemart_custom_id.'" ';
							if(!empty($virtuemart_category_id)){
								$q1 .= ' virtuemart_category_id="'.$virtuemart_category_id.'" and';
							}
							$q2 = 'GROUP BY `customfield_value` ';*/
							$db->setQuery( $q2 );
							$Opts = $db->loadObjectList();
							//vmdebug('getSearchCustom my  q2 '.str_replace('#__',$db->getPrefix(),$db->getQuery()) );
							if($Opts){
								foreach( $Opts as $k => $v ) {
									if(!isset($valueOptions[$v->customfield_value])) {
										$valueOptions[$v->customfield_value] = $v->customfield_value;
									}
								}

								$v = $app->getUserStateFromRequest ('com_virtuemart.customfields.'.$selected->virtuemart_custom_id, 'customfields['.$selected->virtuemart_custom_id.']', '', 'string');
								$searchCustomValues .= '<div class="vm-search-custom-values-group"><div class="vm-custom-title-select">' .  vmText::_( $selected->custom_title ).'</div>'.JHtml::_( 'select.genericlist', $valueOptions, 'customfields['.$selected->virtuemart_custom_id.']', 'class="inputbox vm-chzn-select changeSendForm"', 'virtuemart_custom_id', 'custom_title', $v ) . '</div>';
							}

							//vmdebug('getSearchCustom '.$q2,$Opts,$valueOptions);
							/*} else if($selected->is_list == "2" and !empty($selected->custom_value)) {
								$valueOptions = array();
								$Opts = explode( ';', $selected->custom_value );
								foreach( $Opts as $k => $v ) {
									$valueOptions[$v] = $v;
								}
							}*/

					} else if($selected->field_type=="P"){
						$v = vRequest::getString('customfields['.$selected->virtuemart_custom_id.']');
						$n = 'customfields['.$selected->virtuemart_custom_id.']';
						$searchCustomValues .= vmText::_( $selected->custom_title ).' <input name="'.$n.'" class="inputbox vm-chzn-select" type="text" size="20" value="'.$v.'"/>';
					} else {
					//Atm not written for other field types
					/*	$db->setQuery('SELECT `customfield_value` as virtuemart_custom_id,`custom_value` as custom_title FROM `#__virtuemart_product_customfields` WHERE virtuemart_custom_id='.$selected->virtuemart_custom_id);
						$valueOptions= $db->loadAssocList();

						$valueOptions = array_merge(array($emptyOption), $valueOptions);
						$searchCustomValues .= '<div class="vm-search-custom-values-group"><div class="vm-search-title">'. vmText::_($selected->custom_title).'</div> '.JHtml::_('select.genericlist', $valueOptions, 'customfields['.$selected->virtuemart_custom_id.']', 'class="inputbox vm-chzn-select"', 'virtuemart_custom_id', 'custom_title', 0) . '</div>';*/

					}
				}
				$searchCustomValues .= '<div class="clear"></div>';
			}

			if(VmConfig::get('useCustomSearchTrigger',false)){
				// add search for declared plugins
				JPluginHelper::importPlugin('vmcustom');
				$dispatcher = JDispatcher::getInstance();
				$plgDisplay = $dispatcher->trigger('plgVmSelectSearchableCustom',array( &$this->options,&$searchCustomValues,$this->custom_parent_id ) );
			}
			//vmTime('getSearchCustom after trigger','getSearchCustom');
			vmJsApi::chosenDropDowns();

			return $searchCustomValues;

		}
    }
	
	/*
	 * generate custom fields list to display as search in FE
	 */
	public function getSearchCustom() {

		$categorylist = "";
		$db =JFactory::getDBO();

		$q1= 'SELECT c.* FROM #__virtuemart_customs  as c ';
		$db->setQuery($q1);
		$categorylist = $db->loadObjectList();
		//vmdebug('getSearchCustom '.str_replace('#__',$db->getPrefix(),$db->getQuery()),$selectedlist);//,$virtuemart_category_id,$selectedlist);
		if($categorylist) {
			$app = JFactory::getApplication();
			foreach ($categorylist as $category) {
				$a = $category;
			}
		}
		
		// ****************************
	}
	
}
//no closing tag