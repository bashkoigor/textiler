<?php

use Backend\Classes\AuthManager;
use System\Classes\UpdateManager;
use System\Classes\PluginManager;
use System\Classes\VersionManager;
use October\Rain\Database\Model as ActiveRecord;
use October\Tests\Concerns\InteractsWithAuthentication;

abstract class PluginTestCase extends TestCase
{
    use InteractsWithAuthentication;

    /**
     * @var array Cache for storing which plugins have been loaded
     * and refreshed.
     */
    protected $pluginTestCaseLoadedPlugins = [];

    /**
     * Creates the application.
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../../bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $app->singleton('auth', function ($app) {
            $app['auth.loaded'] = true;

            return AuthManager::instance();
        });

        return $app;
    }

    /**
     * Perform test case set up.
     * @return void
     */
    public function setUp(): void
    {
        /*
         * Force reload of October singletons
         */
        PluginManager::forgetInstance();
        UpdateManager::forgetInstance();
        VersionManager::forgetInstance();

        /*
         * Create application instance
         */
        parent::setUp();

        /*
         * Ensure system is up to date
         */
        $this->runOctoberMigrateCommand();

        /*
         * Detect plugin from test and autoload it
         */
        $this->pluginTestCaseLoadedPlugins = [];
        $pluginCode = $this->guessPluginCodeFromTest();

        if ($pluginCode !== false) {
            $this->runPluginRefreshCommand($pluginCode, false);
        }

        /*
         * Disable mailer
         */
        Mail::pretend();
    }

    /**
     * Flush event listeners and collect garbage.
     * @return void
     */
    public function tearDown(): void
    {
        $this->flushModelEventListeners();
        parent::tearDown();
        unset($this->app);
    }

    /**
     * runOctoberMigrateCommand migrates database (modules only)
     */
    protected function runOctoberMigrateCommand()
    {
        PluginManager::instance()->unloadPlugins();
        UpdateManager::instance()->update();
        PluginManager::instance()->loadPlugins();
    }

    /**
     * Since the test environment has loaded all the test plugins
     * natively, this method will ensure the desired plugin is
     * loaded in the system before proceeding to migrate it.
     * @return void
     */
    protected function runPluginRefreshCommand($code, $throwException = true)
    {
        if (!preg_match('/^[\w+]*\.[\w+]*$/', $code)) {
            if (!$throwException) {
                return;
            }
            throw new Exception(sprintf('Invalid plugin code: "%s"', $code));
        }

        $manager = PluginManager::instance();
        $plugin = $manager->findByIdentifier($code);

        /*
         * First time seeing this plugin, load it up
         */
        if (!$plugin) {
            $namespace = '\\'.str_replace('.', '\\', strtolower($code));
            $path = array_get($manager->getPluginNamespaces(), $namespace);

            if (!$path) {
                if (!$throwException) {
                    return;
                }
                throw new Exception(sprintf('Unable to find plugin with code: "%s"', $code));
            }

            $plugin = $manager->loadPlugin($namespace, $path);
        }

        /*
         * Spin over dependencies and refresh them too
         */
        $this->pluginTestCaseLoadedPlugins[$code] = $plugin;

        if (!empty($plugin->require)) {
            foreach ((array) $plugin->require as $dependency) {
                if (isset($this->pluginTestCaseLoadedPlugins[$dependency])) {
                    continue;
                }

                $this->runPluginRefreshCommand($dependency);
            }
        }

        /*
         * Execute the command
         */
        $manager = UpdateManager::instance();
        $manager->rollbackPlugin($code);
        $manager->updatePlugin($code);
    }

    /**
     * Returns a plugin object from its code, useful for registering events, etc.
     * @return PluginBase
     */
    protected function getPluginObject($code = null)
    {
        if ($code === null) {
            $code = $this->guessPluginCodeFromTest();
        }

        return $this->pluginTestCaseLoadedPlugins[$code] ?? null;
    }

    /**
     * The models in October use a static property to store their events, these
     * will need to be targeted and reset ready for a new test cycle.
     * Pivot models are an exception since they are internally managed.
     * @return void
     */
    protected function flushModelEventListeners()
    {
        foreach (get_declared_classes() as $class) {
            if ($class == \October\Rain\Database\Pivot::class) {
                continue;
            }

            $reflectClass = new ReflectionClass($class);
            if (
                !$reflectClass->isInstantiable() ||
                !$reflectClass->isSubclassOf(\October\Rain\Database\Model::class) ||
                $reflectClass->isSubclassOf(\October\Rain\Database\Pivot::class)
            ) {
                continue;
            }

            $class::flushEventListeners();
        }

        ActiveRecord::flushEventListeners();
    }

    /**
     * Locates the plugin code based on the test file location.
     * @return string|bool
     */
    protected function guessPluginCodeFromTest()
    {
        $reflect = new ReflectionClass($this);
        $path = $reflect->getFilename();
        $basePath = $this->app->pluginsPath();

        $result = false;

        if (strpos($path, $basePath) === 0) {
            $result = ltrim(str_replace('\\', '/', substr($path, strlen($basePath))), '/');
            $result = implode('.', array_slice(explode('/', $result), 0, 2));
        }

        return $result;
    }
}
