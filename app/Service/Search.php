<?php namespace App\Service;

use Elasticsearch\ClientBuilder;

class Search{
	public function __construct()
    {
        $this->client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(config('elasticsearch.hosts'))
            ->build();
    }

    /**
     * 新建索引
     * @param $param
     * @return array
     */
    public function newIndex($param)
    {
        if (env('APP_ENV') != 'local') {
            return $this->client->indices()->create($param);
        }

    }

    /**
     * 删除一个索引
     * @param $param
     * @return array
     */
    public function deleteIndex($param)
    {
        if (env('APP_ENV') != 'local') {
            return $this->client->indices()->delete($param);
        }
    }

    /**
     * 检查文档是否存在
     */
    public function isExists($param)
    {
        return $this->client->exists($param);
    }

    /**
     * 更新一个文档
     * @param $param
     */
    public function update($param)
    {
        if (env('APP_ENV') != 'local') {
            return $this->client->update($param);
        }
    }

    /**
     * 添加一个文档
     * @param $param
     * @return array
     */
    public function create($param) {
        //if (env('APP_ENV') != 'local') {
            return $this->client->index($param);
        //}

    }

    /**搜索文档
     * @param $param
     */
    public function search($param) {
        return $this->client->search($param);
    }

    /**
     * 删除一个文档
     * @param $param
     * @return array
     */
    public function deleteDocument($param) {
        if (env('APP_ENV') != 'local') {
            return $this->client->delete($param);
        }

    }







    
}


