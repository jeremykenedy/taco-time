<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LineTimeTest extends TestCase
{
    /**
     * Test the method lineTime() in OrderController.php
     *
     * Test with no inputs
     *
     * @return void
     */
    public function testLineTimeNoInputs()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $lineTime = $orderController->lineTime();
        $this->assertNull($lineTime);
    }

    /**
     * Test the method lineTime() in OrderController.php
     *
     * Test with bad $customers input
     *
     * @return void
     */
    public function testLineTimeBadInputCustomers()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $lineTime = $orderController->lineTime(3, 1);
        $this->assertNull($lineTime);
    }

    /**
     * Test the method lineTime() in OrderController.php
     *
     * Test with bad $registers input (as a string)
     *
     * @return void
     */
    public function testLineTimeBadInputRegistersString()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $lineTime = $orderController->lineTime([2,2,3,3], 'one');
        $this->assertNull($lineTime);
    }

    /**
     * Test the method lineTime() in OrderController.php
     *
     * Test with bad $registers input (as an array)
     *
     * @return void
     */
    public function testLineTimeBadInputRegistersAsArray()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $lineTime = $orderController->lineTime([2,2,3,3], [2]);
        $this->assertNull($lineTime);
    }

    /**
     * Test the method lineTime() in OrderController.php
     *
     * Test with bad $registers input (as an array)
     *
     * @return void
     */
    public function testLineTimeCases()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $this->assertEquals(10, $orderController->lineTime([2,2,3,3], 1));
        $this->assertEquals(12, $orderController->lineTime([5,3,4], 1));
        $this->assertEquals(13, $orderController->lineTime([10,2,3,3], 2));
        $this->assertEquals(1, $orderController->lineTime([1,1,1], 3));
        $this->assertEquals(5, $orderController->lineTime([5,1,1], 4));
    }
}
