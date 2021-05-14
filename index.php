<?php

$precoMoedaSeparado = "";
$erro = "";

if(isset($_GET ['moeda'])){

    if ($_GET['moeda']){

        if(!@file_get_contents("https://coinmarketcap.com/currencies/".$_GET['moeda'])) {

            $erro = true;

        } else {

            $coinMkPage = file_get_contents("https://coinmarketcap.com/currencies/".$_GET['moeda']);

            $pageArray = explode('Price Today</caption><tbody><tr><th scope="row">', $coinMkPage);

            $pageArray2 = explode('</td></tr><tr><th scope="row"><span class="withBadge___2l5n0">Price Change<span class="badge24h___3Hbkq">24h</span></span>', $pageArray[1]);

            $pageArray3 = explode('Price</strong></th><td>', $pageArray2[0]);

            
            $nomeMoeda = $_GET['moeda']." = ";
            $precoMoedaSeparado = $pageArray3[1];
        }

    } else {
        $moeda = "";
    }
    
} else {
    echo "<body>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="author" content="Isabela Carrara">
    <title>CriptoMoedas</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="images/favicon.ico">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="msapplication-config" content="images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Codystar&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mobile.css">

    </head>
    <body>
        <div class="container">
            <div class="container-fluid, containerBox">
                <h1>CRIPTOMOEDAS</h1>
                <form>
                    <fieldset class="form-group">
                        <label class="lableColor" for="moeda">Pesquise uma moeda para saber a cotação</label>
                        <input type="search" class="form-control" name="moeda" id="moeda" placeholder="Ex: Bitcoin" 
                        value = "<?php 
                        if(isset($_GET ['moeda'])){
                        echo $_GET['moeda']; 
                        } else {
                            echo "";
                        } ?>">
                        
                    </fieldset>
        
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </form>

                <div id="resultado">
                    <p><strong>
                        <?php
                        if ($precoMoedaSeparado) {
                            echo '<div class="alert alert-info" role="alert">'.strtoupper($nomeMoeda.$precoMoedaSeparado).'</div>';
                        } else {
                            if($erro){
                                echo '<div class="alert alert-danger" role="alert">
                                Escreva uma moeda válida
                                </div>'; 
                            } else {
                                echo '<div class="alert alert-light invisivel" role="alert">
                                Aguardando moeda
                                </div>';
                            }
                        } 
                        ?> 
                    </strong></p>
                </div>
                <div id="copyright"><p>&#169; Isabela Carrara</p></div>
            </div>
        </div>


    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>    
    </body>
</html>