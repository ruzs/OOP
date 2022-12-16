<?php


/* 成員的使用
 $cat=new Animal;

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

//方法的使用

$cat=new Animal;
$dog=new Animal;

$cat->run();
echo $cat->type;
$cat->speed();

class Animal{
    protected $type='animal';
    protected $name='John';
    protected $hair_color="brown";

    public function __constructor(){
        //建構式內容
    }

    public function run(){
        echo "我會跑哦";
        $this->speed();
        echo $this->type;
    }

    private function speed(){
        echo "我會加速哦";
    }

}



?>