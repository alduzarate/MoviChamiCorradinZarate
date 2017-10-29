<?php
<?php
namespace TpFinal;
class Boleto{
	protected $dia;
	protected $fecha;
	protected $hora;
	protected $tipoboleto;
	protected $saldo;
	protected $saldoAcumulado;
	protected $linea;
	protected $id_tarj;
	public function __construct(Tarjeta $tar, $tipoboleto, $linea, $saldoac = 0){
		$this->dia = date ('N');
		$this->fecha = date('d-m-Y');
		$this->tar->tipoboleto= $t;
		$this->hora = date('H:m:s');
		$this->tar->saldoAcumulado = $saldoac;
		$this->linea = $linea;
	}

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipoboleto. "\nLINEA DE COLECTIVO: ". $this->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}
	
	public function Normal(){
		$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 9.70;
		if($p<0){
			ViajePlusNormal();
		}
		else{
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
		}
		$this->tar->fechaanterior=$this->fecha;
		$this->tar->horaanterior=$this->hora;
		$this->tar->lineaanterior=$this->linea;
	}
	public function Medio(){
		$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 4.35;
		if($p<0){
			ViajePlusMedio();
		}
		else{ 
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
			$this->tar->fechaanterior=$this->fecha;
			$this->tar->horaanterior=$this->hora;
			$this->tar->lineaanterior=$this->linea;
		}
	}
	
	public function Trasbordo () {
		
	}

	public function ViajePlusNormal(){
		if($this->tar->saldoAcumulado < (9.70*2)){
			$this->tar->saldoAcumulado= $this->tar->saldoAcumulado + 9.70;
			$this->tar->fechaanterior=$this->fecha;
			$this->tar->horaanterior=$this->hora;
			$this->tar->lineaanterior=$this->linea;
			}
		}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";}
	}
	
	public function ViajePlusMedio(){
		if($this->tar->saldoAcumulado < (4.35*2)){
			$this->tar->saldoAcumulado= $this->tar->saldoAcumulado + 4.35;
			$this->tar->fechaanterior=$this->fecha;
			$this->tar->horaanterior=$this->hora;
			$this->tar->lineaanterior=$this->linea;
			}
		}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";}


	}

}
