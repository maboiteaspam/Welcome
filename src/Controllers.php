<?php
namespace C\Welcome;

use C\ModernApp\File\Transforms;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Controllers {


    /**
     * Recursive iteration of a directory.
     *
     * @param $basePath
     * @return \RecursiveIteratorIterator
     */
    protected function recursiveReadPath ($basePath) {
        $Directory = new \RecursiveDirectoryIterator($basePath);
        $filter = new \RecursiveCallbackFilterIterator($Directory, function ($current, $key, $iterator) {
            if (in_array($current->getFilename(), ['..'])) {
                return false;
            }
            return $current;
        });
        $Iterator = new \RecursiveIteratorIterator($filter, \RecursiveIteratorIterator::SELF_FIRST);
        return $Iterator;
    }


    /**
     * Displays index page of welcome module with the lists of
     * layouts found into src/layouts.
     *
     * @return callable
     */
    public function index() {
        return function (Application $app, Request $request) {

            $layoutDirectory = realpath("src/layouts");
            $layouts = [];
            $errors = [];

            if ($layoutDirectory===false) {
                $errors[] = "Layout directory '$layoutDirectory' is missing";
            } else {
                $Iterator = $this->recursiveReadPath($layoutDirectory);
                foreach ($Iterator as $item) {
                    if ($item->getExtension()==='yml') {
                        $layouts[] = substr($item->getRealPath(), strlen($layoutDirectory));
                    }
                }
            }


            Transforms::transform()
                ->setHelpers($app['modern.layout.helpers'])
                ->setStore($app['modern.layout.store'])
                ->setLayout($app['layout'])
                ->importFile('Welcome:/index.yml')
                ->updateData("body_content", [
                    'errors'=>$errors,
                    'layouts'=>$layouts,
                ]);
            return $app['layout.responder']->respond($app['layout'], $request);
        };
    }


    /**
     * Renders provided layout file in url.
     *
     * @return callable
     */
    public function yml() {
        return function (Application $app, Request $request, $file) {
            Transforms::transform()
                ->setHelpers($app['modern.layout.helpers'])
                ->setStore($app['modern.layout.store'])
                ->setLayout($app['layout'])
                ->importFile("src/layouts/$file.yml");
            return $app['layout.responder']->respond($app['layout'], $request);
        };
    }
}