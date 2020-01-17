<?php

namespace Irm\Controller;

use Irm\Common\Controller\TransactionInterface;
use Exception;
use Irm\Model\TransactionTableModel;

/**
 * Implements the transaction interface
 *
 * Class ItemController
 * @package Irm\Controller
 */
class ItemController implements TransactionInterface
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionTableModel();
    }

    /**
     * Set the pricing of items
     *
     * @return mixed|void
     */
    public function setPricing()
    {
        $itemParams = $_POST;
        $message    = '';

        try {
            if (!empty($itemParams)) {
                if (isset($itemParams['itemId']) && isset($itemParams['price'])) {
                    $this->transactionModel->setPricing($itemParams);
                    $message = "Price Saved";
                } else {
                    throw new Exception('Both item id and price are required');
                }
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }

        echo $message;

        return;
    }

    /**
     * Scan items by their id
     *
     * @return mixed|void
     */
    public function scanItem()
    {
        $itemParams = $_POST;
        $message    = '';

        try {
            if (!empty($itemParams)) {
                if (isset($itemParams['itemId'])) {
                    $this->transactionModel->fetchItemsById($itemParams['itemId']);
                    $message = "Item Scanned";
                } else {
                    throw new Exception('Item id is required');
                }
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }

        echo $message;

        return;
    }

    /**
     * Retrieve total amount
     *
     * @return int|mixed
     */
    public function getTotal()
    {
        $this->transactionModel->getTotal();

        return;
    }
}