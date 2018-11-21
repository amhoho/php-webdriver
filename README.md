### 环境安装
```
curl -sS https://getcomposer.org/installer | php
composer config -g repo.packagist composer https://packagist.phpcomposer.com
sudo mv composer.phar /usr/local/bin/composer
yum remove zip 
yum remove unzip 
yum install zip unzip php7.2-zip //7.2为对应版本
composer require ext-simplexml
php函数取消禁用
composer require facebook/webdriver
yum install php-xml 
yum install php-dom
service httpd restart
//安装驱动:
yum install java-1.8.0-openjdk(版本可通过yum search java | grep -i --color JDK查询)
前往http://selenium-release.storage.googleapis.com/index.html下载standalone selenium
并上传为/www/collector/collector.jar
前往https://sites.google.com/a/chromium.org/chromedriver/downloads并上传为/usr/bin/chromedriver
yum install https://dl.google.com/linux/direct/google-chrome-stable_current_x86_64.rpm
chmod -R 777 /usr/bin/chromedriver
chmod -R 777 /usr/bin/chrome
chmod -R 777 /usr/bin/xvfb-firefox
export PATH="$PATH:/usr/local/chromedriver"
export JAVA_HOME=/usr/lib/jvm/jre-1.8.0-openjdk
export PATH=$JAVA_HOME/bin:$PATH:/www/server/mysql/bin:/www/server/apache/bin
source /etc/profile
yum install bitmap-fonts bitmap-fonts-cjk
yum provides */libgconf-2.so.4
yum install GConf2
yum install Xvfb -y
yum install xorg-x11-fonts* -y
yum -y install http://linuxdownload.adobe.com/linux/x86_64/adobe-release-x86_64-1.0-1.noarch.rpm
yum install flash-plugin
yum -y install *-fonts-*

//环境完成
/etc/rc.d/rc.local文件加入:
nohup /usr/lib/jvm/jre-1.8.0-openjdk/bin/java -jar /www/collector/collector.jar
ln -s /etc/alternatives/google-chrome /usr/bin/chrome
```

### 改动说明:

```
修改了/www/wwwroot/39kefu.com/vendor/facebook/webdriver/lib/Chrome/ChromeOptions.php修改addArguments
修改了//www/wwwroot/39kefu.com/vendor/facebook/webdriver/lib/Remote/RemoteWebDriver.php新增TakeScreenshotByElement
```

### 安装测试:(截图test.png出现即成功)
```php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('vendor/autoload.php');
$caps = DesiredCapabilities::chrome();
$options = new ChromeOptions();
$addArguments=[
'enableImages'=> false, //禁止图像,可加速
'windowSize'=>[1920, 1000],//窗口尺寸
'isMobile'=>true,//使用使用移动端UA
'userDataDir'=>'/www/collector/data/'//如果往页面调试跨域js等信息必须.随便空目录路径
//'proxy'=>'127.0.0.1:8000'//代理
];
$options->addArguments($addArguments);
$caps->setCapability(ChromeOptions::CAPABILITY, $options);
$driver = RemoteWebDriver::create('http://127.0.0.1:4444/wd/hub', $caps, 5000);
$driver->get('https://baidu.com');
echo "The title is '" . $driver->getTitle() . "'\n";
echo "The current URI is '" . $driver->getCurrentURL() . "'\n";
$driver->takeScreenshot('./test.jpg');
$driver->quit();
```
### API使用集合:
```php
<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('vendor/autoload.php');

//启动参数
$options = new ChromeOptions();
$addArguments=[
'enableImages'=> false, //禁止图像,可加速
'windowSize'=>[1920, 6000],//窗口尺寸
'isMobile'=>true,//使用使用移动端UA
'userDataDir'=>'/www/collector/data/'//如果往页面调试跨域js等信息必须.随便空目录路径
//'proxy'=>'127.0.0.1:8000'//代理
//'other'=>['']//其它一些参数组成的数组
];
$options->addArguments($addArguments);

//启动时加载指定扩展
$options->addExtensions(array(
'/path/to/chrome/extension1.crx',
'/path/to/chrome/extension2.crx',
));

//启动预设,例如下载目录
$prefs = ['download.default_directory' => 'c:/temp'];
$options->setExperimentalOption('prefs', $prefs);

//启动浏览器
$caps = DesiredCapabilities::chrome();

//除了上方的代理方式还可以用这个
$caps = [
    WebDriverCapabilityType::BROWSER_NAME => 'chrome',
    WebDriverCapabilityType::PROXY => [
        'proxyType' => 'manual',
        'httpProxy' => '127.0.0.1:2043',
        'sslProxy' => '127.0.0.1:2043',
    ]
];

$caps->setCapability(ChromeOptions::CAPABILITY, $options);
$driver = RemoteWebDriver::create('http://127.0.0.1:4444/wd/hub', $caps, 5000);

//获得当前url
$driver->getCurrentURL();


//超时处理
$driver->manage()->timeouts()->pageLoadTimeout(1);
try {
$driver->get('slow_loading.html');
} catch (TimeOutException $e) {
//something
}




//命令参数
$driver->getCommandExecutor()

//前进与后退
$linkElement = $this->driver->findElement(WebDriverBy::id('a-form'));
$linkElement->click();
$driver->wait()->until(WebDriverExpectedCondition::urlContains('form.html'));
$driver->navigate()->back();
$driver->wait()->until(WebDriverExpectedCondition::urlContains('index.html'));
$driver->navigate()->forward();
$driver->wait()->until(WebDriverExpectedCondition::urlContains('form.html'));

//刷新
$driver->navigate()->refresh();


//获得会话ID
$driver->getSessionID();

//所有的会话
$driver->getAllSessions();

//获得源码
$driver->getPageSource();

//退出驱动
$driver->close();
$driver->quit();

//各种类型的筛选元素
//按Css选择器
WebDriverBy::cssSelector('h1.foo > small');

//按Xpath
WebDriverBy::xpath('(//hr)[1]/following-sibling::div[2]');

//按ID
WebDriverBy::id('heading');

//按className
WebDriverBy::className('warning');

//按input的name
WebDriverBy::name('email');

//按tagName比如h1,div,span
WebDriverBy::tagName('h1');

//按链接所在文本
WebDriverBy::linkText('Sign in here');

//按部分匹配链接所在文本
WebDriverBy::partialLinkText('Sign in');

//获取指定元素文本
$result = $driver->findElement(WebDriverBy::id('signin'))->getText();

//获取css的值
$elementWithBorder =$this->driver->findElement(WebDriverBy::id('text-simple')->getCSSValue('display')

//获得尺寸
$elementSize = $element->getSize();

//清空
$input->clear();
$textarea->clear();

//是否可输入
$input->isEnabled();


//获得坐标
$element->getLocation();
$elementLocation->getX();
$elementLocation->getY();

//获得元素数组
$elements = $driver->findElements(WebDriverBy::cssSelector('ul.foo > li'));
foreach ($elements as $element) {
    var_dump($element->getText());
}

//等待元素的出现,类同的还有visibilityOfElementLocated，visibilityOf，stalenessOf和elementToBeClickable
$element = $driver->wait()->until(
    WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div.bar'))
);
$elements = $driver->wait()->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(WebDriverBy::cssSelector('ul > li'))
);

//等待标题匹配
$driver->wait()->until( WebDriverExpectedCondition::titleIs('My Page'));
//按500ms的频率循环,最多等待10秒
$driver->wait(10, 500)->until(WebDriverExpectedCondition::titleIs('My Page'));

//等待标题
titleIs()
titleContains()
titleMatches()

//等待URL
urlIs()
urlContains()
urlMatches()

//等待元素文本或value
presenceOfElementLocated()
presenceOfAllElementsLocatedBy()
elementTextIs()
elementTextContains()
elementTextMatches()
textToBePresentInElementValue()

//等待元素或其可见性
visibilityOfElementLocated()
visibilityOf()//注意该方法前提是dom中已存在该元素,等待的是可见性,而不是元素本身.
invisibilityOfElementLocated()
invisibilityOfElementWithText()

//框架,alert,窗口
frameToBeAvailableAndSwitchToIt()
elementToBeClickable()
alertIsPresent()
numberOfWindowsToBe()

//还有这些
stalenessOf()
refreshed()
not()
elementToBeSelected()
elementSelectionStateToBe()

//还可以自定义,下文等待 li.foo 的数量超过5个.
$driver->wait()->until(
    function () use ($driver) {
        $elements = $driver->findElements(WebDriverBy::cssSelector('li.foo'));
        return count($elements) > 5;
    },
    '未定位到5个以上的li.foo'
);



//鼠标MouseOver在指定元素上
$element = $driver->findElement(WebDriverBy::id('some_id'));
$driver->getMouse()->mouseMove( $element->getCoordinates());

//单击元素（链接，复选框等）
$driver->findElement(WebDriverBy::id('signin'))->click();

//替换元素内容
$driver->findElement(WebDriverBy::id("element id"))->sendKeys("新文本");

//清空元素内容
$driver->findElement(WebDriverBy::id("element id"))->clear();

//如何检查元素是否可见
$element = $driver->findElement(WebDriverBy::id('element id'));
if ($element->isDisplayed()){
    // do something...
}

//页面重载
$driver->navigate()->refresh();

//等待alert弹出
$this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent(), 'I am expecting an alert!',);

//确定alert
$driver->switchTo()->alert()->accept(); 

//取消alert
$driver->switchTo()->alert()->dismiss();

//取得alert正文
$message =$driver->switchTo()->alert()->getText();

//回应alert,如(你的名字是?,此时回应test)
$driver->switchTo()->alert()->sendKeys('test'); 

//最大化浏览器
$driver->manage()->window()->maximize();

//执行js,全局加上window.
$sScriptResult = $driver->executeScript('return window.document.location.hostname',array());

//执行异步js
$driver->executeAsyncScript('return window.document.location.hostname',array());


//异步,5秒后无结果则取消,全局加上window.
$driver->timeouts()->async_script(array('ms'=>5000));

//从js中断并返回php
$sResult = $driver->executeAsyncScript('arguments[arguments.length-1]("done");', array());
if($sResult =='done'){
//do something;
}

//js定时轮询
$sJavascript = <<<END_JAVASCRIPT
var callback = arguments[arguments.length-1], //返回php驱动的callback
    nIntervalId; //setInterval的名称
//测试定时
function checkDone() {
  if( window.MY_STUFF_DONE ) {
    window.clearInterval(nIntervalId);//清除clearInterval
    callback("done"); //执行回调
  }
}
nIntervalId = window.setInterval( checkDone,50); //定时轮询
END_JAVASCRIPT;
$sResult = $driver->executeAsyncScript($sJavascript,array());

//取得当前窗口句柄(句柄为每个窗口的唯一ID)
$handle = $driver->getWindowHandle();

//取得所有窗口的句柄为数组
$handles = $driver->getWindowHandles();

//切换到指定句柄的窗口
$driver->switchTo()->window($handle);

//创建新标签页
$driver->getKeyboard()->sendKeys(array(WebDriverKeys::CONTROL, 't'));

//创建新窗口
$driver->getKeyboard()->sendKeys(array(WebDriverKeys::CONTROL, 'n'));

//按元素ID或内容查找iframe
$iframe = $driver->findElement(WebDriverBy::id('my_frame'));
$iframe = $driver->findElement(WebDriverBy::tagName('iframe'));

//获取iframe的属性
$frameId = $iframe->getAttribute('id');

//切至指定ID的iframe,这样就可以操作iframe中的内容了,比如点击之类
$driver->switchTo()->frame($frameId);

//切回主框架
$driver->switchTo()->defaultContent(); 

//切至focus元素,没有切至body
$active_element = $driver->switchTo()->activeElement();

//获取指定元素的属性值
$title = $driver->findElement(WebDriverBy::id('signin'))->getAttribute('title');

//获取input的值
$value  = $driver->findElement(WebDriverBy::id('username'))->getAttribute('value');

//整页截图
$driver->takeScreenshot('./00001.jpg');

//局部截图
$findElement=$driver->findElement(WebDriverBy::xpath("//img[@class='test']"));
$screenshot_of_element = $driver->TakeScreenshotByElement($findElement,'./1.jpg');

//日志
$caps->setCapability( 'loggingPrefs', ['browser' => 'ALL']);
$driver->manage()->getLog('driver');//driver,browser,server

//Cookie操作
//获取
$driver->manage()->getCookieNamed('CookieName');
$driver->manage()->getCookies();
//设置
$driver->manage()->addCookie(['CookieName'=>'CookieValue']);
//删除或清空
$driver->manage()->deleteCookieNamed('CookieName');
$driver->manage()->deleteAllCookies();



//等待ajax提交后的回调并筛选元素
$submitButton = $driver->findElement(WebDriverBy::id('Submit'));
$submitButton->click();
waitForAjax($driver,'jquery'); 
//waitForAjax($driver, 'prototype');
//waitForAjax($driver, 'dojo');
$anotherButton = $driver->findElement(WebDriverBy::id('secondButton'));
function waitForAjax($driver, $framework='jquery')
{
    //不同框架
    switch($framework){
        case 'jquery':
            $code = "return jQuery.active;"; break;
        case 'prototype':
            $code = "return Ajax.activeRequestCount;"; break;
        case 'dojo':
            $code = "return dojo.io.XMLHTTPTransport.inFlight.length;"; break;
        default:
            throw new Exception('Not supported framework');
    }

    do {
        sleep(2);
    } while ($driver->executeScript($code));
}
function waitForAjax($driver, $framework='jquery')
{
    //不同框架
    switch($framework){
        case 'jquery':
            $code = "return jQuery.active;"; break;
        case 'prototype':
            $code = "return Ajax.activeRequestCount;"; break;
        case 'dojo':
            $code = "return dojo.io.XMLHTTPTransport.inFlight.length;"; break;
        default:
            throw new Exception('Not supported framework');
    }

    //按2000ms的频率循环,最多等待30秒
    $driver->wait(30, 2000)->until(
        function ($driver, $code) {
            return !$driver->executeScript($code);
        }
    );
}

//示例:
<select name="language">
    <option value="cs">Czech</option>
    <option value="de">German</option>
    <option value="en_GB" selected>English (UK)</option>
    <option value="fr">French</option>
</select>

//找到<select>
$selectElement = $driver->findElement(WebDriverBy::name('language'));

//构造select
$select = new WebDriverSelect($selectElement);

//是否被选中
$select->isSelected();

//获得select的value
echo $select->getFirstSelectedOption()->getAttribute('value'); //"en_GB"
echo $select->getFirstSelectedOption()->getText(); //"English（UK）"

//获取所有<options>元素的数组
$options = $select->getOptions();

//获得所有已选中项组成的数组
$selectedOptions = $select->getAllSelectedOptions();

//各种方式选中
$select->selectByValue('fr');//按value
$select->selectByIndex(1); //按index
$select->selectByVisibleText('Czech');//按要选中Option的text内容
$select->selectByVisiblePartialText('UK'); //按要选中Option的text内容是否包含指定值'UK'

//还可以取消选中,比如全不选
$select->deselectAll();
$select->deselectByValue('...');
$select->deselectByIndex(0);
$select->deselectByVisibleText('...');
$select->deselectByVisiblePartialText('...');

//表单的提交
$formElement = $driver->findElement(WebDriverBy::cssSelector('form'));
$formElement->submit();







//示例:
<input type="file" id="file_input"></input>
//流程如下:

//设置一个临时副本
  $remote_image = __DIR__ . '/tmp/image-'.time().'.jpg';
  copy('http://www.site.com/image/photo.jpg', $remote_image);
  
//获取上传框
  $fileInput = $driver->findElement(WebDriverBy::id('file_input'));
  
//设置文件类型
  $fileInput->setFileDetector(new LocalFileDetector());
  
//上传并提交
$fileInput->sendKeys($remote_image)->submit();

//删除临时副本
unlink($remote_image);
```
