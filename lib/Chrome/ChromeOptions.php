<?php
// Copyright 2004-present Facebook. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace Facebook\WebDriver\Chrome;

use Facebook\WebDriver\Remote\DesiredCapabilities;

/**
 * The class manages the capabilities in ChromeDriver.
 *
 * @see https://sites.google.com/a/chromium.org/chromedriver/capabilities
 */
class ChromeOptions
{
    /**
     * The key of chrome options in desired capabilities.
     */
    const CAPABILITY = 'chromeOptions';
    /**
     * @var array
     */
    private $arguments = [];
    /**
     * @var string
     */
    private $binary = '';
    /**
     * @var array
     */
    private $extensions = [];
    /**
     * @var array
     */
    private $experimentalOptions = [];

    /**
     * Sets the path of the Chrome executable. The path should be either absolute
     * or relative to the location running ChromeDriver server.
     *
     * @param string $path
     * @return ChromeOptions
     */
    public function setBinary($path)
    {
        $this->binary = $path;

        return $this;
    }

    /**
     * @param array $arguments
     * @return ChromeOptions
     */
    public function addArguments(array $arguments)
    {
$args = [
'--load-images=no',
'--disable-xss-auditor',
'--disable-impl-side-painting',
'--disable-setuid-sandbox',
'--disable-seccomp-filter-sandbox',
'--disable-breakpad',
'--disable-client-side-phishing-detection',
'--disable-cast',
'--disable-cast-streaming-hw-encoding',
'--disable-cloud-import',
'--disable-popup-blocking',
'--disable-session-crashed-bubble',
'--disable-ipv6',
'--no-default-browser-check',
'--remote-debugging-port=0',
'--disable-background-networking',
'--disable-background-timer-throttling',
'--disable-client-side-phishing-detection',
'--disable-default-apps',
'--disable-hang-monitor',
'--disable-popup-blocking',
'--disable-prompt-on-repost',
'--disable-sync',
'--disable-translate',
'--metrics-recording-only',
'--safebrowsing-disable-auto-update',
'--enable-automation',
'--password-store=basic',
'--use-mock-keychain',
'--no-sandbox',
'--headless',
'--disable-gpu',
'--hide-scrollbars',
'--mute-audio',
'--ignore-certificate-errors',
'--remote-debugging-port=9222',
'--homepage=about:blank',
'--no-first-run',
'--no-default-browser-check',
'--allow-insecure-localhost',
'--disable-web-security',
'--disable-plugins',
'--disable-renderer-backgrounding',
'--disable-device-discovery-notifications',
'--disable-infobars',
'--disable-dev-shm-usage',
'--lang=zh-CN',
'--blink-settings=imagesEnabled=false'
];
//UserAgent
if (array_key_exists('userAgent', $arguments)) {$args[] =  '--user-agent=' . $arguments['userAgent'];};
// window's size
if (array_key_exists('windowSize', $arguments) && $arguments['windowSize']) {
if (!is_array($arguments['windowSize']) || count($arguments['windowSize']) !== 2 || !is_numeric($arguments['windowSize'][0]) || !is_numeric($arguments['windowSize'][1])) {throw new \InvalidArgumentException('Option "windowSize" must be an array of dimensions (eg: [1000, 1200])');}
$args[] = '--window-size=' . implode(',', $arguments['windowSize']) ;
}
//add user data dir
$args[] = '--user-data-dir=' . $arguments['userDataDir'];
// user proxy
if (array_key_exists('proxy', $arguments)) {$args[] = '--proxy-server=' . escapeshellarg($arguments['proxy']);}
//other
if (array_key_exists('other', $arguments)) {$args= array_merge(args, $arguments['other']);}
$this->arguments = array_merge($this->arguments, $args);
        return $this;
    }

    /**
     * Add a Chrome extension to install on browser startup. Each path should be
     * a packed Chrome extension.
     *
     * @param array $paths
     * @return ChromeOptions
     */
    public function addExtensions(array $paths)
    {
        foreach ($paths as $path) {
            $this->addExtension($path);
        }

        return $this;
    }

    /**
     * @param array $encoded_extensions An array of base64 encoded of the extensions.
     * @return ChromeOptions
     */
    public function addEncodedExtensions(array $encoded_extensions)
    {
        foreach ($encoded_extensions as $encoded_extension) {
            $this->addEncodedExtension($encoded_extension);
        }

        return $this;
    }

    /**
     * Sets an experimental option which has not exposed officially.
     *
     * @param string $name
     * @param mixed $value
     * @return ChromeOptions
     */
    public function setExperimentalOption($name, $value)
    {
        $this->experimentalOptions[$name] = $value;

        return $this;
    }

    /**
     * @return DesiredCapabilities The DesiredCapabilities for Chrome with this options.
     */
    public function toCapabilities()
    {
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(self::CAPABILITY, $this);

        return $capabilities;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $options = $this->experimentalOptions;

        // The selenium server expects a 'dictionary' instead of a 'list' when
        // reading the chrome option. However, an empty array in PHP will be
        // converted to a 'list' instead of a 'dictionary'. To fix it, we always
        // set the 'binary' to avoid returning an empty array.
        $options['binary'] = $this->binary;

        if ($this->arguments) {
            $options['args'] = $this->arguments;
        }

        if ($this->extensions) {
            $options['extensions'] = $this->extensions;
        }

        return $options;
    }

    /**
     * Add a Chrome extension to install on browser startup. Each path should be a
     * packed Chrome extension.
     *
     * @param string $path
     * @return ChromeOptions
     */
    private function addExtension($path)
    {
        $this->addEncodedExtension(base64_encode(file_get_contents($path)));

        return $this;
    }

    /**
     * @param string $encoded_extension Base64 encoded of the extension.
     * @return ChromeOptions
     */
    private function addEncodedExtension($encoded_extension)
    {
        $this->extensions[] = $encoded_extension;

        return $this;
    }
}
