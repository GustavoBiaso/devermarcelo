<?php
class Inicio
{
  public function controller()
  {
    $inicio = new Template("view/inicio.html");
    $inicio->set("inicio", "Cadastro de Usuários");
    $retorno["msg"] = $inicio->saida();
    return $retorno;
  }
}
