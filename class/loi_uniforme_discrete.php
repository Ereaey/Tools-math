<?php
class loi_uniforme_discrete
{
	private $n;
	private $esperance;
	private $variance;
	private $prob;
	private $error;

	public function __construct($n)
	{
		$this->error = 0;
		if (!is_numeric($n) or $n < 0)
			$this->error = 1;

		$this->n = $n;
	}
	public function getResult()
	{
		if ($this->error == 0)
		{
			$this->esperance = ($this->n + 1) / 2;
			$this->variance = (bcpow($this->n, 2) - 1) / 12;
			$this->prob = 1 / $this->n;
			return array($this->n, $this->esperance, $this->variance, $this->prob);
		}
		else
			return $this->error;
	}
}
?>