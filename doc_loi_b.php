<?php
include('header.php');
include("class/loi_normale.php");
include("class/loi_binomiale.php");
include("class/loi_poisson.php");
include("class/loi_uniforme_discrete.php");

if ($_SESSION['langue'] == 'en')
{
    $text = array("Mean", "Variability", "Sum", "Standard deviation", "One variable is incorrect", "The system does not manage the complex numbers.",
    "Normal Distribution", "Resolve", "Result", "Uniform distribution (discrete)", "Poisson distribution", "Numbers of possibility",
    "Parameters", "Interval between K and K2", "Binomial distribution B(n, p)");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Espérance", "Écart type", "Somme", "Standard deviation", "Une variable est incorrecte", "Le système ne prend pas en charge les nombres complexes.",
    "Lois Normal", "Resoudre", "Resultat", "Lois Uniforme (discrete)", "Lois de Poisson", "Nombre de possibilité",
    "Paramètres", "Interval entre K et K2", "Lois Binomiale B(n, p)");
}

if(isset($_POST['loi_binomiale']))
{
  $loi = new loi_binomiale($_POST['n_loi_binomiale'], $_POST['p_loi_binomiale'], $_POST['k_loi_binomiale']);
  $data_loi_binomiale = $loi->getResult();
  if (sizeof($data_loi_binomiale) == 1)
    $message = $text[4];
  else
  {
    $k = $loi->getK();
    if ($k == -1)
      $k = 0;
    $message = $text[0]." = ".$data_loi_binomiale[0];
    $message = $message."<br />";
    $message = $message.$text[1]." = ".$data_loi_binomiale[1];
    for ($i = 0; $i < sizeof($data_loi_binomiale[2]); $i++)
    {
      $message = $message."<br />";
      $message = $message."P(".($i + $k).") = ".$data_loi_binomiale[2][$i];
    }
  }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <div class="alert alert-warning" role="alert"><?php echo $text[5]; ?></div>
        </div>
        <div class="col-lg-3">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[14]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
                    <form class="form-horizontal" method="post">
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="textinput">n</label>  
                      <div class="col-md-10">
                      <input id="textinput" name="n_loi_binomiale" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="textinput">p</label>  
                      <div class="col-md-10">
                      <input id="textinput" name="p_loi_binomiale" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group" style="margin-bottom: 0px;">
                      <label class="col-md-2 control-label" for="textinput">k</label>  
                      <div class="col-md-10">
                      <input id="textinput" name="k_loi_binomiale" type="text" placeholder="" class="form-control input-md">
                       <span class="help-block">P(X = k)</span>  
                      </div>
                    </div>
                    </fieldset>
                    
                </div>
                <div class="panel-footer">
                    <button id="singlebutton" name="loi_binomiale" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[7]; ?></button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i>Documentation
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
                  <?php if ($_SESSION['langue'] == 'fr')
                  {
                    ?>
                    <p>La loi binomiale modélise le nombre de succès obtenus lors de la répétition indépendante de plusieurs expériences aléatoires identiques.<br />
                      2 paramétres sont nécessaires<br />
                    <span class="marge">N qui doit étre > 0 (Le nombres d'expériences réalisées)</span><br />
                    <span class="marge">P compris entre 0 et 1 (La probabilité de succés)<span><br />
                    Et K qui est notre variable aléatoire</p>
                    <code style="padding: 0px;">
                      Algorithme<br />
                      Esperance = n * p<br />
                      Variance = Esperance * (1 - P)<br />
                      Probabilité = (factorielle(n)/(factorielle(k) * factorielle(n - k))) * puissance(p, k) * puissance((1 - p), n - k)<br />
                    </code>
                  <?php
                }
                else if ($_SESSION['langue'] == 'en')
                {
                  ?>
                  <p>The binomial distribution is the discrete probability distribution of the number of successes in a sequence of n independent yes/no experiments, each of which yields success with probability p.<br />
                    <span class="marge">N have to be > 0 (The numbers of your tests)</span><br />
                    <span class="marge">P is between 0 and 1 (Success with probability)<span><br />
                    and K the random variable</p>
                    <code style="padding: 0px;">
                      Algorithme<br />
                      Esperance = n * p<br />
                      Variance = Esperance * (1 - P)<br />
                      Probabilité = (factorielle(n)/(factorielle(k) * factorielle(n - k))) * puissance(p, k) * puissance((1 - p), n - k)<br />
                    </code>
                  <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <?php
    if (!empty($message))
    {
    ?>
       <div class="col-sm-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[8]; ?>
                </div>
                <div class="panel-body" style="height: auto;">
                    <p><?php echo $message; ?></p>
                </div>
            </div>
        </div>

    <?php
    }
    ?>   
    </div>

</div>
<?php
include('footer.php');
?>
