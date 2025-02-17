<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Processor;

class PsrLogMessageProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getPairs
     */
    public function testReplacement($val, $expected)
    {
        $proc = new PsrLogMessageProcessor;

        $message = $proc(array(
            'message' => '{foo}',
            'context' => array('foo' => $val),
        ));
        $this->assertEquals($expected, $message['message']);
    }

    public function testReplacementWithContextRemoval()
    {
        $proc = new PsrLogMessageProcessor($dateFormat = null, $removeUsedContextFields = true);

        $message = $proc(array(
            'message' => '{foo}',
            'context' => array('foo' => 'bar', 'lorem' => 'ipsum'),
        ));
        $this->assertSame('bar', $message['message']);
        $this->assertSame(array('lorem' => 'ipsum'), $message['context']);
    }

    public function testCustomDateFormat()
    {
        $format = "Y-m-d";
        $date = new \DateTime();

        $proc = new PsrLogMessageProcessor($format);

        $message = $proc(array(
            'message' => '{foo}',
            'context' => array('foo' => $date),
        ));
        $this->assertEquals($date->format($format), $message['message']);
        $this->assertSame(array('foo' => $date), $message['context']);
    }

    public function getPairs()
    {
        $date = new \DateTime();

        return array(
            array('foo',    'foo'),
            array('3',      '3'),
            array(3,        '3'),
            array(null,     ''),
            array(true,     '1'),
            array(false,    ''),
            array($date, $date->format(PsrLogMessageProcessor::SIMPLE_DATE)),
            array(new \stdClass, '[object stdClass]'),
            array(array(), 'array[]'),
            array(array(1, 2, 3), 'array[1,2,3]'),
            array(array('foo' => 'bar'), 'array{"foo":"bar"}'),
            array(stream_context_create(), '[resource]'),
        );
    }
}
