<?php /* Smarty version Smarty-3.1.11, created on 2012-07-03 15:16:44
         compiled from "C:\Users\Reky nala\Desktop\add-mvc-framework\branches\0.6\views\common_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174734ff30cdcebb9f0-62261720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf5b38c3ee221104f204f14463a8b88e16348b44' => 
    array (
      0 => 'C:\\Users\\Reky nala\\Desktop\\add-mvc-framework\\branches\\0.6\\views\\common_header.tpl',
      1 => 1341327590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174734ff30cdcebb9f0-62261720',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'ctrl_basename' => 0,
    'C' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_4ff30cdd0bc5c7_90626102',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff30cdd0bc5c7_90626102')) {function content_4ff30cdd0bc5c7_90626102($_smarty_tpl) {?>
<!DOCTYPE html>
<html>
   <head>


      <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
      <meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
      <meta name="keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);?>
" />



      <style type="text/css">
         body, table td, table th {
            color:#000;
            font:10px verdana;
         }
         body {
            background:-moz-linear-gradient(center top , #EEEEEE 5%, #FFFFFF 100%) no-repeat scroll 0 0 #EEEEE;
         }
         a,label {
            color:blue;
            text-decoration:none;
            cursor:pointer;
         }
         #page {
            width:900px;
            margin:0 auto;
            background:#fff;
            color:#000;
            box-shadow:0 0 10px #000000;
            border-radius:10px;
            border:1px solid #aaa;
         }
         #header {
            padding:10px 20px;
            margin:10px 0px;
            border-bottom:1px solid #eee;
         }
         #header a.title {
            color:#aaa;
            font:30px times small-caps;
            display:block;
            text-decoration:none;
         }
         #main {
            padding:10px 20px;
            margin:10px 20px;
         }
         #main form input[type=text],
         #main form input[type=password],
         #main form input[type=email],
         #main form select {
            display:block;
            margin:2px auto;
            padding:2px 5px;
            width:50%;
            height:30px;
            line-height:35px;
         }
         #main form label input[type=text],
         #main form label input[type=password],
         #main form label input[type=email],
         #main form label select {
            margin:0;
            width:98%;
         }
         #main form label {
            display:block;
            width:75%;
            text-transform:uppercase;
            cursor:label;
            color:blue;
            text-align:left;
            margin:10px auto;
         }
         #main form input[type=text],
         #main form input[type=password],
         #main form input[type=email] {
            width:90%;
         }
         #main form select {
            height:25px;
         }
         #main form {
            display:block;
            margin:10px auto;
            width:450px;
            padding:10px 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align:center;
         }
         #main form input[type=submit],
         #main form button[type=submit] {
            display:block;
            margin:10px auto;
            width:40%;
            height:40px;
         }
         #main form h1 {
            color:#888;
            font:30px times small-caps;
            text-transform:uppercase;
            text-align:center;
            margin:5px 10px;
         }
         #footer {
            padding:10px 20px;
            margin:10px 0px;
            border-top:1px solid #eee;
         }
         #footer .generator {
            font-size:8px;
            text-transform: uppercase;
         }
         .error_message,#main form label.error {
            color:red;
            font-weight:bold;
            display:block;
            text-align:center;
         }
         #main form label.error {
            margin:0;
            padding:0;
         }
         table {
            border:1px solid #ddd;
            border-collapse: collapse;
            margin:10px auto;
            max-width:90%;
         }
         table th {
            background:#eee;
         }
         table tbody th {
            text-align:right;
            border-right:1px solid #ddd;
         }
         table th, table td {
            margin:0;
            padding:0;
            border-bottom:1px solid #ddd;
         }
         table td, table th {
            padding:5px 10px;
            margin:5px 10px;
         }
         *[data-href] {
            cursor:pointer;
         }
         tr[data-href]:hover td {
            background-color:#ffe;
            color:blue;
         }
         table caption {
            font-weight:bold;
            font-size:14px;
            background:#666;
            color:#fff;
            padding:5px 10px;
            white-space:nowrap;
         }
         #main thead th.search form {
            background:transparent;
            width:auto;
            border-style:none;
            margin:0;
            padding:0;
         }
         #main thead th.search form input[type=text],
         #main thead th.search form button[type=submit],
         #main thead th.search form select {
            display:inline;
            width:200px;
            height:28px;
            margin:0;
            padding:0;
         }
         #main thead th.search form select {
            height:26px;
         }
         div.cb {
            clear:both;
         }
      </style>



   </head>
   <body class="<?php echo $_smarty_tpl->tpl_vars['ctrl_basename']->value;?>
">
      <div id="page">


         <div id="header">
            <a href="<?php echo $_smarty_tpl->tpl_vars['C']->value->base_url;?>
" class="title">
               <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['C']->value->super_domain, 'UTF-8');?>

            </a>
         </div>

         <div id="main">
<?php }} ?>