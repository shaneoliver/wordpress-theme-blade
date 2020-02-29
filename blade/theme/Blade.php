<?php

namespace ShaneOliver;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Blade {

    /**
     * Our single factory instance.
     * 
     * @var Blade
     */
    private static $instance;

    /**
     * The factory that does all the heavy lifting
     * 
     * @var Factory
     */
    private $viewFactory;

    /**
     * The global data to merge into every view
     * 
     * @var array
     */
    private $mergeData = [];

    private function __construct()
    {
        // Configuration
        // Note that you can set several directories where your templates are located
        $pathsToTemplates = [get_template_directory() . '/resources/views', get_template_directory() . '/views'];
        $upload_dir = wp_upload_dir()['basedir'];
        $pathToCompiledTemplates = $upload_dir . '/shaneoliver/blade';

        // Dependencies
        $filesystem = new Filesystem;
        $eventDispatcher = new Dispatcher(new Container);

        // Create compiled templates directory
        if(! $filesystem->exists($pathToCompiledTemplates)) {
            $filesystem->makeDirectory($pathToCompiledTemplates, 0755, true);
        }

        // Create View Factory capable of rendering PHP and Blade templates
        $viewResolver = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);

        $viewResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $viewResolver->register('php', function () {
            return new PhpEngine;
        });

        $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
        $this->viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);
    }

    public static function view($template, $data)
    {
        $instance = static::getInstance();
        return $instance->viewFactory->make($template, $data, $instance->mergeData);
    }

    public static function setContext($key, $value)
    {
        $instance = static::getInstance();

        $instance->mergeData[$key] = $value;
    }

    public static function getContext()
    {
        $instance = static::getInstance();

        return $instance->mergeData;
    }

    public static function getInstance()
    {
        if(is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }
}