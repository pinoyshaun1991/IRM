<?php

use Irm\Service\DealService;
use PHPUnit\Framework\TestCase;

class DealServiceTest extends TestCase
{
    public function testGetDeals(): void
    {
        $mockedClass = $this->createMock(DealService::class);
        $mockedClass->method('getDeals')
            ->willReturn(7);
        $this->assertEquals(7, $mockedClass->getDeals('AZ', 4, 6));
    }
}