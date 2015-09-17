<?php
class loi_binomiale
{
	private $n;
	private $p;
	private $q;

	private $error;

	private $esperance;
	private $variance;
	private function factorielle($n)
	{
		$somme = 1;
		for ($i = 1; $i <= $n; $i++)
			$somme = $somme * $i;
		return $somme;
	}
	public function __construct($n, $p, $k)
	{
		$this->error = 0;
		if (!is_numeric($n) or $n < 0)
			$this->error = 1;
		if (!is_numeric($p) or $p < 0 or $p > 1)
			$this->error = 2;
		if (!is_numeric($k) or ($k < 0 and $k != -1))
			$this->error = 3;

		$this->n = $n;
		$this->p = $p;
		$this->k = $k;
	}
	public function getResult()
	{
		if ($this->error == 0)
		{
			$this->esperance = $this->n * $this->p;
			$this->variance = $this->esperance * (1 - $this->p);
			$prob = array();
			if ($this->k == -1)
				for ($i = 0; $i <= $this->n; $i++)
					$prob[$i] = ($this->factorielle($this->n)/($this->factorielle($i) * $this->factorielle($this->n - $i))) * pow($this->p, $i) * pow((1 - $this->p), $this->n - $i);
			else
			{
				$i = $this->k;
				$prob[0] = ($this->factorielle($this->n)/($this->factorielle($i) * $this->factorielle($this->n - $i))) * pow($this->p, $i) * pow((1 - $this->p), $this->n - $i);
			}
			return array($this->esperance, $this->variance, $prob);
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