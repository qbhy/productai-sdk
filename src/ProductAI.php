<?php

namespace Qbhy\ProductAI;

use ProductAI\API;
use BadMethodCallException;

/**
 * Class ProductAI
 * @package Qbhy\ProductAI
 *
 * @method mixed searchImage($service_type, $service_id, $image, $loc = [], $tags = [], $count = 20, $skip_dedupe = False, $threshold = 0.0)
 * @method mixed classifyImage($service_type, $service_id, $image, $loc = [])
 * @method mixed detectImage($service_type, $service_id, $image, $loc = [])
 * @method mixed addImagesToSet($set_id, $images)
 * @method mixed addImageToSet($set_id, $image_url, $meta = '', $tags = [])
 * @method mixed removeImagesFromSet($set_id, $images)
 * @method mixed imageColorAnalysis($image, $type, $granularity, $return_type, $loc = [])
 * @method mixed generalRequest($service_type, $service_id, $image = null, $args = [])
 */
class ProductAI
{
    /**
     * @var API
     */
    private $api;

    /**
     * @var array
     */
    private $config;

    public function __construct($config)
    {
        $this->api = new API($config['access_key_id'], $config['secret_key']);
        $this->config = $config;
    }

    public function __call($name, $args)
    {
        if (method_exists($this->api, $name)) {
            return call_user_func_array([$this->api, $name], $args);
        } else {
            throw new BadMethodCallException('Call to undefined method ' . get_class($this) . "::{$name}()", 1);
        }
    }

    /**
     * 搜索图片
     * @param $image
     * @param array $loc
     * @param array $tags
     * @param int $count
     * @param bool $skip_dedupe
     * @param float $threshold
     * @return mixed
     */
    public function search($image, $loc = [], $tags = [], $count = 20, $skip_dedupe = false, $threshold = 0.0)
    {
        return $this->searchImage('search', $this->config['server_id'], $image, $loc, $tags, $count, $skip_dedupe, $threshold);
    }

    /**
     * 批量添加图片
     * @param $images
     * @return mixed
     */
    public function addImages($images)
    {
        return $this->addImagesToSet($this->config['image_set_id'], $images);
    }

    /**
     * 添加图片
     * @param $image_url
     * @param string $meta
     * @param array $tags
     * @return mixed
     */
    public function addImage($image_url, $meta = '', $tags = [])
    {
        return $this->addImageToSet($this->config['image_set_id'], $image_url, $meta, $tags);
    }

    /**
     * 批量删除图片
     * @param $images
     * @return mixed
     */
    public function removeImages($images)
    {
        return $this->removeImagesFromSet($this->config['image_set_id'], $images);
    }


}