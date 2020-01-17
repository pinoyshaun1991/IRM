<?php

use Irm\Controller\ItemController;

require_once __DIR__ . '/../../vendor/autoload.php';
$params = $_GET;

if (isset($params['action'])) {
    $items = new itemController();

    switch ($params['action']) {
        case 'setPricing':
            $items->setPricing();
            break;
        case 'scanItem':
            $items->scanItem();
            break;
        case 'getTotal':
            $items->getTotal();
            break;
        case 'destroySession':
            session_destroy();
            break;
        default:
            $items->setPricing();
    }
} else {
    throw new Exception('Please enter an action either; setPricing, scanItem or getTotal');
}

