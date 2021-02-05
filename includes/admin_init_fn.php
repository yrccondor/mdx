<?php
require_once('admin_init_ver.php');
require('default_value.php');

$mdx_subdir_flag_init = 'normal';
if(stripos(explode('//', home_url())[1], '/')){
    $mdx_subdir_flag_init = 'sub';
}
$mdx_default_values['mdx_install'] = $mdx_subdir_flag_init;

update_option('mdx_all_options', $arr);
?>
