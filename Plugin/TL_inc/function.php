<?php

//插件安装时 执行的安装函数

function plugin_install(){

    $sql = S("thread");

    if(!$sql->query("





    

    alter table hy_thread add (niming char(255) DEFAULT NULL,

	biaobai tinyint(1) DEFAULT NULL,

	content char(255) DEFAULT NULL,

	lastdate char(255) DEFAULT NULL,

	xb int(1) NOT NULL);

   



    "))

        return false;

    return true;

} 

//插件卸载时 执行的安装函数

function plugin_uninstall(){

    $sql = S("Plugin");

    if(!$sql->query("DROP TABLE `TL_inc`;"))

        return false;



    return true;

}

