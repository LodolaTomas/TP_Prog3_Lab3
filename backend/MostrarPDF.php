<?php

use Mpdf\HTMLParserMode;

include "./Fabrica.php";
require_once('../vendor/autoload.php');
header('Conten-Type:application/pdf');

$mpdf = new \Mpdf\Mpdf([
    'pagenumPrefix' => 'Página nro. ',
    'pagenumSuffix' => ' - ',
    'nbpgPrefix' => ' de ',
    'nbpgSuffix' => ' páginas'
]);
session_start();
$dni=$_SESSION["DNIEmpleado"];
$mpdf->SetProtection(array('copy'), $dni  , 'MyPassword');
//$css = file_get_contents("../style.css");
//intento de ponerle css //Mejorar css del PDF HACER
$mpdf->WriteHTML('
p{
    background:  #584d4d;
    color: white;
    border-radius: 4px;
    padding: auto 10px;
    margin: 30px auto;  
    font-size: 20px;
}
th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {background-color: #d3c0c0;}
', \Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHeader('Lodola Tomas||{PAGENO}{nbpg}');
$mpdf->setFooter('LocalHost');
$htmlMostrar=Plantilla();
$mpdf->WriteHTML($htmlMostrar, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("ListadoEmpleados.pdf","I");


function Plantilla()
{
    $path = "../archivos/empleados.txt";
    $listaEmpleados = array();
    $unaFabrica = new Fabrica("Google", 7);
    $unaFabrica->TraerDeArchivo($path);
    $listaEmpleados = $unaFabrica->GetEmpleados();
    $plantilla="";
    $plantilla .= '<body><p>Listado de Empleados<p><table>';

    foreach ($listaEmpleados as $unEmpleado) {
        $plantilla .= '<tr>
            <td>' .
            $unEmpleado->ToString() .
            '</td> <td> <img src='.'../fotos/' . $unEmpleado->GetPathFoto() . 'width="90" height="90"> </td> </tr>';
    }
    $plantilla .= '</table></body>';
    return $plantilla;
}
