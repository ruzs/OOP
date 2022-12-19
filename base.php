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
// avg
echo $Student->count();
echo "<br>";
echo $Student->sum('graduate_at');
echo "<hr>";
echo $Student->sum('graduate_at',['dept'=>2]);
echo "<br>";
$Score=new DB("student_scores");
echo $Score->max('score');
echo "<hr>";
echo $Score->min('score');
echo "<hr>";
echo $Score->avg('score');
echo "<hr>";

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
      echo "<br>";
      return $this->pdo->exec($sql);
    }
  }
  function count(...$arg){
    $sql=$this->mathSql('count',"*",$arg);
    echo $sql;
    echo "<br>";
    return $this->pdo->query($sql)->fetchColumn();
  }
  function sum($col,...$arg){
    $sql=$this->mathSql('sum',$col,$arg);
    echo $sql;
    echo "<br>";
    return $this->pdo->query($sql)->fetchColumn();
  }
  function max($col,...$arg){
    $sql=$this->mathSql('max',$col,$arg);
    echo $sql;
    echo "<br>";
    return $this->pdo->query($sql)->fetchColumn();
  }
  function min($col,...$arg){
    $sql=$this->mathSql('min',$col,$arg);
    echo $sql;
    echo "<br>";
    return $this->pdo->query($sql)->fetchColumn();
  }
  function avg($col,...$arg){
    $sql=$this->mathSql('avg',$col,$arg);
    echo $sql;
    echo "<br>";
    return $this->pdo->query($sql)->fetchColumn();
  }
  private function mathSql($math,$col,...$arg){
    if(isset($arg[0][0])){
      foreach($arg[0][0] as $key => $value){
        $tmp[]="`$key`='$value'";
      }
      $sql="select $math($col) from $this->table where ";
      $sql.=join(" && ",$tmp);
    }else{
      $sql="select $math($col) from $this->table";
    }
    return $sql;
  }
  function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
  }
}
?>