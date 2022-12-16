<?php 

$Student=new DB('students');

//var_dump($Student);

$stus=$Student->all();
foreach($stus as $stu){
    echo $stu['parents'];
    echo "<br>";
}


class DB{
    protected $table;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    protected $pdo;

    public function __construct($table)
    {
        $this->pdo=new PDO($this->dsn,'root','');
        $this->table=$table;
    }


    public function all(...$arg){
/*
  原本函式all()的內容
global $pdo;
    $sql="select * from $table ";
    if(isset($args[0])){
        if(is_array($args[0])){
            //是陣列 ['acc'=>'mack','pw'=>'1234'];
            //是陣列 ['product'=>'PC','price'=>'10000'];
            foreach($args[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql=$sql ." WHERE ". join(" && " ,$tmp);
        }else{
            //是字串
            $sql=$sql . $args[0];
        }
    }
    if(isset($args[1])){
        $sql = $sql . $args[1];
    }
    //echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); */

    $sql="select * from $this->table ";

    if(isset($args[0])){
        if(is_array($args[0])){
            //是陣列 ['acc'=>'mack','pw'=>'1234'];
            //是陣列 ['product'=>'PC','price'=>'10000'];

            foreach($args[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql=$sql ." WHERE ". join(" && " ,$tmp);
        }else{
            //是字串
            $sql=$sql . $args[0];
        }
    }

    if(isset($args[1])){
        $sql = $sql . $args[1];
    }

    echo $sql;
    return $this->pdo
                ->query($sql)
                ->fetchAll(PDO::FETCH_ASSOC);

    }

}
?>