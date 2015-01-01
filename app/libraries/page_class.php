<?php
/**
* 前台分页类

  function minupage($array)     : 构造函数，参数( 数组(total总页数，perpage每页显示行数，nowindex当前页,url地址,ajax模式) ) 

使用案例：
$num=20;                          //设置每页显示的记录数
$p=isset($_GET['p'])?intval($_GET['p']):1;    //获得传递的值，为空时即为零
$total=newsSum($sort);       //获得的记录总条数            
$page=new minupage(array('total'=>$total,'perpage'=>$num));    //调用分页类
$p_start=($p-1) * $num;           //计算当页开始的记录数    
$sumpage=&$page->sumPage($total,$num);  //总页数

<?php echo $p?>/<?php echo $sumpage?>页 共<?php echo $total?>条记录，<?php echo $num?>条/页，<?php echo $page->show(4);?>   显示为   11/20 页次 共400条记录 20条/页  上一页 11 12 13 14 15 下一页




require_once('../libs/classes/page.class.php');
$page=new minupage(array('total'=>1000,'perpage'=>20));
echo 'mode:1<br>'.$page->show();
echo '<hr>mode:2<br>'.$page->show(2);
echo '<hr>mode:3<br>'.$page->show(3);
echo '<hr>mode:4<br>'.$page->show(4);
echo '<hr>开始AJAX模式:';
$ajaxpage=new minupage(array('total'=>1000,'perpage'=>20,'ajax'=>'ajax_page','page_name'=>'test'));
echo 'mode:1<br>'.$ajaxpage->show();
*/
class Page_class 
{
/**
   * config ,public
   */
var $page_name="p";//page标签，用来控制url页。比如说xxx.php?PB_page=2中的PB_page
var $next_page='>';//下一页
var $pre_page='<';//上一页
var $first_page='First';//首页
var $last_page='Last';//尾页
var $pre_bar='<<';//上一分页条
var $next_bar='>>';//下一分页条
var $format_left='';
var $format_right='';
var $is_ajax=false;//是否支持AJAX分页模式 

/**
   * private
   *
   */ 
var $pagebarnum=5;//控制记录条的个数。
var $totalpage=0;//总页数
var $ajax_action_name='';//AJAX动作名
var $nowindex=1;//当前页
var $url="";//url地址头
var $offset=0;

/**
   * constructor构造函数
   *
   * @param array $array['total'],$array['perpage'],$array['nowindex'],$array['url'],$array['ajax']...
   */
function minupage($array)
{
   if(is_array($array)){
     if(!array_key_exists('total',$array))$this->error(__FUNCTION__,'need a param of total');
     $total=intval($array['total']);
     $perpage=(array_key_exists('perpage',$array))?intval($array['perpage']):10;
     $nowindex=(array_key_exists('nowindex',$array))?intval($array['nowindex']):'';
     $url=(array_key_exists('url',$array))?$array['url']:'';
   }else{
     $total=$array;
     $perpage=10;
     $nowindex='';
     $url='';
   }
   if((!is_int($total))||($total<0))$this->error(__FUNCTION__,$total.' is not a positive integer!');
   if((!is_int($perpage))||($perpage<=0))$this->error(__FUNCTION__,$perpage.' is not a positive integer!');
   if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//设置pagename
   $this->_set_nowindex($nowindex);//设置当前页
   $this->_set_url($url);//设置链接地址
   $this->totalpage=ceil($total/$perpage);
   $this->offset=($this->nowindex-1)*$perpage;
   if(!empty($array['ajax']))$this->open_ajax($array['ajax']);//打开AJAX模式
}
/**
   * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
   *
   * @param string $var
   * @param string $value
   */
function set($var,$value)
{
   if(in_array($var,get_object_vars($this)))
     $this->$var=$value;
   else {
   $this->error(__FUNCTION__,$var." does not belong to PB_Page!");
   }
  
}
/**
   * 打开倒AJAX模式
   *
   * @param string $action 默认ajax触发的动作。
   */
function open_ajax($action)
{
   $this->is_ajax=true;
   $this->ajax_action_name=$action;
}
/**
   * 获取显示"下一页"的代码
   * 
   * @param string $style
   * @return string
   */
function next_page($style='')
{
   if($this->nowindex<$this->totalpage){
   return $this->_get_link($this->_get_url($this->nowindex+1),$this->next_page,$style);
   }
   return '<span class="'.$style.'">'.$this->next_page.'</span>';
}

/**
   * 获取显示“上一页”的代码
   *
   * @param string $style
   * @return string
   */
function pre_page($style='')
{
   if($this->nowindex>1){
   return $this->_get_link($this->_get_url($this->nowindex-1),$this->pre_page,$style);
   }
   return '<span class="'.$style.'">'.$this->pre_page.'</span>';
}

/**
   * 获取显示“首页”的代码
   *
   * @return string
   */
function first_page($style='')
{
   if($this->nowindex==1){
       return '<span class="'.$style.'">'.$this->first_page.'</span>';
   }
   return $this->_get_link($this->_get_url(1),$this->first_page,$style);
}

/**
   * 获取显示“尾页”的代码
   *
   * @return string
   */
function last_page($style='')
{
   if($this->nowindex==$this->totalpage){
       return '<span class="'.$style.'">'.$this->last_page.'</span>';
   }
   return $this->_get_link($this->_get_url($this->totalpage),$this->last_page,$style);
}

function nowbar($style='',$nowindex_style='hot')
{
   $plus=ceil($this->pagebarnum/2);
   if($this->pagebarnum-$plus+$this->nowindex>$this->totalpage)$plus=($this->pagebarnum-$this->totalpage+$this->nowindex);
   $begin=$this->nowindex-$plus+1;
   $begin=($begin>=1)?$begin:1;
   $return='';
   for($i=$begin;$i<$begin+$this->pagebarnum;$i++)
   {
   if($i<=$this->totalpage){
     if($i!=$this->nowindex)
         $return.=$this->_get_text($this->_get_link($this->_get_url($i),$i,$style));
     else 
         $return.=$this->_get_text('<span class="'.$nowindex_style.'">'.$i.'</span>');
   }else{
     break;
   }
   $return.="\n";
   }
   unset($begin);
   return $return;
}
/**
   * 获取显示跳转按钮的代码
   *
   * @return string
   */
function select($url)
{
   $return='<select name=";PB_Page_Select"  onChange=open_select(this)>';
   for($i=1;$i<=$this->totalpage;$i++)
   {
   if($i==$this->nowindex){
     $return.='<option value='.$url.$i.' selected>'.$i.'</option>';
   }else{
     $return.='<option value='.$this->_get_url($i).'>'.$i.'</option>';
   }
   }
   unset($i);
   $return.='</select>';
   return $return;
}

/**
   * 获取mysql 语句中limit需要的值
   *
   * @return string
   */
function offset()
{
   return $this->offset;
}

/**
   * 控制分页显示风格（你可以增加相应的风格）
   *
   * @param int $mode
   * @return string
   */
function show($mode=1,$url='')
{
   switch ($mode)
   {
   case '1':
     if($this->totalpage == 1){
      return '';
     }else{
      $this->next_page='下一页';
      $this->pre_page='上一页';
     return $this->pre_page().$this->nowbar().$this->next_page().'第'.$this->select($url).'页';
      }
     break;
   case '2':
     $this->next_page='下一页';
     $this->pre_page='上一页';
     $this->first_page='首页';
     $this->last_page='尾页';
     return $this->first_page().$this->pre_page().'[第'.$this->nowindex.'页]'.$this->next_page().$this->last_page().'第'.$this->select($url).'页';
     break;
   case '3': 
     if($this->totalpage == 1){
      return '';
     }else{
     $this->next_page='下一页';
     $this->pre_page='上一页';
     $this->first_page='首页';
     $this->last_page='尾页';
     return $this->first_page().$this->pre_page().$this->next_page().$this->last_page();
     }
     break;
   case '4':
     if($this->totalpage == 1){
      return '';
     }else{
     $this->next_page='下一页';
     $this->pre_page='上一页';
     return $this->pre_page().$this->nowbar().$this->next_page();
     }
     break;
   case '5':
     if($this->totalpage == 1 || $this->totalpage ==0){
      return '';
     }else{
     $this->next_page='下一页';
     $this->pre_page='上一页';
     $this->first_page='首页';
     $this->last_page='尾页';
 
     return $this->first_page().$this->pre_page().$this->nowbar().$this->next_page().$this->last_page();
     }
     break;
   }
  
}
/*----------------private function (私有方法)-----------------------------------------------------------*/
/**
   * 设置url头地址
   * @param: String $url
   * @return boolean
   */
function _set_url($url="")
{
   if(!empty($url)){
       //手动设置
   $this->url=$url;
   }else{
       //自动获取
   if(empty($_SERVER['QUERY_STRING'])){
       //不存在QUERY_STRING时
     $this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";


   }else{
       //
     if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
         //地址存在页面参数
     $this->url=str_replace($this->page_name.'='.$this->nowindex,'',$_SERVER['REQUEST_URI']);
     $last=$this->url[strlen($this->url)-1];
     if($last=='?'||$last=='&'){
         $this->url.=$this->page_name."=";
     }else{
         $this->url.='&'.$this->page_name."=";
     }
     }else{
         //
     $this->url=$_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';


     }//end if    
   }//end if
   }//end if
}

/**
   * 设置当前页面
   *
   */
function _set_nowindex($nowindex)
{
   if(empty($nowindex)){
   //系统获取
   
   if(isset($_GET[$this->page_name])){
     $this->nowindex=intval($_GET[$this->page_name]);
   }
   }else{
       //手动设置
   $this->nowindex=intval($nowindex);
   }
}
  
/**
   * 为指定的页面返回地址值
   *
   * @param int $pageno
   * @return string $url
   */
function _get_url($pageno=1)
{
   return $this->url.$pageno;
}

/**
   * 获取分页显示文字，比如说默认情况下_get_text('<a href="">1</a>')将返回[<a href="">1</a>]
   *
   * @param String $str
   * @return string $url
   */ 
function _get_text($str)
{
   return $this->format_left.$str.$this->format_right;
}

/**
   * 获取链接地址
*/
function _get_link($url,$text,$style=''){
 

   if(config_item('url')==3 && strpos($url,'wap/') ===false){
     $url = '/'. config_item('html_path').'/'.$url.'.html';
     
   }else{
     $url= site_url($url);
   }
   $style=(empty($style))?'':'class="'.$style.'"';
   if($this->is_ajax){
       //如果是使用AJAX模式
   return '<a '.$style.' href="javascript:'.$this->ajax_action_name.'(\''.$url.'\')">'.$text.'</a>';
   }else{
   
   return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
   
   }
}





/**
   * 出错处理方式
*/
function error($function,$errormsg)
{
     die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
}

/*
 * 计算前台页面的总页数
 * @param total  总记录数
 * @param num    每页的记录数
*/
function sumPage($total,$num)
{
  $nn=0;
  $nn=intval($total/$num);
  if((int)($total%$num)!=0)
  {
     $nn=$nn+1;
  } 
  return $nn;
}

}
?>