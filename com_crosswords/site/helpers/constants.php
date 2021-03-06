<?php
/**
 * @version		$Id: constants.php 01 2011-11-08 11:37:09Z maverick $
 * @package		CoreJoomla.crosswords
 * @subpackage	Components.site
 * @copyright	Copyright (C) 2009 - 2013 corejoomla.com, Inc. All rights reserved.
 * @author		Maverick
 * @link		http://www.corejoomla.com/
 * @license		License GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted access');

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// Please do not touch these until and unless you know what you are doing.
define('CW_CURR_VERSION',				'@version@');
define('CW_CJLIB_VER',					'2.0.0');

define("CW_MEDIA_URI",					JURI::root(true).'/media/com_crosswords/');
define('CW_TEMP_STORE',					JPATH_ROOT.'/media/crosswords/tmp');
define('CW_TEMP_STORE_URI',				JURI::root(false).'media/crosswords/tmp/');
define('CW_IMAGES_UPLOAD_DIR',			JPATH_ROOT.'/media/crosswords/images');
define('CW_IMAGES_URI',					JURI::root(false).'media/crosswords/images/');
?>