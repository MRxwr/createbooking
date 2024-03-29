<?php
/**
 * @package    tadcms/tadcms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://github.com/tadcms/tadcms
 * @license    MIT
 *
 * SBhadra0.
 * Date: 5/1/2021
 * Time: 4:31 PM
 */

namespace Juzaweb\Support;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\ProviderRepository;
use Illuminate\Support\Str;
use Juzaweb\Abstracts\Plugin as BasePlugin;

class Module extends BasePlugin
{
    /**
     * {@inheritdoc}
     */
    public function getCachedServicesPath(): string
    {
        return Str::replaceLast('services.php', $this->getSnakeName() . '_module.php', $this->app->getCachedServicesPath());
    }

    /**
     * {@inheritdoc}
     */
    public function registerProviders(): void
    {
        try {
            (new ProviderRepository($this->app, new Filesystem(), $this->getCachedServicesPath()))
                ->load($this->getExtraLarevel('providers'));
        } catch (\Throwable $e) {
            add_backend_message('plugin_errors', $e->getMessage());
            $this->disable();
        }

    }

    /**
     * {@inheritdoc}
     */
    public function registerAliases(): void
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->getExtraLarevel('aliases') as $aliasName => $aliasClass) {
            $loader->alias($aliasName, $aliasClass);
        }
    }
}
