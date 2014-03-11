<?php
set_include_path('/home/tfoot/protsvetnoy.com/docs/core/components/moysklad');
require_once('service.moysklad.php');
require_once('utils.moysklad.php');
require_once('config.moysklad.php');

$service = new MoySkladService();
$goods = $service->getGoods();
$result = array();
foreach ($goods->attributes() as $name => $value) {
	$result[$name] = (string)$value;
}
//$i = 0;
$codes = array();
$resultGoods = array();
foreach ($goods as $good) {
	if ((string)$good['parentUuid'] != MoySkladConfig::WARE_GROUP_MENGLEI_UUID) continue;
	$uuid = (string)$good->uuid;
	$resultGoods[$uuid] = array();
	$resultGoods[$uuid]['name'] = (string)$good['name'];
	$resultGoods[$uuid]['productCode'] = (string)$good['productCode'];
	$codes[$uuid] = (string)$good['productCode'];
	$resultGoods[$uuid]['salePrice'] = (double)$good['salePrice'];
	$resultGoods[$uuid]['properties'] = array();
	foreach ($good->attribute as $attribute) {
	    //print_r($attribute);
	    if (isset($attribute['entityValueUuid'])) {
            $resultGoods[$uuid]['properties'][] = (string)$attribute['entityValueUuid'];
        }
    }
//	$i++;
}
array_multisort($codes, SORT_ASC, $resultGoods);
$result['good'] = $resultGoods;
return json_encode($result);
//return json_encode($service->getGoods());
/* Example XML
<?xml version="1.0" encoding="UTF-8"?>
<collection total="402" start="0" count="1000">
<good 
	isSerialTrackable="false" 
	buyPrice="17486.0" 
	minimumBalance="0.0" 
	weight="0.0" 
	volume="0.0" 
	minPrice="0.0" 
	uomUuid="19f1edc0-fc42-4001-94cb-c9ec9c62ec10" 
	countryUuid="fd44cd2e-b398-4222-9c43-f75688bdf327" 
	supplierUuid="8845ff9c-a1ec-11e2-162e-001b21d91495" 
	salePrice="43000.0" 
	saleCurrencyUuid="68a11ec6-a14e-11e2-bb85-001b21d91495"
	buyCurrencyUuid="68a11ec6-a14e-11e2-bb85-001b21d91495" 
	archived="false" 
	parentUuid="8e21b3fc-a14e-11e2-075a-001b21d91495" 
	productCode="ME092" 
	name="��������" 
	updated="2014-02-03T15:33:33.636+04:00" 
	updatedBy="admin@shalom" 
	readMode="ALL" 
	changeMode="NONE">
	
	<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
	<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
	<uuid>002e7339-c6c6-11e2-e683-001b21d91495</uuid>
	<code>ME092</code>
	<externalcode>225</externalcode>
	<description/>
	<attribute 
		goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" 
		metadataUuid="f26391b2-e93b-11e2-ec33-7054d21a8d1e" 
		entityValueUuid="861d509a-0fe6-11e3-c726-7054d21a8d1e" 
		updated="2014-01-19T16:46:11.109+04:00" 
		updatedBy="admin@shalom" 
		readMode="ALL" 
		changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>ac8f6f46-8107-11e3-0b70-002590a28eca</uuid>
	</attribute>
	<attribute 
		goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" 
		metadataUuid="2da66e46-e3d8-11e2-9b00-7054d21a8d1e" 
		entityValueUuid="a48f404c-e3d8-11e2-5d32-7054d21a8d1e" 
		updated="2014-02-03T15:33:33.638+04:00" 
		updatedBy="admin@shalom" 
		readMode="ALL" 
		changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>8c946477-ee1e-11e2-de46-7054d21a8d1e</uuid>
	</attribute>
	<attribute 
		goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" 
		metadataUuid="2da67490-e3d8-11e2-0fe5-7054d21a8d1e" 
		entityValueUuid="6866e528-e3d9-11e2-2b59-7054d21a8d1e" 
		updated="2014-02-03T15:33:33.638+04:00" 
		updatedBy="admin@shalom" 
		readMode="ALL" 
		changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>8c9461cd-ee1e-11e2-f2c8-7054d21a8d1e</uuid>
	</attribute>
	<attribute 
		goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" 
		metadataUuid="2da67148-e3d8-11e2-c954-7054d21a8d1e" 
		entityValueUuid="5c45b02f-e3d8-11e2-af83-7054d21a8d1e" 
		updated="2014-02-03T15:33:33.638+04:00" 
		updatedBy="admin@shalom" 
		readMode="ALL" 
		changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>8c94661a-ee1e-11e2-f3ee-7054d21a8d1e</uuid>
	</attribute>
	<attribute goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" metadataUuid="3ecfdb53-a1e6-11e2-4bf8-001b21d91495" updated="2014-02-03T15:33:33.638+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>8c94676d-ee1e-11e2-ad97-7054d21a8d1e</uuid>
		<file created="2013-05-27T16:08:11.775+04:00" filename="ME093.png" miniatureUuid="1a48d2cb-c6c6-11e2-8183-001b21d91495" name="ME093.png" updated="2013-05-27T16:08:12.134+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="NONE">
			<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
			<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
			<uuid>1a12297b-c6c6-11e2-a4ce-001b21d91495</uuid>
			<externalcode>R4D3Lf_Tigio3UK1G-AMT3</externalcode>
		</file>
	</attribute>
	<attribute goodUuid="002e7339-c6c6-11e2-e683-001b21d91495" metadataUuid="2da6777d-e3d8-11e2-3c1f-7054d21a8d1e" entityValueUuid="1e0623a2-e3d9-11e2-770b-7054d21a8d1e" updated="2014-01-19T16:46:11.109+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>ac8f7279-8107-11e3-e98e-002590a28eca</uuid>
	</attribute>
	<barcode barcode="2000000000411" barcodeType="EAN13" readMode="ALL" changeMode="NONE">
		<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
		<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
		<uuid>f8caa161-de36-11e2-d681-7054d21a8d1e</uuid>
	</barcode>
	<salePrices>
		<price currencyUuid="68a11ec6-a14e-11e2-bb85-001b21d91495" priceTypeUuid="5bcf63c7-ae65-11e2-283e-001b21d91495" value="79900.0" readMode="ALL" changeMode="ALL">
			<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
			<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
			<uuid>002e7e0d-c6c6-11e2-fb8c-001b21d91495</uuid>
		</price>
		<price currencyUuid="68a11ec6-a14e-11e2-bb85-001b21d91495" priceTypeUuid="68a476fa-a14e-11e2-43fe-001b21d91495" value="43000.0" readMode="ALL" changeMode="ALL">
			<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
			<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
			<uuid>002e7ca0-c6c6-11e2-a613-001b21d91495</uuid>
		</price>
		<price currencyUuid="68a11ec6-a14e-11e2-bb85-001b21d91495" priceTypeUuid="6bc55166-b0ce-11e2-8680-001b21d91495" value="120000.0" readMode="ALL" changeMode="ALL">
			<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
			<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
			<uuid>002e7f19-c6c6-11e2-209b-001b21d91495</uuid>
		</price>
	</salePrices>
	<preferences/>
</good><good isSerialTrackable="false" ...
</collection>
*/
?>