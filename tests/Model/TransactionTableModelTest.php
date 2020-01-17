<?php

use PHPUnit\Framework\TestCase;
use Irm\Model\TransactionTableModel;

class TransactionTableModelTest extends TestCase
{

    private $returnedTransactionArray = array(
       'AZ' => 2
    );

    /**
     * @dataProvider itemProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetItemId($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setItemId');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function itemProvider()
    {
        return [
            [null, 'Item id is required']
        ];
    }

    /**
     * @dataProvider itemWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetItemIdWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setItemId');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function itemWithoutExceptionProvider()
    {
        return [
            ['Testing', 'Testing'],
            [3, 3],
            [10, 10],
            [100, 100]
        ];
    }

    public function testGetItemId(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getItemId')
            ->willReturn(array(1));
        $this->assertEquals(array(1), $mockedClass->getItemId());
    }

    /**
     * @dataProvider priceProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetPrice($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setPrice');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function priceProvider()
    {
        return [
            [null, 'Price is required and needs to be a positive number'],
            [0, 'Price is required and needs to be a positive number'],
            [-12, 'Price is required and needs to be a positive number']
        ];
    }

    /**
     * @dataProvider priceWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetPriceWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setPrice');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function priceWithoutExceptionProvider()
    {
        return [
            [1, 1],
            ['1', '1'],
            [2, 2],
            ['2', '2']
        ];
    }

    public function testGetPrice(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getPrice')
            ->willReturn($this->returnedTransactionArray['AZ']);
        $this->assertEquals(2, $mockedClass->getPrice('AZ'));
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testFetchItemsById($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('fetchItemsById');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }
    public function itemsProvider()
    {
        return [
            [null, 'Unable to find item'],
            ['abcdefg', 'Unable to find item']
        ];
    }

    public function testFetchItemsByIdWithoutException(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('fetchItemsById')
            ->willReturn(2);
        $this->assertEquals(2, $mockedClass->fetchItemsById('AZ'));
    }

    public function testSetPricing(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('setPricing')
            ->willReturn(array(array('AZ' => 2)));
        $this->assertEquals(array(array('AZ' => 2)), $mockedClass->setPricing(array('itemId' => 'AZ', 'price' => 2)));
    }

    public function testGetTotal(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getTotal')
            ->willReturn('Total: £2');
        $this->assertEquals('Total: £2', $mockedClass->getTotal());
    }
}