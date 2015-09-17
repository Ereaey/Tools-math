<?php
class ki
{
	public $tab = array();
	public $tab_somme = array();
	public $tab_theorique = array();
	private $tab_ki = array();
	private $column;
	private $line;

	public function __construct($tab, $column, $line)
	{
		$this->tab = $tab;
		$this->column = $column;
		$this->line = $line;

		$this->somme();
		$this->c_theorique();
		$this->c_ki();
	}

	public function somme()
	{
		$this->tab_somme = $this->tab;
		for ($i = 0; $i < $this->line; $i++)
		{
			for ($e = 0; $e < $this->column; $e++)
			{
				$this->tab_somme[$i][$this->column] += $this->tab_somme[$i][$e];
				
				$this->tab_somme[$this->line][$e] = $this->tab_somme[$this->line][$e] + $this->tab_somme[$i][$e];
				$this->tab_somme[$this->line][$this->column] = $this->tab_somme[$this->line][$this->column] + $this->tab_somme[$i][$e];
				
			}

		}
	}
	
	public function get_somme()
	{
		return $this->tab_somme;
	}

	public function c_theorique()
	{
		$this->tab_theorique = array();

		for ($i = 0; $i < $this->line; $i++)
		{
			for ($e = 0; $e < $this->column; $e++)
			{
				$this->tab_theorique[$i][$e] = ($this->tab_somme[$this->line][$e] * $this->tab_somme[$i][$this->column]) / $this->tab_somme[$this->line][$this->column];
			}
		}


		for ($i = 0; $i < $this->line; $i++)
		{
			for ($e = 0; $e < $this->column; $e++)
			{
				$this->tab_theorique[$i][$this->column] = $this->tab_theorique[$i][$this->column] + $this->tab_theorique[$i][$e];
				$this->tab_theorique[$this->line][$e] = $this->tab_theorique[$this->line][$e] + $this->tab_theorique[$i][$e];
				$this->tab_theorique[$this->line][$this->column] = $this->tab_theorique[$this->line][$this->column] + $this->tab_theorique[$i][$e];
			}

		}
	}

	public function get_theorique_tab()
	{
		return $this->tab_theorique;
	}

	public function c_ki()
	{
		$this->tab_ki = array();
		for ($i = 0; $i < $this->line; $i++)
		{
			for ($e = 0; $e < $this->column; $e++)
			{
				$this->tab_ki[$i][$e] = pow(($this->tab_theorique[$i][$e] - $this->tab_somme[$i][$e]), 2) / $this->tab_theorique[$i][$e];
			}
		}

		for ($i = 0; $i < $this->line; $i++)
		{
			for ($e = 0; $e < $this->column; $e++)
			{
				$this->tab_ki[$i][$this->column] = $this->tab_ki[$i][$this->column] + $this->tab_ki[$i][$e];
				$this->tab_ki[$this->line][$e] = $this->tab_ki[$this->line][$e] + $this->tab_ki[$i][$e];
				$this->tab_ki[$this->line][$this->column] = $this->tab_ki[$this->line][$this->column] + $this->tab_ki[$i][$e];
			}

		}
	}

	public function get_tab_ki()
	{
		return $this->tab_ki;
	}
}
?>