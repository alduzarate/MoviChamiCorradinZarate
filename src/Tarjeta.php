<?php

namespace TpFinal;
class Tarjeta {
protected $saldo;
protected $id;
protected $fechaanterior;
protected $horaanterior;
    public function __construct($id, $tipo){
    if (in_array (array("Normal", "MedioBoleto"), $tipo)){
        $this->tipo = $tipo;
    }
    else {
        echo "El tipo de tarjeta no existe \n";
    }       
    $this->saldo=0;
    $this->id=$id;
    }
    public function saldo() {
        return 0;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    public function getId(){
     return $this->id;   
    }
    public function cargar($monto){
      if($monto==332){
        $this->saldo+=388;
      }
      elseif($monto==624){
       $this->saldo+=776;   
      }
    else{    
    $this->saldo+=$monto;
    }
  }

  public function Viaje(Tarjeta $tar){
    $b = new Boleto();
    if($b->tipo == "Normal"){
      $b->Normal();
    }
    if($b->tipo == "MedioBoleto"){
      $b->Medio();
    }
    else{
      return "Tipo de viaje invalido."
    }
  }
}
?>
