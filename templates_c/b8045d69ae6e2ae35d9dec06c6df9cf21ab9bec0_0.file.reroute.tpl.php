<?php
/* Smarty version 3.1.29, created on 2017-01-31 22:10:19
  from "/home/steffen/ownCloud/Projects/www/url-shortener/templates/reroute.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5890fd3b4d3406_37580323',
  'file_dependency' => 
  array (
    'b8045d69ae6e2ae35d9dec06c6df9cf21ab9bec0' => 
    array (
      0 => '/home/steffen/ownCloud/Projects/www/url-shortener/templates/reroute.tpl',
      1 => 1485897018,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5890fd3b4d3406_37580323 ($_smarty_tpl) {
?>
<!DOCTYPE>
<html>
<head>
    <title>Rerouting</title>
    <link rel="stylesheet" type="text/css" href="templates/assets/css/core.css" />

</head>
<body>
<h1>Mapping ...</h1>

<?php if (isset($_smarty_tpl->tpl_vars['errorMsg']->value)) {?>
    <p><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['notify']->value)) {?>
    <section id="notifyBox">
        <ul>
            <?php
$_from = $_smarty_tpl->tpl_vars['notify']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_n_0_saved_item = isset($_smarty_tpl->tpl_vars['n']) ? $_smarty_tpl->tpl_vars['n'] : false;
$_smarty_tpl->tpl_vars['n'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['n']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['n']->value) {
$_smarty_tpl->tpl_vars['n']->_loop = true;
$__foreach_n_0_saved_local_item = $_smarty_tpl->tpl_vars['n'];
?>
                <li><?php echo $_smarty_tpl->tpl_vars['n']->value;?>
</li>
            <?php
$_smarty_tpl->tpl_vars['n'] = $__foreach_n_0_saved_local_item;
}
if ($__foreach_n_0_saved_item) {
$_smarty_tpl->tpl_vars['n'] = $__foreach_n_0_saved_item;
}
?>
        </ul>
    </section>
<?php }?>
</body>
</html>

<?php }
}
