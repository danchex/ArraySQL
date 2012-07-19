<?php
//测试|演示入口

require_once('./library/ArraySQL.class.php');
$array = array(
	array('name' => 'danchex', 'age' => 26, 'sort' => 1),
	array('name' => 'scropio', 'age' => 23, 'sort' => 3),
	array('name' => 'wickey', 'age' => 24, 'sort' => 5),
	array('name' => 'danchex', 'age' => 33, 'sort' => 4),
	array('name' => 'nation', 'age' => 24, 'sort' => 3)
);

$arraysql = new ArraySQL($array);
$arraysql->row('sort')->order('sort', 'DESC')->output();