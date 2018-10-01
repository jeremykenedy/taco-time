<?php

namespace Tests\Unit;

use Tests\TestCase;

class LineTimeTest extends TestCase
{
    /**
     * Test the method lineTime() in OrderController.php.
     *
     * Test with no inputs
     *
     * @return void
     */
    public function testLineTimeBadInputs()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $this->assertNull($orderController->lineTime(3, 1));
        $this->assertNull($orderController->lineTime('one', [2, 2, 3, 3]));
        $this->assertNull($orderController->lineTime([2, 2, 3, 3], 'one'));
        $this->assertNull($orderController->lineTime([2, 2, 3, 3], [2]));
    }

    /**
     * Test the method lineTime() in OrderController.php.
     *
     * Test with bad $registers input (as an array)
     *
     * @return void
     */
    public function testLineTimeCases()
    {
        $orderController = new \App\Http\Controllers\OrderController();
        $this->assertEquals(10, $orderController->lineTime([2, 2, 3, 3], 1));
        $this->assertEquals(12, $orderController->lineTime([5, 3, 4], 1));
        $this->assertEquals(10, $orderController->lineTime([10, 2, 3, 3], 2));
        $this->assertEquals(12, $orderController->lineTime([10, 2, 3, 3, 4], 2));
        $this->assertEquals(1, $orderController->lineTime([1, 1, 1], 3));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1], 4));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1], 4));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1, 1], 4));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1, 1], 3));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1, 1], 2));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1, 1, 1], 2));
        $this->assertEquals(6, $orderController->lineTime([5, 1, 1, 1, 1, 1, 1], 2));
        $this->assertEquals(5, $orderController->lineTime([5, 1, 1, 1, 1, 1, 1], 3));
        $this->assertEquals(11, $orderController->lineTime([5, 1, 1, 1, 1, 1, 1], 1));
    }
}
