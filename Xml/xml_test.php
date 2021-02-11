<?php

require_once 'XMLParser.php';
require_once 'Models/Model.php';
require_once 'Models/Product.php';
require_once 'Models/Price.php';
require_once 'Models/Property.php';

    $parser = XmlParser::fromFilePath('example.xml');


    $test_samson = $parser->parse();


$db = new PDO("mysql:host=localhost; dbname=test_samson", "pupa",  "Gafs!1987poTr1");

    try {
        $db = new PDO("mysql:host=localhost; dbname=test_samson", "pupa",  "Gafs!1987poTr1");
        $db->exec("set names utf8");
    } catch (PDOException $e) {
        print_r("Ошибка!: ") . $e->getMessage() . "<br/>";
        die();
    }


    foreach ($test_samson as $product) {
        $product->insert($db);

        foreach ($product->getPrices() as $price) {
            $price->id_product = $product->getIdentifier();
            $price->insert($db);
        }
        foreach ($product->getProperts() as $property) {
            $property->id_product = $product->getIdentifier();
            $property->insert($db);
        }

    }

