<?php

namespace core;

/**
 *класс вида
 */
class View
{
    /**
     * свойство хранения буферизованного вида
     * @var string
     */
    public string $content = '';

    /**
     * @param $route
     * @param $layout
     * @param $view
     * @param $meta
     */
    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    )
    {
        if(false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    /**
     * метод непосредственной отрисовки нашей страницы (шаблон + вид)
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function render($data): void
    {
        if(is_array($data)) {
            extract($data);
        }
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if(is_file($view_file)) {
            ob_start(); //буферизация
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Не найден вид {$view_file}", 500);
        }

        if(false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Не найден шаблон {$layout_file}", 500);
            }
        }
    }

    /**
     * метод для получения метаданных
     * @return void
     */
    public function getMeta()
    {
        $out = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="' . $this->meta['description'] . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $out;
    }
}