<?php
    require_once 'php/libs/Markdown/markdown.php';
    
$expression = "";
$post_button = filter_input(INPUT_POST, 'button', FILTER_SANITIZE_SPECIAL_CHARS);
$post_express = filter_input(INPUT_POST, 'expresion', FILTER_SANITIZE_SPECIAL_CHARS);
if(isset($post_button)){
    $expression = process($post_button, $post_express);
}

function process($post, $express) {
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
            if($express == '' && $post == 0){
                $express = '';
            }else{
                $express .= $post;
            }
            break;
        case '=':
//            require_once 'php/Math.php';
//            $math = new Math();
//            $express = $math->evaluate($express);
            break;
        case 'C':
            $express = "";
            break;
    }
    
    return $express;
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
              <input class="form-control" type="text" name="anzeige" value="<?= ($expression == "") ? "0":$expression ?>" />
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
          <input type="hidden" name="expresion" value="<?=$expression; ?>">
      </form>

    </div>

    <div class="anmerkungen">
      <?= Markdown(file_get_contents("README.md")) ?>
    </div>

    <script src="bower_components/jquery/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>
