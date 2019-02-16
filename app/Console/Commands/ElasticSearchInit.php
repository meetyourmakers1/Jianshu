<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ElasticSearchInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init laravel ES for Post["初始化laravel中Post的ES搜索引擎"]';

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
        //创建ES的template
        $client =new Client();
        $url = config('scout.elasticsearch.hosts')[0].'/_template/tmp';
        $client->delete($url);
        $params = [
            'json' => [
                'template' => config('scout.elasticsearch.index'),
                'mappings' => [
                    '_default_' => [
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url,$params);
        $this->info('------创建模板完成------');

        //创建ES的index
        $url = config('scout.elasticsearch.hosts')[0].'/'.config('scout.elasticsearch.index');
        $client->delete($url);
        $params = [
            'json' => [
                'settings' => [
                    'refresh_interval' => '1s',
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url,$params);
        $this->info('------创建索引完成------');
    }
}
