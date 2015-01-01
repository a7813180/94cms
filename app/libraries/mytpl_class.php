<?php
    /**
	 94cms 模板引擎
	*/
	class mytpl_class{
		public $template_dir = TMPATH;       //定义模板文件存放的目录  
		public $compile_dir = TMCPATH;      //定义通过模板引擎组合后文件存放目录
	    private $tpl_vars = array();              //内部使用的临时变量
		
        /** 
			将PHP中分配的值会保存到成员属性$tpl_vars中，用于将板中对应的变量进行替换  
			@param	string	$tpl_var	需要一个字符串参数作为关联数组下标，要和模板中的变量名对应    
			@param	mixed	$value		需要一个标量类型的值，用来分配给模板中变量的值  	
		*/
		function assign($tpl_var, $value = null) {   
			if ($tpl_var != '')                   
				$this->tpl_vars[$tpl_var] = $value;
		}
		
        /** 
			加载指定目录下的模板文件，并将替换后的内容生成组合文件存放到另一个指定目录下
			@param	string	$fileName	提供模板文件的文件名                                         	
		*/
        function view($fileName,$data=null) { 
			/* 到指定的目录中寻找模板文件 */
			$tplFile = $this->template_dir.DS.$fileName;  
			/* 如果需要处理的模板文件不存在,则退出并报告错误 */
			if(!file_exists($tplFile)) {               	
		       show_error('模板文件'.$fileName.'不存在！请创建');
		       die;
			}
            /* 获取组合的模板文件，该文件中的内容都是被替换过的 */
			$comFileName = $this->compile_dir."/94cms_".$fileName.'.php';  
            /* 判断替换后的文件是否存在或是存在但有改动，都需要重新创建 */
			if(!file_exists($comFileName) || filemtime($comFileName) < filemtime($tplFile)) {
				/* 调用内部替换模板方法 */
				$repContent = $this->template_parse(file_get_contents($tplFile));  
				/* 保存由系统组合后的脚本文件 */
				file_put_contents($comFileName, $repContent);
			}
			/* 包含处理后的模板文件输出给客户端 */
		    if(empty($data)){
			 	return ('index'."/94cms_".$fileName.'.php'); 
			 }else{
			 	return ("94cms_".$fileName.'.php'); 
			 }   	
		}
        
        
        /** 
            加载指定目录下的模板文件，并将替换后的内容生成组合文件存放到另一个指定目录下
            @param  string  $fileName   提供模板文件的文件名                                          
        */
        function wap_view($fileName,$data=null) { 
            /* 到指定的目录中寻找模板文件 */
            $tplFile = $this->template_dir.DS.'wap'.DS.$fileName;  
            /* 如果需要处理的模板文件不存在,则退出并报告错误 */
            if(!file_exists($tplFile)) {                
               show_error('模板文件目录'.$fileName.'不存在！请手动创建');
               die;
            }
            /* 获取组合的模板文件，该文件中的内容都是被替换过的 */
            $comFileName = $this->compile_dir."/94cms_wap_".$fileName.'.php';  
            /* 判断替换后的文件是否存在或是存在但有改动，都需要重新创建 */
            if(!file_exists($comFileName) || filemtime($comFileName) < filemtime($tplFile)) {
                /* 调用内部替换模板方法 */
                $repContent = $this->template_parse(file_get_contents($tplFile));  
                /* 保存由系统组合后的脚本文件 */
                file_put_contents($comFileName, $repContent);
            }
            /* 包含处理后的模板文件输出给客户端 */
            if(empty($data)){
                return ('index'."/94cms_wap_".$fileName.'.php'); 
             }else{
                return ("94cms_wap_".$fileName.'.php'); 
             }      
        }
        	   /**
     * 解析模板
     *
     * @param $str    模板内容
     * @return ture
     */
    public function template_parse($str) {
        $str = preg_replace ( "/\{load\s+(.+)\}/", "<?php include \$this->mytpl_class->view('\\1',true); ?>", $str );
        $str = preg_replace ( "/\{wapload\s+(.+)\}/", "<?php include \$this->mytpl_class->wap_view('\\1',true); ?>", $str );
        $str = preg_replace ( "/\{PUBLIC\}/", "<?php echo base_url('template/'.C('template')).'/'; ?>", $str );
        $str = preg_replace ( "/\{include\s+(.+)\}/", "<?php include \\1; ?>", $str );
        $str = preg_replace ( "/\{view\s+(.+)\}/", "<?php \$this->load->view(\\1); ?>", $str );
        $str = preg_replace ( "/\{php\s+(.+)\}/", "<?php \\1?>", $str );
        $str = preg_replace("/\{click\}/", "<script type='text/Javascript' src='<?php echo site_url().'/show/click/'.\$cid.'/'.\$id ;?>'> </script>", $str);
        //alex fix

        $str = preg_replace ( "/\{{if\s+(.+?)\}}/", "``if \\1``", $str );
        $str = preg_replace ( "/\{{else\}}/", "``else``", $str );
        $str = preg_replace ( "/\{{\/if\}}/", "``/if``", $str );

        $str = preg_replace ( "/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $str );
        $str = preg_replace ( "/\{else\}/", "<?php } else { ?>", $str );
        $str = preg_replace ( "/\{elseif\s+(.+?)\}/", "<?php } elseif (\\1) { ?>", $str );
        $str = preg_replace ( "/\{\/if\}/", "<?php } ?>", $str );

        //for 循环
        $str = preg_replace("/\{for\s+(.+?)\}/","<?php for(\\1) { ?>",$str);
        $str = preg_replace("/\{\/for\}/","<?php } ?>",$str);
        //++ --
        $str = preg_replace("/\{\+\+(.+?)\}/","<?php ++\\1; ?>",$str);
        $str = preg_replace("/\{\-\-(.+?)\}/","<?php ++\\1; ?>",$str);
        $str = preg_replace("/\{(.+?)\+\+\}/","<?php \\1++; ?>",$str);
        $str = preg_replace("/\{(.+?)\-\-\}/","<?php \\1--; ?>",$str);
        //alex fix
        $str = preg_replace ( "/\``if\s+(.+?)\``/", "{{if \\1}}", $str );
        $str = preg_replace ( "/\``else``/", "{{else}}", $str );
        $str = preg_replace ( "/\``\/if\``/", "{{/if}}", $str );

        $str = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\}/", "<?php \$n=1;if(is_array(\\1)) foreach(\\1 AS \\2) { ?>", $str );
        $str = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php  if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>", $str );
        $str = preg_replace ( "/\{\/loop\}/", "<?php } ?>", $str );
        $str = preg_replace ( "/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $str );
        $str = preg_replace ( "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $str );
        $str = preg_replace ( "/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $str );
        $str = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "\$this->addquote('<?php echo \\1;?>')",$str);
        $str = preg_replace ( "/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $str );
        $str = preg_replace("/\{pc:(\w+)\s+([^}]+)\}/ie", "self::pc_tag('$1','$2')", $str);
        $str = preg_replace("/\{\/pc\}/ie", "self::end_pc_tag()", $str);
        $str = "<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>" . $str;
        return $str;
    }

   /**
     * 转义 // 为 /
     *
     * @param $var    转义的字符
     * @return 转义后的字符
     */
    public function addquote($var) {
        return str_replace ( "\\\"", "\"", preg_replace ( "/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var ) );
    }


    /**
     * 解析PC标签
     * @param string $op 操作方式
     * @param string $data 参数
     * @param string $html 匹配到的所有的HTML代码
     */

        public static function pc_tag($op, $data) {
        preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($data), $matches, PREG_SET_ORDER);
        $arr = array('action','num','page','return', 'start');
        $tools = array('json', 'xml', 'block', 'get');
        $datas = array();
        foreach ($matches as $v) {
            if(in_array($v[1], $arr)) {
                $$v[1] = $v[2];
                continue;
            }
            $datas[$v[1]] = $v[2];
        }
        $str = '';
        $num = isset($num) && intval($num) ? intval($num) : 10;
        $return = isset($return) && trim($return) ? trim($return) : 'data';
        isset($datas['order'])? '' : $datas['order'] = 'DESC';
        if(!isset($action) || empty($action)) return false;

            if (file_exists(APPPATH.'libraries'.DIRECTORY_SEPARATOR.$op.'_tag.php')) {
                $str .= 'if(!isset($CI))$CI =& get_instance();$CI->load->library("'.$op.'_tag");if (method_exists($CI->'.$op.'_tag, \''.$action.'\')) {';    
                $datas['num'] = $num;
                $str .= '$'.$return.' = $CI->'.$op.'_tag->'.$action.'('.self::arr_to_html($datas).');';
                $str .= '}';
            } 
         if (isset($page)) {
            $wap = isset($datas['wap']) ?  ",TRUE" : '';

             $str .= '$total = $CI->'.$op.'_tag->'.$action.'('.self::arr_to_html($datas).',true);';
             $str .= '$page'.' = $CI->'.$op.'_tag->page'.'($ename,$cid,$pagenum,$total,'.$num.','.$page.$wap.');';
        }
  
        return "<"."?php ".$str."?".">";
    }



    /**
     * PC标签结束
     */
    static private function end_pc_tag() {
        return '<?php if(isset($data))unset($data);?>';
    }

    /**
     * 转换数据为HTML代码
     * @param array $data 数组
     */
    private static function arr_to_html($data) {
        if (is_array($data)) {
            $str = 'array(';
            foreach ($data as $key=>$val) {
                if (is_array($val)) {
                    $str .= "'$key'=>".self::arr_to_html($val).",";
                } else {
                    if (strpos($val, '$')===0) {
                        $str .= "'$key'=>$val,";
                    } else {
                        $str .= "'$key'=>'".self::new_addslashes($val)."',";
                    }
                }
            }
            return $str.')';
        }
        return false;
    }

    /**
     * 返回经addslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
    function new_addslashes($string){
        if(!is_array($string)) return addslashes($string);
        foreach($string as $key => $val) $string[$key] = new_addslashes($val);
        return $string;
    }





}

 
