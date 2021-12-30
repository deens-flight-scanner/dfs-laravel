<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class SoapController extends Controller
{
    //
    public function timeZone($airport_code)
    {
        $soapclient = new SoapClient('https://dfs-timezone.herokuapp.com/SOAPTime.asmx');

        $param=array('airportCode'=>$airport_code);

        $response = $soapclient->createTimeObject($param);

        $array = json_decode(json_encode($response), true);

        return $array;
    }
    
    public function timeDifference($departure_code, $arrival_code)
    {
        $soapclient = new SoapClient('https://dfs-timezone.herokuapp.com/SOAPTime.asmx');

        $param=array('departureCode'=>$departure_code, 'arrivalCode'=>$arrival_code);

        $response = $soapclient->timeDifference($param);

        $array = json_decode(json_encode($response), true);

        return $array;
    }
}
