<?php /* Smarty version Smarty-3.1.8, created on 2012-07-02 22:42:01
         compiled from "../../trunk/views\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133384ff21e650e37f7-13053828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8dc483d49f21ba17a321352dba2736941dc967bb' => 
    array (
      0 => '../../trunk/views\\404.tpl',
      1 => 1341268920,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133384ff21e650e37f7-13053828',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff21e6539deb8_65636567',
  'variables' => 
  array (
    'C' => 0,
    '_GET' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff21e6539deb8_65636567')) {function content_4ff21e6539deb8_65636567($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("common_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

   <h1>Page not found</h1>
   <p>The page you are looking for is not found</p>
   Configuration:
   <ul>
      <li>path: <?php echo $_smarty_tpl->tpl_vars['C']->value->path;?>
</li>
      <li>controller rewritten: <?php echo $_smarty_tpl->tpl_vars['_GET']->value['add_mvc_path'];?>
</li>
      <li>current controller: <?php echo add::current_controller_basename();?>
</li>
   </ul>
<?php echo $_smarty_tpl->getSubTemplate ("common_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>