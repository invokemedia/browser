<?php

/**
 * Part of the Browser package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the MIT License.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Browser
 * @version    1.0.0
 * @author     Invoke Media
 * @license    MIT License
 * @copyright  (c) 2016, Invoke Media
 * @link       https://www.invokemedia.com
 */

namespace Invoke\Browser\Tests;

use PHPUnit_Framework_TestCase;
use Invoke\Browser\Browser;

class BrowserTest extends PHPUnit_Framework_TestCase
{

    public $browser;

    public function setupDefaultBrowser()
    {
        $fake_ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.35 Safari/537.36";
        $this->browser = new Browser($fake_ua);
    }

    /** @test */
    public function itCanMatchABrowser1()
    {
        $this->setupDefaultBrowser();
        $this->assertEquals($this->browser->browser, 'google-chrome');
    }

    /** @test */
    public function itCanUseAGetterForBrowser()
    {
        $this->setupDefaultBrowser();
        $this->assertEquals($this->browser->getBrowser(), 'google-chrome');
    }

    /** @test */
    public function itCanUseAGetterForPlatform()
    {
        $this->setupDefaultBrowser();
        $this->assertEquals($this->browser->getPlatform(), 'mac');
    }

    /** @test */
    public function itCanMatchAPlatform1()
    {
        $this->setupDefaultBrowser();
        $this->assertEquals($this->browser->platform, 'mac');
    }

    /** @test */
    public function itWillFailWhenAnArrayIsGiven()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Browser([]);
    }

    /** @test */
    public function itWillFailWhenAnObjectIsGiven()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Browser(new \stdClass());
    }

    /** @test */
    public function itWillFailWhenNullIsGiven()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Browser(null);
    }

    /** @test */
    public function itWillFailWhenIntegersAreGiven()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Browser(0);
    }

    /** @test */
    public function itWillFailWhenIntegersAreGiven2()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Browser(1234);
    }

    /** @test */
    public function itWillHandleAnUnknownBrowser()
    {
        $browser = new Browser('this is not a real ua string');

        $this->assertEquals(false, $browser->browser);
    }

    /** @test */
    public function itWillHandleAnUnknownPlatform()
    {
        $browser = new Browser('this is not a real ua string');

        $this->assertEquals(false, $browser->platform);
    }

    /** @test */
    public function itWillMatchMobile()
    {
        $ua = "Opera/9.80 (iPhone; Opera Mini/8.0.0/34.2336; U; en) Presto/2.8.119 Version/11.10";

        $browser = new Browser($ua);

        $this->assertTrue($browser->isMobile());
    }

    /** @test */
    public function itWillMatchDesktop()
    {
        $this->setupDefaultBrowser();

        $this->assertTrue($this->browser->isDesktop());
    }

    /** @test */
    public function itWillNotMatchiPadAsMobile()
    {
        $ua = "Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B137 Safari/601.1";

        $browser = new Browser($ua);

        $this->assertFalse($browser->isMobile());
    }

    /** @test */
    public function itWillMatchOldAndroid()
    {
        $ua = "Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; Nexus S Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";
        $browser = new Browser($ua);

        $this->assertEquals('android', $browser->platform);
        $this->assertEquals('android', $browser->browser);
    }

    /** @test */
    public function itWillMatchAndroid()
    {
        $ua = "Mozilla/5.0 (Linux; U; Android 4.0.2; en-us; Galaxy Nexus Build/ICL53F) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";

        $browser = new Browser($ua);

        $this->assertEquals('android', $browser->platform);
        $this->assertEquals('android', $browser->browser);
    }

    /** @test */
    public function itWillMatchIE11()
    {
        $ua = "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('internet-explorer', $browser->browser);
    }

    /** @test */
    public function itWillMatchIE10()
    {
        $ua = "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('internet-explorer', $browser->browser);
    }

    /** @test */
    public function itWillMatchIE9()
    {
        $ua = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('internet-explorer', $browser->browser);
    }

    /** @test */
    public function itWillMatchIE8()
    {
        $ua = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('internet-explorer', $browser->browser);
    }

    /** @test */
    public function itWillMatchIE7()
    {
        $ua = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('internet-explorer', $browser->browser);
    }

    /** @test */
    public function itWillMatchBlackBerry10()
    {
        $ua = "Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+";

        $browser = new Browser($ua);

        $this->assertEquals('blackberry', $browser->platform);
        $this->assertEquals('blackberry', $browser->browser);
    }

    /** @test */
    public function itWillMatchOpera()
    {
        $ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36 OPR/37.0.2178.31";

        $browser = new Browser($ua);

        $this->assertEquals('mac', $browser->platform);
        $this->assertEquals('opera', $browser->browser);
    }

    /** @test */
    public function itWillMatchOpera2()
    {
        $ua = "Opera/9.80 (Macintosh; Intel Mac OS X 10.9.1) Presto/2.12.388 Version/12.16";

        $browser = new Browser($ua);

        $this->assertEquals('mac', $browser->platform);
        $this->assertEquals('opera', $browser->browser);
    }

    /** @test */
    public function itWillMatchOperaMini()
    {
        $ua = "Opera/9.80 (iPhone; Opera Mini/8.0.0/34.2336; U; en) Presto/2.8.119 Version/11.10";

        $browser = new Browser($ua);

        $this->assertEquals('ios', $browser->platform);
        $this->assertEquals('opera-mini', $browser->browser);
    }

    /** @test */
    public function itWillMatchiPad()
    {
        $ua = "Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B137 Safari/601.1";

        $browser = new Browser($ua);

        $this->assertEquals('ios', $browser->platform);
        $this->assertEquals('safari', $browser->browser);
    }

    /** @test */
    public function itWillMatchiPhone()
    {
        $ua = "Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B137 Safari/601.1";

        $browser = new Browser($ua);

        $this->assertEquals('ios', $browser->platform);
        $this->assertEquals('safari', $browser->browser);
    }

    /** @test */
    public function itWillMatchSafari()
    {
        $ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A";

        $browser = new Browser($ua);

        $this->assertEquals('mac', $browser->platform);
        $this->assertEquals('safari', $browser->browser);
    }

    /** @test */
    public function itWillMatchUCBrowser()
    {
        $ua = "NokiaX2-02/2.0 (11.79) Profile/MIDP-2.1 Configuration/CLDC-1.1 Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2;.NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2) UCBrowser8.4.0.159/70/352";

        $browser = new Browser($ua);

        $this->assertEquals('windows', $browser->platform);
        $this->assertEquals('uc-browser', $browser->browser);
    }
}
