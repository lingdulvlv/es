<?php namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Sunra\PhpSimple\HtmlDomParser;

use Illuminate\Console\Command;

class BaController extends Command
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        echo 111;exit;
        //
        //
        
    }

}
