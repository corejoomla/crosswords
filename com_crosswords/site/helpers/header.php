<?php
/**
 * @version		$Id: header.php 01 2011-08-13 11:37:09Z maverick $
 * @package		CoreJoomla.crosswords
 * @subpackage	Components
 * @copyright	Copyright (C) 2009 - 2011 corejoomla.com. All rights reserved.
 * @author		Maverick
 * @link		http://www.corejoomla.com/
 * @license		License GNU General Public License version 2 or later
 */
defined('_JEXEC') or die;

$user = JFactory::getUser();

$itemid = CJFunctions::get_active_menu_id();
$home_itemid = CJFunctions::get_active_menu_id(true, 'index.php?option='.CW_APP_NAME.'&view=crosswords');
$user_itemid = CJFunctions::get_active_menu_id(true, 'index.php?option='.CW_APP_NAME.'&view=users');

$base_uri = 'index.php?option='.CW_APP_NAME.'&view=crosswords';
$catparam = !empty($this->category) ? '&id='.$this->category->id.':'.$this->category->alias : '';
$categories = null;

if($user->authorise('core.keywords', CW_APP_NAME) || !empty($this->form_view)){
	
	$categories = JHtml::_('category.categories', CW_APP_NAME);
	foreach ($categories as $id=>$category){
	
		if($category->value == '1' || !$user->authorise('core.create', CW_APP_NAME.'.category.'.$category->value)) {
	
			unset($categories[$id]);
		}
	}
	
	$nocat = new JObject();
	$nocat->set('text', JText::_('COM_CROSSWORDS_CHOOSE_CATEGORY'));
	$nocat->set('value', '0');
	$nocat->set('disable', false);
	
	array_unshift($categories, $nocat);
}

if($this->params->get('display_toolbar', 1) == 1)
{
?>

<div class="navbar">
	<div class="navbar-inner">
		<div class="header-container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".cw-nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="<?php echo JRoute::_('index.php?option='.CW_APP_NAME.'&view=crosswords'.$itemid);?>">
				<?php echo JText::_('COM_CROSSWORDS_HOME');?>
			</a>
			
			<div class="nav-collapse collapse cw-nav-collapse" style="overflow: visible">
				<ul class="nav">
					<li class="dropdown<?php echo in_array($this->action, array('latest', 'popular', 'solved')) ? ' active' : '';?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo JText::_('COM_CROSSWORDS_DISCOVER');?> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li class="nav-header"><?php echo JText::_('COM_CROSSWORDS_CROSSWORDS');?></li>
							<li<?php echo $this->action == 'latest' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=latest'.$catparam.$home_itemid);?>">
									<i class="icon-leaf"></i> <?php echo JText::_('COM_CROSSWORDS_LATEST_CROSSWORDS');?>
								</a>
							</li>
							<li<?php echo $this->action == 'popular' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=popular'.$catparam.$home_itemid);?>">
									<i class="icon-fire"></i> <?php echo JText::_('COM_CROSSWORDS_POPULAR_CROSSWORDS');?>
								</a>
							</li>
							<li<?php echo $this->action == 'solved' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=solved'.$catparam.$home_itemid);?>">
									<i class="icon-check"></i> <?php echo JText::_('COM_CROSSWORDS_SOLVED_CROSSWORDS');?>
								</a>
							</li>
						</ul>
					</li>
					
					<?php if($user->authorise('core.create', CW_APP_NAME)):?>
					<li class="dropdown<?php echo in_array($this->action, array('form', 'keyword_form', 'edit')) ? ' active' : '';?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo JText::_('COM_CROSSWORDS_CREATE');?> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li class="nav-header"><?php echo JText::_('COM_CROSSWORDS_SUBMIT_CONTENT');?></li>
							<li<?php echo $this->action == 'form' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=form'.$home_itemid);?>">
									<i class="icon-th"></i> <?php echo JText::_('COM_CROSSWORDS_CREATE_CROSSWORD');?>
								</a>
							</li>
							<li<?php echo $this->action == 'keyword_form' ? ' class="active"' : '';?>>
								<a href="#keyword_form" role="button" data-toggle="modal">
									<i class="icon-th-list"></i> <?php echo JText::_('COM_CROSSWORDS_SUBMIT_KEYWORD');?>
								</a>
							</li>
						</ul>
					</li>
					<?php endif;?>
					
					<?php if(!$user->guest):?>
					<li class="dropdown<?php echo in_array($this->action, array('mycrosswords', 'myresponses')) ? ' active' : '';?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo JText::_('COM_CROSSWORDS_MY_STUFF');?> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li class="nav-header"><?php echo JText::_('COM_CROSSWORDS_CROSSWORDS');?></li>
							<li<?php echo $this->action == 'mycrosswords' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=mycrosswords'.$catparam.$home_itemid);?>">
									<i class="icon-pencil"></i> <?php echo JText::_('COM_CROSSWORDS_MY_CROSSWORDS');?>
								</a>
							</li>
							<li<?php echo $this->action == 'myresponses' ? ' class="active"' : '';?>>
								<a href="<?php echo JRoute::_($base_uri.'&task=myresponses'.$catparam.$home_itemid);?>">
									<i class="icon-user"></i> <?php echo JText::_('COM_CROSSWORDS_MY_RESPONSES');?>
								</a>
							</li>
						</ul>
					</li>
					<?php endif;?>
				</ul>
				
				<ul class="nav pull-right">
					<?php if($user->guest):?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> <b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li class="nav-header"><?php echo JText::_('JLOGIN');?></li>
							<li class="padding-10">
								<form action="<?php echo JRoute::_('index.php', true, $this->params->get('usesecure')); ?>" method="post" id="login-form" class="form-horizontal">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-user"></i></span>
										<input type="text" name="username" id="inputUsername" class="input-fix margin-bottom-10" placeholder="<?php echo JText::_('JGLOBAL_USERNAME');?>"/>
									</div>
									
									<div class="input-prepend">
										<span class="add-on"><i class="icon-lock"></i></span>
										<input type="password" name="password" class="input-fix margin-bottom-10" id="inputPassword" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD');?>"/>
									</div>
									
									<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
									<label class="checkbox"><input type="checkbox"/> <?php echo JText::_('COM_CJLIB_REMEMBER_ME');?></label>
									<?php endif; ?>
					
									<input type="hidden" name="option" value="com_users" />
									<input type="hidden" name="task" value="user.login" />
									<input type="hidden" name="return" value="<?php echo base64_encode(JUri::current()); ?>" />
									<?php echo JHtml::_('form.token'); ?>
									<button type="button" class="btn" data-dismiss="modal"><?php echo JText::_('JCANCEL');?></button>
									<button class="btn btn-primary" type="submit"><?php echo JText::_('JLOGIN');?></button>
								</form>
							</li>
						</ul>
					</li>
					<?php else:?>
					<li>
						<a class="tooltip-hover" href="#" onclick="document.cw_logout_form.submit();" title="<?php echo JText::_('JLOGOUT');?>">
							<i class="icon-lock"></i> <span class="visible-phone"><?php echo JText::_('JLOGOUT');?></span>
						</a>
						<form id="cw_logout_form" name="cw_logout_form" action="<?php echo JRoute::_('index.php', true, $this->params->get('usesecure'));?>" method="post" style="display: none;">
							<input type="hidden" name="option" value="com_users"/> 
							<input type="hidden" name="task" value="user.logout"/> 
							<input type="hidden" name="return" value="<?php echo base64_encode(JUri::current());?>"/>
							<?php echo JHTML::_( 'form.token' ); ?>
						</form>
					</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php 
}

if($user->authorise('core.keywords', CW_APP_NAME))
{
?>
<div id="keyword_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel"><?php echo JText::_('COM_CROSSWORDS_SUBMIT_KEYWORD');?></h3>
	</div>
	<div class="modal-body">
		<div class="alert alert-info"><?php echo JText::_('COM_CROSSWORDS_SUBMIT_QUESTION_HELP');?></div>
		<div class="alert alert-error hide" id="submit-keyword-error"></div>
		<div class="alert alert-success hide" id="submit-keyword-message"></div>
		<form class="form-horizontal" id="form-submit-keyword" method="post" 
			action="<?php echo JRoute::_('index.php?option='.CW_APP_NAME.'&view=crosswords&task=save_keyword'.$home_itemid)?>">
			<div class="control-group">
				<label class="control-label" for="keyword"><?php echo JText::_('COM_CROSSWORDS_KEYWORD');?></label>
				<div class="controls">
					<input type="text" id="keyword" name="keyword" class="input-xlarge required" placeholder="<?php echo JText::_('COM_CROSSWORDS_KEYWORD');?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="question"><?php echo JText::_('COM_CROSSWORDS_QUESTION');?></label>
				<div class="controls">
					<input type="text" id="question" name="question" class="input-xlarge required" placeholder="<?php echo JText::_('COM_CROSSWORDS_QUESTION');?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="category"><?php echo JText::_('COM_CROSSWORDS_CATEGORY');?></label>
				<div class="controls">
					<?php echo JHTML::_('select.genericlist', $categories, 'category');?>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_CROSSWORDS_CLOSE');?></button>
		<button class="btn btn-primary" id="save-keyword"><?php echo JText::_('JSUBMIT');?></button>
	</div>
</div>
<?php 
}
?>