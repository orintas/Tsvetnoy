<?php
set_include_path('/home/tfoot/protsvetnoy.com/docs/core/components/moysklad');
require_once('service.moysklad.php');
require_once('utils.moysklad.php');
require_once('config.moysklad.php');

$service = new MoySkladService();
$demands = $service->getRetailDemand();
$result = array();
foreach ($demands->attributes() as $name => $value) {
	$result[$name] = (string)$value;
}
$i = 0;
$demandDates = array();
$resultDemands = array();
foreach ($demands as $demand) {
    $uuid = (string)$demand->uuid;
    $resultDemands[$i] = array(
        "retailStoreUuid"   => (string)$demand["retailStoreUuid"],
        "created"           => (string)$demand["created"],
        "sum"               => (string)$demand->sum["sum"],
        "shipmentOut"       => array()
    );
    $dateTime = new DateTime((string)$demand["created"]);
    $demandDates[$i] = $dateTime->getTimestamp();
    $shipments = array();
    if (is_array($demand->shipmentOut)) {
        foreach($demand->shipmentOut as $shipment) {
            $shipments[$shipment->uuid] = array(
                "discount"  => (string)$shipment["discount"],
                "quantity"  => (string)$shipment["quantity"],
                "goodUuid"  => (string)$shipment["goodUuid"],
                "basePrice" => (string)$shipment->basePrice["sum"],
                "price"     => (string)$shipment->price["sum"]
            );
        }
    } else {
        $shipments[(string)$demand->shipmentOut->uuid] = array(
            "discount"  => (string)$demand->shipmentOut["discount"],
            "quantity"  => (string)$demand->shipmentOut["quantity"],
            "goodUuid"  => (string)$demand->shipmentOut["goodUuid"],
            "basePrice" => (string)$demand->shipmentOut->basePrice["sum"],
            "price"     => (string)$demand->shipmentOut->price["sum"]
        );
    }
    $resultDemands[$i]["shipmentOut"] = $shipments;
    $i++;
}
array_multisort($demandDates, SORT_ASC, SORT_NUMERIC, $resultDemands);
$result['demand'] = $resultDemands;
return json_encode($result);
/*
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:37:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:38:29.802+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01853
            [updated] => 2014-03-07T15:38:29.802+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 013f9981-a5ed-11e3-5093-002590a28eca
    [externalcode] => eCK40ljTj46kHgVbq1fl91
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 37.5
                    [quantity] => 1.0
                    [consignmentUuid] => 30b995dc-c6e6-11e2-fb7d-001b21d91495
                    [goodUuid] => a32e3061-c6c9-11e2-604b-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 01401bce-a5ed-11e3-2772-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.0
                            [sumInCurrency] => 100000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T11:55:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T11:56:38.642+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01097
            [updated] => 2014-03-07T11:56:38.642+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 032db865-a5ce-11e3-9bab-002590a28eca
    [externalcode] => uHKNGtFBhfeJs-xLCHaX82
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 165000.0
                    [sumInCurrency] => 165000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 15.3846
                            [quantity] => 1.0
                            [consignmentUuid] => 61c4bef4-c6e5-11e2-a0ba-001b21d91495
                            [goodUuid] => e0b992fb-c6bf-11e2-bdd6-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 032e390f-a5ce-11e3-7ac8-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 35000.0
                                    [sumInCurrency] => 35000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 29615.39
                                    [sumInCurrency] => 29615.39
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 15.3846
                            [quantity] => 1.0
                            [consignmentUuid] => a8b7fcfb-c6e6-11e2-e53f-001b21d91495
                            [goodUuid] => 285de3eb-c6cc-11e2-19e7-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 032e3a79-a5ce-11e3-fcd5-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 135384.63999999998
                                    [sumInCurrency] => 135384.63999999998
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T18:30:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T18:31:32.238+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01034
            [updated] => 2014-03-06T18:31:32.238+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 033fdaa1-a53c-11e3-07d8-002590a28eca
    [externalcode] => JNYRSM6CgXKe4h5aMzzNz1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 180000.0
                    [sumInCurrency] => 180000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5fe128cf-843e-11e3-0211-002590a28eca
                    [goodUuid] => 5fe11db0-843e-11e3-53a1-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 03404c8d-a53c-11e3-6178-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 180000.0
                            [sumInCurrency] => 180000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T12:59:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T13:02:16.575+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01029
            [updated] => 2014-03-06T13:02:16.575+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 03f4e616-a50e-11e3-433b-002590a28eca
    [externalcode] => Bbuo6TeSg56n44Ut_SE9k3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5abb017f-1a3c-11e3-1f19-7054d21a8d1e
                    [goodUuid] => 5abaf2bd-1a3c-11e3-0adc-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 03f55708-a50e-11e3-0e27-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:53:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:54:16.964+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01844
            [updated] => 2014-03-06T15:54:16.964+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 0b63384e-a526-11e3-bd41-002590a28eca
    [externalcode] => ywAvUgJDhwSsD-AycpdJN2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 200000.0
                    [sumInCurrency] => 200000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => df5f1728-8cd8-11e3-c226-002590a28eca
                    [goodUuid] => df5f0d35-8cd8-11e3-e015-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 0b63b154-a526-11e3-3b79-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T17:48:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T17:49:14.106+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01033
            [updated] => 2014-03-06T17:49:14.106+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 1a679ee4-a536-11e3-1ceb-002590a28eca
    [externalcode] => i9xdT26Xgjibe_qpWAYkg3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => b87b3529-a1eb-11e2-62a4-001b21d91495
                    [goodUuid] => 4edbc6cc-a1e9-11e2-7fc3-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 1a6815c2-a536-11e3-900e-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:44:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T18:45:28.531+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01105
            [updated] => 2014-03-07T18:45:28.531+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 2021b1f3-a607-11e3-8be8-002590a28eca
    [externalcode] => gBGO6xUphEmHOWPGtUDzA2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => c26c7b6c-eef9-11e2-c2c7-7054d21a8d1e
                    [goodUuid] => c244d7b9-eef9-11e2-ae08-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 202229e6-a607-11e3-7ad5-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T21:08:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T21:09:53.770+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01849
            [updated] => 2014-03-06T21:09:53.770+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 229a9957-a552-11e3-f218-002590a28eca
    [externalcode] => _xewcphjiPiZLsQv06xNH0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 120000.0
                    [sumInCurrency] => 120000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 82def16b-8107-11e3-eac6-002590a28eca
                    [goodUuid] => 82dee818-8107-11e3-d56a-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 229b1570-a552-11e3-d133-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T19:29:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T19:29:59.156+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01095
            [updated] => 2014-03-06T19:29:59.156+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 2d8917c2-a544-11e3-144b-002590a28eca
    [externalcode] => aMd3hXl7gKiuDRLsVaPj30
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 0c4de7a6-eeeb-11e2-0fa9-7054d21a8d1e
                    [goodUuid] => 0c24483c-eeeb-11e2-6f71-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 2d8999d7-a544-11e3-bcd5-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T19:00:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T19:01:21.541+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01094
            [updated] => 2014-03-06T19:01:21.541+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 2dc1dbb3-a540-11e3-47af-002590a28eca
    [externalcode] => MXjIWAUFjBuUMfoU0rH7Y0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 990e0c20-eee8-11e2-e490-7054d21a8d1e
                    [goodUuid] => 98c4f80b-eee8-11e2-f13c-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 2dc24d29-a540-11e3-7aec-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T18:17:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T18:18:28.324+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01848
            [updated] => 2014-03-06T18:18:28.324+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 300000b5-a53a-11e3-20d7-002590a28eca
    [externalcode] => so0L1CSXh8yYmTSOd7jQN1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 120000.0
                    [sumInCurrency] => 120000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 6ce5baba-ead7-11e2-2568-7054d21a8d1e
                    [goodUuid] => 6c5e4ab1-ead7-11e2-2024-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 3001ecfe-a53a-11e3-005b-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T21:05:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T21:09:24.802+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01868
            [updated] => 2014-03-07T21:09:24.802+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 3bc00f74-a61b-11e3-ba9a-002590a28eca
    [externalcode] => caIQ0bpghJG7FDXmiN4YC0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3768e050-c6e6-11e2-412c-001b21d91495
                    [goodUuid] => fb27ecd7-c6c9-11e2-c7b1-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 3bc08b4e-a61b-11e3-fdd8-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:02:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T17:06:05.605+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01860
            [updated] => 2014-03-07T17:06:05.605+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 3df37132-a5f9-11e3-e84b-002590a28eca
    [externalcode] => O1kPfirfheal6QKU06XvH3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                    [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 3df3efa7-a5f9-11e3-be0f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:39:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:40:20.705+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01854
            [updated] => 2014-03-07T15:40:20.705+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 435a03e1-a5ed-11e3-6ff0-002590a28eca
    [externalcode] => GY95WtgtgWaAhj6wZUDsj1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 071bb84c-c6e6-11e2-0819-001b21d91495
                    [goodUuid] => e8392162-c6c6-11e2-dbcf-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 435a820a-a5ed-11e3-1672-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:35:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T18:25:09.997+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01104
            [updated] => 2014-03-07T18:25:09.997+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 49d4403a-a604-11e3-aa9c-002590a28eca
    [externalcode] => w-F8gPUIjKWwZ2T7cpxCe0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 200000.0
                    [sumInCurrency] => 200000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5fe128cf-843e-11e3-0211-002590a28eca
                    [goodUuid] => 5fe11db0-843e-11e3-53a1-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 49d4c42e-a604-11e3-06e2-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:46:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:48:29.268+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01867
            [updated] => 2014-03-07T20:48:29.268+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 4f64e040-a618-11e3-b9e8-002590a28eca
    [externalcode] => x9w-CUjgjjylc8PIVNSFJ1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 33.3333
                    [quantity] => 1.0
                    [consignmentUuid] => 5a4d927f-1a36-11e3-b1d0-7054d21a8d1e
                    [goodUuid] => 5a4d84bc-1a36-11e3-4386-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 4f655d8c-a618-11e3-50a8-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.04000000001
                            [sumInCurrency] => 80000.04000000001
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:46:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T17:49:32.936+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01862
            [updated] => 2014-03-07T17:49:32.936+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 500aa638-a5ff-11e3-00d7-002590a28eca
    [externalcode] => 0sZDptKoiaWTXIiFVQp_R0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 15b45e45-80fa-11e3-e5d3-002590a28eca
                    [goodUuid] => 15b4525c-80fa-11e3-0b4e-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 500b2f7f-a5ff-11e3-a72b-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:02:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T16:09:38.645+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01856
            [updated] => 2014-03-07T16:09:38.645+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 5b2a6e2f-a5f1-11e3-d106-002590a28eca
    [externalcode] => 1CZ8LSqai72W8V042mS9e0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 280000.0
                    [sumInCurrency] => 280000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 2b943681-c6e7-11e2-af99-001b21d91495
                            [goodUuid] => 24f1fe9f-c6d5-11e2-3217-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 5b2b148d-a5f1-11e3-c1f8-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => e925e8b7-c6e5-11e2-a1a0-001b21d91495
                            [goodUuid] => 9123245d-c6c5-11e2-8779-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 5b2b16a8-a5f1-11e3-2a53-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T18:04:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T18:05:25.112+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01092
            [updated] => 2014-03-06T18:05:25.112+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 5d2b67de-a538-11e3-cdf0-002590a28eca
    [externalcode] => hooS3jshiqq8uaQ0BUcdf1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 165000.0
                    [sumInCurrency] => 165000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 15.3846
                            [quantity] => 1.0
                            [consignmentUuid] => 744f863f-80f8-11e3-12dd-002590a28eca
                            [goodUuid] => 744f7c86-80f8-11e3-0bbc-002590a28eca
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 5d2bd9d5-a538-11e3-f7fc-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 35000.0
                                    [sumInCurrency] => 35000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 29615.39
                                    [sumInCurrency] => 29615.39
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 15.3846
                            [quantity] => 1.0
                            [consignmentUuid] => 71b506ad-810d-11e3-5784-002590a28eca
                            [goodUuid] => 71b4fd87-810d-11e3-7ee3-002590a28eca
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 5d2bdb14-a538-11e3-3409-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 135384.63999999998
                                    [sumInCurrency] => 135384.63999999998
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T16:24:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T16:25:16.952+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01091
            [updated] => 2014-03-06T16:25:16.952+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 6006de70-a52a-11e3-91f5-002590a28eca
    [externalcode] => s2kntCtOiguGmQhfQVVBJ0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 8ab9f5ce-eeeb-11e2-89d6-7054d21a8d1e
                    [goodUuid] => 8a7bc548-eeeb-11e2-52cd-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 600751ce-a52a-11e3-80e2-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:03:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:06:04.616+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01866
            [updated] => 2014-03-07T20:06:04.616+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 62a9b1a6-a612-11e3-21a7-002590a28eca
    [externalcode] => rS9N4VrFiU6tA69Cwne870
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 10d1d849-c6e7-11e2-392d-001b21d91495
                    [goodUuid] => 51eb28af-c6d3-11e2-8180-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 62aa2ce9-a612-11e3-3c16-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T10:46:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:47:48.464+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01038
            [updated] => 2014-03-07T10:47:48.464+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 6566a074-a5c4-11e3-89e1-002590a28eca
    [externalcode] => NvFYZ3nfgRGMhDr9iExkt2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3ab64173-c6e7-11e2-c69a-001b21d91495
                    [goodUuid] => 207336ec-c6d6-11e2-a238-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 65671c43-a5c4-11e3-2e72-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:40:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:41:19.155+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01855
            [updated] => 2014-03-07T15:41:19.155+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 6630cf3b-a5ed-11e3-adb3-002590a28eca
    [externalcode] => bQwEY37ThfylDF4Radi251
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 071bb84c-c6e6-11e2-0819-001b21d91495
                    [goodUuid] => e8392162-c6c6-11e2-dbcf-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 66314b8d-a5ed-11e3-137f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T12:49:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T12:50:52.983+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01089
            [updated] => 2014-03-06T12:50:52.983+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 6c810044-a50c-11e3-2120-002590a28eca
    [externalcode] => KN_6sh3RhraCClRzkwk1t0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 200000.0
                    [sumInCurrency] => 200000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5ac1d1bd-ef01-11e2-ff71-7054d21a8d1e
                    [goodUuid] => 5a80e35c-ef01-11e2-5ad2-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 6c817132-a50c-11e3-4f61-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T21:02:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T21:03:45.817+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01107
            [updated] => 2014-03-07T21:03:45.817+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 71b32d4d-a61a-11e3-7b73-002590a28eca
    [externalcode] => DoX6v77DhG_mx1KHrYAc_2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 6a9d5b4f-1a3f-11e3-25b4-7054d21a8d1e
                    [goodUuid] => 6a9d4d80-1a3f-11e3-45d7-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 71b3a900-a61a-11e3-f3b7-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T17:12:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T17:15:59.043+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01847
            [updated] => 2014-03-06T17:15:59.043+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 75413452-a531-11e3-f122-002590a28eca
    [externalcode] => W7uauDwKg6qY3VcoAfodQ2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 960000.0
                    [sumInCurrency] => 960000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 567186a5-b7d8-11e2-6489-001b21d91495
                            [goodUuid] => 566fbbbd-b7d8-11e2-6ade-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b599-a531-11e3-989e-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => eedfbd72-c6e5-11e2-1fe7-001b21d91495
                            [goodUuid] => 002e7339-c6c6-11e2-e683-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b6e7-a531-11e3-2088-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [2] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => e5358699-58e8-11e3-84bf-7054d21a8d1e
                            [goodUuid] => e5357e01-58e8-11e3-da94-7054d21a8d1e
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b797-a531-11e3-92cc-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 120000.0
                                    [sumInCurrency] => 120000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [3] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 2522b66e-c6e6-11e2-b6e2-001b21d91495
                            [goodUuid] => fbcb12df-c6c8-11e2-05c3-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b838-a531-11e3-0a03-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [4] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 5ac1d1bd-ef01-11e2-ff71-7054d21a8d1e
                            [goodUuid] => 5a80e35c-ef01-11e2-5ad2-7054d21a8d1e
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b8d8-a531-11e3-f71c-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 200000.0
                                    [sumInCurrency] => 200000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 200000.0
                                    [sumInCurrency] => 200000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [5] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 5fe128cf-843e-11e3-0211-002590a28eca
                            [goodUuid] => 5fe11db0-843e-11e3-53a1-002590a28eca
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => 7541b97a-a531-11e3-064d-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 200000.0
                                    [sumInCurrency] => 200000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 200000.0
                                    [sumInCurrency] => 200000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:26:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:30:52.092+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01865
            [updated] => 2014-03-07T19:30:52.092+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 778028c1-a60d-11e3-1522-002590a28eca
    [externalcode] => wIgV3m1bhZipG7WX9SD8W2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 990e0c20-eee8-11e2-e490-7054d21a8d1e
                    [goodUuid] => 98c4f80b-eee8-11e2-f13c-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 7780a608-a60d-11e3-7050-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T10:47:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:48:21.465+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01039
            [updated] => 2014-03-07T10:48:21.465+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 79121791-a5c4-11e3-0002-002590a28eca
    [externalcode] => QA9VxAPZgF2afuvaZwyjt3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 30000.0
                    [sumInCurrency] => 30000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 14.2857
                    [quantity] => 1.0
                    [consignmentUuid] => b4bc2c96-c6e4-11e2-5b48-001b21d91495
                    [goodUuid] => 36504bc2-c6bd-11e2-74f8-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 79129ba1-a5c4-11e3-9701-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 30000.005
                            [sumInCurrency] => 30000.005
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T14:09:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T14:10:00.800+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01090
            [updated] => 2014-03-06T14:10:00.800+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 7a6c740e-a517-11e3-58f8-002590a28eca
    [externalcode] => ijVMxlbpgryZT6HMoPifW1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => d70b73b0-c6e6-11e2-3fb4-001b21d91495
                    [goodUuid] => edc3dae6-c6d0-11e2-1df0-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 7a6ce5e1-a517-11e3-9eab-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:19:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:20:27.968+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01102
            [updated] => 2014-03-07T15:20:27.968+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 7c6cd86d-a5ea-11e3-9f78-002590a28eca
    [externalcode] => k25o86m8gMaowofsV7vTJ2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 5c9bc657-c6e7-11e2-335c-001b21d91495
                    [goodUuid] => 9a0e71f4-c6d8-11e2-1159-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 7c6d5017-a5ea-11e3-86b4-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T13:11:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T13:12:50.231+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01840
            [updated] => 2014-03-06T13:12:50.231+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 7da51a14-a50f-11e3-0c6b-002590a28eca
    [externalcode] => rutL42YzjRiFSTc6U2Eb93
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 35000.0
                    [sumInCurrency] => 35000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 998d30a0-80ef-11e3-6a0e-002590a28eca
                    [goodUuid] => 998d26ea-80ef-11e3-52c2-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 7da59134-a50f-11e3-ec7e-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:47:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T16:53:35.518+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01859
            [updated] => 2014-03-07T16:53:35.518+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 7edd4919-a5f7-11e3-9d5f-002590a28eca
    [externalcode] => cHKPFFWAhOaBIJMecUc4L3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5c9bc657-c6e7-11e2-335c-001b21d91495
                    [goodUuid] => 9a0e71f4-c6d8-11e2-1159-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 7eddcb62-a5f7-11e3-69b6-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:02:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.681+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01064
            [updated] => 2014-03-07T19:23:59.681+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81af3be5-a60c-11e3-bf65-002590a28eca
    [externalcode] => vc0MguBQjdyBA4se5GLxJ1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 567186a5-b7d8-11e2-6489-001b21d91495
                    [goodUuid] => 566fbbbd-b7d8-11e2-6ade-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81afc7b1-a60c-11e3-39d4-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:24:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.725+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01078
            [updated] => 2014-03-07T19:23:59.725+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81b5faac-a60c-11e3-d78e-002590a28eca
    [externalcode] => tbc05bukjP2b7p1Eoe-PY0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 82def16b-8107-11e3-eac6-002590a28eca
                    [goodUuid] => 82dee818-8107-11e3-d56a-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81b677e3-a60c-11e3-2f5b-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:33:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.756+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01056
            [updated] => 2014-03-07T19:23:59.756+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81bab931-a60c-11e3-cb01-002590a28eca
    [externalcode] => ZFiPjw7CheSSCAP4l3ya-2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 0ea33188-58fe-11e3-7c86-7054d21a8d1e
                    [goodUuid] => 0ea327af-58fe-11e3-f58d-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81bb3446-a60c-11e3-38ec-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T12:08:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.785+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01045
            [updated] => 2014-03-07T19:23:59.785+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81bf127c-a60c-11e3-8bfb-002590a28eca
    [externalcode] => D0-rUTUUgiasCMaPiCCn90
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d1f7d9e4-58e2-11e3-e09d-7054d21a8d1e
                    [goodUuid] => d1f7d234-58e2-11e3-c97d-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81bf9060-a60c-11e3-2adf-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:21:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.813+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01048
            [updated] => 2014-03-07T19:23:59.813+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81c37231-a60c-11e3-3fac-002590a28eca
    [externalcode] => M8QesVA_gNKcNKpRXSJPf0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 37.5
                    [quantity] => 1.0
                    [consignmentUuid] => 8c69f232-a1ed-11e2-42c8-001b21d91495
                    [goodUuid] => cf0914b4-a1e9-11e2-cfa9-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81c3efd4-a60c-11e3-223a-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.0
                            [sumInCurrency] => 100000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:44:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.842+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01067
            [updated] => 2014-03-07T19:23:59.842+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81c7db27-a60c-11e3-a836-002590a28eca
    [externalcode] => 3pmjZ_g_iqKMh-loygO2z3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 30000.0
                    [sumInCurrency] => 30000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 14.2857
                    [quantity] => 1.0
                    [consignmentUuid] => 998d30a0-80ef-11e3-6a0e-002590a28eca
                    [goodUuid] => 998d26ea-80ef-11e3-52c2-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81c8591e-a60c-11e3-4c6c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 30000.005
                            [sumInCurrency] => 30000.005
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T10:53:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.871+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01040
            [updated] => 2014-03-07T19:23:59.871+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81cc4393-a60c-11e3-6f21-002590a28eca
    [externalcode] => dDrLqF4_jIiDtrb-i49h32
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 270000.0
                    [sumInCurrency] => 270000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c919993b-8441-11e3-8d68-002590a28eca
                    [goodUuid] => c9198f4a-8441-11e3-726d-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81ccc29c-a60c-11e3-1f80-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 300000.0
                            [sumInCurrency] => 300000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 270000.0
                            [sumInCurrency] => 270000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T11:32:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.901+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01041
            [updated] => 2014-03-07T19:23:59.901+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81d0c77a-a60c-11e3-7890-002590a28eca
    [externalcode] => DQZwqgRDi3OoMWUR5_j730
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d73e5923-a1eb-11e2-8d40-001b21d91495
                    [goodUuid] => 17263ef7-a1eb-11e2-bd3a-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81d14834-a60c-11e3-2a93-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:16:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.930+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01082
            [updated] => 2014-03-07T19:23:59.930+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81d5396f-a60c-11e3-9ec6-002590a28eca
    [externalcode] => kcVEz9R4jdS63Zehetfzg2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81d5b593-a60c-11e3-4fd0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:17:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.959+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01083
            [updated] => 2014-03-07T19:23:59.959+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81d9b35c-a60c-11e3-5aa5-002590a28eca
    [externalcode] => bRmW7TRVi_ueDsQAz367a1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c26c36b1-810c-11e3-38f1-002590a28eca
                    [goodUuid] => c26c2ccd-810c-11e3-f22c-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81da31db-a60c-11e3-66cf-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:33:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:23:59.988+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01055
            [updated] => 2014-03-07T19:23:59.988+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81de2bfb-a60c-11e3-abd0-002590a28eca
    [externalcode] => 725swpW-j3_47e49mJE5R0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d177d814-c6e6-11e2-f758-001b21d91495
                    [goodUuid] => bcfd842d-c6d0-11e2-5213-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81dea4a2-a60c-11e3-8dd2-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:14:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.015+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01076
            [updated] => 2014-03-07T19:24:00.015+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81e24a14-a60c-11e3-b9ba-002590a28eca
    [externalcode] => Bi0kI-0Kh9uZJdKht7c3N3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 6a58c12c-58f1-11e3-577c-7054d21a8d1e
                    [goodUuid] => 6a58b822-58f1-11e3-7f27-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81e2d16e-a60c-11e3-4e79-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:40:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.044+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01050
            [updated] => 2014-03-07T19:24:00.044+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81e6a55f-a60c-11e3-40b1-002590a28eca
    [externalcode] => z1RipG7Tjp2-fOx2yspJO0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 206a7086-58fa-11e3-5e8d-7054d21a8d1e
                    [goodUuid] => 206a67cf-58fa-11e3-60fe-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81e71fa7-a60c-11e3-d94e-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:30:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.073+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01062
            [updated] => 2014-03-07T19:24:00.073+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81eb0d2d-a60c-11e3-6e89-002590a28eca
    [externalcode] => Sx3LiHbwhvyO0pFb08doz2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5a4d927f-1a36-11e3-b1d0-7054d21a8d1e
                    [goodUuid] => 5a4d84bc-1a36-11e3-4386-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81eb897e-a60c-11e3-ba56-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:21:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.094+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01084
            [updated] => 2014-03-07T19:24:00.094+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81ee3d5b-a60c-11e3-565d-002590a28eca
    [externalcode] => uU20jpLwgniqfGo_jhMn21
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81eeb774-a60c-11e3-d91b-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:27:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.122+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01071
            [updated] => 2014-03-07T19:24:00.122+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81f28f1d-a60c-11e3-d16e-002590a28eca
    [externalcode] => NBseGsWKhbu7PPy4yW1eM3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 30000.0
                    [sumInCurrency] => 30000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 14.2857
                    [quantity] => 1.0
                    [consignmentUuid] => b4bc2c96-c6e4-11e2-5b48-001b21d91495
                    [goodUuid] => 36504bc2-c6bd-11e2-74f8-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81f31645-a60c-11e3-49ff-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 30000.005
                            [sumInCurrency] => 30000.005
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:13:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.151+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01075
            [updated] => 2014-03-07T19:24:00.151+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81f70a1e-a60c-11e3-ca89-002590a28eca
    [externalcode] => ddpHtZIThFONWzT0Zerx52
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => ff352c44-c6e6-11e2-640a-001b21d91495
                    [goodUuid] => e34d852b-c6d1-11e2-772d-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81f78f6c-a60c-11e3-a10a-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:45:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.173+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01058
            [updated] => 2014-03-07T19:24:00.172+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81fa406a-a60c-11e3-d88f-002590a28eca
    [externalcode] => 8YAWp6ihg3CspSy7o3sSd3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c26c36b1-810c-11e3-38f1-002590a28eca
                    [goodUuid] => c26c2ccd-810c-11e3-f22c-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81fabede-a60c-11e3-5ef6-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:19:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.200+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01070
            [updated] => 2014-03-07T19:24:00.200+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 81fe6822-a60c-11e3-4799-002590a28eca
    [externalcode] => E1LGDhkDjimAEgXPXD28P0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 270000.0
                    [sumInCurrency] => 270000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => f49df24b-8454-11e3-93e1-002590a28eca
                    [goodUuid] => f49de808-8454-11e3-6bb1-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 81fee637-a60c-11e3-3bc9-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 300000.0
                            [sumInCurrency] => 300000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 270000.0
                            [sumInCurrency] => 270000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:19:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.230+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01046
            [updated] => 2014-03-07T19:24:00.230+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82030464-a60c-11e3-6145-002590a28eca
    [externalcode] => k7mJUawKjrKs5hySUy0Po0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 72000.0
                    [sumInCurrency] => 72000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                    [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 820383b7-a60c-11e3-d221-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 72000.0
                            [sumInCurrency] => 72000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:56:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.250+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01081
            [updated] => 2014-03-07T19:24:00.250+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8206220c-a60c-11e3-b331-002590a28eca
    [externalcode] => B3Y4SL90jmmF0BSHhw_LA0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 82def16b-8107-11e3-eac6-002590a28eca
                    [goodUuid] => 82dee818-8107-11e3-d56a-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82069b9d-a60c-11e3-39fe-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:31:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.278+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01063
            [updated] => 2014-03-07T19:24:00.278+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 820a52f2-a60c-11e3-c74e-002590a28eca
    [externalcode] => 4fP1hWB2jDK46UJz0oALX0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => aa88499b-a1eb-11e2-f257-001b21d91495
                    [goodUuid] => e0c1b185-a1e8-11e2-7484-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 820ad2b2-a60c-11e3-c3dd-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:20:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.307+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01047
            [updated] => 2014-03-07T19:24:00.307+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 820ec751-a60c-11e3-937a-002590a28eca
    [externalcode] => x_Eyz_wgjvqrhve4ASdQK2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 1c1d0b74-c6e6-11e2-21a0-001b21d91495
                    [goodUuid] => 796f1283-c6c8-11e2-0bed-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 820f4046-a60c-11e3-1806-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:18:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.335+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01069
            [updated] => 2014-03-07T19:24:00.335+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82131ea9-a60c-11e3-db72-002590a28eca
    [externalcode] => jwD3Ku3xgsSDsXCndK8zz1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 144c1048-c6e6-11e2-a414-001b21d91495
                    [goodUuid] => 33e429c3-c6c7-11e2-8263-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82139747-a60c-11e3-37d6-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:25:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.363+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01061
            [updated] => 2014-03-07T19:24:00.362+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82173ebb-a60c-11e3-8014-002590a28eca
    [externalcode] => IQ2FvncIgoCzkrJ_YgouT2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => eedfbd72-c6e5-11e2-1fe7-001b21d91495
                    [goodUuid] => 002e7339-c6c6-11e2-e683-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8217bd17-a60c-11e3-3e74-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:38:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.390+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01057
            [updated] => 2014-03-07T19:24:00.390+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 821b7ed5-a60c-11e3-495c-002590a28eca
    [externalcode] => Asu_s_Ocgzuxd3OoxBgTC3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => f6304a34-c6e5-11e2-dff8-001b21d91495
                    [goodUuid] => 5739a09d-c6c6-11e2-0c09-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 821bfb7a-a60c-11e3-ab9f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:33:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.419+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01066
            [updated] => 2014-03-07T19:24:00.419+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 821fdd5d-a60c-11e3-8d06-002590a28eca
    [externalcode] => L1RXb3ayht6cFpkId-OKs0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => b87b3529-a1eb-11e2-62a4-001b21d91495
                    [goodUuid] => 4edbc6cc-a1e9-11e2-7fc3-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 822058ca-a60c-11e3-0b03-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:03:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.448+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01065
            [updated] => 2014-03-07T19:24:00.448+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82243be9-a60c-11e3-723a-002590a28eca
    [externalcode] => V5padwCOiDSVHznbApauS3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => a69320e9-bbc5-11e2-a703-001b21d91495
                    [goodUuid] => a69160a2-bbc5-11e2-6030-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8224b739-a60c-11e3-776e-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:01:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.468+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01053
            [updated] => 2014-03-07T19:24:00.468+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82275fca-a60c-11e3-b70e-002590a28eca
    [externalcode] => wrTNO__EhfqEe528ql8d60
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 30000.0
                    [sumInCurrency] => 30000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 14.2857
                    [quantity] => 1.0
                    [consignmentUuid] => b4bc2c96-c6e4-11e2-5b48-001b21d91495
                    [goodUuid] => 36504bc2-c6bd-11e2-74f8-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8227e28e-a60c-11e3-31d2-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 30000.005
                            [sumInCurrency] => 30000.005
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:32:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.488+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01054
            [updated] => 2014-03-07T19:24:00.488+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 822a68da-a60c-11e3-5ac6-002590a28eca
    [externalcode] => O6ZteMA4gSeLIRjlGAH231
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d73e5923-a1eb-11e2-8d40-001b21d91495
                    [goodUuid] => 17263ef7-a1eb-11e2-bd3a-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 822adda2-a60c-11e3-e5c0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:41:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.515+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01052
            [updated] => 2014-03-07T19:24:00.515+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 822e9031-a60c-11e3-3609-002590a28eca
    [externalcode] => o8Djlau6hwm_GgQ_nMxCu3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 45291889-c6e7-11e2-0aa7-001b21d91495
                    [goodUuid] => dd9e5dd3-c6d6-11e2-6a9b-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 822f0b6a-a60c-11e3-5559-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:39:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.537+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01049
            [updated] => 2014-03-07T19:24:00.537+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8231e05c-a60c-11e3-8891-002590a28eca
    [externalcode] => mxWUoby4iSqXrCtWrR1kO3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => f6304a34-c6e5-11e2-dff8-001b21d91495
                    [goodUuid] => 5739a09d-c6c6-11e2-0c09-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82325af4-a60c-11e3-2828-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:59:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.565+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01068
            [updated] => 2014-03-07T19:24:00.565+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 823621d3-a60c-11e3-170e-002590a28eca
    [externalcode] => t7H2_JdYg9aOg1-nypzM21
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 5abb017f-1a3c-11e3-1f19-7054d21a8d1e
                    [goodUuid] => 5abaf2bd-1a3c-11e3-0adc-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82369bd5-a60c-11e3-446f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T11:49:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.586+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01043
            [updated] => 2014-03-07T19:24:00.586+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82395c76-a60c-11e3-46e1-002590a28eca
    [externalcode] => 3OJxXcrDgUmVHWzC20zfd1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8239d134-a60c-11e3-f4bb-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:41:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.613+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01073
            [updated] => 2014-03-07T19:24:00.613+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 823d752e-a60c-11e3-5d83-002590a28eca
    [externalcode] => 3McZreT_gcW8PeMAaZ9gq2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 6ce5baba-ead7-11e2-2568-7054d21a8d1e
                    [goodUuid] => 6c5e4ab1-ead7-11e2-2024-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 823df205-a60c-11e3-a734-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:56:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.655+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01080
            [updated] => 2014-03-07T19:24:00.654+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8243cc50-a60c-11e3-a1af-002590a28eca
    [externalcode] => 4HVYoy6iiYSTUyctPinMw2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 6889c7ae-1a3a-11e3-a49a-7054d21a8d1e
                    [goodUuid] => 6889b506-1a3a-11e3-452e-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82444951-a60c-11e3-b07f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:22:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.677+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01059
            [updated] => 2014-03-07T19:24:00.677+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82474b0a-a60c-11e3-e768-002590a28eca
    [externalcode] => iB61DZegidC__FRjgvVQS0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8247b9c4-a60c-11e3-d439-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:25:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.697+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01060
            [updated] => 2014-03-07T19:24:00.697+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 824a4bff-a60c-11e3-e3b3-002590a28eca
    [externalcode] => rGXq29tAiVWXUq6XXLcdY0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => eedfbd72-c6e5-11e2-1fe7-001b21d91495
                    [goodUuid] => 002e7339-c6c6-11e2-e683-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 824ac3f4-a60c-11e3-d5ed-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T11:32:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.725+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01042
            [updated] => 2014-03-07T19:24:00.725+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 824e9b54-a60c-11e3-d580-002590a28eca
    [externalcode] => q-qK-RkshDihce_miuik82
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 71b506ad-810d-11e3-5784-002590a28eca
                    [goodUuid] => 71b4fd87-810d-11e3-7ee3-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 824f1cb2-a60c-11e3-5ae4-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T12:05:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.755+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01044
            [updated] => 2014-03-07T19:24:00.755+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82532809-a60c-11e3-e91b-002590a28eca
    [externalcode] => X6v4E7W9haCPDhBu7-CPM2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => a8b7fcfb-c6e6-11e2-e53f-001b21d91495
                    [goodUuid] => 285de3eb-c6cc-11e2-19e7-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8253a87e-a60c-11e3-38d8-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
            [salesReturnRef] => 9901d4f3-a618-11e3-73b9-002590a28eca
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:41:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.777+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01051
            [updated] => 2014-03-07T19:24:00.777+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 82567082-a60c-11e3-ab2a-002590a28eca
    [externalcode] => ATotDEbBguy4PYCGcOuX_0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => f6304a34-c6e5-11e2-dff8-001b21d91495
                    [goodUuid] => 5739a09d-c6c6-11e2-0c09-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8256ec5f-a60c-11e3-d655-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:12:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.804+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01074
            [updated] => 2014-03-07T19:24:00.804+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 825a90bb-a60c-11e3-6f82-002590a28eca
    [externalcode] => dgXKBsruisatvzhOq2BQS3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 413ccb0b-eeea-11e2-bb61-7054d21a8d1e
                    [goodUuid] => 40fed4c0-eeea-11e2-ad31-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 825b17fb-a60c-11e3-e96c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:55:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.833+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01079
            [updated] => 2014-03-07T19:24:00.833+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 825f0f5f-a60c-11e3-09f9-002590a28eca
    [externalcode] => a1JwnDI1hoaHoCJhdHnIH0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => ec3bf8fb-58f1-11e3-7382-7054d21a8d1e
                    [goodUuid] => ec3befc9-58f1-11e3-d7be-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 825f88f7-a60c-11e3-ff00-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:22:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.855+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01085
            [updated] => 2014-03-07T19:24:00.855+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8262572f-a60c-11e3-9c18-002590a28eca
    [externalcode] => gv5FM5ZOjxiScSAUCgIFC3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 30000.0
                    [sumInCurrency] => 30000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 14.2857
                    [quantity] => 1.0
                    [consignmentUuid] => 998d30a0-80ef-11e3-6a0e-002590a28eca
                    [goodUuid] => 998d26ea-80ef-11e3-52c2-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8262df26-a60c-11e3-25cb-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 30000.005
                            [sumInCurrency] => 30000.005
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:41:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.876+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01072
            [updated] => 2014-03-07T19:24:00.876+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8265996c-a60c-11e3-871f-002590a28eca
    [externalcode] => vvhOWjavidmM087jjz7Wo3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 72000.0
                    [sumInCurrency] => 72000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                    [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 82660dd9-a60c-11e3-8a25-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 72000.0
                            [sumInCurrency] => 72000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:23:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:24:00.905+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01077
            [updated] => 2014-03-07T19:24:00.905+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8269f37c-a60c-11e3-bb6a-002590a28eca
    [externalcode] => 8YWQK-Vih_2chEYoYjxc72
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => a4235b58-58f5-11e3-9584-7054d21a8d1e
                    [goodUuid] => a42352ba-58f5-11e3-d7d1-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 826a722a-a60c-11e3-5bbd-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:42:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:42:57.834+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01106
            [updated] => 2014-03-07T20:42:57.834+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 89d80679-a617-11e3-1dc0-002590a28eca
    [externalcode] => Pk-Gy3kuhAO4e40a9qEqJ3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 527ac7e2-810c-11e3-6608-002590a28eca
                    [goodUuid] => 527ab9a5-810c-11e3-9441-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 89d88582-a617-11e3-b408-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T18:34:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T18:42:34.346+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01093
            [updated] => 2014-03-06T18:42:34.346+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 8de57e31-a53d-11e3-ab5b-002590a28eca
    [externalcode] => D30DHp7djW2CQdfFX8x1i2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                    [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 8de5eede-a53d-11e3-8ad0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T11:32:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T11:33:16.090+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01839
            [updated] => 2014-03-06T11:33:16.090+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 94c78e46-a501-11e3-cc96-002590a28eca
    [externalcode] => mn_zAuq0g6m53uKwxJkzg1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 11ee4e49-eeee-11e2-6cab-7054d21a8d1e
                    [goodUuid] => 11c1fc26-eeee-11e2-b8a6-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 94c800db-a501-11e3-298e-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:34:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:35:32.195+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01852
            [updated] => 2014-03-07T15:35:32.195+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 9762f1cd-a5ec-11e3-24a2-002590a28eca
    [externalcode] => kmt4Okmmg7S4bUD3m15Ak1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 37.5
                    [quantity] => 1.0
                    [consignmentUuid] => cc238faa-1a3e-11e3-9dae-7054d21a8d1e
                    [goodUuid] => cc238233-1a3e-11e3-6bd7-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 976370c8-a5ec-11e3-0293-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.0
                            [sumInCurrency] => 100000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:25:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:50:32.614+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01089
            [updated] => 2014-03-07T20:50:32.614+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 98e9feda-a618-11e3-0371-002590a28eca
    [externalcode] => 9cT2UJFZjmOO2k8tcvGOk0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 82def16b-8107-11e3-eac6-002590a28eca
                    [goodUuid] => 82dee818-8107-11e3-d56a-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 98ea7af4-a618-11e3-0b4a-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:20:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:50:32.646+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01088
            [updated] => 2014-03-07T20:50:32.646+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 98eee63a-a618-11e3-02e6-002590a28eca
    [externalcode] => 78UAeDpkjmqcw0vQRA9zo1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 1280c7f3-58f7-11e3-49a3-7054d21a8d1e
                    [goodUuid] => 1280bf89-58f7-11e3-dd00-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 98ef5ec2-a618-11e3-bfd1-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:07:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:50:32.678+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01087
            [updated] => 2014-03-07T20:50:32.678+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 98f3c81c-a618-11e3-878b-002590a28eca
    [externalcode] => lnTDq6cWg8O1Onyot9Uc51
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3e3cc782-58ff-11e3-33d6-7054d21a8d1e
                    [goodUuid] => 3e3ca15e-58ff-11e3-09a4-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 98f43fe6-a618-11e3-9242-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:45:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:50:32.729+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01090
            [updated] => 2014-03-07T20:50:32.729+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 98fb7e94-a618-11e3-d6f5-002590a28eca
    [externalcode] => M_3Dbws2hw2TXl06ZTg3c0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 180000.0
                    [sumInCurrency] => 180000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => df5f1728-8cd8-11e3-c226-002590a28eca
                    [goodUuid] => df5f0d35-8cd8-11e3-e015-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 98fbf936-a618-11e3-5b1c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 180000.0
                            [sumInCurrency] => 180000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:38:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T16:40:09.212+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01857
            [updated] => 2014-03-07T16:40:09.212+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 9e44c53d-a5f5-11e3-b160-002590a28eca
    [externalcode] => 2tQozgDbiceerab1BN_VG3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 144c1048-c6e6-11e2-a414-001b21d91495
                    [goodUuid] => 33e429c3-c6c7-11e2-8263-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 9e454c68-a5f5-11e3-99f2-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T13:48:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:14:16.952+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01850
            [updated] => 2014-03-07T15:14:16.952+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 9f484756-a5e9-11e3-aba5-002590a28eca
    [externalcode] => eKe8XwVNj16UyFVTMj9yI1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => ddcc6143-a1eb-11e2-19f7-001b21d91495
                    [goodUuid] => c5dd5d70-a1ea-11e2-face-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 9f48c90b-a5e9-11e3-8dc6-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:12:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:14:17+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01851
            [updated] => 2014-03-07T15:14:17+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => 9f4f9c54-a5e9-11e3-32dc-002590a28eca
    [externalcode] => oNSk2Xreh22iOVzCqykA83
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 2e1e8174-8101-11e3-f3e5-002590a28eca
                    [goodUuid] => 2e1e786e-8101-11e3-a5da-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => 9f501fb9-a5e9-11e3-3d6a-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T11:46:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T11:47:55.360+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01028
            [updated] => 2014-03-06T11:47:55.360+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => a0dd777d-a503-11e3-bdab-002590a28eca
    [externalcode] => tUQ1d2hxgoCf2O-9p1eaa1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 72000.0
                    [sumInCurrency] => 72000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 87aa4e36-1a33-11e3-45e2-7054d21a8d1e
                    [goodUuid] => 87aa416c-1a33-11e3-1b78-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => a0dde5b9-a503-11e3-f504-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 72000.0
                            [sumInCurrency] => 72000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T14:58:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:00:01.372+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01100
            [updated] => 2014-03-07T15:00:01.372+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => a1511766-a5e7-11e3-3a02-002590a28eca
    [externalcode] => WF-IeOrZjVKILXw_EoZNJ2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 35000.0
                    [sumInCurrency] => 35000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 744f863f-80f8-11e3-12dd-002590a28eca
                    [goodUuid] => 744f7c86-80f8-11e3-0bbc-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => a15198b8-a5e7-11e3-dfd0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T17:05:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T17:08:55.427+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01861
            [updated] => 2014-03-07T17:08:55.427+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => a32c3773-a5f9-11e3-0a10-002590a28eca
    [externalcode] => qvVDWiibivK60lIxyLnah2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 200000.0
                    [sumInCurrency] => 200000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => fb2c6136-5904-11e3-4a14-7054d21a8d1e
                    [goodUuid] => fb2c5331-5904-11e3-d496-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => a32cb231-a5f9-11e3-5444-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T12:28:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T12:29:50.637+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01099
            [updated] => 2014-03-07T12:29:50.637+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => a68019c2-a5d2-11e3-d488-002590a28eca
    [externalcode] => LSWfknDOiiyOzcqohC1pY2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => ddcc6143-a1eb-11e2-19f7-001b21d91495
                    [goodUuid] => c5dd5d70-a1ea-11e2-face-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => a680995e-a5d2-11e3-692c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T21:07:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.509+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01039
            [updated] => 2014-03-07T10:13:57.509+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aadb7e44-a5bf-11e3-a2fe-002590a28eca
    [externalcode] => FiTUzDmxi4aVq3Z6bMU-l3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => f21b4418-eefd-11e2-1f9c-7054d21a8d1e
                    [goodUuid] => f1d91960-eefd-11e2-304c-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aadbfee6-a5bf-11e3-882b-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T19:02:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.563+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01036
            [updated] => 2014-03-07T10:13:57.562+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aae39b5e-a5bf-11e3-bd46-002590a28eca
    [externalcode] => MDBi74X8hRuHuF58DgQST1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d73e5923-a1eb-11e2-8d40-001b21d91495
                    [goodUuid] => 17263ef7-a1eb-11e2-bd3a-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aae419af-a5bf-11e3-e37c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T18:49:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.598+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01035
            [updated] => 2014-03-07T10:13:57.598+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aae8fd40-a5bf-11e3-70de-002590a28eca
    [externalcode] => p1swA8rvh4Wje2IqK6PsS3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3a42f4ac-1a3d-11e3-36db-7054d21a8d1e
                    [goodUuid] => 3a42e5ce-1a3d-11e3-ac30-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aae9790b-a5bf-11e3-5e7f-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T21:14:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.632+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01040
            [updated] => 2014-03-07T10:13:57.632+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aaee2ce2-a5bf-11e3-1882-002590a28eca
    [externalcode] => kxgPTWSqjyuFYmS-MKEDm3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 180000.0
                    [sumInCurrency] => 180000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => ed9b020e-8cd6-11e3-85e4-002590a28eca
                    [goodUuid] => ed9af863-8cd6-11e3-928b-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aaeeae62-a5bf-11e3-4077-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 180000.0
                            [sumInCurrency] => 180000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T21:00:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.661+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01038
            [updated] => 2014-03-07T10:13:57.661+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aaf2b2b1-a5bf-11e3-5a3f-002590a28eca
    [externalcode] => BkAhgbw6ilCl-5MKARVNk0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3e3cc782-58ff-11e3-33d6-7054d21a8d1e
                    [goodUuid] => 3e3ca15e-58ff-11e3-09a4-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aaf33483-a5bf-11e3-1732-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T19:11:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T10:13:57.697+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01037
            [updated] => 2014-03-07T10:13:57.697+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => aaf81459-a5bf-11e3-661d-002590a28eca
    [externalcode] => 7bDKWYIfjpCPKTbxX8Q1G3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 270000.0
                    [sumInCurrency] => 270000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d6487446-590b-11e3-3d95-7054d21a8d1e
                    [goodUuid] => d6486bfc-590b-11e3-f6a1-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => aaf89578-a5bf-11e3-26f0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 300000.0
                            [sumInCurrency] => 300000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 270000.0
                            [sumInCurrency] => 270000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:38:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:39:30.240+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01086
            [updated] => 2014-03-07T19:39:30.240+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => ac573937-a60e-11e3-ff97-002590a28eca
    [externalcode] => vA1bypr6juGMX8xa9zHgz1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 108000.0
                    [sumInCurrency] => 108000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => ac57b8d9-a60e-11e3-a4ca-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 108000.0
                            [sumInCurrency] => 108000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:37:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:43:30.080+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01103
            [updated] => 2014-03-07T15:43:30.080+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => b43a4ffb-a5ed-11e3-d747-002590a28eca
    [externalcode] => WpBTSSjDgYG9kMuxQR0h62
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => cde82637-58fb-11e3-e1b3-7054d21a8d1e
                    [goodUuid] => cde81d53-58fb-11e3-4418-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => b43acb33-a5ed-11e3-d279-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T16:40:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T16:41:13.773+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01858
            [updated] => 2014-03-07T16:41:13.773+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => c4bfe640-a5f5-11e3-b92a-002590a28eca
    [externalcode] => pLAMZBBqgvSQVN6Brpyy21
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 28.5714
                    [quantity] => 1.0
                    [consignmentUuid] => 144c1048-c6e6-11e2-a414-001b21d91495
                    [goodUuid] => 33e429c3-c6c7-11e2-8263-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => c4c068b3-a5f5-11e3-ddcf-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 140000.0
                            [sumInCurrency] => 140000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 100000.04
                            [sumInCurrency] => 100000.04
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T14:25:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T14:26:24.584+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01841
            [updated] => 2014-03-06T14:26:24.584+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => c4cde5ea-a519-11e3-0cce-002590a28eca
    [externalcode] => 1sx96MS0geWTjyne8R0i81
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 35000.0
                    [sumInCurrency] => 35000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 744f863f-80f8-11e3-12dd-002590a28eca
                    [goodUuid] => 744f7c86-80f8-11e3-0bbc-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => c4ce5065-a519-11e3-73b0-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T10:22:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T10:23:03.932+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01087
            [updated] => 2014-03-06T10:23:03.932+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => c62332f9-a4f7-11e3-983b-002590a28eca
    [externalcode] => pFWFecrniQGpG7C2dXFjJ3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 39e7a212-eeed-11e2-d70c-7054d21a8d1e
                    [goodUuid] => 39b7d9e9-eeed-11e2-76a9-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => c624460d-a4f7-11e3-d2a4-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T15:14:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T15:15:22.245+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01101
            [updated] => 2014-03-07T15:15:22.245+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => c6332347-a5e9-11e3-6eec-002590a28eca
    [externalcode] => YGWnStX1gJm3tzh4lOKZT2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 260000.0
                    [sumInCurrency] => 260000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 18.75
                            [quantity] => 1.0
                            [consignmentUuid] => 45291889-c6e7-11e2-0aa7-001b21d91495
                            [goodUuid] => dd9e5dd3-c6d6-11e2-6a9b-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => c633a7b6-a5e9-11e3-d78d-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 130000.0
                                    [sumInCurrency] => 130000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 18.75
                            [quantity] => 1.0
                            [consignmentUuid] => 55cf7fae-a1ed-11e2-4181-001b21d91495
                            [goodUuid] => b6c5696a-a1ea-11e2-ea93-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => c633a949-a5e9-11e3-f590-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 160000.0
                                    [sumInCurrency] => 160000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 130000.0
                                    [sumInCurrency] => 130000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:57:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:59:31.234+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01845
            [updated] => 2014-03-06T15:59:31.234+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => c6b515dd-a526-11e3-4651-002590a28eca
    [externalcode] => BUf0sE2-jXi-FWUP-9Ly42
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3a42f4ac-1a3d-11e3-36db-7054d21a8d1e
                    [goodUuid] => 3a42e5ce-1a3d-11e3-ac30-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => c6b598fc-a526-11e3-ee77-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T18:27:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T18:28:55.862+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01863
            [updated] => 2014-03-07T18:28:55.862+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => d07488eb-a604-11e3-2913-002590a28eca
    [externalcode] => tWLYeKq2gL2TnPABCtLk_0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 120000.0
                    [sumInCurrency] => 120000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => f6304a34-c6e5-11e2-dff8-001b21d91495
                    [goodUuid] => 5739a09d-c6c6-11e2-0c09-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => d0750659-a604-11e3-4a37-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:35:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:38:36.939+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01843
            [updated] => 2014-03-06T15:38:36.939+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => db16e0c7-a523-11e3-7157-002590a28eca
    [externalcode] => BVNWCbaXigClBWFM86vt03
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                            [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => db1758ca-a523-11e3-a68a-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 80000.0
                                    [sumInCurrency] => 80000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 80000.0
                                    [sumInCurrency] => 80000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 0.0
                            [quantity] => 1.0
                            [consignmentUuid] => 56130b48-b7d8-11e2-5607-001b21d91495
                            [goodUuid] => 561141a9-b7d8-11e2-a42d-001b21d91495
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => db175a93-a523-11e3-8532-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 80000.0
                                    [sumInCurrency] => 80000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 80000.0
                                    [sumInCurrency] => 80000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T16:40:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T16:43:13.672+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01846
            [updated] => 2014-03-06T16:43:13.672+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => e1cd6c50-a52c-11e3-2a19-002590a28eca
    [externalcode] => -n0XlzDajbKC-DFM1MQnM2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 160000.0
                    [sumInCurrency] => 160000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 3a42f4ac-1a3d-11e3-36db-7054d21a8d1e
                    [goodUuid] => 3a42e5ce-1a3d-11e3-ac30-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => e1cde8d7-a52c-11e3-2ebe-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T20:51:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T20:52:53.329+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01091
            [updated] => 2014-03-07T20:52:53.329+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => ecc968d8-a618-11e3-ab58-002590a28eca
    [externalcode] => tz_h1fd_h3KyR5x8_2XAm3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 80000.0
                    [sumInCurrency] => 80000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => b9834b96-c6e5-11e2-7982-001b21d91495
                    [goodUuid] => 957b9b0e-c6c3-11e2-7036-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => ecc9e3c9-a618-11e3-2d20-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T19:25:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T19:27:03.885+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01864
            [updated] => 2014-03-07T19:27:03.885+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => ef7a9680-a60c-11e3-7ab9-002590a28eca
    [externalcode] => 7vqhJkfjgoG8CaVvo2A1F0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 100000.0
                    [sumInCurrency] => 100000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 16.6667
                    [quantity] => 1.0
                    [consignmentUuid] => abccfbc6-8106-11e3-3a8b-002590a28eca
                    [goodUuid] => abccf1e9-8106-11e3-00f7-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => ef7b1416-a60c-11e3-4996-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 99999.95999999999
                            [sumInCurrency] => 99999.95999999999
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T12:11:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T12:17:35.408+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01098
            [updated] => 2014-03-07T12:17:35.408+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f04502ea-a5d0-11e3-e483-002590a28eca
    [externalcode] => FqanEAZoh0ivBdZFgIPE73
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 200000.0
                    [sumInCurrency] => 200000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => fb2c6136-5904-11e3-4a14-7054d21a8d1e
                    [goodUuid] => fb2c5331-5904-11e3-d496-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => f0458180-a5d0-11e3-4b39-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 200000.0
                            [sumInCurrency] => 200000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T21:13:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T21:14:31.694+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01108
            [updated] => 2014-03-07T21:14:31.694+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f2ac33a3-a61b-11e3-00cd-002590a28eca
    [externalcode] => j8Kv5RHbhkOXXYureH4ih1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => 7730e7c2-58f2-11e3-a581-7054d21a8d1e
                    [goodUuid] => 7730de91-58f2-11e3-cfc5-7054d21a8d1e
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => f2acac3d-a61b-11e3-8889-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:15:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:32:10.598+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01031
            [updated] => 2014-03-06T15:32:10.597+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f4cfced3-a522-11e3-0237-002590a28eca
    [externalcode] => Hu3Vw6EviAC0pcwmnGWoK2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 424000.0
                    [sumInCurrency] => 424000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 20.0
                            [quantity] => 1.0
                            [consignmentUuid] => 201b0484-8804-11e3-ac71-002590a28eca
                            [goodUuid] => 201afce7-8804-11e3-1af1-002590a28eca
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => f4d05ce6-a522-11e3-ae0b-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 230000.0
                                    [sumInCurrency] => 230000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 184000.0
                                    [sumInCurrency] => 184000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [discount] => 20.0
                            [quantity] => 1.0
                            [consignmentUuid] => 176a0685-8445-11e3-bc22-002590a28eca
                            [goodUuid] => 1769fc6a-8445-11e3-1fb1-002590a28eca
                            [vat] => 0
                            [readMode] => SELF
                            [changeMode] => SELF
                        )

                    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
                    [uuid] => f4d05e73-a522-11e3-40f2-002590a28eca
                    [basePrice] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 300000.0
                                    [sumInCurrency] => 300000.0
                                )

                        )

                    [price] => SimpleXMLElement Object
                        (
                            [@attributes] => Array
                                (
                                    [sum] => 240000.0
                                    [sumInCurrency] => 240000.0
                                )

                        )

                    [things] => SimpleXMLElement Object
                        (
                        )

                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:27:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:32:10.646+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01032
            [updated] => 2014-03-06T15:32:10.646+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f4d72472-a522-11e3-6b1d-002590a28eca
    [externalcode] => ywJmVoGMixSf9C3wS7WoG1
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 144000.0
                    [sumInCurrency] => 144000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => d73e5923-a1eb-11e2-8d40-001b21d91495
                    [goodUuid] => 17263ef7-a1eb-11e2-bd3a-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => f4d79dfd-a522-11e3-e419-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 144000.0
                            [sumInCurrency] => 144000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => e4405e53-a9a0-11e2-dd46-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:13:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 88e1aeaa-214f-11e3-428c-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:32:10.677+04:00
            [createdBy] => rubin@shalom
            [employeeUuid] => 383abd00-214f-11e3-d7ad-7054d21a8d1e
            [name] => 01030
            [updated] => 2014-03-06T15:32:10.677+04:00
            [updatedBy] => rubin@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f4dbdfc3-a522-11e3-5520-002590a28eca
    [externalcode] => aHHEfYFIg1OHvoxkjTVq-0
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 72000.0
                    [sumInCurrency] => 72000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 3fcac1fa-a5c4-11e3-5952-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 10.0
                    [quantity] => 1.0
                    [consignmentUuid] => 15b45e45-80fa-11e3-e5d3-002590a28eca
                    [goodUuid] => 15b4525c-80fa-11e3-0b4e-002590a28eca
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => f4dc5c63-a522-11e3-e47c-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 80000.0
                            [sumInCurrency] => 80000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 72000.0
                            [sumInCurrency] => 72000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-07T11:48:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-07T11:49:10.382+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01096
            [updated] => 2014-03-07T11:49:10.382+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => f7febb0e-a5cc-11e3-71ca-002590a28eca
    [externalcode] => lSaWb3imiEyHCYN0dJCOS3
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 130000.0
                    [sumInCurrency] => 130000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 18.75
                    [quantity] => 1.0
                    [consignmentUuid] => fc16d60e-a1eb-11e2-0cf7-001b21d91495
                    [goodUuid] => 20ab2380-a1ea-11e2-74e0-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => f7ff3c4f-a5cc-11e3-93e4-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 160000.0
                            [sumInCurrency] => 160000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 130000.0
                            [sumInCurrency] => 130000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 7ad8cb30-a98f-11e2-a2b9-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T15:30:00+04:00
            [payerVat] => true
            [retailStoreUuid] => e602fee3-b0d0-11e2-54c6-001b21d91495
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T15:32:22.958+04:00
            [createdBy] => sale@shalom
            [employeeUuid] => 3c18ee4a-e302-11e2-504c-7054d21a8d1e
            [name] => 01842
            [updated] => 2014-03-06T15:32:22.958+04:00
            [updatedBy] => sale@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => fc2de0ae-a522-11e3-6c82-002590a28eca
    [externalcode] => bWHB2pu0h_qISkqjOArZo2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 120000.0
                    [sumInCurrency] => 120000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => 7fcfd9ea-a561-11e3-8462-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => c1a30efa-c6e5-11e2-48f3-001b21d91495
                    [goodUuid] => f2d818e6-c6c3-11e2-84da-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => fc2e6188-a522-11e3-58e5-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 120000.0
                            [sumInCurrency] => 120000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [targetAgentUuid] => e5d0d140-b0d0-11e2-a46b-001b21d91495
            [sourceAgentUuid] => 6895f876-a14e-11e2-b23c-001b21d91495
            [sourceStoreUuid] => 451ef1c6-c767-11e2-125b-001b21d91495
            [applicable] => true
            [moment] => 2014-03-06T12:31:00+04:00
            [payerVat] => true
            [retailStoreUuid] => 43b1132e-045a-11e3-03e1-7054d21a8d1e
            [rate] => 1.0
            [vatIncluded] => true
            [created] => 2014-03-06T12:33:28.285+04:00
            [createdBy] => korston@shalom
            [employeeUuid] => ac2544a3-045a-11e3-c6b7-7054d21a8d1e
            [name] => 01088
            [updated] => 2014-03-06T12:33:28.285+04:00
            [updatedBy] => korston@shalom
            [readMode] => SELF
            [changeMode] => SELF
        )

    [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
    [uuid] => fdd0d1df-a509-11e3-8f40-002590a28eca
    [externalcode] => J6DJ4qgghCuQ8UlMzLTmX2
    [sum] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [sum] => 35000.0
                    [sumInCurrency] => 35000.0
                )

        )

    [invoicesOutUuid] => SimpleXMLElement Object
        (
        )

    [paymentsUuid] => SimpleXMLElement Object
        (
            [financeInRef] => fd7a1c02-a557-11e3-4ee1-002590a28eca
        )

    [shipmentOut] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [discount] => 0.0
                    [quantity] => 1.0
                    [consignmentUuid] => 61c4bef4-c6e5-11e2-a0ba-001b21d91495
                    [goodUuid] => e0b992fb-c6bf-11e2-bdd6-001b21d91495
                    [vat] => 0
                    [readMode] => SELF
                    [changeMode] => SELF
                )

            [accountUuid] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [accountId] => 686b3d0c-a14e-11e2-5e44-001b21d91495
            [uuid] => fdd1565c-a509-11e3-b960-002590a28eca
            [basePrice] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [price] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [sum] => 35000.0
                            [sumInCurrency] => 35000.0
                        )

                )

            [things] => SimpleXMLElement Object
                (
                )

        )

    [salesReturnsUuid] => SimpleXMLElement Object
        (
        )

)
{"total":"119","start":"0","count":"1000","demand":[]}*/
?>