<?php
class loi_poisson
{
	private $parametre;
	private $k;
	private $k2;
	private $esperance;
	private $variance;
	private $ecart_type;
	private $error;
	private function factorielle($n)
	{
		$somme = 1;
		for ($i = 1; $i <= $n; $i++)
			$somme = $somme * $i;
		return $somme;
	}
	public function __construct($parametre, $k, $k2)
	{
		$this->error = 0;

		if (!is_numeric($parametre) or $parametre < 0)
			$this->error = 1;
		if (!is_numeric($k) or $k < 0)
			$this->error = 2;
		if (!is_numeric($k2) or $parametre < 0)
			$this->error = 3;
		if ($k > $k2)
			$this->error = 4;

		$this->parametre = $parametre;
		$this->k = $k;
		$this->k2 = $k2;
	}
	public function getResult()
	{
		if ($this->error == 0)
		{
			$this->esperance = $this->parametre;
			$this->variance = $this->parametre;
			$this->ecart_type = sqrt($this->parametre);
			$data = array();
			$e = 0;
			$somme = 0;
			for ($i = $this->k; $i <= $this->k2; $i++)
			{
				$result = (exp(-$this->parametre)* bcpow($this->parametre, $i)/($this->factorielle($i)));
				$data[$e][0] = $i;
				$data[$e][1] = $result;
				$e++;
				$somme = $somme + $result;
			}
			return array($data, $somme, $this->esperance, $this->variance, $this->ecart_type);
		}
		else
			return $this->error;
	}
	public function getK()
	{
		return $this->k;
	}
}
?>