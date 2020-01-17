<?php

namespace Irm\Model;

use Exception;
use Irm\Common\Model\AbstractModel;
use Irm\Service\DealService;

/**
 * Class TransactionTable
 * @package Model
 */
class TransactionTableModel extends AbstractModel
{
    /**
     * @var string
     */
    private $itemId;

    /**
     * @var int
     */
    private $price;

    /**
     * @var array
     */
    private $items;

    /**
     * @var int
     */
    private $total;

    /**
     * @var DealService
     */
    private $dealService;

    /**
     * TransactionTable constructor.
     * @throws Exception
     */
    public function __construct()
    {
        session_start();
        $this->itemId       = array();
        $this->price        = array();
        $this->items        = array();
        $this->total        = 0;
        $this->dealService  = new DealService();
    }

    /**
     * Set the item id
     *
     * @param $id
     * @return string
     * @throws Exception
     */
    private function setItemId($id): string
    {
        if (is_null($id)) {
            throw new Exception('Item id is required');
        }

        return $this->itemId[] = $id;
    }

    /**
     * Retrieve item id
     *
     * @return array|string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * set the price value
     *
     * @param $price
     * @return int
     * @throws Exception
     */
    private function setPrice($price): int
    {
        if (is_null($price) || !is_numeric($price) || $price <= 0) {
            throw new Exception('Price is required and needs to be a positive number');
        }

        return $this->price[] = $price;
    }

    /**
     * Retrieve price
     *
     * @param $id
     * @return mixed
     */
    public function getPrice($id)
    {
        return $this->price[$id];
    }

    /**
     * Fetch and validate items by id
     *
     * @param $ids
     * @return int
     * @throws Exception
     */
    public function fetchItemsById($ids): int
    {
        $found     = false;
        $scanCount = 1;

        if (is_array($ids) === false) {
            $ids = (array)$ids;
        }

        if (empty($this->items)) {
            $found = false;
        }

        if (isset($_SESSION['data'])) {
            foreach ($_SESSION['data'] as $itemArray) {
                foreach ($ids as $id) {
                    if (array_key_exists($id, $itemArray)) {

                        if ($id === 'ZA' && $scanCount % 4 == 0 || $id === 'FC' && $scanCount % 6 == 0) {
                            $this->total = $this->dealService->getDeals($id, $scanCount, $itemArray[$id]);
                        } else {
                            $this->total += $this->dealService->getDeals($id, $scanCount, $itemArray[$id]);
                        }

                        $scanCount += 1;
                        $found = true;
                    }
                }
            }
        }

        if ($found === false) {
            throw new Exception('Unable to find item');
        }

        $_SESSION['total'] = $this->total;

        return $_SESSION['total'];
    }

    /**
     * Set the pricing per item
     *
     * @param $itemParams
     * @return array
     */
    public function setPricing($itemParams)
    {
        if (is_array($itemParams) === false) {
            $itemParams = (array)$itemParams;
        }

        $this->setAttributes($itemParams['itemId'], 'setItemId');
        $this->setAttributes($itemParams['price'], 'setPrice');

        foreach ($this->getItemId() as $key => $item) {
            $this->items[] = array(
                $item => $this->getPrice($key)
            );

        }

        $_SESSION['data'] = $this->items;

        return $_SESSION['data'];
    }

    /**
     * Abstract method for setting attributes
     *
     * @param array $params
     * @param string $method
     */
    private function setAttributes($params = array(), $method = '')
    {
        foreach ($params as $key => $itemIdParam) {
            $this->{$method}($itemIdParam);
        }

        return;
    }

    /**
     * Retrieve total cost of items
     */
    public function getTotal()
    {
        echo "Total: £".number_format($_SESSION['total'], 2, '.', '');

        return;
    }

}