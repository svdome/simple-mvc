<?php

namespace core;

use RedBeanPHP\R;

/**
 * Класс вида
 */
class View
{
    /**
     * Свойство для хранения буферизированного вида
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
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    /**
     * Метод для отрисовки страницы (шаблон + вид)
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Не найден вид {$view_file}", 500);
        }

        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Не найден шаблон {$layout_file}", 500);
            }
        }
    }

    /**
     * Метод для получения метаданных
     * @return string
     */
    public function getMeta()
    {
        $out = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="' . $this->meta['description'] . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $out;
    }

    /**
     * Отлавливает все запросы к базе на текущей странице
     * @return void
     */
    public function getDataBaseLog()
    {
        if (DEBUG) {
            $log = R::getDatabaseAdapter()
                ->getDatabase()
                ->getLogger();
            $logs = array_merge($log->grep('SELECT'), $log->grep('INSERT'), $log->grep('UPDATE'), $log->grep('DELETE'));
            debug($logs);
        }
    }

    /**
     * Подключает фаил с частью вёрстки
     * @param $file - путь до файла
     * @param $data - данные для передачи в файл с вёрсткой
     * @return void
     */
    public function getPart($file, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        $file = APP . "/views/{$file}.php";
        if (is_file($file)) {
            require $file;
        } else {
            echo "File {$file} not found...";
        }
    }
}
