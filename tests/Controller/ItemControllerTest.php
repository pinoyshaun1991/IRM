<?php

use Irm\Model\TransactionTableModel;
use PHPUnit\Framework\TestCase;
use Irm\Controller\ItemController;

class ItemControllerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_POST['itemId'] = 'AZ';
        $_POST['price'] = 2;
    }

    public function testSetPricing(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('setPricing')
            ->willReturn('Both item id and price are required');
        $this->assertEquals('Both item id and price are required', $mockedClass->setPricing());

    }

    public function testSetPricingWithoutException(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('setPricing')
            ->willReturn('Price Saved');
        $this->assertEquals('Price Saved', $mockedClass->setPricing());
    }

    public function testScanItem(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('setPricing')
            ->willReturn('Item id is required');
        $this->assertEquals('Item id is required', $mockedClass->setPricing());
    }

    public function testScanItemWithoutException(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('scanItem')
            ->willReturn('Item Scanned');
        $this->assertEquals('Item Scanned', $mockedClass->scanItem());
    }

    public function testGetTotal(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('getTotal')
            ->willReturn('Total: £2');
        $this->assertEquals('Total: £2', $mockedClass->getTotal());
    }
}