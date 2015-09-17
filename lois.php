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
    $text = array("Espérance", "Variance", "Somme", "Ecart type", "Une variable est incorrecte", "Le système ne prend pas en charge les nombres complexes.",
    "Lois Normal", "Resoudre", "Resultat", "Lois Uniforme (discrete)", "Lois de Poisson", "Nombre de possibilité",
    "Paramètres", "Interval entre K et K2", "Lois Binomiale B(n, p)");
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
else if(isset($_POST['loi_binomiale']))
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
else if (isset($_POST['loi_uniforme']))
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
else if (isset($_POST['loi_poisson']))
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
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[6]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
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
        <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[14]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 210px;">
                    <form class="form-horizontal" method="post">
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">n</label>  
                      <div class="col-md-8">
                      <input id="textinput" name="n_loi_binomiale" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">p</label>  
                      <div class="col-md-8">
                      <input id="textinput" name="p_loi_binomiale" type="text" placeholder="" class="form-control input-md">
                        
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group" style="margin-bottom: 0px;">
                      <label class="col-md-4 control-label" for="textinput">k</label>  
                      <div class="col-md-8">
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

        <div class="col-sm-6 col-md-3">
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

        <div class="col-sm-6 col-md-3">
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
                  <label class="col-md-4 control-label" for="textinput">n</label>  
                  <div class="col-md-8">
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
