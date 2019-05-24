<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Service\Search;
class Es extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:shuju';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '开始学习elasticsearch';

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
        //
        $index = 'pachong';
        $type = 'pachong';
        $analysis['analyzer']['ik_pinyin_analyzer'] = array(
            'type' => 'custom',
            'tokenizer' => 'ik_smart',
            'filter' => array('my_pinyin')
        );
        $analysis['filter']['my_pinyin'] = array(
            'type' => 'pinyin',
            'keep_first_letter'=>true,
            'keep_separate_first_letter' => false,
            'keep_full_pinyin' =>true,
            'keep_original' => true,
            'limit_first_letter_length'=>16,
            'lowercase' => true,
        );
        $params['index'] = $index;
        $params['body']['settings']['number_of_shards'] = 1;
        $params['body']['settings']['number_of_replicas'] = 1;
        $params['body']['settings']['analysis'] = $analysis;
        $params['body']['mappings'][$type]['properties'] = array(

            'id'=>array('type' => 'integer'),

            'name' => array(
                'type' => 'keyword',
            ),
            'name_for_search' => array(
                'type' => 'string',
                'analyzer' => 'ik_smart',
                'fields'=> [
                    'pinyin' => [
                        'type' => 'string',
                        'analyzer'=>'ik_pinyin_analyzer'
                    ],
                    'origin' => [
                        'ignore_above'=>256,
                        'type'=> 'keyword'
                    ]
                ]
            ),
            'sex'=>array( //性别
                'type' => 'integer',
            ),
            'age'=>array( //年龄
                'type' => 'integer',
            ),
        );
        $search = new Search();
        $response = $search->newIndex($params);
        print_r($params);
        return true;
    }
}
