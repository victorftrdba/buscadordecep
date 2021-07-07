<?php
error_reporting(0);
date_default_timezone_set('America/Sao_Paulo')
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./cep.css">
    </head>
    <body>
                
        <form>
        Digite o CEP:
        <input type="text" name="cep" />
        <input type="submit" />
        </form>
        <br/>
        <div id="CepInfo">
        <?php
        $cep = $_GET['cep']; //CEP e ser consultado
        
        //Link do webservice com a variável $cep
        $link = "https://viacep.com.br/ws/$cep/json";
        
        //Chama a biblioteca passando o link
        $ch = curl_init($link);
        
        /* Passamos a biblioteca ($ch), esperando um retorno (CURLOPT_RETURNTRANSFER), 
        esperando uma resposta (1) */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        //Não verifica o SSL, já que os dados trafegados não são sensíveis (0)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        //Executa
        $response = curl_exec($ch);
        
        //Fecha conexão
        curl_close($ch);
        
        //Converte o JSON em array
        $data = json_decode($response, true);
        
        //MOSTRAR ARRAY-JSON INTEIRO print_r(json_encode($data));
        echo "CEP: ".$data['cep'];
        echo "<br>Rua: ".$data['logradouro'];
        echo "<br>Bairro: ".$data['bairro'];
        echo "<br>Cidade: ".$data['localidade'];
        ?>
        </div>
    </body>
</html>