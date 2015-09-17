<?php
class equation
{
	private $a;//x^3
	private $b;//x^2
	private $c;//x
	private $d;//
	private $delta;
	private $type;// 0 : 1er degré, 1: 2s degré 2: 3eme degré
	private $x1;
	private $x2;
	private $x3;
	private $x1_2;//Calcul_detail
	private $x2_2;//Calcul_detail
	private $x3_2;//Calcul_detail
	public function __construct($a, $b, $c, $d)
	{
		if (empty($a) or !is_numeric($a))
			$this->a = "0";
		else
			$this->a = $a;
		
		if (empty($b) or !is_numeric($b))
			$this->b = "0";
		else
			$this->b = $b;

		if (empty($c) or !is_numeric($c))
			$this->c = "0";
		else
			$this->c = $c;

		if (empty($d) or !is_numeric($d))
			$this->d = "0";
		else
			$this->d = $d;
	}
	private function racine($nbr, $racine)
	{
		if ($nbr > 0)
			return pow($nbr, (1.0/$racine));
		else
			return - pow(abs($nbr), (1.0/$racine));
	}
	private function bcpow_($num, $power) {
	    $awnser = "1";
	    while ($power) {
		$awnser = bcmul($awnser, $num, 100);
		$power = bcsub($power, "1");
	    }
	    return rtrim($awnser, '0.');
	}
	public function Resolve()
	{
		if ($this->a == 0 and $this->b == 0 and $this->c == 0 and $this->d == 0)
		{

		}
		else if ($this->a == 0 and $this->b == 0)
			$this->Resolve_1();
		else if ($this->a == 0)
			$this->Resolve_2();
		else
			$this->Resolve_3();
	}
	private function Resolve_1()
	{
		$this->type = 0;
		$this->x1 = (-($this->d))/($this->c);
		$this->x1_2 = "\\frac{".(-($this->d))."}{".($this->c)."}";
	}
	private function Resolve_2()
	{
		$this->type = 1;
		$this->delta = bcpow($this->c, 2) - (4 * $this->b * $this->d);
		if ($this->delta < 0)
		{
			$this->delta = abs($this->delta);
			if (sqrt($this->delta) == intval(sqrt($this->delta)))
			{
				$this->x1 = "\\frac{".-($this->c)." + ".sqrt($this->delta)." i}{".(2*$this->b)."}";
				$this->x2 = "\\frac{".-($this->c)." - ".sqrt($this->delta)." i}{".(2*$this->b)."}";

				$this->x1_2 = "\\frac{".-($this->c)." + sqrt{".($this->delta)."} i}{".(2*$this->b)."}";
				$this->x2_2 = "\\frac{".-($this->c)." - sqrt{".($this->delta)."} i}{".(2*$this->b)."}";

				//$this->x1_2 = "(".-($this->c)." + ".sqrt($this->delta)." i)/".(2*$this->b);
				//$this->x2_2 = "(".-($this->c)." - ".sqrt($this->delta)." i)/".(2*$this->b);
			}
			else
			{
				$this->x1 = "\\frac{".-($this->c)." + ".sqrt($this->delta)." i}{".(2*$this->b)."}";
				$this->x2 = "\\frac{".-($this->c)." - ".sqrt($this->delta)." i}{".(2*$this->b)."}";

				$this->x1_2 = "\\frac{".-($this->c)." + sqrt{".($this->delta)."} i}{".(2*$this->b)."}";
				$this->x2_2 = "\\frac{".-($this->c)." - sqrt{".($this->delta)."} i}{".(2*$this->b)."}";
			}	
			$this->delta = - $this->delta;
		}
		else if ($this->delta == 0)
		{
			$this->x1 = -$this->c/(2*$this->b);
			$this->x1_2 = "\\frac{".-($this->c)."}{".(2*$this->b)."}";
		}
		else
		{
			if (sqrt($this->delta) == intval(sqrt($this->delta)))
			{
				$this->x1 = (-($this->c) + sqrt($this->delta))/(2*$this->b);
				$this->x2 = (-($this->c) - sqrt($this->delta))/(2*$this->b);
				
				$this->x1_2 = "\\frac{".-($this->c)." + sqrt{".($this->delta)."}}{".(2*$this->b)."}";
				$this->x2_2 = "\\frac{".-($this->c)." - sqrt{".($this->delta)."}}{".(2*$this->b)."}";
			}
			else
			{
				$this->x1 = (-($this->c) + sqrt($this->delta))/(2*$this->b);
				$this->x2 = (-($this->c) - sqrt($this->delta))/(2*$this->b);
				
				$this->x1_2 = "\\frac{".-($this->c)." + sqrt{".($this->delta)."}}{".(2*$this->b)."}";
				$this->x2_2 = "\\frac{".-($this->c)." - sqrt{".($this->delta)."}}{".(2*$this->b)."}";
			}
		}
	}
	private function Resolve_3()
	{
		$this->type = 2;
		if ($this->b == 0 and $this->c == 0 and $this->d == 0)
		{
			$this->x1 = '0';
			$this->x2 = "0";
			$this->x3 = "0";

			$this->x1_2 = 0;
			$this->x2_2 = 0;
			$this->x3_2 = 0;
		}
		else if ($this->b == 0 and $this->c == 0 and $this->d != 0)
		{
			$this->x1 = $this->racine(-$this->d/$this->a, 3);
			$this->x2 = "\\frac{-1 +  sqrt{3} i}{2} * ".$this->x1;
			$this->x3 = "\\frac{-1 - sqrt{3} i}{2} * ".$this->x1;
			
			$this->x1_2 = "\\sqrt[3]{ \\frac{".((-$this->d)."}{".($this->a))."}}";
			$this->x2_2 = "\\frac{-1 +  sqrt{3} i}{2} * \sqrt[3]{ \\frac{".((-$this->d)."}{".($this->a))."}}";
			$this->x3_2 = "\\frac{-1 - sqrt{3} i}{2} * \sqrt[3]{ \\frac{".((-$this->d)."}{".($this->a))."}}";
		}
		else if ($this->b == 0 and $this->c != 0 and $this->d == 0)
		{
			if (($this->a > 0 and $this->c > 0) or ($this->a < 0 and $this->c < 0))
			{
				$this->x1 = 0;
				$this->x2 = "i".sqrt($this->c/$this->a);
				$this->x3 = "-i".sqrt($this->c/$this->a);

				$this->x1_2 = 0;
				$this->x2_2 = "i * \\sqrt{ \\frac{".(($this->c)."}{".($this->a))."}}";
				$this->x3_2 = "-i * \\sqrt{ \\frac{".(($this->c)."}{".($this->a))."}}";
			}
			else
			{
				$this->x1 = 0;
				$this->x2 = sqrt(-($this->c/$this->a));
				$this->x3 = -sqrt(-($this->c/$this->a));

				$this->x1_2 = 0;
				$this->x2_2 = "\\sqrt{ - \\frac{".(($this->c)."}{".($this->a))."}}";
				$this->x3_2 = "\\sqrt{ - \\frac{".(($this->c)."}{".($this->a))."}}";
			}
		}
		else if ($this->b == 0 and $this->c != 0 and $this->d != 0)
		{
			$p = $this->b / $this->a;
			$q = $this->c / $this->a;
			$f = 0;
			$this->Resolve_3_2($p, $q, $f);
		}
		else if ($this->b != 0 and $this->c == 0 and $this->d == 0)
		{
			$this->x1 = "0";
			$this->x2 = "0";
			$this->x3 = -($this->b/$this->a);

			$this->x1_2 = 0;
			$this->x2_2 = 0;
			$this->x3_2 = "- \\frac{".(($this->b)."}{".($this->a))."}";
		}
		else if ($this->b != 0 and $this->c != 0 and $this->d == 0)
		{
			$this->x3 = 0;
			$this->Resolve_2();
		}
		else
		{
			$p = ($this->c / $this->a) - ($this->bcpow_($this->b, 2)/(3 * $this->bcpow_($this->a, 2)));
			$q = ($this->d / $this->a) - (($this->b * $this->c) / (3 * $this->bcpow_($this->a, 2))) + ((2 * $this->bcpow_($this->b, 3))/(27 * $this->bcpow_($this->a, 3)));
			$f = - (($this->b) / ( 3 * $this->a));
			$this->Resolve_3_2($p, $q, $f);
		}
	}
	private function Resolve_3_2($p, $q, $f)
	{
		if ($p == 0 and $q == 0)
		{
			$this->x1 = $this->racine(-1, 3);
			$this->x1_2 = "\\sqrt[3]{-1}";
		}
		else if ($p == 0 and $q != 0)
		{
			$this->x1 = $this->racine(-$q, 3);
			$this->x2 = "\\frac{-1 + sqrt{3} i}{2} * ".(($this->x1));
			$this->x3 = "\\frac{-1 - sqrt{3} i}{2} * ".(($this->x1));
			
			$this->x1_2 = "\\sqrt[3]{".(-($this->q))."}";
			$this->x2_2 = "\\frac{-1 +  sqrt{3} i}{2} * \\sqrt[3]{".(-($this->q))."}";
			$this->x3_2 = "\\frac{-1 - sqrt{3} i}{2} * \\sqrt[3]{".(-($this->q))."}";
		}
		else if ($p != 0 and $q == 0)
		{
			if ($p < 0)
			{
				$this->x1 = 0;
				$this->x2 = sqrt(-$p);
				$this->x3 = -sqrt(-$p);

				$this->x1_2 = 0;
				$this->x2_2 = "\\sqrt{".-$p."}";
				$this->x3_2 = "- \\sqrt{".-$p."}";
			}
			else
			{
				$this->x1 = 0;
				$this->x2 = "i * ".sqrt($p);
				$this->x3 = "-i * ".sqrt($p);

				$this->x1_2 = 0;
				$this->x2_2 = "i * \\sqrt{".$p."}";
				$this->x3_2 = "-i * \\sqrt{".$p."}";
			}
		}
		else
		{
			$this->delta = ($this->bcpow_($q, 2)/4) + ($this->bcpow_($p, 3)/27);
			if ($this->delta > 0)
			{
				$this->x1 = $this->racine((-($q/2) + sqrt($this->delta)), 3) + $this->racine((-($q/2) - sqrt($this->delta)), 3);
				$x12 = $this->racine((-($q/2) + sqrt($this->delta)), 3) - $this->racine((-($q/2) - sqrt($this->delta)), 3);
				$this->x2 = (((-1/2) * $this->x1) + $f)."+ i".((sqrt(3)/2) * $x12);
				$this->x3 = (((-1/2) * $this->x1) + $f)."- i".((sqrt(3)/2) * $x12);
				$this->x1 = $this->x1 + $f;

				if ($f == - (($this->b) / ( 3 * $this->a)))
					$f_2 = "- \\frac{".(round($this->b, 4))."}{".(3 * round($this->a, 4))."}";
				else
					$f_2 = "- ".round($f, 4);
				
				$this->x1_2 = "\\sqrt[3]{ \\frac{".-(round($q, 4))."}{2} + \\sqrt{".round($this->delta, 4)."}} + \\sqrt[3]{ \\frac{".(-(round($q, 4)))."}{2} - \\sqrt{".round($this->delta, 4)."}}";
				$this->x1_22 = "\\sqrt[3]{ \\frac{".-(round($q, 4))."}{2} + \\sqrt{".round($this->delta, 4)."}} - \\sqrt[3]{ \\frac{".(-(round($q, 4)))."}{2} - \\sqrt{".round($this->delta, 4)."}}";

				$this->x2_2 = "(\\frac{-1}{2} (".$this->x1_2.") ".$f_2.") + i ( \\frac{\\sqrt{3}}{2} (".$this->x1_22."))";
				$this->x3_2 = "(\\frac{-1}{2} (".$this->x1_2.") ".$f_2.") - i ( \\frac{\\sqrt{3}}{2} (".$this->x1_22."))";
				$this->x1_2 = "\\sqrt[3]{ \\frac{".(-(round($q, 4)))."}{2} + \\sqrt{".round($this->delta, 4)."}} + \\sqrt[3]{ \\frac{".(-(round($q, 4)))."}{2} - \\sqrt{".round($this->delta, 4)."}}".$f_2;
			}
			else if ($this->delta == 0)
			{
				$this->x1 = (3*$q) / $p;
				$this->x2 = (-3*$q) / (2 * $p);
				$this->x3 = (-3*$q) / (2 * $p);

				$this->x1_2 = "\\frac{".(3 * $q)."}{".($p)."}";
				$this->x2_2 = "\\frac{".(-3 * $q)."}{".(2 * $p)."}";
				$this->x3_2 = "\\frac{".(-3 * $q)."}{".(2 * $p)."}";
			}
			else if ($this->delta < 0)
			{
				if ($f == - (($this->b) / ( 3 * $this->a)))
					$f_2 = "- \\frac{".(($this->b))."}{".(3 * $this->a)."}";
				else
					$f_2 = "- ".$f;

				$fi = acos(((3 * $q) / (2 * $p)) * sqrt(-3/$p));
				$fi_2 = "\\arccos{ \\frac{".(3 * $q)."}{".(2 * $p)."} * \\sqrt{ \\frac{-3}{".$p."}}}";
				$this->x1 = 2 * (sqrt(-$p/3)) * cos ($fi / 3) + $f;
				$this->x2 = 2 * (sqrt(-$p/3)) * cos(($fi + 2 * pi())/3 ) + $f;
				$this->x3 = 2 * (sqrt(-$p/3)) * cos(($fi + 4 * pi())/3 ) + $f;

				$this->x1_2 = "2 * \\sqrt{ \\frac{".-$p."}{3}} * \\cos{ \\frac{".$fi_2."}{3}}".$f_2;
				$this->x2_2 = "2 * \\sqrt{ \\frac{".-$p."}{3}} * \\cos{ \\frac{".$fi_2." + 2\\pi}{3}}".$f_2;
				$this->x3_2 = "2 * \\sqrt{ \\frac{".-$p."}{3}} * \\cos{ \\frac{".$fi_2." + 4\\pi}{3}}".$f_2;
			}
		}
	}
	public function getDelta()
	{
		return $this->delta;
	}

	public function getResult()
	{
		return array($this->x1, $this->x2, $this->x3);
	}
	public function getResult_detail()
	{
		return array($this->x1_2, $this->x2_2, $this->x3_2);
	}
	public function getFonctionAff()
	{
		return $this->a."x^3 + ".$this->b."x^2 + ".$this->c."x + ".$this->d; 
	}
}
?>