<?php
namespace TpFinal;
include 'Boleto.php';
class Tarjeta {
public $saldo;      //lo pongo public nomas porque sino  falla el test
public $saldoAcumulado; //lo pongo public nomas porque sino  falla el test
public $id;     //lo pongo public nomas porque sino  falla el test
public $fechaanterior;
protected $diaanterior;
public $tipo;       //lo pongo public nomas porque sino  falla el test
public $fechatras;
protected $diasemana;
protected $linea_anterior;
    public function __construct($id,$tipotarjeta){
    $this->saldo=0;
    $this->id=$id;
    $this->tipo=$tipotarjeta;
    $this->saldoAcumulado=0;
    $this->fechaanterior=new DateTime("now");
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
    public function getTipo(){
     return $this->tipo;   
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
    public function Viaje($transporte){ 
        if( (is_a($transporte,'Colectivo')) ){
			print "entra el if is_a\n";
            $this->fechatras = new \DateTime ("now");
            $this->diasemana = date('N');
            $h=date('G');
            $diff = ($this->fechaanterior)->diff($this->fechatras);
            
            if($this->linea_anterior != $transporte->linea){
				print "comillas no es igual que la linea\n";
                $this->linea_anterior= $transporte->linea;
             
                if( ((( ($this->diasemana>6) && ($this->h>=6 && $this->h<=22) ) || ( ($this->diasemana==6) && ($this->h>=6 && $this->h<=14))) && ( ( (($diff->h) * 60) + $diff->i) >= 60) || ( ( (($diff->h) * 60) + $diff->i) >= 90)) ){
                    $this->Trasbordo();
                }
			}
            else{
                if ($this->tipo == "Medio"){
                    $this->Medio();
                }
                else{
                $this->Normal();
                }
            }
		}
        if(is_a($transporte,'Bicicleta') ) {
            $this->viajeBici();
            }
}
    public function Normal(){
        $p  = $this->saldo - $this->saldoAcumulado - 9.70;
            if($p<0) {
                $this->ViajePlus();
            }
            else {
            $this->saldo = $p;
            $this->saldoAcumulado = 0;
            $this->fechaanterior=$this->fechatras;
            $this->diaanterior=$this->diasemana;
        }
       }
    public function Trasbordo () {
	if ($this->tipo == "Medio"){
		$p  = $this->saldo - $this->saldoAcumulado - 1.60;
	}
	else {
		$p  = $this->saldo - $this->saldoAcumulado - 3.20;
	}
	if( $p<0 ) {
		echo "No tiene saldo suficiente para pagar trasbordo. Se realizará un viaje plus";
		$this->ViajePlus();
	}
	else{
		$this->saldo = $p;
		$this->saldoAcumulado = 0;
	}
	}
    public function ViajePlus() {
        if($this->saldoAcumulado < (9.70*2)){
            $this->saldoAcumulado= $this->saldoAcumulado + 9.70;
            $this->fechaanterior=$this->fechatras;
            $this->diaanterior=$this->diasemana;
        }
        else {
            return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
        }
    }
    
    public function viajeBici(){
        if($fechaantbici==" "|| ($fecha->diff($fechaantbici))->d != 0){
            $this->saldo = $this->saldo - 12.45;
            $this->fechaanterior=$this->fecha;
            $this->horaanterior=$this->hora;
        }
		$this->getBoleto();
    
    }
}
