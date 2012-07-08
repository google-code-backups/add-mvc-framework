<?php /* Smarty version Smarty-3.1.8, created on 2012-07-02 22:25:26
         compiled from "../../trunk/views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73894ff21fd6c88d96-20516701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd163955c1fae7cd6932186124541d4b1008e44a0' => 
    array (
      0 => '../../trunk/views\\index.tpl',
      1 => 1340299515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73894ff21fd6c88d96-20516701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'log' => 0,
    'warning' => 0,
    'dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff21fd6d44676_76281438',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff21fd6d44676_76281438')) {function content_4ff21fd6d44676_76281438($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("common_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

   <h1>New Website</h1>
   Hello, this website is very new, please comeback again later to see contents.
   <?php if ($_smarty_tpl->tpl_vars['log']->value['warnings']){?>
      <h5>Warnings</h5>
      <ul>
      <?php  $_smarty_tpl->tpl_vars['warning'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['warning']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['warnings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['warning']->key => $_smarty_tpl->tpl_vars['warning']->value){
$_smarty_tpl->tpl_vars['warning']->_loop = true;
?>
         <li><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</li>
      <?php } ?>
      </ul>
   <?php }?>
   <?php if ($_smarty_tpl->tpl_vars['log']->value['dirs']){?>
      <h2>Directories Created</h2>
      <ul>
      <?php  $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dir']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['dirs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dir']->key => $_smarty_tpl->tpl_vars['dir']->value){
$_smarty_tpl->tpl_vars['dir']->_loop = true;
?>
         <li><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
</li>
      <?php } ?>
      </ul>
   <?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("common_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>