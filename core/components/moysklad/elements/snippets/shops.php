<?php
set_include_path('/home/tfoot/protsvetnoy.com/docs/core/components/moysklad');
require_once('config.moysklad.php');

$shops = array();
$shops["451ef1c6-c767-11e2-125b-001b21d91495"] = array(
    "sort" => 2,
    "mall" => array(
        "name"      => "ТЦ Корстон",
        "address"   => "город Серпухов, Борисовское шоссе, 1",
        "site"      => "www.korston.ru/serpukhov/shares-shops",
        "area"      => 110000,
        "parking"   => 1000
    ),
    "shop" => array(
        "area"      => 10,
        "openDate"  => "18 июня 2013",
        "location"  => "1 этаж, главная галлерея"
    )
);
$shops["e4405e53-a9a0-11e2-dd46-001b21d91495"] = array(
    "sort" => 1,
    "mall" => array(
        "name"      => "ТЦ Рубин",
        "address"   => "город Тверь, пр-т Калинина, 15 стр. 1",
        "site"      => "www.rubin69.ru",
        "area"      => 55000,
        "parking"   => 1000
    ),
    "shop" => array(
        "area"      => 7,
        "openDate"  => "21 апреля 2013",
        "location"  => "1 этаж, главная галлерея"
    )
);
$shops["7ad8cb30-a98f-11e2-a2b9-001b21d91495"] = array(
    "sort" => 0,
    "mall" => array(
        "name"      => "ТЦ Вегас",
        "address"   => "город Москва, 24 км МКАД Х Каширское ш.",
        "site"      => "kashirskoe.vegas-city.ru",
        "area"      => 396000,
        "parking"   => 7500
    ),
    "shop" => array(
        "area"      => 5,
        "openDate"  => "15 мая 2013",
        "location"  => "1 этаж, галлерея Fashion"
    )
);
return json_encode($shops);
?>