<?php
function retornaVinos($arregloVinos) {
    $tipoVinos = array();
    for ($i = 0; $i < count($arregloVinos); $i++) {
        $tipo = $arregloVinos[$i]["variedad"];
        if (array_key_exists($tipo, $tipoVinos)) {
            $tipoVinos[$tipo]["cantidadBotellas"] = $tipoVinos[$tipo]["cantidadBotellas"] + $arregloVinos[$i]["cantidadBotellas"];
            $tipoVinos[$tipo]["precioProm"] =  $tipoVinos[$tipo]["precioProm"] + $arregloVinos[$i]["precioUnidad"];
            $tipoVinos[$tipo]["contador"] = $tipoVinos[$tipo]["contador"]+1;
        }
        else {
            $infoVino = array();
            $infoVino["cantidadBotellas"] = $arregloVinos[$i]["cantidadBotellas"];
            $infoVino["precioProm"] = $arregloVinos[$i]["precioUnidad"];
            $infoVino["contador"] = 1;
            $tipoVinos[$tipo] = $infoVino;
        }
    }
    $prom = sacarpromedio($tipoVinos);
    return $prom;
}
function sacarpromedio($arregloTIpo){
    
    foreach ( $arregloTIpo as $indice => $elemento) {
        $arregloTIpo[$indice]["precioProm"] = $arregloTIpo[$indice]["precioProm"] / $arregloTIpo[$indice]["contador"];
    }
    return  $arregloTIpo;
}
function main() {
    $arregloVinos = array();
    $arregloVinos[0] = array("variedad"=>"MALBEC","cantidadBotellas"=>400,"anioProduccion"=>2010,"precioUnidad"=>150);
    $arregloVinos[1] = array("variedad"=>"CABERNET SAUVIGNON","cantidadBotellas"=>200,"anioProduccion"=>2010,"precioUnidad"=>200);
    $arregloVinos[2] = array("variedad"=>"MERLOT","cantidadBotellas"=>150,"anioProduccion"=>2011,"precioUnidad"=>170);
    $arregloVinos[3] = array("variedad"=>"TANNAT","cantidadBotellas"=>75,"anioProduccion"=>2000,"precioUnidad"=>145);
    $arregloVinos[4] = array("variedad"=>"MALBEC","cantidadBotellas"=>200,"anioProduccion"=>2005,"precioUnidad"=>200);
    $arregloVinos[5] = array("variedad"=>"CABERNET SAUVIGNON","cantidadBotellas"=>50,"anioProduccion"=>2000,"precioUnidad"=>250);
    $arregloVinos[6] = array("variedad"=>"SANGIOVESE","cantidadBotellas"=>42,"anioProduccion"=>2007,"precioUnidad"=>250);
    $arregloVinos[7] = array("variedad"=>"TANNAT","cantidadBotellas"=>100,"anioProduccion"=>2012,"precioUnidad"=>250);
    $arregloVinos[8] = array("variedad"=>"CABERNET SAUVIGNON","cantidadBotellas"=>100,"anioProduccion"=>1998,"precioUnidad"=>300);
    $arregloVinos[9] = array("variedad"=>"CABERNET SAUVIGNON","cantidadBotellas"=>43,"anioProduccion"=>1890,"precioUnidad"=>350);
    $arregloVinos[10] = array("variedad"=>"SANGIOVESE","cantidadBotellas"=>35,"anioProduccion"=>1950,"precioUnidad"=>350);
    $arregloVinos[11] = array("variedad"=>"TANNAT","cantidadBotellas"=>130,"anioProduccion"=>2010,"precioUnidad"=>150);
    $arregloVinos[12] = array("variedad"=>"SANGIOVESE","cantidadBotellas"=>85,"anioProduccion"=>2011,"precioUnidad"=>200);
    $arregloVinos[13] = array("variedad"=>"MALBEC","cantidadBotellas"=>120,"anioProduccion"=>2005,"precioUnidad"=>350);
    $arregloVinos[14] = array("variedad"=>"SANGIOVESE","cantidadBotellas"=>40,"anioProduccion"=>2010,"precioUnidad"=>500);
    $arregloVinos[15] = array("variedad"=>"MALBEC","cantidadBotellas"=>100,"anioProduccion"=>2017,"precioUnidad"=>200);
    $arregloVinos[16] = array("variedad"=>"TANNAT","cantidadBotellas"=>160,"anioProduccion"=>2018,"precioUnidad"=>150);
    $arregloVinos[17] = array("variedad"=>"MALBEC","cantidadBotellas"=>200,"anioProduccion"=>2018,"precioUnidad"=>130);
    $arregloVinos[18] = array("variedad"=>"CABERNET SAUVIGNON","cantidadBotellas"=>50,"anioProduccion"=>2000,"precioUnidad"=>190);
    $arregloVinos[19] = array("variedad"=>"TANNAT","cantidadBotellas"=>100,"anioProduccion"=>2015,"precioUnidad"=>160);
    $arregloVinos[20] = array("variedad"=>"SANGIOVESE","cantidadBotellas"=>150,"anioProduccion"=>2011,"precioUnidad"=>200);
    $arregloVinos[21] = array("variedad"=>"MERLOT","cantidadBotellas"=>150,"anioProduccion"=>2010,"precioUnidad"=>170);
    $arregloVinos[22] = array("variedad"=>"MERLOT","cantidadBotellas"=>200,"anioProduccion"=>2007,"precioUnidad"=>170);
    $resultado = retornaVinos($arregloVinos);
    print_r($resultado);
}
main();
?>