<?php
class statistics
{
	private $data;


	public function __construct($data)
	{
		$this->data = $data;
	}
	public function bcpow_($num, $power)
	{
		$awnser = "1";
		while($power)
		{
			$awnser = bcmul($awnser, $num, 100);
			$power = bcsub($power, "1");
		}
		return rtrim($awnser, '0.');
	}

	public function racine($nbr, $racine)
	{
	 if ($nbr > 0)
	  return pow($nbr, (1.0/$racine));
	 else
	  return - pow(abs($nbr), (1.0/$racine));
	 //return bcpow((float)$nbr, (1.0/$racine));
	 //return exp(bcpow_($nbr, -1) * log($nbr));
	}

	public function getResult()
	{
		$total = 0;
		$total_variance = 0;
		$total_n = 0;
		$data_s = array();

		foreach ($this->data as $key => $val)
		{
			//echo floatval($key).":".floatval($val)."<br />";
			$total = $total + ($key) * ($val);
			$total_n = $total_n + ($val);

			for ($i = 0; $i < $val; $i++)
				array_push($data_s, $key);
		}
		asort($data_s, SORT_NUMERIC);
		$moyenne = $total / $total_n;

		foreach ($this->data as $key => $val)
		{
			$total_variance = $total_variance + $this->bcpow_(($key), 2) * ($val);
		}
		$variance = ($total_variance / $total_n) - $this->bcpow_($moyenne, 2);

		$ecart_type = $this->racine($variance, 2);
		//var_dump($data_s);
		$mid = floor(($total_n - 1)/ 2);


		if ($total_n % 2)
		{
			$median = $data_s[$mid]; 
		}
		else
		{
			$m1 = $data_s[$mid];
			$m2 = $data_s[$mid + 1];
			$median = (($m1 + $m2) / 2);
		}

		$value = max($this->data);
		$mode = array_search($value, $this->data);

		return array($moyenne, $variance, $ecart_type, $median, $mode);
	}

}
?>