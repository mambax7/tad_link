<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2011-11-14
// $Id:$
// ------------------------------------------------------------------------- //

//區塊主函式 (好站推薦快速連結(tad_link_all))
function tad_link_all($options){
  global $xoopsDB;

	$block="";
	$and_cate=empty($options[1])?"":"where cate_sn in({$options[1]})";
	$sql = "select * from ".$xoopsDB->prefix("tad_link_cate")." $and_cate order by of_cate_sn,cate_sort";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while($all=$xoopsDB->fetchArray($result)){
	  //以下會產生這些變數： $cate_sn , $of_cate_sn , $cate_title , $cate_sort
    foreach($all as $k=>$v){
      $$k=$v;
    }
    $color=cate_sn2color($cate_sn);
    
    $link_js=($options[0]==1)?"window.open(this.value,'_blank');":"location.href='".XOOPS_URL."/modules/tad_link/index.php?link_sn='+this.value";

    
  	$sql2 = "select * from ".$xoopsDB->prefix("tad_link")." where `cate_sn` = '{$cate_sn}' and enable='1' order by link_sort";
  	$result2 = $xoopsDB->query($sql2) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
    $total=$xoopsDB->getRowsNum($result2);
    if(empty($total))continue;


    $block.="
    <select onChange=\"{$link_js}\" style='background-color:{$color};' class='span12'>
    <option value=''>$cate_title</option>
    ";
    
  	while($all2=$xoopsDB->fetchArray($result2)){
  	  //以下會產生這些變數： $link_sn , $cate_sn , $link_title , $link_url , $link_desc , $link_sort , $link_counter , $unable_date , $uid , $post_date , $enable
      foreach($all2 as $k=>$v){
        $$k=$v;
      }
      $val=($options[0]==1)?$link_url:$link_sn;
      $block.="<option value='$val'>&#x2665; {$link_title}</option>";
    }
    $block.="</select>
    <br />";
    
  }
	return $block;
}

//區塊編輯函式
function tad_link_all_edit($options){

  include_once XOOPS_ROOT_PATH."/modules/tad_link/function_block.php";
	$chked0_0=($options[0]=="1")?"checked":"";
	$chked0_1=($options[0]=="0")?"checked":"";
	
	$menu=block_link_cate($options[1]);

	$form="{$menu['js']}
	"._MB_TADLINK_TAD_LINK_ALL_EDIT_BITEM0."
	<INPUT type='radio' $chked0_0 name='options[0]' value='1'>"._YES."
	<INPUT type='radio' $chked0_1 name='options[0]' value='0'>"._NO."

	"._MB_TADLINK_TAD_CATE_MENU."
	{$menu['form']}
	<INPUT type='hidden' name='options[1]' id='bb' value='{$options[1]}'>
	";
	return $form;
}

if(!function_exists('cate_sn2color')){
  //自動取得顏色
  function cate_sn2color($cate_sn=''){
    $R=$G=$B=255;
    $m=ceil($cate_sn/6);
    $n=$cate_sn % 6;
    $degree=intval($cate_sn)*3*$m;

    if($n==0){
      $R-=$degree;
    }elseif($n==1){
      $G-=$degree;
    }elseif($n==2){
      $B-=$degree;
    }elseif($n==3){
      $R-=$degree;
      $G-=$degree;
    }elseif($n==4){
      $R-=$degree;
      $B-=$degree;
    }elseif($n==5){
      $G-=$degree;
      $B-=$degree;
    }elseif($n==6){
      $R-=$degree;
      $G-=$degree;
      $B-=$degree;
    }

    return "rgb({$R},{$G},{$B})";
  }
}

?>