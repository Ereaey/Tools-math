<?php

class loi_normale
{
	private $x_inferieur;
	private $x_superieur;
	private $esperance;
	private $ecart_type;
	private $error;
	private $prob;
	private $type;
	private function bcpow_($num, $power) {
	    $awnser = "1";
	    while ($power) {
		$awnser = bcmul($awnser, $num, 100);
		$power = bcsub($power, "1");
	    }
	    return rtrim($awnser, '0.');
	}
	public function __construct($x_inferieur, $x_superieur, $esperance, $ecart_type, $type)
	{
		$this->error = 0;
		$this->type = $type;

		if (!is_numeric($x_inferieur) and !is_numeric($x_superieur))
			$this->error = 1;
		if (!is_numeric($esperance) or $esperance < 0)
			$this->error = 2;
		if (!is_numeric($ecart_type) or $ecart_type < 0)
			$this->error = 3;


		$this->x_inferieur = $x_inferieur;
		$this->x_superieur = $x_superieur;
		$this->esperance = $esperance;
		$this->ecart_type = $ecart_type;
	}
	private function calcul($x)
	{
		$u = abs($x);
		$z = 1/(sqrt(2 * pi()))*exp(-$u*$u/2);
		$b = array(0.2316419, 0.319381530, -0.356563782, 1.781477937, -1.821255978, 1.330274429);
		$t = 1/(1+$b[0]*$u);
		$p = 1-$z*($b[1]*$t + $b[2]*($t*$t) + $b[3]*($t*$t)*$t + $b[4]*($t*$t*$t*$t) + $b[5]*($t*$t*$t*$t)*$t);

		return $p;
	}
	function getResultC($x_inf, $x_sup)
	{
		$x = ($x_inf - $this->esperance) / $this->ecart_type;
		$y = ($x_sup - $this->esperance) / $this->ecart_type;
		if (-$x == $y)
			$result = (2*$this->calcul($y)) - 1;
		else if ($x < 0)
			$result = $this->calcul($x) - (1 - $this->calcul($y));
		else
			$result = $this->calcul($x) - $this->calcul($y);
		return $result;

	}
	function getResult()
	{
		if ($this->error == 0)
		{
			if ($this->type == 0)
			{
				$result = $this->getResultC($this->x_inferieur, $this->x_superieur);
				return array($this->x_inferieur, $this->x_superieur, $result);
			}
			else if ($this->type == 1)
			{
				$x = ($this->x_inferieur - $this->esperance) / $this->ecart_type;
				if ($x < 0)
					$val = 1 - $this->calcul(-$x);
				else
					$val = $this->calcul($x);

				return array($this->x_inferieur, "+inf", $val);
				
			}
			else if ($this->type == 2)
			{
				$y = ($this->x_superieur - $this->esperance) / $this->ecart_type;
				if ($y < 0)
					$val = 1 - $this->calcul(-$y);
				else
					$val = $this->calcul($y);


				return array("-inf", $this->x_superieur, $val);

			}
		}
		else
			return $this->error;
	}
}
?>