<?php
namespace Action;
use HY\Action;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class My extends HYBBS {
    public $menu_action;
    public function __construct(){
		parent::__construct();
        //{hook a_my_init}
        $this->view = IS_MOBILE ? $this->conf['wapuserview'] : $this->conf['userview'];
        $this->menu_action = array(
            'index'=>'',
            'thread'=>'',
            'post'=>'',
            'mess'=>'',
            'op'=>'',
            'file'=>''
        );
        //{hook a_my_init_1}

    }
    //用户中心
    public function _no(){
        //{hook a_my_empty_1}
        $username   = isset($_GET['HY_URL'][1])?$_GET['HY_URL'][1]:'';
        $method     = isset($_GET['HY_URL'][2])?$_GET['HY_URL'][2]:'index';
        $username = urldecode ($username); //url解码
        if(empty($username))
            return $this->message("请输入一个用户名称");

        //$encode = mb_detect_encoding($username);
        //var_dump($username);

        //echo $encode;return;
        //if ($encode == "UTF-8"){
        //$username = iconv('GBK',"UTF-8",$username);
            //$username = iconv('GBK',"UTF-8",$username);
        //}
        
        //服务器引入 GBK编码 非zh系统
        $encode = mb_detect_encoding($username, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
        $username = mb_convert_encoding($username, 'UTF-8', $encode);

        //{hook a_my_empty_2}
        $User = M("User"); //实例用户模型
        $uid = $User->user_to_uid($username); //用户名转ID



        if(!$uid)
            return $this->message("不存在该用户");

        //{hook a_my_empty_3}
        $this->menu_action[$method] = 'active';
        $this->v('menu_action',$this->menu_action);

        if($method == 'index'){ //用户首页
            $forum= S("forum");
            $f= $forum-> get("*",array("forumg"=>NOW_UID));
            if(!$f)
            {       
            $f=0;
            } 
            else{

                $day=round(($f['ti']-time())/86400,1);
                if($day<=0)
                {
                    $day=0;
                }
                            $this->v('day',$day);
            }

            $data = $User->read($uid);
            $data['avatar'] = $this->avatar($data['user']);
            $this->v("title",$data['user']);
            $this->v('data',$data);
            $this->v('f',$f);
            $this->display('user_post');
        }elseif($method == 'thread'){ //用户主题
            //{hook a_my_empty_6}
            $data = $User->read($uid);
            $data['avatar'] = $this->avatar($data['user']);

            $Thread = M("Thread");
            $pageid=intval(isset($_GET['HY_URL'][3]) ? $_GET['HY_URL'][3] : 1) or $pageid=1;
            $thread_data = (array)$Thread->get_user_thread_list($uid,$pageid);

            foreach ($thread_data as &$v) {
                $v['atime'] =   $v['atime'];
                $v['avatar'] =$data['avatar'];
                $v['user']  = $data['user'];
                
            }
            //{hook a_my_empty_7}
            //print_r($thread_data);

            $count = $data['threads'];
    		$count = (!$count)?1:$count;
    		$page_count = ($count % 10 != 0)?(intval($count/10)+1) : intval($count/10);
            //{hook a_my_empty_8}
            $this->v("title",$data['user']);
            $this->v("pageid",$pageid);
    		$this->v("page_count",$page_count);
            $this->v('thread_data',$thread_data);
            $this->v('data',$data);
            $this->display('user_thread');
        }elseif($method == 'post'){ //用户帖子
            //{hook a_my_empty_9}
               $forum= S("forum");
            $f= $forum-> get("*",array("forumg"=>NOW_UID));
            if(!$f)
            {       
            $f=0;
            } 
            else{

                $day=round(($f['ti']-time())/86400,1);
                if($day<=0)
                {
                    $day=0;
                }
                            $this->v('day',$day);
            }

            $data = $User->read($uid);
            $data['avatar'] = $this->avatar($data['user']);
            $this->v("title",$data['user']);
            $this->v('data',$data);
            $this->v('f',$f);
            $this->display('user_post');
        
        }elseif($method == 'op'){//用户配置
            //{hook a_my_empty_13}
            if(!IS_LOGIN)
                return $this->message("未登录，无法查看该页面");
            if(NOW_UID != $uid)
                return $this->message("你要改别人密码?");
            $data = $User->read($uid);
            $data['avatar'] = $this->avatar($data['user']);

            //{hook a_my_empty_133}
            $this->v('data',$data);
            $this->v("title","消息中心");
            $this->display('user_op');

        }elseif($method == 'file'){ //文件列表
            //{hook a_my_empty_16}
            if(!IS_LOGIN)
                return $this->message("未登录，无法查看你的消息");
            if(NOW_UID != $uid)
                return $this->message("你不能查看他人文件!");
            $data = $User->read($uid);
            $data['avatar'] = $this->avatar($data['user']);

            $File=S("File");
            $Filedata = $File->select(array('filename','md5name','filesize','atime'),array('uid'=>$uid));

            $filearr = array();
            if(is_dir(INDEX_PATH. "upload/userfile/".$uid."/")){
                if($dh = opendir(INDEX_PATH. "upload/userfile/".$uid."/")) {
                    while (($file = readdir($dh)) !== false){
                        
                        if($file!="." && $file!=".."){
                            $filearr[]=$file;
                            
                        }
                    }
                }
            }
            //{hook a_my_empty_17}
            $this->v("filearr",$filearr);
            $this->v("Filelist",$Filedata);
            $this->v('data',$data);
            $this->v("title","我的文件");
            $this->display('user_file');
        }
        //{hook a_my_empty_18}


    }
    //{hook a_my_fun}
}
