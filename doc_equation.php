<?php
include('header.php');
include("class/equation.php");
if ($_SESSION['langue'] == 'en')
{
    $text = array("Equation", "The system does not manage the complex numbers.", "Resolve", "Result", "Read documentation", "Documentation", "<samp>The present form allows to solve this type of equation</samp><br />
                          <var>ax³</var> + <var>bx²</var> + <var>cx</var> + <var>d</var> = 0<br />
                          <samp>Fields can remain empty</samp>");
    $algo = array("Algorithm for first degree equations <var>ax</var> + <var>b</var> = 0<br /><br />x = (- b)/ (a)", "Algorithm for second degree equations <var>ax²</var> + <var>bx</var> + <var>c</var> = 0<br /><br />
                          Delta = <var>bx²</var> - 4 * a * c<br />
                          SI Delta < 0<br />
                          ALORS<br />
                            <span class=\"marge\">x1 = (- b - racine(Delta))i / (2 * a)<br /></span>
                            <span class=\"marge\">x2 = (- b + racine(Delta))i / (2 * a)<br /></span>
                          FINSI<br />
                          SI Delta = 0<br />
                          ALORS<br />
                            <span class=\"marge\">x = (-b) / (2 * a)<br /></span>
                          FINSI<br />
                          SI Delta > 0<br />
                          ALORS<br />
                            <span class=\"marge\">x1 = (- b - racine(Delta)) / (2 * a)<br /></span>
                            <span class=\"marge\">x2 = (- b + racine(Delta)) / (2 * a)<br /></span>
                          FINSI", "For this algorithm, I have used this website <a href=\"http://www.alain.be/boece/degree3algo.html\">site</a><br />
                          Thanks to this, i can do my algorithm<br />
                          This algorithm is to big to be on this page.");
    $menu = array("Quadratic equation", "Cubic function", "Linear equation");

}
else if ($_SESSION['langue'] == 'fr')
{
    $text = array("Equation", "Le système ne prend pas en charge les nombres complexes.", "Résoudre", "Résultat", "Voir la documentation", "Documentation", "<samp>Le formulaire présent permet de résoudre ce type d'équation</samp><br />
                          <var>ax³</var> + <var>bx²</var> + <var>cx</var> + <var>d</var> = 0<br />
                          <samp>Les champs peuvent rester vides</samp>");
    $algo = array("Algorithme pour une equation du premier degré <var>ax</var> + <var>b</var> = 0<br /><br />x = (- b)/ (a)", "Algorithme pour une equation du second degré <var>ax²</var> + <var>bx</var> + <var>c</var> = 0<br /><br />
                          Delta = <var>bx²</var> - 4 * a * c<br />
                          SI Delta < 0<br />
                          ALORS<br />
                            <span class=\"marge\">x1 = (- b - racine(Delta))i / (2 * a)<br /></span>
                            <span class=\"marge\">x2 = (- b + racine(Delta))i / (2 * a)<br /></span>
                          FINSI<br />
                          SI Delta = 0<br />
                          ALORS<br />
                            <span class=\"marge\">x = (-b) / (2 * a)<br /></span>
                          FINSI<br />
                          SI Delta > 0<br />
                          ALORS<br />
                            <span class=\"marge\">x1 = (- b - racine(Delta)) / (2 * a)<br /></span>
                            <span class=\"marge\">x2 = (- b + racine(Delta)) / (2 * a)<br /></span>
                          FINSI", "Pour cette algorithme, je me suis servi de ce <a href=\"http://www.alain.be/boece/degree3algo.html\">site</a><br />
                          A partir de la méthode de la calcul, je fais mon algorithme<br />
                          Celui ci est trop imposant pour étre affiché ici.");
    $menu = array("Second degrée", "Troisiéme degrée", "Premier degrée");
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
                <div class="panel-body" style="min-height: 226px">
                  <?php
                  if (isset($f))
                  {
                  ?>
                    <center><p><img alt="mimetex:\large f(x)\ =<?php echo $f; ?>"></p></center>
                  <?php
                  }
                  ?>
                        <code>
                          <?php echo $text[6]; ?>
                        </code><br />


                </div>
                <div class="panel-footer">
                    <button type="submit" value="ds" id="valider_equation" name="valider_equation" class="btn btn-primary" style="width: 220px;"><strong><?php echo $text[4]; ?></strong></button>
                </div>
            </div>
        </div>
      </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $menu[2] ?>
                </div>
                <div class="panel-body" style="height: auto;">

                        <code>
                          <?php echo $algo[0]; ?>
                        </code>
              </div>
          </div>
        </div>
       <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $menu[0] ?>
                </div>
                <div class="panel-body" style="height: auto;">

                        <code>
                          <?php echo $algo[1]; ?>

                        </code>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gear fa-fw" style="margin-right: 10px;"></i><?php echo $menu[1] ?>
                </div>
                <div class="panel-body" style="height: auto;"><code>
                  <?php echo $algo[2]; ?>
                        </code>
              </div>
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
