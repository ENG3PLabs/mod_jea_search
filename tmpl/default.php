<?php 
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     $Id$
 * @package		Jea.module.search
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.txt
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$use_ajax = $params->get('use_ajax', 0);
$category = $params->get('category', 0);
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:12em;
	}");

if ($use_ajax ) {
	JHTML::script('search.js', 'media/com_jea/js/', true);
	
	//initialize the form when the page load
	$document->addScriptDeclaration("
		window.addEvent('domready', function() {
			refreshForm(); 
		});");
}

?>

<form action="index.php?option=com_jea&amp;task=search" method="post" id="jea_search_form" enctype="application/x-www-form-urlencoded" >

	<?php if($category == 1): ?>
    <input type="hidden" id="cat" name="cat" value="selling" />
    <?php elseif($category == 2): ?>
    <input type="hidden" id="cat" name="cat" value="renting" />
    <?php else: ?>
	<p>
    <input type="radio" name="cat" id="renting" value="renting" checked="checked" <?php echo $use_ajax ? 'onclick="reinitForm()"' : '' ?> />
    <label for="renting"><?php echo JText::_('Renting') ?></label>
    <input type="radio" name="cat" id="selling" value="selling" <?php echo $use_ajax ? 'onclick="reinitForm()"' : '' ?> />
    <label for="selling"><?php echo JText::_('Selling') ?></label>
    </p>
    <?php endif ?>
    
<?php if ( $use_ajax ): ?>
    <p>
    <?php if ($params->get('show_types', 1) == 1):?>
    <select id="type_id" name="type_id" onchange="updateList(this)" class="inputbox"><option value="0"> </option></select>
    <?php endif ?>
    <?php if ($params->get('show_departments', 1) == 1):?>
    <select id="department_id"  name="department_id" onchange="updateList(this)" class="inputbox" ><option value="0"> </option></select>
    <?php endif ?>
    <?php if ($params->get('show_towns', 1) == 1):?>
    <select id="town_id" name="town_id" onchange="updateList(this)" class="inputbox"><option value="0"> </option></select>
    <?php endif ?>
    </p>
<?php else: ?> 

   	<p>
   	<?php if ($params->get('show_types', 1) == 1):?>
	<?php echo getHtmlList('#__jea_types', '--'.JText::_( 'Property type' ).'--', 'type_id' ) ?>
	<?php endif ?>
	<?php if ($params->get('show_departments', 1) == 1):?>
	<?php echo getHtmlList('#__jea_departments', '--'.JText::_( 'Department' ).'--', 'department_id' ) ?>
	<?php endif ?>
	<?php if ($params->get('show_towns', 1) == 1):?>
  	<?php echo getHtmlList('#__jea_towns', '--'.JText::_( 'Town' ).'--', 'town_id' ) ?>
  	<?php endif ?>
  	</p>
  	
<?php endif ?>
  	<p><input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
    <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
    </p>
</form>
