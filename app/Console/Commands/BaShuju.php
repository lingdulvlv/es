<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;//并发请求:使用Promise和异步请求来同时发送多个请求
use GuzzleHttp\Pool;//发送不确定数量的请求
use Psr\Http\Message\RequestInterface;//
use Sunra\PhpSimple\HtmlDomParser;

class BaShuju extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ba:shuju';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pachongwenjian';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $html = HtmlDomParser::str_get_html("<div>foo <b>bar</b></div>"); 
        $html->set_callback('my_callback');
        print_R($html);
        exit;
        // echo $e."\n";exit;


        $client = new Client();
        $promise = $client->requestAsync('GET', 'http://www.royole.com/cn/media-coverage');

        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
                $res =  $res->getBody()->getContents();

                $dom = HtmlDomParser::str_get_html( $res );

                $list = $dom->find('div.dynamics li');
                foreach ($list as $k => $e) {
                    try {
                        $this->line(111);
                        $this->line(trim($e->find('a',0)->href));
                        // $this->line($e->plaintext);
                        // $this->line(trim($e->find('div.col-sm-8 div.text a',0)->plaintext));
                        // $this->line(trim($e->find('div.col-sm-8 div.text a',0)->href));
                        // $this->line($k);
                    }catch(\Exception $e) {
                        $this->line(222);
                    }
                }
                $this->line(gettype($res));
                $this->line('----------');
                $this->line('-----结束-----');
            },
            function (RequestException $e) {
                // echo $e->getMessage() . "\n";
                echo $e->getResponse()->getStatusCode() . "\n";
                // echo $e->getRequest()->getMethod();
            }
        );
        $promise->wait();


        // $promise = $client->requestAsync('GET', 'http://www.fiber-laser.cn/article.html');
        // $promise->then(
        //     function (ResponseInterface $res) {
        //         echo $res->getStatusCode() . "\n";
        //         $res =  $res->getBody()->getContents();

        //         $dom = HtmlDomParser::str_get_html( $res );

        //         $list = $dom->find('div.module section.news_list div.row');
        //         foreach ($list as $k => $e) {
        //             try {
        //                 // $this->line($e->plaintext);
        //                 $a = trim($e->find('div.col-sm-8 div.text a',0)->plaintext);
        //                 echo '1111'.$a."22222\n";
        //                 $this->line(trim($e->find('div.col-sm-8 div.text a',0)->href));
        //                 $this->line($k);
        //             }catch(\Exception $e) {

        //             }
        //         }
        //         $this->line(gettype($res));
        //         $this->line('----------');
        //         $this->line('-----结束-----');
        //     },
        //     function (RequestException $e) {
        //         //echo $e->getMessage() . "\n";
        //         echo $e->getResponse()->getStatusCode() . "\n";
        //         //echo $e->getRequest()->getMethod();
        //     }
        // );
        // $promise->wait();



        // $promise = $client->requestAsync('GET', 'http://www.sunic.com.cn/news/ynNews');
        // $promise->then(
        //     function (ResponseInterface $res) {
        //         echo $res->getStatusCode() . "\n";
        //         $res =  $res->getBody()->getContents();

        //         $dom = HtmlDomParser::str_get_html( $res );

        //         $list = $dom->find('div.news_ny li');
        //         foreach ($list as $k => $e) {
        //             try {
        //                 $this->line(trim($e->find('p a',0)->plaintext));
        //                 $this->line(trim($e->find('p a',0)->href));
        //                 $this->line(trim($e->find('em',0)->plaintext));
        //                 $this->line($k);
        //             }catch(\Exception $e) {

        //             }
        //         }
        //         $this->line(gettype($res));
        //         $this->line('----------');
        //         $this->line('-----结束-----');
        //     },
        //     function (RequestException $e) {
        //         //echo $e->getMessage() . "\n";
        //         echo $e->getResponse()->getStatusCode() . "\n";
        //         //echo $e->getRequest()->getMethod();
        //     }
        // );
        // $promise->wait();
        exit;








        // allow_redirects：描述请求的重定向行为
        // auth：传入HTTP认证参数的数组来使用请求，该数组索引[0]为用户名、索引[1]为密码，索引[2]为可选的内置认证类型。传入 null 进入请求认证。
        // body：用来控制一个请求(比如：PUT, POST, PATCH)的主体部分
        //     Psr\Http\Message\StreamInterface
        // cert：设置成指定PEM格式认证文件的路径的字符串，如果需要密码，需要设置成一个数组，其中PEM文件在第一个元素，密码在第二个元素
        // cookies：声明是否在请求中使用cookie，或者要使用的cookie jar，或者要发送的cookie
        //     GuzzleHttp\Cookie\CookieJarInterface
        // connect_timeout：表示等待服务器响应超时的最大值，使用 0 将无限等待 (默认行为)
        // debug：设置成 true 或设置成一个 fopen() 返回的流来启用调试输出发送请求的处理器
        // decode_content：声明是否自动解码 Content-Encoding 响应 (gzip, deflate等) 
        // delay：发送请求前延迟的毫秒数值
        // expect：控制"Expect: 100-Continue"报文头的行为
        // form_params：用来发送一个 application/x-www-form-urlencoded POST请求
        // headers：要添加到请求的报文头的关联数组，每个键名是header的名称，每个键值是一个字符串或包含代表头字段字符串的数组
        // http_errors：设置成 false 来禁用HTTP协议抛出的异常(如 4xx 和 5xx 响应)，默认情况下HTPP协议出错时会抛出异常
        // json：json 选项用来轻松将JSON数据当成主体上传， 如果没有设置Content-Type头信息的时候会设置成 application/json
        // multipart：设置请求的主体为 multipart/form-data 表单
        // on_headers：回调函数，当响应的HTTP头信息被接收且主体部分还未开始下载的时候调用
        // on_stats： 允许你获取请求传输数据统计以及处理器在底层传输的详情. on_stats 是个回调，当处理器完成传输一个请求的时候被调用。 该回调被调用请求传输数据统计、接收到响应，或遇到错误，包含发送请求数据时间的总量
        // proxy：传入字符串来指定HTTP代理，或者为不同代理指定不同协议的数组
        // query：要添加到请求的查询字符串的关联数组或查询字符串
        // sink：声明响应的主体部分将要保存的位置
        // ssl_key：指定一个链接到私有SSL密钥的PEM格式的文件的路径的字符串。 如果需要密码，设置成一个数组，数组第一个元素为链接到私有SSL密钥的PEM格式的文件的路径，第二个元素为认证密码
        // stream：设置成 true 流响应，而非下载响应
        // synchronous：设置成 true 来通知HTTP处理器你要等待响应，这有利于优化
        // verify：请求时验证SSL证书行为。设置成 true 启用SSL证书验证，默认使用操作系统提供的CA包。设置成 false 禁用证书验证(这是不安全的！)。设置成字符串启用验证，并使用该字符串作为自定义证书CA包的路径
        // timeout：请求超时的秒数。使用 0 无限期的等待(默认行为)
        // version：请求要使用到的协议版本





        // $client = new Client();
        $client = new Client(['base_uri' => 'http://httpbin.org']);

        $client->request('GET', 'http://httpbin.org/stream/1024', [
            'on_headers' => function (ResponseInterface $response) {
                if ($response->getHeaderLine('Content-Length') > 1024) {
                    throw new \Exception('The file is too big!');
                }
            }
        ]);
        exit;


        try {
            $client->request('GET', '/get', ['debug' => true]);exit;
            $onRedirect = function(
                RequestInterface $request,
                ResponseInterface $response,
                UriInterface $uri
            ) {
                echo 'Redirecting! ' . $request->getUri() . ' to ' . $uri . "\n";
            };

            $res = $client->request('GET', '/redirect/3', [
                'allow_redirects' => [
                    'max'             => 10,        // allow at most 10 redirects.
                    'strict'          => true,      // use "strict" RFC compliant redirects.
                    'referer'         => true,      // add a Referer header
                    'protocols'       => ['https'], // only allow https URLs
                    'on_redirect'     => $onRedirect,
                    'track_redirects' => true
                ]
            ]);

            echo $res->getStatusCode();
            // 200

            echo $res->getHeaderLine('X-Guzzle-Redirect-History');
        } catch (RequestException $e) {
            print_R($e->getRequest());
            if ($e->hasResponse()) {
                print_R( $e->getResponse());
            }
        }



    }
}
