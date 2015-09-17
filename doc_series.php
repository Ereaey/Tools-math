<?php
include('header.php');
include("class/statistics.php");
if (isset($_POST['test_stat']))
{
  $data = array();
  for ($y = 0; $y < $_GET['numbers_data']; $y++)
  {
    $data[$_POST['data_0_'.$y.'']] = $_POST['data_1_'.$y.''];;
  }
  $stat = new statistics($data);
  $result = $stat->getResult();
}

if ($_SESSION['langue'] == 'en')
{
    $text = array("Statistics Series", "The system does not manage the complex numbers.", "Numbers of data", "Generate", "Calculate", "Data", "You have to choose the size of the array to generate it", "The statistics studies several characteristics: characters or variables in a finished set: population. The elements of this studied population are then called individuals.");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Series statistiques", "Le système ne prend pas en charge les nombres complexes.", "Nombres de données", "Generer", "Calculer", "Données", "Vous devez choisir la taille du tableau de données pour le générer", "La statistique étudie certaines caractéristiques : caractères ou variables d'un ensemble fini: population. Les éléments de cette population étudiée sont appelés alors individus.");
}

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <div class="alert alert-warning" role="alert"><?php echo $text[1]; ?></div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i>Documentation
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <p><?php echo $text[7]; ?><br />
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[0]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <form class="form-horizontal" method="get">

                        <fieldset>
                        <div class="form-group">
                          <label class="col-md-5 control-label" for="textinput"><?php echo $text[2]; ?></label>  
                          <div class="col-md-7">
                          <input id="textinput" name="numbers_data" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>

                        </fieldset>
                </div>
                <div class="panel-footer">
                    <button type="submit" value="ds" class="btn btn-primary center-block" style="width: 100%"><strong><?php echo $text[3]; ?></strong></button>
                </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[5]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <?php
                if (isset($_GET['numbers_data']))
                {
                ?>
                <form class="form-inline" method="post">
                  <table class="table table-bordered table-hover" data-height="299">
                    <tbody>
                      <tr>
                        <th>Valeur de la variable</th>
                        <th>Effectif</th>
                      </tr>
                      <?php
                      for ($y = 0; $y < $_GET['numbers_data']; $y++)
                      {
                        echo "<tr>";
                        for ($x = 0; $x < 2; $x++)
                        {
                          echo '<th><input id="textinput" name="data_'.$x.'_'.$y.'" type="text" placeholder="" style="width : 100%;" class="form-control input-md"></th>';
                        }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="test_stat" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[4]; ?></button>
                </div>
              </form>
              <?php
              }
              else
              {
              ?>
                <code><?php echo $text[6]; ?></code>
              <?php
              }
              ?>
            </div>
        </div>  
      </div>
      <div class="row">
        <?php
        if (isset($result))
        {
          ?>
            <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[5]; ?>
                </div>
                <div class="panel-body">

                      <p>Moyenne : <?php echo $result[0]; ?></p>
                      <p>Variance : <?php echo $result[1]; ?></p>
                      <p>Ecart type : <?php echo $result[2]; ?></p>
                      <p>Mediane : <?php echo $result[3]; ?></p>
                      <p>Mode : <?php echo $result[4]; ?></p>
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
