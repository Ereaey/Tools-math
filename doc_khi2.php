<?php
include('header.php');
include("class/ki.php");

if ($_SESSION['langue'] == 'en')
{
    $text = array("Columns", "The system does not manage the complex numbers.", "Generate", "Line", "Calculate", "Data", "You have to choose the size of the array to generate it", "Pearson's chi-squared test is a statistical test applied to sets of categorical data to evaluate how likely it is that any observed difference between the sets arose by chance. It is suitable for unpaired data from large samples");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Colonnes", "Le système ne prend pas en charge les nombres complexes.", "Génerer", "Lignes", "Calculer", "Données", "Vous devez choisir la taille du tableau de données pour le générer", "Le test du « khi-deux » est un test statistique permettant de tester l'adéquation d'une série de données à une famille de lois de probabilités ou de tester l'indépendance entre deux variables aléatoires.");
}

if (isset($_POST['test_ki']))
{
  $data = array();
  for ($x = 0; $x < $_GET['x']; $x++)
  {
    $d = array();
    for ($y = 0; $y < $_GET['y']; $y++)
    {
      $d[$y] = $_POST['data_'.$x.'_'.$y.''];
    }
    $data[$x] = $d;
  }
  $ki2 = new ki($data, $_GET['y'], $_GET['x']);
  $result_somme = $ki2->get_somme();
  $result_theorique = $ki2->get_theorique_tab();
  $result_ki = $ki2->get_tab_ki();
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
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i>Khi 2
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <form class="form-horizontal" method="get">

                        <fieldset>
                        <div class="form-group">
                          <label class="col-md-5 control-label" for="textinput"><?php echo $text[0]; ?></label>  
                          <div class="col-md-7">
                          <input id="textinput" name="y" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-5 control-label" for="textinput"><?php echo $text[3]; ?></label>  
                          <div class="col-md-7">
                          <input id="textinput" name="x" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>

                        </fieldset>
                </div>
                <div class="panel-footer">
                    <button type="submit" value="ds" id="valider_equation" name="valider_equation" class="btn btn-primary center-block" style="width: 100%"><strong><?php echo $text[2]; ?></strong></button>
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
                if (isset($_GET['x']) and isset($_GET['y']))
                {
                ?>
                <form class="form-inline" method="post">
                  <table class="table table-bordered table-hover" data-height="299">
                    <tbody>
                      <?php
                      for ($x = 0; $x < $_GET['x']; $x++)
                      {
                        echo "<tr>";
                        for ($y = 0; $y < $_GET['y']; $y++)
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
                    <button id="singlebutton" name="test_ki" class="btn btn-primary center-block" style="width: 100%"><?php echo $text[4]; ?></button>
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
        if (isset($result_somme))
        {
          ?>
            <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[5]; ?>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered table-hover" data-height="299">
                    <tbody>

                       <?php
                       echo '<tr>';
                      for ($y = 0; $y < ($_GET['y'] + 2); $y++)
                      {
                        if ($y < $_GET['y'] + 1)
                        {
                          echo '<th style="background-color: #f5f5f5;"></th>';
                        }
                        else
                          echo '<th>Total</th>';
                      }
                      echo '</tr>';
                      for ($x = 0; $x < ($_GET['x'] + 1); $x++)
                      {
                        if ($x < $_GET['x'])
                          echo '<tr><th style="background-color: #f5f5f5;"></th>';
                        else
                          echo '<tr><th>Total</th>';
                        for ($y = 0; $y < ($_GET['y'] + 1); $y++)
                        {
                          echo '<th>'.$result_somme[$x][$y].'</th>';
                        }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($result_theorique))
        {
          ?>
            <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[5]; ?>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered table-hover" data-height="299">
                    <tbody>

                       <?php
                       echo '<tr>';
                      for ($y = 0; $y < ($_GET['y'] + 2); $y++)
                      {
                        if ($y < $_GET['y'] + 1)
                        {
                          echo '<th style="background-color: #f5f5f5;"></th>';
                        }
                        else
                          echo '<th>Total</th>';
                      }
                      echo '</tr>';
                      for ($x = 0; $x < ($_GET['x'] + 1); $x++)
                      {
                        if ($x < $_GET['x'])
                          echo '<tr><th style="background-color: #f5f5f5;"></th>';
                        else
                          echo '<tr><th>Total</th>';
                        for ($y = 0; $y < ($_GET['y'] + 1); $y++)
                        {
                          echo '<th>'.number_format($result_theorique[$x][$y], 3).'</th>';
                        }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($result_ki))
        {
          ?>
            <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[5]; ?>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered table-hover" data-height="299">
                    <tbody>

                       <?php
                       echo '<tr>';
                      for ($y = 0; $y < ($_GET['y'] + 2); $y++)
                      {
                        if ($y < $_GET['y'] + 1)
                        {
                          echo '<th style="background-color: #f5f5f5;"></th>';
                        }
                        else
                          echo '<th>Total</th>';
                      }
                      echo '</tr>';
                      for ($x = 0; $x < ($_GET['x'] + 1); $x++)
                      {
                        if ($x < $_GET['x'])
                          echo '<tr><th style="background-color: #f5f5f5;"></th>';
                        else
                          echo '<tr><th>Total</th>';
                        for ($y = 0; $y < ($_GET['y'] + 1); $y++)
                        {
                          echo '<th>'.number_format($result_ki[$x][$y], 3).'</th>';
                        }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
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
