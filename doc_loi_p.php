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
    "Parameters", "Interval between K and K2", "Binomial distribution B(n, p)", "Parameter", "square root", "power", "factorial", "Algorithm", "The P parameter must be between 0 and infinity",
    "The Poisson distribution is a discrete probability distribution that expresses the probability of a given number of events occurring in a fixed interval of time and/or space if these events occur with a known average rate and independently of the time since the last event");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Espérance", "Variance", "Somme", "Ecart type", "Une variable est incorrecte", "Le système ne prend pas en charge les nombres complexes.",
    "Lois Normal", "Resoudre", "Resultat", "Lois Uniforme (discrete)", "Lois de Poisson", "Nombre de possibilité",
    "Paramètres", "Interval entre K et K2", "Lois Binomiale B(n, p)", "Paramétre", "racine", "puissance", "factorielle", "Algorithme", "Le paramétre P doit étre compris entre 0 et infini",
    "la loi de Poisson est une loi de probabilité discrète qui décrit le comportement du nombre d'évènements se produisant dans un laps de temps fixé, si ces évènements se produisent avec une fréquence moyenne connue et indépendamment du temps écoulé depuis l'évènement précédent.");
}

if (isset($_POST['loi_poisson']))
{
  $loi = new loi_poisson($_POST['parametre_loi_poisson'], $_POST['k_loi_poisson'], $_POST['k2_loi_poisson']);
  $data_loi_poisson = $loi->getResult();
  if (sizeof($data_loi_poisson) == 1)
    $message = $text[4];
  else
  {
    $message = $text[0]." = ".$data_loi_poisson[2];
    $message = $message."<br />";
    $message = $message.$text[1]." = ".$data_loi_poisson[3];
    $message = $message."<br />";
    $message = $message.$text[3]." = ".$data_loi_poisson[4];
    $message = $message."<br />";
    for ($i = 0; $i < sizeof($data_loi_poisson[0]); $i++)
    {
      $message = $message."<br />";
      $message = $message."P(".$data_loi_poisson[0][$i][0].") = ".$data_loi_poisson[0][$i][1];
    }
    $message = $message."<br />";
    $message = $message.$text[2]." = ".$data_loi_poisson[1];
    
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
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[10]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
                    <form class="form-horizontal" method="post">
                    <fieldset>

                    <!-- Text input-->
                    <div class="form-group" style="margin-bottom: 0px;">
                      <label class="col-md-4 control-label" for="textinput"><?php echo $text[12]; ?></label>  
                      <div class="col-md-8">
                      <input id="textinput" name="parametre_loi_poisson" type="text" placeholder="" class="form-control input-md">
                      <span class="help-block"><?php echo $text[13]; ?></span>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">K</label>  
                      <div class="col-md-8">
                      <input id="textinput" name="k_loi_poisson" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">K2</label>  
                      <div class="col-md-8">
                      <input id="textinput" name="k2_loi_poisson" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>
                    
                </div>
                <div class="panel-footer">
                    <button id="singlebutton" name="loi_poisson" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[7]; ?></button>
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
                  <p><?php echo $text[21]; ?><br />
                  <p><?php echo $text[20]; ?><br />
                  </p>
                    <code style="padding: 0px;">
                      <?php echo $text[19]; ?><br />
                       <?php echo $text[0]; ?> = <?php echo $text[15]; ?><br />
                       <?php echo $text[1]; ?> = <?php echo $text[15]; ?><br />
                       <?php echo $text[3]; ?> = <?php echo $text[16]; ?>(<?php echo $text[15]; ?>)<br />
                       <?php echo $text[8]; ?> = (exp(-<?php echo $text[15]; ?>)* <?php echo $text[17]; ?>(<?php echo $text[15]; ?>, k)/(<?php echo $text[18]; ?>(k)))<br />
                    </code>
                    
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
