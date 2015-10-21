<?php
namespace C\Welcome;

use C\ModernApp\File\Helpers\FormViewHelper;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class ControllersProvider implements
    ServiceProviderInterface,
    ControllerProviderInterface
{
    /**
     * Register services.
     *
     * @param Application $app
     **/
    public function register(Application $app)
    {
        $app['welcome.controllers'] = $app->share(function() use ($app) {
            $controllers = new Controllers();
            return $controllers;
        });

        // Configure FormViewHelper to set a default submit method
        // on the forms created via layout files.
        // The targeted controller should take care of submitting the form.
        if (isset($app['modern.layout.helpers'])) {
            $app['modern.layout.helpers'] = $app->extend("modern.layout.helpers", function($helpers) {
                $formViewHelper = $helpers->find("FormView");
                /* @var $formViewHelper FormViewHelper */
                $formViewHelper->setSubmitRoute("yml_file_post"); // forms will be submitted to that controllers
                return $helpers;
            });
            $app->before(function (Request $r) use($app) {
                // file parameter must be re injected in the helper
                // to generate the url.
                $file = $r->attributes->get("file");
                if ($file) {
                    $formViewHelper = $app['modern.layout.helpers']->find("FormView");
                    /* @var $formViewHelper FormViewHelper */
                    $formViewHelper->setRouteParameters(["file"=>"$file"]);
                }
            });
        }
    }

    /**
     * Boot and configure services.
     *
     * @param Application $app Silex application instance.
     * @return void
     **/
    public function boot(Application $app)
    {
        if (isset($app['assets.fs'])) {
            $app['assets.fs']->register(__DIR__.'/assets/', 'Welcome');
        }
        if (isset($app['layout.fs'])) {
            $app['layout.fs']->register(__DIR__.'/templates/', 'Welcome');
        }
        if (isset($app['intl.fs'])) {
            $app['intl.fs']->register(__DIR__.'/intl/', 'Welcome');
        }
        if (isset($app['modern.fs'])) {
            $app['modern.fs']->register(__DIR__.'/layouts/', 'Welcome');
        }
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        // Index controller will list the available layouts.
        $controllers->get( '/',
            $app['welcome.controllers']->index()
        )->bind ('home');

        // This controller will render a layout file
        $controllers->get( '/{file}.yml',
            $app['welcome.controllers']->yml()
        )->assert("file", ".+"
        )->bind ('yml_file');

        // This controller will pick a form from a block and submit it.
        $controllers->post( '/submit/{formId}/{block}/{file}.yml',
            $app['welcome.controllers']->form()
        )->bind ('yml_file_post');

        return $controllers;
    }
}
