<?php
namespace Irm\Common\Controller;

/**
 * Declaring the methods needed to display transaction totals
 *
 * Interface TransactionInterface
 * @package Common\Controller
 */
interface TransactionInterface
{
    /**
     * Set the pricing per product id
     *
     * @return mixed
     */
    public function setPricing();

    /**
     * Get the item by it's id
     *
     * @return mixed
     */
    public function scanItem();

    /**
     * Retrieves the total cost of items
     *
     * @return mixed
     */
    public function getTotal();
}