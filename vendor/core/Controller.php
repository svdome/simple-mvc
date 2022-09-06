<?php

namespace core;

/**
 * базовый сласс контроллера
 */
abstract class Controller
{
    /**
     * массив с данными для передачи в вид
     * @var array
     */
    public array $data = [];

    /**
     * массив с метаданными страницы
     * @var array
     */
    public array $meta = [];
    /**
     * название шаблона страницы
     * @var false|string
     */
    public false|string $layout = '';
    /**
     * название вида
     * @var string
     */
    public string $view = '';
    /**
     * объект модели для текущего контроллера
     * @var object
     */
    public object $model;


    /**
     * конструктор
     * @param $route - текущий маршрут, прокидываем из Router
     */
    public function __construct(public $route= [])
    {

    }

    /**
     * метод получения объекта нашей модели
     * @return void
     */
    public function getModel()
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    /**
     * метод получения нашего вида
     * @return void
     */
    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    /**
     * сеттер для данных
     * @param $data
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * сеттер для метаданных
     * @param $title
     * @param $description
     * @param $keywords
     * @return void
     */
    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta = [
            'title'=>$title,
            'description'=>$description,
            'keywords'=>$keywords
        ];
    }
}