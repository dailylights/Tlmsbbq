<?php
namespace Action;
use HY\Action;
!defined('HY_PATH') && exit('HY_PATH not defined.');
use PDO;

class Inst extends Action {
    public $state;
    // public function index(){
    //     if(C('DOMAIN_NAME')){
    //       header("location: " . C('DOMAIN_NAME'));
    //       exit;
    //     }
    //     //$this->view = 'install';
    //     //$this->display('index');
    // }
    private function app_text($str){
      $this->state.='<p><i class="fa fa-check"></i> '.$str.'</p>';
    }
    
    public function install(){
        die('install');
    }
    public function rex(){
      $DOMAIN_NAME = C('DOMAIN_NAME');
      
        if(!empty($DOMAIN_NAME)){
          if(IS_AJAX)
          $this->json(array('error'=>false,'info'=>'你已经安装过,如果需要重装请将 /Conf/config.php删除'));
            else
          die('你已经安装过,如果需要重装请将 /Conf/config.php删除');
        }
        $bbs_user = X('post.bbs_user');
        $bbs_pass = X('post.bbs_pass');
        $email = X('post.email');
        $www = X('post.www');
        !empty($bbs_user) or $this->json(array('error'=>false,'info'=>'请输入管理员用户名'));
        !empty($bbs_pass) or $this->json(array('error'=>false,'info'=>'请输入管理员密码 (最少6位)'));
        !empty($email) or $this->json(array('error'=>false,'info'=>'请输入管理员邮箱'));
        !empty($www) or $this->json(array('error'=>false,'info'=>'请输入网站域名'));


        
        return $sql = new \HY\Lib\Medoo(array(
            // 必须配置项
            'database_type' => X("post.sqltype"),
            'database_name' => X("post.name"),
            'server' => X("post.ip"),
            'username' => X("post.username"),
            'password' => X("post.password"),
            'charset' => 'utf8',
            // 可选参数
            'port' => X("post.port"),
            // 可选，定义表的前缀
            'prefix' => 'hy_',
        ));
    }
    public function index(){
        // if(C('DOMAIN_NAME')){
        //   header("location: " . C('DOMAIN_NAME'));
        //   exit;
        // }
        
        $sql = $this->rex();
        $table_type = X("post.table_type");

        $gn = X('post.gn');

if($gn == 1){
    $salt = substr(md5(mt_rand(10000000, 99999999).NOW_TIME), 0, 8);
    $sql->query("
DROP TABLE IF EXISTS hy_cache;
DROP TABLE IF EXISTS hy_chat;
DROP TABLE IF EXISTS hy_chat_count;
DROP TABLE IF EXISTS hy_count;
DROP TABLE IF EXISTS hy_file;
DROP TABLE IF EXISTS hy_filegold;
DROP TABLE IF EXISTS hy_fileinfo;
DROP TABLE IF EXISTS hy_forum;
DROP TABLE IF EXISTS hy_forum_group;
DROP TABLE IF EXISTS hy_friend;
DROP TABLE IF EXISTS hy_log;
DROP TABLE IF EXISTS hy_online;
DROP TABLE IF EXISTS hy_post;
DROP TABLE IF EXISTS hy_thread;
DROP TABLE IF EXISTS hy_threadgold;
DROP TABLE IF EXISTS hy_user;
DROP TABLE IF EXISTS hy_usergroup;
DROP TABLE IF EXISTS hy_vote_post;
DROP TABLE IF EXISTS hy_vote_thread;




    --
    -- 表的结构 `hy_cache`
    --

    CREATE TABLE `hy_cache` (
    `cachekey` varchar(255) NOT NULL,
    `expire` int(11) NOT NULL,
    `data` blob,
    `datacrc` int(32) DEFAULT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_chat`
    --

    CREATE TABLE `hy_chat` (
    `id` int(10) UNSIGNED NOT NULL,
    `uid1` int(10) UNSIGNED NOT NULL,
    `uid2` int(10) UNSIGNED NOT NULL,
    `content` tinytext NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_chat_count`
    --

    CREATE TABLE `hy_chat_count` (
    `uid` int(10) UNSIGNED NOT NULL,
    `c` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `atime` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_count`
    --

    CREATE TABLE `hy_count` (
        `name` varchar(12) NOT NULL,
        `v` int(11) NOT NULL DEFAULT '0'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;
    INSERT INTO `hy_count` (`name`, `v`) VALUES
    ('A1.0', 1),
    ('A1.1', 1),
    ('A1.2', 1),
    ('1.5', 1),
    ('1.5.1', 1),
    ('1.5.27', 1),
    ('1.5.33', 1),
    ('2.0', 1),
    ('2.0.12', 1),
    ('thread', 0);


    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_file`
    --

    CREATE TABLE `hy_file` (
    `id` int(10) UNSIGNED NOT NULL COMMENT '附件ID',
    `uid` int(10) UNSIGNED NOT NULL COMMENT '附件主人UID',
    `filename` text NOT NULL COMMENT '附件名称',
    `md5name` text NOT NULL COMMENT '附件随机名',
    `filesize` int(10) UNSIGNED NOT NULL COMMENT '文件大小',
    `atime` int(10) UNSIGNED NOT NULL COMMENT '添加时间'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_filegold`
    --

    CREATE TABLE `hy_filegold` (
    `uid` int(10) UNSIGNED NOT NULL,
    `fileid` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_fileinfo`
    --

    CREATE TABLE `hy_fileinfo` (
    `fileid` int(10) UNSIGNED NOT NULL,
    `tid` int(10) UNSIGNED NOT NULL,
    `uid` int(10) UNSIGNED NOT NULL,
    `gold` int(10) UNSIGNED NOT NULL,
    `hide` tinyint(1) UNSIGNED NOT NULL,
    `downs` int(10) UNSIGNED NOT NULL,
    `mess` text NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_forum`
    --

    CREATE TABLE `hy_forum` (
    `id` int(10) UNSIGNED NOT NULL,
    `fid` int(10) NOT NULL DEFAULT '-1',
    `fgid` int(10) UNSIGNED NOT NULL DEFAULT '1',
    `name` varchar(12) NOT NULL,
    `name2` varchar(18) NOT NULL,
    `threads` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `forumg` text NOT NULL,
    `json` text NOT NULL,
    `html` longtext NOT NULL,
    `color` varchar(30) NOT NULL,
    `background` varchar(30) NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    INSERT INTO `hy_forum` (`id`, `fid`, `name`,`name2`, `threads`) VALUES
    (0, -1, '默认分类','morenfenlei', 0);

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_forum_group`
    --

    CREATE TABLE `hy_forum_group` (
    `id` int(10) UNSIGNED NOT NULL,
    `name` varchar(32) NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_friend`
    --

    CREATE TABLE `hy_friend` (
    `uid1` int(10) UNSIGNED NOT NULL,
    `uid2` int(10) UNSIGNED NOT NULL,
    `c` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
    `atime` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_log`
    --

    CREATE TABLE `hy_log` (
    `uid` int(10) UNSIGNED NOT NULL,
    `gold` int(10) NOT NULL,
    `credits` int(10) UNSIGNED NOT NULL,
    `content` varchar(32) NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_online`
    --

    CREATE TABLE `hy_online` (
    `uid` int(10) UNSIGNED NOT NULL,
    `user` char(18) NOT NULL,
    `gid` int(10) UNSIGNED NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_post`
    --

    CREATE TABLE `hy_post` (
    `pid` int(10) UNSIGNED NOT NULL,
    `tid` int(10) UNSIGNED NOT NULL,
    `fid` int(10) UNSIGNED NOT NULL,
    `uid` int(10) UNSIGNED NOT NULL,
    `isthread` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
    `content` longtext NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL,
    `goods` int(10) UNSIGNED DEFAULT '0',
    `nos` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `posts` int(10) UNSIGNED NOT NULL DEFAULT '0'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;


    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_thread`
    --

    CREATE TABLE `hy_thread` (
    `tid` int(10) UNSIGNED NOT NULL,
    `fid` int(10) UNSIGNED NOT NULL,
    `uid` int(10) UNSIGNED NOT NULL COMMENT 'user_id',
    `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `title` char(128) NOT NULL,
    `summary` text NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `btime` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `buid` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `views` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'view_size',
    `posts` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'post_size',
    `goods` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `nos` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `img` text NOT NULL,
    `img_count` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
    `top` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
    `files` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '附件数量',
    `hide` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
    `gold` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_threadgold`
    --

    CREATE TABLE `hy_threadgold` (
    `uid` int(10) UNSIGNED NOT NULL,
    `tid` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_user`
    --

    CREATE TABLE `hy_user` (
    `uid` int(10) UNSIGNED NOT NULL,
    `user` varchar(18) NOT NULL,
    `pass` varchar(32) NOT NULL,
    `email` varchar(100) NOT NULL,
    `salt` varchar(8) NOT NULL,
    `threads` int(10) UNSIGNED NOT NULL,
    `posts` int(10) UNSIGNED NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL,
    `gid` smallint(2) UNSIGNED NOT NULL DEFAULT '0',
    `gold` int(10) NOT NULL DEFAULT '0' COMMENT '金钱',
    `credits` int(10) NOT NULL DEFAULT '0',
    `etime` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `ps` varchar(40) DEFAULT '',
    `fans` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `follow` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `ctime` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `file_size` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `chat_size` int(10) UNSIGNED NOT NULL DEFAULT '0'
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    INSERT INTO `hy_user` (`uid`, `user`, `pass`, `email`, `salt`, `threads`, `posts`, `atime`, `gid`) VALUES
    (1, '".X("post.bbs_user")."', '".L("User")->md5_md5(X("post.bbs_pass"),$salt)."', '".X("post.email")."', '".$salt."', 0, 0, ".NOW_TIME.", 1);

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_usergroup`
    --

    CREATE TABLE `hy_usergroup` (
    `gid` int(10) UNSIGNED NOT NULL,
    `credits` int(11) NOT NULL DEFAULT '-1',
    `space_size` int(10) UNSIGNED DEFAULT '4294967295',
    `chat_size` int(10) UNSIGNED NOT NULL DEFAULT '4294967295',
    `name` varchar(12) NOT NULL,
    `json` varchar(120) NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    INSERT INTO `hy_usergroup` (`gid`, `space_size`, `chat_size`, `name`, `json`) VALUES
    (1, 4294967295, 4294967295, '管理员', '{\"uploadfile\":1,\"down\":1,\"del\":1,\"upload\":1,\"mess\":1,\"post\":1,\"thread\":1,\"tgold\":1,\"thide\":1,\"nogold\":0}'),
    (2, 4294967295, 4294967295, '新用户', '{\"down\":1,\"uploadfile\":1,\"del\":1,\"upload\":1,\"mess\":1,\"post\":1,\"thread\":1,\"nogold\":0,\"thide\":1,\"tgold\":1}'),
    (3, 4294967295, 4294967295, '游客', '{\"down\":1,\"uploadfile\":1,\"del\":1,\"upload\":1,\"mess\":1,\"post\":1,\"thread\":1,\"nogold\":0,\"thide\":1,\"tgold\":1}');

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_vote_post`
    --

    CREATE TABLE `hy_vote_post` (
    `uid` int(10) UNSIGNED NOT NULL,
    `pid` int(10) UNSIGNED NOT NULL,
    `atime` int(10) UNSIGNED NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- 表的结构 `hy_vote_thread`
    --

    CREATE TABLE `hy_vote_thread` (
    `uid` int(10) NOT NULL,
    `tid` int(10) NOT NULL,
    `atime` int(10) NOT NULL
    ) ENGINE={$table_type} DEFAULT CHARSET=utf8;

    
    ");
    $this->json(array('error'=>true,'info'=>'创建数据表完成'));
}

if($gn == 2){

    $sql->query("
    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `hy_cache`
    --
    ALTER TABLE `hy_cache`
      ADD UNIQUE KEY `cachekey` (`cachekey`);

    --
    -- Indexes for table `hy_chat`
    --
    ALTER TABLE `hy_chat`
      ADD PRIMARY KEY (`id`),
      ADD KEY `uid1` (`uid1`,`uid2`);

    --
    -- Indexes for table `hy_chat_count`
    --
    ALTER TABLE `hy_chat_count`
      ADD UNIQUE KEY `uid` (`uid`);

    --
    -- Indexes for table `hy_file`
    --
    ALTER TABLE `hy_file`
      ADD PRIMARY KEY (`id`,`uid`) USING BTREE;

    --
    -- Indexes for table `hy_filegold`
    --
    ALTER TABLE `hy_filegold`
      ADD PRIMARY KEY (`uid`,`fileid`) USING BTREE;

    --
    -- Indexes for table `hy_fileinfo`
    --
    ALTER TABLE `hy_fileinfo`
      ADD PRIMARY KEY (`fileid`) USING BTREE,
      ADD KEY `tid` (`tid`) USING BTREE,
      ADD KEY `uid` (`uid`) USING BTREE;

    --
    -- Indexes for table `hy_forum`
    --
    ALTER TABLE `hy_forum`
      ADD PRIMARY KEY (`id`) USING BTREE,
      ADD KEY `fid` (`fid`);

    --
    -- Indexes for table `hy_forum_group`
    --
    ALTER TABLE `hy_forum_group`
      ADD PRIMARY KEY (`id`) USING BTREE;

    --
    -- Indexes for table `hy_friend`
    --
    ALTER TABLE `hy_friend`
      ADD PRIMARY KEY (`uid1`,`uid2`) USING BTREE,
      ADD KEY `uid2` (`uid2`,`state`) USING BTREE;

    --
    -- Indexes for table `hy_log`
    --
    ALTER TABLE `hy_log`
      ADD KEY `uid` (`uid`);

    --
    -- Indexes for table `hy_online`
    --
    ALTER TABLE `hy_online`
      ADD PRIMARY KEY (`uid`) USING BTREE;

    --
    -- Indexes for table `hy_post`
    --
    ALTER TABLE `hy_post`
      ADD PRIMARY KEY (`pid`) USING BTREE,
      ADD KEY `tid` (`tid`),
      ADD KEY `uid` (`uid`);

    --
    -- Indexes for table `hy_thread`
    --
    ALTER TABLE `hy_thread`
      ADD PRIMARY KEY (`tid`) USING BTREE,
      ADD KEY `uid` (`uid`),
      ADD KEY `fid` (`fid`),
      ADD KEY `top` (`top`),
      ADD KEY `posts` (`posts`),
      ADD KEY `btime` (`btime`),
      ADD KEY `views` (`views`);

    --
    -- Indexes for table `hy_threadgold`
    --
    ALTER TABLE `hy_threadgold`
      ADD PRIMARY KEY (`uid`,`tid`) USING BTREE;

    --
    -- Indexes for table `hy_user`
    --
    ALTER TABLE `hy_user`
      ADD PRIMARY KEY (`uid`) USING BTREE,
      ADD UNIQUE KEY `user` (`user`) USING BTREE,
      ADD UNIQUE KEY `email` (`email`) USING BTREE,
      ADD KEY `gid` (`gid`);

    --
    -- Indexes for table `hy_usergroup`
    --
    ALTER TABLE `hy_usergroup`
      ADD PRIMARY KEY (`gid`) USING BTREE;

    --
    -- Indexes for table `hy_vote_post`
    --
    ALTER TABLE `hy_vote_post`
      ADD PRIMARY KEY (`uid`,`pid`) USING BTREE;

    --
    -- Indexes for table `hy_vote_thread`
    --
    ALTER TABLE `hy_vote_thread`
      ADD PRIMARY KEY (`uid`,`tid`) USING BTREE;


    ");
    $this->json(array('error'=>true,'info'=>'创建索引完成'));
}
if($gn == 3){
    $sql->query("
    --
    -- 在导出的表使用AUTO_INCREMENT
    --

    --
    -- 使用表AUTO_INCREMENT `hy_chat`
    --
    ALTER TABLE `hy_chat`
      MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    --
    -- 使用表AUTO_INCREMENT `hy_file`
    --
    ALTER TABLE `hy_file`
      MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '附件ID', AUTO_INCREMENT=1;
    --
    -- 使用表AUTO_INCREMENT `hy_forum_group`
    --
    ALTER TABLE `hy_forum_group`
      MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    --
    -- 使用表AUTO_INCREMENT `hy_post`
    --
    ALTER TABLE `hy_post`
      MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    --
    -- 使用表AUTO_INCREMENT `hy_thread`
    --
    ALTER TABLE `hy_thread`
      MODIFY `tid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    --
    -- 使用表AUTO_INCREMENT `hy_user`
    --
    ALTER TABLE `hy_user`
      MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
    ");
    $content = @file_get_contents(INDEX_PATH . 'Conf/config.back');
        if($content === false)
          $this->json(array('error'=>false,'info'=>'/Conf无读取权限'));
        $str = rand_str(16);
        $content = str_replace(

          array(
            'MYSQL_NAME',
            'MYSQL_IP',
            'MYSQL_USER',
            'MYSQL_PASS',
            'MYSQL_PORT',
            'http://127.0.0.1',
            'sql_typee',
            '1234567890',
            'SQL_STORAGE_ENGINE_VALUE'
          ),
          array(
            X("post.name"),
            X("post.ip"),
            X("post.username"),
            X("post.password"),
            X("post.port"),
            trim(X("post.www"),'/'),
            X("post.sqltype"),
            $str,
            $table_type

          ),$content
        );

        

        if(@file_put_contents(INDEX_PATH . 'Conf/config.php',$content) === false)
          $this->json(array('error'=>false,'info'=>'/Conf无写入权限'));

    $this->json(array('error'=>true,'info'=>'创建AUTO_INCREMENT完成','url'=>trim(X("post.www"),'/') . '/?s='));
}
  //$this->json(array('error'=>false,'info'=>'创建SQL失败'));

//$this->app_text('Insert Data success');




      

      //if(is_file(ACTION_PATH . 'Install.php'))
          //rename(ACTION_PATH . 'Install.php' , ACTION_PATH . 'Install.php.back');
      
      //$this->json(array('error'=>true,'info'=>$this->state,'url'=>(X("post.https")=='on'?'https://':'http://').trim(X("post.www"),'/') ));
      


        //echo X("post.name");
    }

}
