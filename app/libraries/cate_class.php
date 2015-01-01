<?php

/*********************************************************************************
* InitPHP 3.6 国产PHP开发框架  扩展类库-无限极分类
*-------------------------------------------------------------------------------
* 版权所有: CopyRight By initphp.com
* 您可以自由使用该源码，但是在使用过程中，请保留作者信息。尊重他人劳动成果就是尊重自己
*-------------------------------------------------------------------------------
* Author:zhuli Dtime:2014-9-3 
***********************************************************************************/
class Cate_class
{


    /*
    递归重新所有分类
    */

    function yi_wei($date, $pid = 0, $html = '&nbsp;&nbsp;&nbsp;&nbsp;', $level = 0)
    {
        $arr = array();
        foreach ($date as $key => $v) {

            if ($v['pid'] == $pid) {
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, $this->yi_wei($date, $v['id'], $html, $level + 1));

            }

        }
        return ($arr);
    }


    /**
     * 输入一个分类di 查询所有的下级ID
     * $cate 所有分类数组
     * $id  要查询的id
     */


    public function fu_cate($cate, $id)
    {
        $arr = array();
        foreach ($cate as $v) {

            if ($v['pid'] == $id) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, $this->fu_cate($cate, $v['id']));
            }
        }
        return $arr;
    }


    /**
     * 输入一个分类di 查询所有的下级所有内容
     * $cate 所有分类数组
     * $id  要查询的id
     */


    public function fu_cate_nr($cate, $id)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $id) {
                $v['x'] = $this->fu_cate_nr($cate, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }


    //查询本模型下面是有分类
    public function mid_cate($date, $mid, $pid = 0, $html =
        '&nbsp;&nbsp;&nbsp;&nbsp;', $level = 0)
    {
        $arr = array();
        foreach ($date as $key => $v) {

            if ($v['pid'] == $pid && $v['modelid'] == $mid) {
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, $this->yi_wei($date, $v['id'], $html, $level + 1));
            }
        }
        return ($arr);
    }


    //一维数组(同模型)(model = tablename相同)，删除其他模型的分类
    public function getLevelOfModel($cate, $tablename = 'news')
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['modelid'] == $tablename) {
                $arr[] = $v;
            }
        }
        return $arr;
    }


    /*
    * 组合数组无限极分类
    */
    public function zuhe_cate($cate, $pid = 0, $num = 10,$wap = null)
    {  
        $arr = array();
        $a = 1;
        foreach ($cate as $key => $v) {
            //url
            $v['url'] = list_url($v,$wap);
            $v['litpic'] = base_url($v['litpic']);
            //url
            if ($a <= $num) {
                if ($v['pid'] == $pid) {
                    $v['x'] = self::zuhe_cate($cate, $v['id'],$num,$wap);
                    $arr[] = $v;
                    $a++;
                }
            }
        }
        return $arr;
    }


    /**
     * 无限级分类树-获取父类
     * @param  array $tree 树的数组
     * @param  int   $id   子类ID
     * @return string|array
     */
    public function get_parent($cate,$id,$wap=null)
    {
       $arr=array();
        foreach ($cate as  $v){
            if ($v['id']==$id){
                $v['url'] = list_url($v,$wap); //引入list——url函数调用出分类url
                $arr[]=$v;
                $arr=array_merge(self::get_parent($cate, $v['pid']),$arr);
             } 
        }
       return $arr;
    }

    
    static public function get_tcid($cate,$id){
      
      $arr=array();
      foreach ($cate as  $v){
        if ($v['id']==$id){
        $arr=array_merge($arr,self::get_tcid($cate, $v['pid']));
          if($v['pid'] == '0') {$arr = $v;}
           } 
      }
       return $arr;
    }
    



}
