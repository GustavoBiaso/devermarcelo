<?php
spl_autoload_register( null , false);
spl_autoload_extensions(".php");


 function classLoader($class) {
  $nomeArquivo = $class . ".php";
  $pastas = array("controller", "model") ;
  foreach ($pastas as $pasta) {
    $arquivo = "{$pasta}/{$nomeArquivo}";
    if (file_exists($arquivo)) {
      require_once $arquivo;
    }
  }
}

  function ConverteData($date){
    if(strpos($date, '-')){
      $dataConvertida = implode("/",array_reverse(explode("-", $date)));
      return $dataConvertida;
    } else {
      $dataConvertida = implode("-",array_reverse(explode("/", $date)));
      $dataConvertida = "'". $dataConvertida ."'";
      return $dataConvertida;
    }
  }

 spl_autoload_register("classLoader", "ConverteData");

 class Aplicacao {

 public static function run(){
  $layout = new Template("view/layout.html");
  $conteudo["msg"] = "";
  if (!isset($_GET["acao"]) ) {
    $class = "Inicio";
  } else {
    $class = $_GET["acao"];
  }
    if (class_exists($class)) {
      $pagina = new $class;
      if (isset($_GET["metodo"])) {
        $metodo = $_GET["metodo"];
        if (method_exists($pagina, $metodo)) {
          $conteudo = $pagina->$metodo();
        }
      } else {
        $conteudo = $pagina -> controller();
      }
    }
  $layout -> set("conteudo", $conteudo["msg"]);
  echo $layout -> saida();
  }
 }

 Aplicacao::run();
 ?>