<?php /* Smarty version 2.6.26, created on 2012-10-10 12:56:28
         compiled from /var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_body.tpl', 3, false),array('modifier', 'translate', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_body.tpl', 7, false),array('function', 'cycle', '/var/www/vhosts/ab-art.lt/httpdocs/piwik/plugins/CoreHome/templates/html_report_body.tpl', 36, false),)), $this); ?>
<a name ="<?php echo $this->_tpl_vars['reportId']; ?>
"/>
<h2 style="color: rgb(<?php echo $this->_tpl_vars['reportTitleTextColor']; ?>
); font-size: <?php echo $this->_tpl_vars['reportTitleTextSize']; ?>
pt;">
	<?php echo ((is_array($_tmp=$this->_tpl_vars['reportName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

</h2>

<?php if (empty ( $this->_tpl_vars['reportRows'] )): ?>
	<?php echo ((is_array($_tmp='CoreHome_ThereIsNoDataForThisReport')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<?php else: ?>
	<?php if ($this->_tpl_vars['displayGraph']): ?>
		<img
			alt=""
			<?php if ($this->_tpl_vars['renderImageInline']): ?>
				src="data:image/png;base64,<?php echo $this->_tpl_vars['generatedImageGraph']; ?>
"
			<?php else: ?>
				src="cid:<?php echo $this->_tpl_vars['reportId']; ?>
"
			<?php endif; ?>
			height="<?php echo $this->_tpl_vars['graphHeight']; ?>
"
			width="<?php echo $this->_tpl_vars['graphWidth']; ?>
" />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['displayGraph'] && $this->_tpl_vars['displayTable']): ?>
		<br/>
		<br/>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['displayTable']): ?>
	<table style="border-collapse:collapse; margin-left: 5px">
		<thead style="background-color: rgb(<?php echo $this->_tpl_vars['tableHeaderBgColor']; ?>
); color: rgb(<?php echo $this->_tpl_vars['tableHeaderTextColor']; ?>
); font-size: <?php echo $this->_tpl_vars['reportTableHeaderTextSize']; ?>
pt;">
			<?php $_from = $this->_tpl_vars['reportColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['columnName']):
?>
			<th style="padding: 6px 0;">
				&nbsp;<?php echo $this->_tpl_vars['columnName']; ?>
&nbsp;&nbsp;
			</th>
			<?php endforeach; endif; unset($_from); ?>
		</thead>
		<tbody>
			<?php echo smarty_function_cycle(array('name' => 'tr-background-color','delimiter' => ';','values' => ";background-color: rgb(".($this->_tpl_vars['tableBgColor']).")",'print' => false,'reset' => true,'advance' => false), $this);?>

			<?php $_from = $this->_tpl_vars['reportRows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowId'] => $this->_tpl_vars['row']):
?>

			<?php $this->assign('rowMetrics', $this->_tpl_vars['row']->getColumns()); ?>

			<?php if (isset ( $this->_tpl_vars['reportRowsMetadata'][$this->_tpl_vars['rowId']] )): ?>
				<?php $this->assign('rowMetadata', $this->_tpl_vars['reportRowsMetadata'][$this->_tpl_vars['rowId']]->getColumns()); ?>
			<?php else: ?>
				<?php $this->assign('rowMetadata', null); ?>
			<?php endif; ?>

			<tr style="<?php echo smarty_function_cycle(array('name' => 'tr-background-color'), $this);?>
">
				<?php $_from = $this->_tpl_vars['reportColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['columnId'] => $this->_tpl_vars['columnName']):
?>
				<td style="font-size: <?php echo $this->_tpl_vars['reportTableRowTextSize']; ?>
pt; border-bottom: 1px solid rgb(<?php echo $this->_tpl_vars['tableCellBorderColor']; ?>
); padding: 5px 0 5px 5px;">
					<?php if ($this->_tpl_vars['columnId'] == 'label'): ?>
						<?php if (isset ( $this->_tpl_vars['rowMetrics'][$this->_tpl_vars['columnId']] )): ?>
							<?php if (isset ( $this->_tpl_vars['rowMetadata']['logo'] )): ?>
							<img src='<?php echo $this->_tpl_vars['currentPath']; ?>
<?php echo $this->_tpl_vars['rowMetadata']['logo']; ?>
'>&nbsp;
							<?php endif; ?>
							<?php if (isset ( $this->_tpl_vars['rowMetadata']['url'] )): ?>
								<a style="color: rgb(<?php echo $this->_tpl_vars['reportTextColor']; ?>
);" href='<?php if (! in_array ( substr ( $this->_tpl_vars['rowMetadata']['url'] , 0 , 4 ) , array ( 'http' , 'ftp:' ) )): ?>http://<?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['rowMetadata']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'>
							<?php endif; ?>
									<?php echo $this->_tpl_vars['rowMetrics'][$this->_tpl_vars['columnId']]; ?>

							<?php if (isset ( $this->_tpl_vars['rowMetadata']['url'] )): ?>
								</a>
							<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
						<?php if (empty ( $this->_tpl_vars['rowMetrics'][$this->_tpl_vars['columnId']] )): ?>
							0
						<?php else: ?>
							<?php echo $this->_tpl_vars['rowMetrics'][$this->_tpl_vars['columnId']]; ?>

						<?php endif; ?>
					<?php endif; ?>
				</td>
				<?php endforeach; endif; unset($_from); ?>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	<?php endif; ?>
<?php endif; ?>
<br/>
<a style="text-decoration:none; color: rgb(<?php echo $this->_tpl_vars['reportTitleTextColor']; ?>
); font-size: <?php echo $this->_tpl_vars['reportBackToTopTextSize']; ?>
pt" href="#reportTop">
	<?php echo ((is_array($_tmp='PDFReports_TopOfReport')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

</a>