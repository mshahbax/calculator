<?php
    require_once 'php/libs/Markdown/markdown.php';
    
 session_start();
 
$_SESSION['expression'] = (!isset($_SESSION['expression']) || $_SESSION['expression'] == '') ?  "" : $_SESSION['expression'];
$display = (!isset($_SESSION['display']) || $_SESSION['display'] == '') ?  "0" : $_SESSION['display'];

if(isset($_POST['button'])){
    
    process($_POST['button']);
    $display = (!isset($_SESSION['display']) || $_SESSION['display'] == '') ?  "0" : $_SESSION['display'];
}else{
    unset($_SESSION['expression'],$_SESSION['display']);
    $display = 0;
}

function process($post) {
    switch ($post) {
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
        case '0':
        case '+':    
        case '-':
        case '/':
        case '*':
            if($_SESSION['expression'] == '' && $post == 0){
                $_SESSION['expression'] = '';
            }else{
                $_SESSION['expression'] .= $post;
                $_SESSION['display'] = $_SESSION['expression'];
            }
            
            break;
        case '=':
            require_once 'php/Math.php';
            $math = new Math();
            $_SESSION['display'] = $math->evaluate($_SESSION['expression']);
            $_SESSION['expression'] = $_SESSION['display'];
            break;
        case 'C':
            $_SESSION['expression'] = 0;
            $_SESSION['display'] = 0;
            break;
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Calculator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/global.css" rel="stylesheet" media="screen">    
  </head>
  <body>
    <div class="main">

      <h1>3pc Taschenrechner</h1>

      <form action="" method="post">

        <table class="calculator">
          <tr>
            <td colspan="5">
              <input class="form-control" type="text" name="anzeige" value="<?= $display ?>" />
            </td>
          </tr>
          <tr>
            <td><input class="btn btn-sm btn-primary" type="submit" value="1" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="2" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="3" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="+" name="button" /></td>
            <td><button class="btn btn-sm btn-primary" type="submit" name="button" value="square">x<sup>2</sup></button></td>
          </tr>
          <tr>
            <td><input class="btn btn-sm btn-primary" type="submit" value="4" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="5" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="6" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="-" name="button" /></td>
            <td><button class="btn btn-sm btn-primary" type="submit" name="button" value="power">x<sup>y</sup></button></td>
          </tr>
          <tr>
            <td><input class="btn btn-sm btn-primary" type="submit" value="7" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="8" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="9" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="*" name="button" /></td>
            <td><button class="btn btn-sm btn-primary" type="submit" name="button" value="faculty">x!</button></td>
          </tr>
          <tr>
            <td><button class="btn btn-sm btn-primary" type="submit" name="button" value="plusminus">&plusmn;</button></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="0" name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="," name="button" /></td>
            <td><input class="btn btn-sm btn-primary" type="submit" value="/" name="button" /></td>
            <td><button class="btn btn-sm btn-primary" type="submit" value="sqrt" name="button" />&radic;<span style="text-decoration:overline;">&nbsp;x</span></td>
          </tr>
          <tr>
            <td><input class="btn btn-sm btn-danger" type="submit" value="C" name="button" /></td>          
            <td><button class="btn btn-sm btn-warning" type="submit" name="button" value="load">LOAD</button></td>
            <td><button class="btn btn-sm btn-warning" type="submit" name="button" value="save">SAVE</button></td>
            <td><button class="btn btn-sm btn-primary" type="submit" value="pi" name="button" />&pi;</td>
            <td><input class="btn btn-sm btn-success" type="submit" value="=" name="button" /></td>
          </tr>
        </table>

      </form>

    </div>

    <div class="anmerkungen">
      <?= Markdown(file_get_contents("README.md")) ?>
    </div>

    <script src="bower_components/jquery/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>
