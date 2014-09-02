<?php
set_include_path('/home/tfoot/protsvetnoy.com/docs/core/components/moysklad');
require_once('service.moysklad.php');
require_once('utils.moysklad.php');
require_once('config.moysklad.php');

$service = new MoySkladService();
$stocks = $service->getStock();

$result = array();
foreach ($stocks as $stock) {
	$productCode = (string)$stock['productCode'];
	$result[$productCode] = (string)$stock['stock'];
}
return json_encode($result);
/*
SimpleXMLElement Object (
    [stockTO] => Array (
        [0] => SimpleXMLElement Object (
            [@attributes] => Array (
                [productCode] => MMC043
                [uomName] => шт
                [quantity] => 36.0
                [reserve] => 0.0
                [inTransit] => 0.0
                [stock] => 36.0
                [sumTotal] => 1128306.0
                [saleAmount] => 2502000.0
                [minimumBalance] => 0.0
                [category] => Menglei
                [externalCode] => MUrJIJ71hjuXo9vKtg5Jq3
                [parentUuid] => 8e21b3fc-a14e-11e2-075a-001b21d91495
                [defaultConsignment] => false
                [salePrice] => 69500.0
            )
            [goodRef] => SimpleXMLElement Object (
                [@attributes] => Array (
                    [uuid] => 60756b1b-5903-11e3-fe59-7054d21a8d1e
                    [name] => Верный спутник
                    [code] => MMC043
                    [objectType] => Good
                )
            )
        )
        [1] => SimpleXMLElement Object (
            [@attributes] => Array (
                [productCode] => MF012
                [uomName] => шт
                [quantity] => 0.0
                [reserve] => 0.0
                [inTransit] => 0.0
                [stock] => 0.0
                [sumTotal] => 0.0
                [saleAmount] => 0.0
                [minimumBalance] => 0.0
                [category] => Menglei
                [externalCode] => 262
                [parentUuid] => 8e21b3fc-a14e-11e2-075a-001b21d91495 [defaultConsignment] => false [salePrice] => 50000.0 ) [goodRef] => SimpleXMLElement Object ( [@attributes] => Array ( [uuid] => 796f1283-c6c8-11e2-0bed-001b21d91495 [name] => Регата [code] => MF012 [objectType] => Good ) ) ) [2] => SimpleXMLElement Object ( [@attributes] => Array ( [productCode] => MA006 [uomName] => шт [quantity] => 0.0 [reserve] => 0.0 [inTransit] => 0.0 [stock] => 0.0 [sumTotal] => 0.0 [saleAmount] => 0.0 [minimumBalance] => 0.0 [category] => Menglei [externalCode] => KG843m24i4ajxjDWyFFMU2 [parentUuid] => 8e21b3fc-a14e-11e2-075a-001b21d91495 [defaultConsignment] => false [salePrice] => 12000.0 ) [goodRef] => SimpleXMLElement Object ( [@attributes] => Array ( [uuid] => b65435a6-c6bc-11e2-96be-001b21d91495 [name] => Пикник [code] => MA006 [objectType] => Good ) ) ) [3] => SimpleXMLElement Object ( [@attributes] => Array ( [productCode] => MG293 [uomName] => шт [quantity] => 44.0 [reserve] => 0.0 [inTransit] => 0.0 [stock] => 44.0 [sumTotal] => 914692.0 [saleAmount] => 2464000.0 [minimumBalance] => 0.0 [category] => Menglei [externalCode] => JJ_pok_XgUWhstONvzvDL2 [parentUuid] => 8e21b3fc-a14e-11e2-075a-001b21d91495 [defaultConsignment] => false [salePrice] => 56000.0 ) [goodRef] => SimpleXMLElement Object ( [@attributes] => Array ( [uuid] => 3a42e5ce-1a3d-11e3-ac30-7054d21a8d1e [name] => Встреча [code] => MG293 [objectType] => Good ) ) ) [4] => SimpleXMLElement Object ( [@attributes] => Array ( [productCode] => pd3040 [uomName] => шт [quantity] => 3.0 [reserve] => 0.0 [inTransit] => 0.0 [stock] => 3.0 [sumTotal] => 24000.0 [saleAmount] => 36000.0 [minimumBalance] => 0.0 [category] => Аксессуары [externalCode] => gwYnAaQ8gXyBhtIcsJ8gH0 [parentUuid] => 3be87114-e05d-11e3-0f90-002590a28eca [defaultConsignment] => false [salePrice] => 12000.0 ) [goodRef] => SimpleXMLElement Object ( [@attributes] => Array ( [uuid] => bb45fcda-e0f2-11e3-968f-002590a28eca [name] => подрамник [code] => pd3040 [objectType] => Good ) ) ) [5] => SimpleXMLElement Object ( [@attributes] => Array ( [productCode] => ME036 [uomName] => шт [quantity] => 0.0 [reserve] => 0.0 [inTransit] => 0.0 [stock] => 0.0 [sumTotal] => 0.0 [saleAmount] => 0.0 [minimumBalance] => 0.0 [category] => Menglei [externalCode] => -5lSsOhWgVevz46AXtKKv2 [parentUuid] => 8e21b3fc-a14e-11e2-075a-001b21d91495 [defaultConsignment] => false [salePrice] => 43000.0 ) [goodRef] => SimpleXMLElement Object ( [@attributes] => Array ( [uuid] => d89d4447-c6c4-11e2-6686-001b21d91495 [name] => Джаконда [code] => ME036 [objectType] => Good ) ) ) [6] => SimpleXMLElement Object ( [@attributes] => Array ( [productCode] =>
*/
?>