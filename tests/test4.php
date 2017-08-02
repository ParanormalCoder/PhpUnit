<?php
use PHPUnit\Framework\TestCase;

class DependencyAndDataProviderComboTest extends TestCase
{
    public function provider()
    {
        return [['provider1', 'provider1'], ['provider2', 'provider2']];
    }

    public function provider2()
    {
        return [['provider1'], ['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends      testProducerFirst
     * @depends      testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer1()
    {
        $this->assertEquals(
            ['provider1', 'first', 'second'],
            func_get_args()
        );
    }

    /**
     * @depends      testProducerFirst
     * @depends      testProducerSecond
     * @dataProvider provider2
     */
    public function testConsumer1a()
    {
        $this->assertEquals(
            ['provider2', 'first', 'second'],
            func_get_args()
        );
    }

    /**
     * @dataProvider provider
     */
    public function testConsumer2($proData1, $proData2)
    {
        $this->assertEquals($proData1, $proData2);
    }
}

?>