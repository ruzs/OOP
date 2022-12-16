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

/* $cat=new Animal;
$dog=new Animal;

$cat->run();
echo $cat->type;
$cat->speed(); */


/* 建構式的使用
*/
$cat =new Animal('小花','黑白相間');
echo $cat->getName();
echo $cat->getColor();

$dog =new Animal('小莉','土黃色');
echo $dog->getName();
echo $dog->getColor();

$turtle =new Animal('達文西','墨綠色');
echo $turtle->getName();
echo $turtle->getColor();

$guineapig =new Animal('puipui','黃色');
echo $guineapig->getName();
echo $guineapig->getColor();
class Animal{
    protected $type='animal';
    protected $name='John';
    protected $hair_color="brown";

    public function __construct($name,$color)
    {
        //$this->run();
        $this->name=$name;
        $this->hair_color=$color;

    }

    public function getName()
    {
        return $this->name;
    }
    public function getColor()
    {
        return $this->hair_color;
    }

    public function run()
    {
        echo "我會跑哦";
        $this->speed();
        echo $this->type;
    }

    private function speed(){
        echo "我會加速哦";
    }

}



?>