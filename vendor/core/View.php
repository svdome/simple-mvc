<?php

namespace core;

class View
{
    /**
     * @var string
     */
    public string $content ='';

    /**
     * @param $route
     * @param $layout
     * @param $view
     * @param $meta
     */
    public function __construct(
        public $route,
        public $layout ='',
        public $view='',
        public $meta = [],
    )
    {
        if(false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    /**
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function render($data)
    {
        if(is_array($data)) {
            extract($data);
        }

        $prefix=str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file=APP . "/view/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if(is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content= ob_get_clean();
        } else {
            throw new \Exception("не найден вид {$view_file}", 500);
        }

        if(false !== $this->layout) {
            $layout_file = APP . "/view/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("не найден шаблон {$layout_file}", 500);
            }
        }
    }

    /**
     * @return void
     */
    public function getMeta()
    {
        $out = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $out .= '<meta name="description ';
    }
}