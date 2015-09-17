<?php
include('header.php');
include("class/equation.php");
if ($_SESSION['langue'] == 'en')
{
    $text = array("Equation", "The system does not manage the complex numbers.", "Resolve", "Result", "Read documentation", "Documentation", "<samp>The present form allows to solve this type of equation</samp><br />
                          <var>ax³</var> + <var>bx²</var> + <var>cx</var> + <var>d</var> = 0<br />
                          <samp>Fields can remain empty, this system do not manage complex numbers</samp>");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Equation", "Le système ne prend pas en charge les nombres complexes.", "Résoudre", "Résultat", "Voir la documentation", "Documentation", "<samp>Le formulaire présent permet de résoudre ce type d'équation</samp><br />
                          <var>ax³</var> + <var>bx²</var> + <var>cx</var> + <var>d</var> = 0<br />
                          <samp>Les champs peuvent rester vides, le systéme ne gére pas les nombres complexes</samp>");
}

if (isset($_POST['valider_equation']))
{
  $equation = new Equation($_POST['x3'], $_POST['x2'], $_POST['x'], $_POST['d']);
  $equation->Resolve();
  $result = $equation->getResult();
  $result_d = $equation->getResult_detail();
  $delta = $equation->getDelta();
  $f = $equation->getFonctionAff();
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <div class="alert alert-warning" role="alert"><?php echo $text[1]; ?></div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[0]; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <form class="form-horizontal" method="post" action="index.php">

                        <fieldset>
                        <!-- Appended Input-->
                        <div class="form-group">
                          <div class="col-sm-12">
                            <div class="input-group">
                               
                                  <input id="x3" name="x3" class="form-control center-block" placeholder="a" type="text">
                                  <span class="input-group-addon">x^3</span>
                                </div>
                            </div>
                        </div>
                        <!-- Appended Input-->
                        <div class="form-group">
                          <div class="col-sm-12">
                            <div class="input-group">

                              <input id="x2" name="x2" class="form-control" placeholder="b" type="text">
                              <span class="input-group-addon">x^2</span>
                            </div>
                          </div>
                        </div>
                        <!-- Appended Input-->
                        <div class="form-group">
                          <div class="col-sm-12">
                            <div class="input-group">
                              <input id="x" name="x" class="form-control" placeholder="c" type="text">
                              <span class="input-group-addon">x</span>
                            </div>
                          </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                          <div class="col-sm-12">
                          <input id="d" type="text"name="d" placeholder="d" class="form-control input-md">
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
                <div class="panel-body" style="min-height:226px;">
                  <?php
                  if (isset($f))
                  {
                  ?>
                    <center><p><img alt="mimetex:\large f(x)\ =<?php echo $f; ?>"></p></center>
                  <?php
                  }
                  ?>
                        <code style="padding : 0px;">
                          <?php echo $text[6]; ?>
                        </code>
                </div>
                <div class="panel-footer">
                    <a href="doc_equation.php"><button type="" name="" class="btn btn-primary" style="width: 220px;"><strong><?php echo $text[4]; ?></strong></button></a>
                </div>
            </div>
        </div>


    <?php
    if (!empty($result))
    {
    ?>
       <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $text[3]; ?>
                </div>
                <div class="panel-body" style="height: auto;">
                    <?php
                    if (!empty($delta))
                    {
                    ?>
                      <div class="alert alert-info" role="alert" style="margin-bottom: 2px;">
                      
                      <p><img alt="mimetex:\Delta = <?php echo $delta; ?>"></p>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($result[0]) or $result[0] == "0")
                    {
                    ?>
                    <div class="alert alert-success" role="alert" style="margin-bottom: 2px;">
                      <p><img alt="mimetex:x1=<?php echo $result_d[0]; ?>"></p>
                      <p><img alt="mimetex:x1=<?php echo $result[0]; ?>"></p>
                    </div>
                    <?php
                    }
                    if (!empty($result[1]))
                    {
                    ?>
                    <div class="alert alert-success" role="alert" style="margin-bottom: 2px;">
                      <p><img alt="mimetex:x2=<?php echo $result_d[1]; ?>"></p>
                      <p><img alt="mimetex:x2=<?php echo $result[1]; ?>"></p>
                      
                    </div>
                    <?php
                    }
                    if (!empty($result[2]))
                    {
                    ?>
                    <div class="alert alert-success" role="alert" style="margin-bottom: 2px;">
                      <p><img alt="mimetex:x3=<?php echo $result_d[2]; ?>"></p>
                      <p><img alt="mimetex:x3=<?php echo $result[2]; ?>"></p>
                    </div>
                    <?php
                    }
                    ?>
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
