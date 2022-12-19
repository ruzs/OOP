<?php 

$Student=new DB('students');

//var_dump($Student);

// $john=$Student->find(30);
// echo $john['name']; 
// echo "<br>";


// $stus=$Student->all(['dept'=>3]);
// foreach($stus as $stu){
  //     echo $stu['parents'] . "=>".$stu['dept'];
  //     echo "<br>";
  // }
// 刪除資料
// $Student->del(10);
// $Student->del(['dept'=>1]);

// 新增資料
// $Student ->save(['name'=>'張大同','dept'=>'2','uni_id'=>'C100000218']);
// echo "<hr>";

//更新資料
// $Student->save(['name'=>'張大同','dept'=>2,'uni_id'=>"H22211223",'id'=>3]);
// $stu=$Student->find(15);
// dd($stu);
// $stu['name']="陳秋桂";
// $Student->save($stu);

// 數學函式
// count
// sum
// max
// min
// svg

class DB{
  protected $table;
  protected $dsn="mysql:host=localhost;charset=utf8;dbname=school";
  protected $pdo;

  public function __construct($table)
  {
      $this->pdo=new PDO($this->dsn,'root','');
      $this->table=$table;
  }


  public function all(...$args){
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
      return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    */
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
    echo "<br>";
    return $this->pdo
                ->query($sql)
                ->fetchAll(PDO::FETCH_ASSOC);

  }

  function find($id){
    $sql="select * from `$this->table` ";

    if(is_array($id)){
      foreach($id as $key => $value){
          $tmp[]="`$key`='$value'";
      }
      $sql = $sql . " where " . join(" && ",$tmp);
    }else{
      $sql=$sql . " where `id`='$id'";
    }
    echo $sql;
    echo "<br>";
    return $this->pdo
                ->query($sql)
                ->fetch(PDO::FETCH_ASSOC);
  }
  function del($id){
    $sql="delete from `$this->table` ";

    if(is_array($id)){
      foreach($id as $key => $value){
          $tmp[]="`$key`='$value'";
      }
      $sql = $sql . " where " . join(" && ",$tmp);
    }else{
      $sql=$sql . " where `id`='$id'";
    }

    echo $sql;
    echo "<br>";
    return $this->pdo->exec($sql);
  }
  function save($array){
    if(isset($array['id'])){
      //更新update
      foreach($array as $key => $value){
        /*if($key!='id'){
          $tmp[]="`$key`='$value'";
        } */
        if($key!='id'){
          $tmp[]="`$key`='$value'";
        }
      }
      $sql ="update $this->table set ";
      $sql .=join(",",$tmp);
      $sql .=" where `id`='{$array['id']}'";
    }else{
      //新增insert
      $cols=array_keys($array);
      $sql="insert into $this->table (`" . join("`,`",$cols) . "`) 
                               values('" . join("','",$array) . "')";
      echo $sql;
      return $this->pdo->exec($sql);
    }
  }

}
function dd($array){
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
?>