<?php /* Smarty version 2.6.26, created on 2012-10-10 12:56:28
         compiled from /var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_header.tpl', 8, false),array('modifier', 'escape', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_header.tpl', 28, false),)), $this); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body style="color: rgb(<?php echo $this->_tpl_vars['reportTextColor']; ?>
);">

	<a name="reportTop"/>
	<a target="_blank" href="<?php echo $this->_tpl_vars['currentPath']; ?>
"><img title="<?php echo ((is_array($_tmp='General_GoTo')) ? $this->_run_mod_handler('translate', true, $_tmp, 'Piwik') : smarty_modifier_translate($_tmp, 'Piwik')); ?>
" border="0" alt="Piwik" src='<?php echo $this->_tpl_vars['logoHeader']; ?>
' /></a>

	<h1 style="color: rgb(<?php echo $this->_tpl_vars['reportTitleTextColor']; ?>
); font-size: <?php echo $this->_tpl_vars['reportTitleTextSize']; ?>
pt;">
		<?php echo ((is_array($_tmp='General_Website')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo $this->_tpl_vars['websiteName']; ?>

	</h1>

	<p>
		<?php echo $this->_tpl_vars['description']; ?>
 - <?php echo ((is_array($_tmp='General_DateRange')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo $this->_tpl_vars['prettyDate']; ?>

	</p>

	<?php if (sizeof ( $this->_tpl_vars['reportMetadata'] ) > 1): ?>

		<h2 style="color: rgb(<?php echo $this->_tpl_vars['reportTitleTextColor']; ?>
); font-size: <?php echo $this->_tpl_vars['reportTitleTextSize']; ?>
pt;">
			<?php echo ((is_array($_tmp='PDFReports_TableOfContent')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

		</h2>

		<ul>
			<?php $_from = $this->_tpl_vars['reportMetadata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['metadata']):
?>
				<li>
					<a href="#<?php echo $this->_tpl_vars['metadata']['uniqueId']; ?>
" style="text-decoration:none; color: rgb(<?php echo $this->_tpl_vars['reportTextColor']; ?>
);">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['metadata']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>

	<?php endif; ?>