<?php
 namespace Irm\Service;

 /**
  * Dummy web service retrieving deals
  *
  * Class DealService
  * @package Irm\Service
  */
class DealService
{

    /**
     * Retrieve deals by item id and its quantity
     *
     * @param $itemId
     * @param $quantity
     * @param $price
     * @return int
     */
    public function getDeals($itemId, $quantity, $price)
    {
        if (in_array($itemId, array('ZA', 'FC'))) {
            if ($itemId === 'ZA' && $quantity % 4 == 0) {
                $price = 7;
            }

            if ($itemId === 'FC' && $quantity % 6 == 0) {
                $price = 6;
            }
        }

        return $price;
    }
}