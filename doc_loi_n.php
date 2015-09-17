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
    "Parameters", "Interval between K and K2", "Binomial distribution B(n, p)", "The normal (or Gaussian) distribution is a very common continuous probability distribution.
Normal distributions are important in statistics and are often used in the natural and social sciences to represent real-valued random variables whose distributions are not known.");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Espérance", "Écart type", "Somme", "Ecart-type", "Une variable est incorrecte", "Le système ne prend pas en charge les nombres complexes.",
    "Lois Normal", "Resoudre", "Resultat", "Lois Uniforme (discrete)", "Lois de Poisson", "Nombre de possibilité",
    "Paramètres", "Interval entre K et K2", "Lois Binomiale B(n, p)", "La loi normale est l'une des lois de probabilité les plus adaptées pour modéliser des phénomènes naturels issus de plusieurs événements aléatoires.
Elle est en lien avec de nombreux objets mathématique ainsi qu'avec d'autres lois de probabilité.");
}

if (isset($_POST['loi_normale']))
{
  if (!empty($_POST['x_loi_normale']) and !empty($_POST['x1_loi_normale']))
    $type =  0;
  else if (!empty($_POST['x1_loi_normale']))
    $type = 1;
  else if (!empty($_POST['x_loi_normale']))
    $type = 2;

  $loi = new loi_normale($_POST['x1_loi_normale'], $_POST['x_loi_normale'], $_POST['esperance_loi_normale'], $_POST['ecart_type_loi_normale'], $type);
  $data_loi_normale = $loi->getResult();
  if (sizeof($data_loi_normale) == 1)
    $message = $text[4];
  else
    $message = "P(".$data_loi_normale[0]." < X < ".$data_loi_normale[1].") = ".$data_loi_normale[2];
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
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[6]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <form class="form-horizontal" method="post">
                        <fieldset>

                        <!-- Text input-->
                        <div class="form-group center-block" style="margin-bottom: 0px;">
                          <label class="col-md-4 control-label" for="textinput">P</label>  
                          <div class="col-md-8">
                          <input id="textinput" name="x_loi_normale" type="text" placeholder="" class="form-control input-md" />
                            
                          </div>
                        </div>
                        <center><span class="help-block center-block">P (X < X1)</span></center>

                        <div class="form-group center-block" style="margin-bottom: 0px;">
                          <label class="col-md-4 control-label" for="textinput">P</label>  
                          <div class="col-md-8">
                          <input id="textinput" name="x1_loi_normale" type="text" placeholder="" class="form-control input-md" />
                            
                          </div>
                        </div>
                        <center><span class="help-block center-block">P (X2 < X)</span></center>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput"><?php echo $text[0]; ?></label>  
                          <div class="col-md-8">
                          <input id="textinput" name="esperance_loi_normale" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput"><?php echo $text[3]; ?></label>  
                          <div class="col-md-8">
                          <input id="textinput" name="ecart_type_loi_normale" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>
                        </fieldset>
                </div>
                <div class="panel-footer">
                    <button id="singlebutton" name="loi_normale" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[7]; ?></button>
                </div>
                </form>
          </div>
    </div>
    <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i>Documentatnion
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <p><?php echo $text[15]; ?>
                </div>
                </form>
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
