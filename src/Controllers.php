<?php
namespace C\Welcome;

use C\Form\FormErrorHelper;
use C\ModernApp\File\Transforms;
use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
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
        $filter = new \RecursiveCallbackFilterIterator($Directory, function ($current) {
            if (in_array($current->getFilename(), ['..'])) {
                return false;
            }
            return $current;
        });
        $Iterator = new \RecursiveIteratorIterator($filter, \RecursiveIteratorIterator::SELF_FIRST);
        return $Iterator;
    }


    /**
     * Displays index page of Welcome module with the lists of
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


    /**
     * Given a block with a form attached to it,
     * this route
     * - renders the given file layout
     * - gets the concerned block
     * - extract the form object
     *
     * to submit the form and render its errors.
     *
     * @return callable
     */
    public function form() {
        return function (Application $app, Request $request, $formId, $block, $file) {
            $layout = Transforms::transform()
                ->setHelpers($app['modern.layout.helpers'])
                ->setStore($app['modern.layout.store'])
                ->setLayout($app['layout'])
                ->importFile("src/layouts/$file.yml")
                ->getLayout();

            /*  @var $form Form */
            $form = $layout->get("$block")->data["$formId"]->form;

            $form->handleRequest($request);

            // trigger validation anyway
            $form->isValid();

            $helper = new FormErrorHelper();
            return json_encode($helper->getFormErrors($form));
        };
    }


    /**
     * Given a block with a form attached to it,
     * this action pick the form and submit it.
     *
     * @return callable
     */
    public function form_playground() {
        return function (Application $app, Request $request, $formId, $block, $file) {
            $layout = Transforms::transform()
                ->setHelpers($app['modern.layout.helpers'])
                ->setStore($app['modern.layout.store'])
                ->setLayout($app['layout'])
                ->importFile("src/layouts/$file.yml")
                ->getLayout();

            /*  @var $form Form */
            $form = $layout->get("$block")->data["$formId"]->form;

            $form->handleRequest($request);


            if ($form->isValid()) {
                echo "Form is valid<br>";
            } else {
                echo "Form is NOT valid<br>";
            }

            $data = $form->getData();

            echo "Form data are <br/>";
            dump($data);
            echo "Post data are <br/>";
            dump($_POST);

            echo "Errors are <br/>";
            $errors = $form->getErrors(true);
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    dump($error);
                }
            } else {
                echo 'The author is valid';
            }

            echo "Cliked button is <br/>";
            if ($form->get('subscribe')->isClicked()) {
                echo "subscribe ";
            }

            if ($form->get('unsubscribe')->isClicked()) {
                echo "unsubscribe";
            }

            return "";
        };
    }
}
