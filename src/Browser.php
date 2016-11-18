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

namespace Invoke\Browser;

class Browser
{
    protected $userAgent;
    protected $platform;
    protected $browser;

    private $unknownPlatform = false;
    private $unknownBrowser = false;

    /**
     * @var the specific platforms to match
     */
    private $platformTests = [
        [
            'pattern' => '/Android/i',
            'platform' => 'android',
        ],
        [
            'pattern' => '/linux/i',
            'platform' => 'linux',
        ],
        [
            'pattern' => '/iPhone|iPod|iPad/i',
            'platform' => 'ios',
        ],
        [
            'pattern' => '/macintosh|mac os x/i',
            'platform' => 'mac',
        ],
        [
            'pattern' => '/windows|win32/i',
            'platform' => 'windows',
        ],
        [
            'pattern' => '/BlackBerry/i',
            'platform' => 'blackberry',
        ],
        [
            'pattern' => '/BB[0-9]?[0-9]/i',
            'platform' => 'blackberry',
        ],
    ];

    /**
     * @var the specific browsers to match
     */
    private $browserTests = [
        [
            'pattern' => 'UCBrowser',
            'browser' => 'uc-browser',
        ],
        [
            'pattern' => 'Android',
            'browser' => 'android',
        ],
        [
            'pattern' => 'MSIE',
            'browser' => 'internet-explorer',
        ],
        [
            'pattern' => 'Trident',
            'browser' => 'internet-explorer',
        ],
        [
            'pattern' => 'BB10',
            'browser' => 'blackberry',
        ],
        [
            'pattern' => 'Vivaldi',
            'browser' => 'vivaldi',
        ],
        [
            'pattern' => 'Firefox',
            'browser' => 'mozilla-firefox',
        ],
        [
            'pattern' => 'OPR',
            'browser' => 'opera',
        ],
        [
            'pattern' => 'Opera Mini',
            'browser' => 'opera-mini',
        ],
        [
            'pattern' => 'Opera',
            'browser' => 'opera',
        ],
        [
            'pattern' => 'Chrome',
            'browser' => 'google-chrome',
        ],
        [
            'pattern' => 'Safari',
            'browser' => 'safari',
        ],
    ];

    /**
     * Class Initiator
     * @param string $ua The HTTP_USER_AGENT string
     */
    public function __construct($ua = null)
    {
        // $_SERVER['HTTP_USER_AGENT']

        if (!is_string($ua)) {
            throw new \InvalidArgumentException('testPlatform expects parameter to be a string, ' . gettype($ua) . ' given.');
        }

        $this->userAgent = $ua;
        $this->platform = $this->testPlatform($ua);
        $this->browser = $this->testBrowser($ua);
    }

    private function testPlatform($ua)
    {
        if (!is_string($ua)) {
            throw new \InvalidArgumentException('testPlatform expects parameter 1 to be a string, ' . gettype($ua) . ' given.');
        }

        foreach ($this->platformTests as $test) {
            if (preg_match($test['pattern'], $ua)) {
                return $test['platform'];
            }
        }

        return $this->unknownPlatform;
    }

    private function testBrowser($ua)
    {

        if (!is_string($ua)) {
            throw new \InvalidArgumentException('testBrowser expects parameter 1 to be a string, ' . gettype($ua) . ' given.');
        }

        foreach ($this->browserTests as $test) {
            if (strpos($ua, $test['pattern']) !== false) {
                return $test['browser'];
            }
        }

        return $this->unknownBrowser;
    }

    /**
     * return the browser result
     * @return string browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * return the platform result
     * @return string platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * return a guess on the form factor
     * @return string formFactor
     */
    public function isMobile()
    {
        // mobile devices, but not ipads
        return in_array($this->platform, ['android', 'ios']) && !preg_match('/iPad/i', $this->userAgent);
    }

    /**
     * return a guess on the form factor
     * @return string formFactor
     */
    public function isDesktop()
    {
        return !$this->isMobile();
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new \Exception('Undefined property ' . $property);
        }
    }
}
