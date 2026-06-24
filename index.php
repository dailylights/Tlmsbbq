<?php
/*
ALTER TABLE `hy_chat` CHANGE `uid1` `uid1` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_chat` CHANGE `uid2` `uid2` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_chat` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_chat` ADD `id` INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);

ALTER TABLE `hy_chat_count` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_chat_count` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `hy_count` DROP INDEX name;

ALTER TABLE `hy_file` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL COMMENT '附件主人UID';
ALTER TABLE `hy_file` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `uid`) USING BTREE;
ALTER TABLE `hy_file` DROP INDEX uid;

ALTER TABLE `hy_filegold` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_filegold` CHANGE `fileinfoid` `fileid` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `hy_filegold` DROP INDEX `uid`;
ALTER TABLE `hy_filegold` DROP INDEX `fileinfoid`;
ALTER TABLE `hy_filegold` DROP INDEX `uid_fileinfoid`;
ALTER TABLE `hy_filegold` ADD PRIMARY KEY (`uid`, `fileid`);


ALTER TABLE `hy_fileinfo` DROP `id`;
ALTER TABLE `hy_fileinfo` CHANGE `fileid` `fileid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_fileinfo` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_fileinfo` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_fileinfo` CHANGE `gold` `gold` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_fileinfo` CHANGE `downs` `downs` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_fileinfo` CHANGE `hide` `hide` TINYINT(1) UNSIGNED NOT NULL;

ALTER TABLE `hy_fileinfo` DROP INDEX `fileid`, ADD PRIMARY KEY (`fileid`) USING BTREE;


ALTER TABLE `hy_forum` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_forum` CHANGE `fgid` `fgid` INT(10) UNSIGNED NOT NULL DEFAULT '1';
ALTER TABLE `hy_forum` CHANGE `threads` `threads` INT(10) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `hy_forum` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `hy_forum` DROP INDEX `id`, ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `hy_forum_group` DROP INDEX `id`, ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `hy_friend` CHANGE `uid1` `uid1` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_friend` CHANGE `uid2` `uid2` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_friend` CHANGE `state` `state` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `hy_friend` DROP INDEX `uid1_uid2`, ADD PRIMARY KEY (`uid1`, `uid2`) USING BTREE;
ALTER TABLE `hy_friend` DROP INDEX `uid1`;
ALTER TABLE `hy_friend` DROP INDEX `uid2`;
ALTER TABLE `hy_friend` DROP INDEX `uid1_uid2_state`;
ALTER TABLE `hy_friend` DROP INDEX `uid1_state`;


ALTER TABLE `hy_post` CHANGE `id` `pid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `hy_post` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `fid` `fid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `isthread` `isthread` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `hy_post` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `goods` `goods` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `nos` `nos` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_post` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;


ALTER TABLE `hy_post` DROP INDEX `id`, ADD PRIMARY KEY (`pid`) USING BTREE;
ALTER TABLE `hy_post` DROP INDEX atime;
ALTER TABLE `hy_post` DROP INDEX tid_isthread;
ALTER TABLE `hy_post` DROP INDEX tid_uid;

ALTER TABLE `hy_thread` CHANGE `id` `tid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `hy_thread` CHANGE `fid` `fid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `buid` `buid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `views` `views` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `goods` `goods` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `nos` `nos` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `gold` `gold` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_thread` CHANGE `top` `top` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `hy_thread` CHANGE `hide` `hide` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `hy_thread` CHANGE `state` `state` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `hy_thread` DROP INDEX `id`, ADD PRIMARY KEY (`tid`) USING BTREE;
ALTER TABLE `hy_thread` DROP INDEX top_fid;
ALTER TABLE `hy_thread` DROP INDEX img_count;
ALTER TABLE `hy_thread` DROP INDEX atime;
ALTER TABLE `hy_thread` DROP INDEX goods;


ALTER TABLE `hy_threadgold` DROP INDEX `tid_uid`, ADD PRIMARY KEY (`tid`, `uid`) USING BTREE;

ALTER TABLE `hy_user` CHANGE `id` `uid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `hy_user` CHANGE `threads` `threads` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_user` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_user` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_user` CHANGE `group` `gid` SMALLINT(2) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `hy_user` CHANGE `gold` `gold` INT(10) NOT NULL;
ALTER TABLE `hy_user` CHANGE `credits` `credits` INT(10) NOT NULL;
ALTER TABLE `hy_user` CHANGE `etime` `etime` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_user` CHANGE `ctime` `ctime` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_user` CHANGE `file_size` `file_size` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `hy_user` DROP INDEX `id`, ADD PRIMARY KEY (`uid`) USING BTREE;
ALTER TABLE `hy_user` DROP INDEX `user`, ADD UNIQUE `user` (`user`) USING BTREE;
ALTER TABLE `hy_user` DROP INDEX `email`, ADD UNIQUE `email` (`email`) USING BTREE;
ALTER TABLE `hy_user` DROP INDEX atime;


ALTER TABLE `hy_usergroup` CHANGE `id` `gid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_usergroup` CHANGE `space_size` `space_size` INT(10) UNSIGNED NULL DEFAULT '4294967295';

ALTER TABLE `hy_usergroup` DROP INDEX `id`, ADD PRIMARY KEY (`gid`) USING BTREE;

ALTER TABLE `hy_vote_post` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_vote_post` CHANGE `pid` `pid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_vote_post` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `hy_vote_post` DROP INDEX `uid`, ADD PRIMARY KEY (`uid`, `pid`) USING BTREE;
ALTER TABLE `hy_vote_post` DROP INDEX pid;

ALTER TABLE `hy_vote_thread` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_vote_thread` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `hy_vote_thread` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `hy_vote_thread` DROP INDEX `uid`, ADD PRIMARY KEY (`uid`, `tid`) USING BTREE;
ALTER TABLE `hy_vote_thread` DROP INDEX tid;



*/
if(version_compare(PHP_VERSION,'5.4.0','<')){
	header("Content-Type: text/html; charset=UTF-8");
	die('HYPHP2.0 不支持 5.4以下的PHP版本.  当前你的PHP版本：' . PHP_VERSION);
}

define('HYBBS_V'			,'2.0.15');

define('INDEX_PATH' 		, str_replace('\\', '/', dirname(__FILE__)).'/');
//define('PATH','App/');
define('DEBUG'      ,(is_file(INDEX_PATH . 'DEBUG'))?false:true);
define('PLUGIN_ON'  ,true);
define('PLUGIN_ON_FILE',true);
define('PLUGIN_MORE_LANG_ON',true);

require  'HY/HYPHP.php';