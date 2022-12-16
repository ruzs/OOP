<?php


/* $cat=new Animal;

$dog=new Animal;

echo $cat->type;
echo "<br>";
echo $dog->name; */

/* 權限為public時，可以對成員做修改
 $cat->type='snake';
$dog->name='mack';
echo "<br>";
echo $cat->type;
echo "<br>";
echo $dog->name; */

/* echo "<pre>";
var_dump($cat);
echo "</pre>";
 */

class Animal{
    public $type='animal';
    public $name='John';
    public $hair_color="brown";

    public function __constructor(){
        //建構式內容
    }

    public function run(){
        echo "我會跑哦";
    }

    private function speed(){
        echo "我會叫哦";
    }

}



?>