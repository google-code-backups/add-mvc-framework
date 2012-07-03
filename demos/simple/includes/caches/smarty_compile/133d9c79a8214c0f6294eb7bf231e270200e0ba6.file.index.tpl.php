<?php /* Smarty version Smarty-3.1.8, created on 2012-07-02 23:58:39
         compiled from "C:\xampp\htdocs\add-mvc-framework\demos\simple/includes/views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:294424ff22198318a04-07770046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '133d9c79a8214c0f6294eb7bf231e270200e0ba6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\add-mvc-framework\\demos\\simple/includes/views\\index.tpl',
      1 => 1341273518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '294424ff22198318a04-07770046',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff22198421db0_79195116',
  'variables' => 
  array (
    'C' => 0,
    'current_view' => 0,
    'current_controller' => 0,
    'utc_timestamp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff22198421db0_79195116')) {function content_4ff22198421db0_79195116($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'C:\\xampp\\htdocs\\add-mvc-framework\\trunk\\libs\\smarty\\plugins\\modifier.replace.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ("common_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

   <h1>Simple Example</h1>
   <p>Hi! This is a very simple implementation of ADD MVC Framework.</p>

   <p>Just edit <b><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['C']->value->views_dir,'\\','/');?>
/<?php echo $_smarty_tpl->tpl_vars['current_view']->value;?>
</b> to change the view</p>

   <p>You can also edit the controller: <b><?php echo $_smarty_tpl->tpl_vars['current_controller']->value;?>
.class.php</b></p>

   <p>current UTC time: <b><?php echo date("Y-m-d h:i:s",$_smarty_tpl->tpl_vars['utc_timestamp']->value);?>
</b></p>

<?php echo $_smarty_tpl->getSubTemplate ("common_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>