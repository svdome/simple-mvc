<?php

namespace core;

abstract class Controller
{
    /**
     * @var array
     */
    public array $data=[];

    /**
     * @var array
     */
    public array $meta=[];
    /**
     * @var false|string
     */
    public false|string $layout ='';
    /**
     * @var string
     */
    public string $view ='';
    /**
     * @var object
     */
    public object $model;
    //public $route =[];

    /**
     * @param $route
     */
    public function __construct(public $route =[])
    {

    }

    /**
     * @return void
     */
    public function getModel()
    {
        $model = 'app\model\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    /**
     * @return void
     */
    public function getView()
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this-> meta))->render($this->data);
    }

    /**
     * @param $data
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param $title
     * @param $description
     * @param $keywords
     * @return void
     */
    public function setMeta($title='', $description='', $keywords='')
    {
        $this->mets=[
          'title'=>$title,
          'description'=>$description,
          'keywords'=>$keywords,

        ];
    }
}