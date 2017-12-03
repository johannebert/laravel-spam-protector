<?php

namespace JohannEbert\LaravelSpamProtector\Tests;

use JohannEbert\LaravelSpamProtector\SpamProtectorFacade as SpamProtector;

class SpamProtectorTest extends TestCase
{
    /**
     * It checks the StopForumSpam API for spam with not registered email
     *
     * @test
     */
    public function it_checks_not_registered_email_for_spam()
    {
        $result = SpamProtector::isSpamEmail('john.doe@example.com');

        $this->assertFalse($result);
    }

    /**
     * It checks the StopForumSpam API for spam with not registered ip
     *
     * @test
     */
    public function it_checks_not_registered_ip_for_spam()
    {
        $result = SpamProtector::isSpamIp('8.8.8.8');

        $this->assertFalse($result);
    }

    /**
     * It checks the StopForumSpam API for spam with not registered username
     *
     * @test
     */
    public function it_checks_not_registered_username_for_spam()
    {
        $result = SpamProtector::isSpamUsername('JohnDoe');

        $this->assertFalse($result);
    }

    /**
     * It checks the StopForumSpam API for spam with registered email
     *
     * @test
     */
    public function it_checks_registered_email_for_spam()
    {
        $result = SpamProtector::isSpamEmail('duete@gmx.com');

        $this->assertTrue($result);
    }

    /**
     * It checks the StopForumSpam API for spam with registered ip
     *
     * @test
     */
    public function it_checks_registered_ip_for_spam()
    {
        $result = SpamProtector::isSpamIp('179.219.194.239');

        $this->assertTrue($result);
    }

    /**
     * It checks the StopForumSpam API for spam with registered username
     *
     * @test
     */
    public function it_checks_registered_username_for_spam()
    {
        $result = SpamProtector::isSpamUsername('Lin Wei');

        $this->assertTrue($result);
    }
}