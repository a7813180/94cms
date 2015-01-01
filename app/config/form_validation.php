<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


$config = array(
    /*分类*/
   'cate' => array(
             array('field' => 'name','label' => '栏目名称','rules' => 'required|min_length[2]'),
             array('field' => 'sort','label' => '栏目顺序','rules' => 'required'),
             array('field' => 'pid','label' => '上级栏目','rules' => 'required'),
             array('field' => 'status','label' => '栏目状态','rules' => 'required'),
               ),
   //添加自定义字段
   'field'=>array(
		      array('field' => 'label','label' => '字段别名','rules' => 'required|min_length[2]'),
		   	  array('field' => 'field','label' => '字段表名','rules' => 'required|min_length[2]|alpha'),
		   	  array('field' => 'fieldtype','label' => '字段类型','rules' => 'required|min_length[1]'),
		      //array('field' => 'pattern','label' => '验证规则','rules' => 'required'),
		      array('field' => 'sort','label' => '字段顺序','rules' => 'required'),
		   	 ),
                  
   'page' => array(
             array('field' => 'name','label' => '单页名称','rules' => 'required|min_length[2]'),
               ),              
                  
                  
                  
             
      );




?>