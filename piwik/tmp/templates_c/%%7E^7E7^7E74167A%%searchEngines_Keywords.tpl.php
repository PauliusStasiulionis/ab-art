<?php /* Smarty version 2.6.26, created on 2012-09-22 22:50:32
         compiled from /var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/Referers/templates/searchEngines_Keywords.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/Referers/templates/searchEngines_Keywords.tpl', 2, false),)), $this); ?>
<div id='leftcolumn'>
	<h2><?php echo ((is_array($_tmp='Referers_Keywords')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
	<?php echo $this->_tpl_vars['keywords']; ?>

</div>

<div id='rightcolumn'>
	<h2><?php echo ((is_array($_tmp='Referers_SearchEngines')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
	<?php echo $this->_tpl_vars['searchEngines']; ?>

</div>