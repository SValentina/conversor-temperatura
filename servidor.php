<?php    
    require_once('nusoap.php');
    $server = new soap_server();

    // Initialize WSDL support
    $server->configureWSDL('mathwsdl', 'urn:mathwsdl');

    // Register the FahrenheitToCelsius method to expose its method name
    $server->register('FahrenheitToCelsius',    
        array('tempFahrenheit' => 'xsd:float'),    // input parameters
        array('tempCelsius' => 'xsd:float'),             // output parameters
        'urn:TemperatureConverterwsdl',                              // namespace    
        'urn:TemperatureConverterwsdl#FahrenheitToCelsius',          // soapaction
        'rpc',                                                  // style
        'encoded',                                              // use    
        'Convierte la temperatura de Fahrenheit a Celsius.'  // documentation
    );

    $server->register('CelsiusToFahrenheit',    
        array('tempCelsius' => 'xsd:float'),    // input parameters
        array('tempFahrenheit' => 'xsd:float'),             // output parameters
        'urn:TemperatureConverterwsdl',                              // namespace    
        'urn:TemperatureConverterwsdl#CelsiusToFahrenheit',          // soapaction
        'rpc',                                                  // style
        'encoded',                                              // use    
        'Convierte la temperatura de Celsius a Fahrenheit.'  // documentation
    );

    // Define the TemperatureConverter method as a
    // PHP function
    function FahrenheitToCelsius($tempFahrenheit) {                
        return round((($tempFahrenheit-32)*(5/9)),2);
    }

    function CelsiusToFahrenheit($tempCelsius) {
        return round((($tempCelsius*(9/5))+32),2);
    }

    // Use the request to invoke the service
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
    //$server->service($HTTP_RAW_POST_DATA);
    $server->service(file_get_contents("php://input"));
?>