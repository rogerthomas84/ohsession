<?php
/**
 * OhSession - a session management library for PHP
 *
 * @author      Roger Thomas <roger.thomas@rogerethomas.com>
 * @copyright   2014 Roger Thomas
 * @link        http://www.rogerethomas.com
 * @license     http://www.rogerethomas.com/license
 * @since       1.0
 * @package     OhSession
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace OhSession\Tests;

use OhSession\Session;

class SessionTest extends SessionTestBase
{
    private function reset()
    {
        return Session::getInstance();
    }

    /**
     * @runInSeparateProcess
     */
    public function testRegenerate()
    {
        $_SESSION = array();
        $storage = $this->reset();
        $this->assertTrue($storage->destroy(true));
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetAndGet()
    {
        $_SESSION = array();
        $storage = $this->reset();
        $this->assertTrue($storage->set('abc', '123'));
        $this->assertEquals('123', $storage->get('abc'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testRemove()
    {
        $_SESSION = array();
        $storage = $this->reset();
        $storage->set('abc', '123');
        $this->assertTrue($storage->remove('abc'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testRemoveAll()
    {
        $_SESSION = array();
        $storage = $this->reset();
        $storage->set('abc', '123');
        $this->assertTrue($storage->removeAll());
    }

    /**
     * @runInSeparateProcess
     */
    public function testHeaders()
    {
        $_SESSION = array();
        header("ABC", "123");
        $storage = $this->reset();
        $storage->set('abc', '123');
        $this->assertTrue($storage->removeAll());
    }
}
