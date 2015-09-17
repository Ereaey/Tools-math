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
    "Parameters", "Interval between K and K2", "Binomial distribution B(n, p)", "Parameter", "square root", "power", "factorial", "Algorithm", "The P parameter must be between 0 and infinity", "The discrete uniform distribution is a symmetric probability distribution whereby a finite number of values are equally likely to be observed.");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Espérance", "Variance", "Somme", "Ecart type", "Une variable est incorrecte", "Le système ne prend pas en charge les nombres complexes.",
    "Lois Normal", "Resoudre", "Resultat", "Lois Uniforme (discrete)", "Lois de Poisson", "Nombre de possibilité",
    "Paramètres", "Interval entre K et K2", "Lois Binomiale B(n, p)", "Paramétre", "racine", "puissance", "factorielle", "Algorithme", "Le paramétre P doit étre compris entre 0 et infini", "La loi discrète uniforme est une loi de probabilité discrète indiquant une probabilité de se réaliser identique (équiprobabilité) à chaque valeur d’un ensemble fini de valeurs possibles.");
}

if (isset($_POST['loi_uniforme']))
{
  $loi = new loi_uniforme_discrete($_POST['n_loi_uniforme']);
  $data_loi_uniforme = $loi->getResult();
  if (sizeof($data_loi_uniforme) == 1)
    $message = $text[4];
  else
  {
    $message = $text[0]." = ".$data_loi_uniforme[1];
    $message = $message."<br />";
    $message = $message.$text[1]." = ".$data_loi_uniforme[2];
    $message = $message."<br />";
    $message = $message."P(".$data_loi_uniforme[0].") = ".$data_loi_uniforme[3];
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
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[9]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
                    <form class="form-horizontal" method="post">
                    <fieldset>

                    <!-- Text input-->
                <div class="form-group" style="margin-bottom: 0px;">
                  <label class="col-md-2 control-label" for="textinput">n</label>  
                  <div class="col-md-10">
                  <input id="textinput" name="n_loi_uniforme" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block"><?php echo $text[11]; ?></span>  
                  </div>
                </div>
                    
                </div>
                <div class="panel-footer">
                    <button id="singlebutton" name="loi_uniforme" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[7]; ?></button>
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
                  <?php echo $text[21]; ?>
                  <code style="padding: 0px;">
                      <?php echo $text[0]; ?> = (n + 1) / 2<br />
                      <?php echo $text[1]; ?> = (<?php echo $text[17]; ?>(n, 2) - 1) / 12<br />
                      Prob = 1 / n<br />
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
