<?php

namespace core;

/**
 * Базовый класс контроллера
 */
abstract class Controller
{
    /**
     * Массив с данными для передачи в вид
     * @var array
     */
    public array $data = [];

    /**
     * Массив с метаданными страницы
     * @var array
     */
    public array $meta = [];

    /**
     * Название шаблона страницы
     * @var false|string
     */
    public false|string $layout = '';

    /**
     * Название вида
     * @var string
     */
    public string $view = '';

    /**
     * Объект модели для текущего контрллера
     * @var object
     */
    public object $model;

    /**
     *
     * @param $route - текущий маршрут, прокидываем из Router
     */
    public function __construct(public $route = [])
    {

    }

    /**
     * Метод для получения объекта модели
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
     * Метод для получения вида
     * @return void
     */
    public function getView()
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    /**
     * Сеттер для данных
     * @param $data
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Сеттер для метаданных страницы
     * @param $title
     * @param $description
     * @param $keywords
     * @return void
     */
    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords
        ];
    }
}