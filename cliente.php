<?php
    require_once('nusoap.php');
    $client = new nusoap_client('http://localhost/ejercicio3/servidor.php?wsdl', true);

    $err = $client->getError();
    if ($err) {
        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    }
    
    $dato = $_POST['temp'];
    $boton = $_POST['boton'];
    
    if ($client->fault) {
        echo '<h2>Fault</h2>';        
    } else {
        // Check for errors
        $err = $client->getError();
        if ($err) {
            // Display the error
            echo '<h2>Error</h2><pre>' . $err . '</pre>';
        } else {
            if ($boton == 1){
                $result = $client->call('CelsiusToFahrenheit', array('tempCelsius' => $dato)); 
                print_r($dato."°C equivale a ". $result."°F.");
            }else{
                $result = $client->call('FahrenheitToCelsius', array('tempFahrenheit' => $dato)); 
                print_r($dato."°F equivale a ". $result."°C.");    
            }
        }
    }
?>