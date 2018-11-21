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
'--lang=zh-CN'
];
$ua=[];
$ua['pc']=[
' Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0 ',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.163 Safari/535.1',
'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0) Gecko/20100101 Firefox/6.0',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
'Opera/9.80 (Windows NT 6.1; U; zh-cn) Presto/2.9.168 Version/11.50',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2 ',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36',
'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11',
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.133 Safari/534.16',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 UBrowser/4.0.3214.0 Safari/537.36',
'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
'Opera/9.80 (Windows NT 6.1; U; zh-cn) Presto/2.9.168 Version/11.50',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
'Mozilla/5.0 (masking-agent; rv:55.0) Gecko/20100101 Firefox/55.0',
'Mozilla/5.0 (masking-agent; rv:45.0) Gecko/20100101 Firefox/45.0,gzip(gfe)',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
'Mozilla/5.0 (Windows NT 5.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.63 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0',
'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0',
'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.1.2 Safari/605.1.15',
'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0',
'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36',
'Mozilla/5.0 (Windows NT 6.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0',
'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'
];
$ua['mobile']=[
'MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22;CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-cn; BLA-AL00 Build/HUAWEIBLA-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.9 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; MHA-AL00 Build/HUAWEIMHA-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.4.994 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-CN; EML-AL00 Build/HUAWEIEML-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/11.9.4.974 UWS/2.13.1.48 Mobile Safari/537.36 AliApp(DingTalk/4.5.11) com.alibaba.android.rimet/10487439 Channel/227200 language/zh-CN',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; BAC-AL00 Build/HUAWEIBAC-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/11.9.4.974 UWS/2.13.1.48 Mobile Safari/537.36 AliApp(DingTalk/4.5.11) com.alibaba.android.rimet/10487439 Channel/227200 language/zh-CN',
'Mozilla/5.0 (Linux; Android 7.0; VTR-AL00 Build/HUAWEIVTR-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 lite baiduboxapp/3.6.0.10 (Baidu; P1 7.0)',
'Mozilla/5.0 (Linux; Android 8.1.0; CLT-AL00 Build/HUAWEICLT-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 8.1.0)',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; HUAWEI NXT-TL00 Build/HUAWEINXT-TL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.4.994 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 8.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/10.6 baiduboxapp/10.6.0.11 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-cn; Mi Note 2 Build/OPR1.170623.032) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/10.1.1',
'Mozilla/5.0 (Linux; Android 8.0.0; MI 6 Build/OPR1.170623.027) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36 Maxthon/3235',
'Mozilla/5.0 (Linux; U; Android 7.0; zh-cn; MI 5s Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/10.2.2',
'Mozilla/5.0 (Linux; Android 8.0.0; MI 6 Build/OPR1.170623.027; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-cn; Mi Note 3 Build/OPM1.171019.019) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/10.0.2',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; MI 5 Build/OPR1.170623.032) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/11.8.9.969 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-cn; MI MAX 3 Build/OPM1.171019.019) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/10.1.1',
'Mozilla/5.0 (Linux; U; Android 9; zh-cn; MIX 2S Build/PKQ1.180729.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/10.1.2',
'Mozilla/5.0 (Linux; Android 8.0.0; MI 5 Build/OPR1.170623.032; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.10 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; Android 7.0; MI 5s Plus Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 7.0)',
'Mozilla/5.0 (Linux; Android 8.0.0; SM-G9650 Build/R16NW; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; Android 8.0.0; SM-N9500 Build/R16NW; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; Android 7.0; SM-G9280 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/10.8 baiduboxapp/10.8.7.10 (Baidu; P1 7.0)',
'Mozilla/5.0 (Linux; Android 7.0; SM-G9208 Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/35.0.1916.138 Mobile Safari/537.36 T7/7.4 baiduboxapp/8.2.5 (Baidu; P1 7.0)',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; SM-G9500 Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.3.993 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-cn; SM-G9350 Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.8 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 8.0.0; SM-G9650 Build/R16NW; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.10 lite baiduboxapp/3.5.5.10 (Baidu; P1 8.0.0)',
'Mozilla/5.0 (Linux; U; Android 8.0.0; zh-CN; SM-G9550 Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.3.993 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 5.1; zh-CN; m2 note Build/LMY47D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.9.2.712 U3/0.8.0 Mobile Safari/534.30',
'Mozilla/5.0 (Linux; U; Android 5.1; zh-cn; m2 note Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.8 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 7.1.1; zh-cn; PRO 6 Build/NMF26O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.5 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 7.1.1; zh-cn; MX6 Build/NMF26O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.7 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 5.1; m2 note Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/10.9 baiduboxapp/10.9.5.10 (Baidu; P1 5.1)',
'Mozilla/5.0 (Linux; U; Android 7.0; zh-CN; PRO 5 Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.0.4.984 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 7.0; PRO 5 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/10.9 baiduboxapp/10.9.0.10 (Baidu; P1 7.0)',
'Mozilla/5.0 (Linux; U; Android 5.1; zh-cn; PRO 5 Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.5 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 8.1.0; PACM00 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 8.1.0)',
'Mozilla/5.0 (Linux; Android 6.0.1; OPPO A57 Build/MMB29M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.10 (Baidu; P1 6.0.1)',
'Mozilla/5.0 (Linux; Android 6.0.1; OPPO A57 Build/MMB29M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/9.1 baidubrowser/7.18.21.0 (Baidu; P1 6.0.1)',
'Mozilla/5.0 (Linux; Android 7.1.1; OPPO R11 Build/NMF26X; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.13 baiduboxapp/10.13.0.11 (Baidu; P1 7.1.1)',
'Mozilla/5.0 (Linux; U; Android 5.1.1; zh-CN; OPPO R9 Plusm A Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.4.994 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 4.4.4; zh-cn; OPPO R7s Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.9 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 5.1; OPPO R9m Build/LMY47I; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.116 Mobile Safari/537.36 T7/10.11 baiduboxapp/10.11.0.12 (Baidu; P1 5.1)',
'Mozilla/5.0 (Linux; U; Android 5.1.1; zh-CN; OPPO R9 Plusm A Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.1.3.993 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 6.0.1; zh-cn; OPPO A57 Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/37.0.0.0 MQQBrowser/7.3 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 7.1.1; zh-cn; OPPO R11 Plus Build/NMF26X) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.8 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 6.0.1; zh-CN; OPPO A57 Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/11.9.4.974 UWS/2.14.0.11 Mobile Safari/537.36 AliApp(TB/7.10.0) UCBS/2.11.1.1 TTID/10001401@taobao_android_7.10.0 WindVane/8.3.0 720X1280',
'Mozilla/5.0 (Linux; U; Android 7.1.1; zh-cn; PACM00 Build/PACM00) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.2 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-cn; PACM00 Build/O11019) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/8.8 Mobile Safari/537.36',
'Mozilla/5.0 (Linux; Android 8.1.0; PACM00 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.83 Mobile Safari/537.36 T7/10.12 baiduboxapp/10.12.0.12 (Baidu; P1 8.1.0)',
'Mozilla/5.0 (iPhone 6s; CPU iPhone OS 11_4_1 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 MQQBrowser/8.3.0 Mobile/15B87 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 10_1 like Mac OS X) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0 MQQBrowser/8.8.2 Mobile/14B72c Safari/602.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 11_2 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 MQQBrowser/8.8.2 Mobile/15B87 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 10_1_1 like Mac OS X) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0 MQQBrowser/8.8.2 Mobile/14B100 Safari/602.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone 6sp; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 MQQBrowser/8.2.1 Mobile/14G60 Safari/602.1 MttCustomUA/2 QBWebViewType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_5 like Mac OS X) AppleWebKit/600.1.17 (KHTML, like Gecko) Version/9.0 Mobile/13E233 MQQBrowser/6.6 Safari/600.1.4',
'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/12.0 MQQBrowser/8.7.1 Mobile/15B87 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 11_4_1 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 MQQBrowser/8.8.2 Mobile/15B87 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone 6s; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 MQQBrowser/7.7.1 Mobile/16A366 Safari/8536.25',
'Mozilla/5.0 (iPhone 92; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 MQQBrowser/7.8.0 Mobile/15A372 Safari/8536.25 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 11_2_5 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 MQQBrowser/8.7.1 Mobile/15B87 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 MQQBrowser/8.8.1 Mobile/16A366 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 MQQBrowser/8.8.1 Mobile/16A366 Safari/604.1 MttCustomUA/2 QBWebViewType/1 WKType/1',
'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 MQQBrowser/8.8.0 Mobile/13B143 Safari/601.1 MttCustomUA/2 QBWebViewType/1 WKType/1'
];

        // disable loading of images (currently can't be done via devtools, only CLI)
        if (array_key_exists('isMobile', $arguments) && ($arguments['isMobile'] === true)) {
          $args[] =  '--user-agent=' . array_rand($ua['mobile'],1);
        }else{
        $args[] =  '--user-agent=' . array_rand($ua['pc'],1);
        }
$ua=null;

        // disable loading of images (currently can't be done via devtools, only CLI)
        if (array_key_exists('enableImages', $arguments) && ($arguments['enableImages'] === false)) {
            $args[] = '--blink-settings=imagesEnabled=false';
        }

        // window's size
        if (array_key_exists('windowSize', $arguments) && $arguments['windowSize']) {
            if (!is_array($arguments['windowSize']) ||
                count($arguments['windowSize']) !== 2 ||
                !is_numeric($arguments['windowSize'][0]) ||
                !is_numeric($arguments['windowSize'][1])
            ) {
                throw new \InvalidArgumentException(
                    'Option "windowSize" must be an array of dimensions (eg: [1000, 1200])'
                );
            }

            $args[] = '--window-size=' . implode(',', $arguments['windowSize']) ;
        }


        // add custom flags
        if (array_key_exists('customFlags', $arguments) && is_array($arguments['customFlags'])) {
            $args =  array_merge($args, $arguments['customFlags']);
        }

        // add user data dir to args
        $args[] = '--user-data-dir=' . $arguments['userDataDir'];
        // user proxy
        if (array_key_exists('proxy', $arguments)) {
        
            $args[] = '--proxy-server=' . escapeshellarg($arguments['proxy']);
        }
     if (array_key_exists('other', $arguments)) {
         $args= array_merge(args, $arguments['other']);
        }
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
