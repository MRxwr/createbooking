<?php return array (
  'app' => 
  array (
    'name' => 'Juzaweb',
    'env' => 'production',
    'debug' => true,
    'url' => 'https://booking.createkwservers.com/',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'ar',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:aM5V2rwn5vvVCB9LZOfCw/WfXCtxd8xhqIF+huJEuAg=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Juzaweb\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'juzaweb_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'create_booking',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'create_booking',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => 'cp_',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'create_booking',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => 'cp_',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'create_booking',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => 'cp_',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'juzaweb_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/u671249433/domains/createkwservers.com/public_html/app/public',
        'url' => '/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
        'endpoint' => NULL,
      ),
      'tmp' => 
      array (
        'driver' => 'local',
        'root' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/app/tmps',
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'ide-helper' => 
  array (
    'filename' => '_ide_helper',
    'format' => 'php',
    'meta_filename' => '.phpstorm.meta.php',
    'include_fluent' => false,
    'include_factory_builders' => false,
    'write_model_magic_where' => true,
    'write_eloquent_model_mixins' => false,
    'include_helpers' => false,
    'helper_files' => 
    array (
      0 => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ),
    'model_locations' => 
    array (
      0 => 'app',
      1 => 'packages',
      2 => 'plugins',
    ),
    'ignored_models' => 
    array (
    ),
    'extra' => 
    array (
      'Eloquent' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'Illuminate\\Database\\Query\\Builder',
      ),
      'Session' => 
      array (
        0 => 'Illuminate\\Session\\Store',
      ),
    ),
    'magic' => 
    array (
    ),
    'interfaces' => 
    array (
    ),
    'custom_db_types' => 
    array (
    ),
    'model_camel_case_properties' => false,
    'type_overrides' => 
    array (
      'integer' => 'int',
      'boolean' => 'bool',
    ),
    'include_class_docblocks' => false,
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBookingstorage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => '',
      'name' => '',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => NULL,
        'secret' => NULL,
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'juzaweb_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'translatable' => 
  array (
    'fallback_locale' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/resourcesviews',
    ),
    'compiled' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/framework/views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => true,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'installer' => 
  array (
    'core' => 
    array (
      'minPhpVersion' => '7.2.5',
    ),
    'final' => 
    array (
      'key' => true,
      'publish' => false,
    ),
    'requirements' => 
    array (
      'php' => 
      array (
        0 => 'openssl',
        1 => 'pdo',
        2 => 'mbstring',
        3 => 'tokenizer',
        4 => 'JSON',
        5 => 'cURL',
        6 => 'fileinfo',
      ),
      'apache' => 
      array (
        0 => 'mod_rewrite',
      ),
    ),
    'permissions' => 
    array (
      'storage/' => '775',
      'bootstrap/cache/' => '775',
      'resources/' => '775',
      'public/' => '775',
      'plugins/' => '775',
      'themes/' => '775',
      'vendor/' => '775',
    ),
    'environment' => 
    array (
      'form' => 
      array (
        'rules' => 
        array (
          'database_hostname' => 'required|string|max:150',
          'database_port' => 'required|numeric',
          'database_name' => 'required|string|max:150',
          'database_username' => 'required|string|max:150',
          'database_password' => 'nullable|string|max:150',
        ),
      ),
    ),
  ),
  'juzaweb' => 
  array (
    'admin_prefix' => 'admin',
    'api_route' => false,
    'logs_viewer' => true,
    'email' => 
    array (
      'method' => 'sync',
    ),
    'theme' => 
    array (
      'enable_upload' => true,
      'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/themes',
    ),
    'plugin' => 
    array (
      'enable_upload' => true,
      'path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/plugins',
      'assets' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/public_html/plugins',
    ),
    'performance' => 
    array (
      'minify_views' => true,
      'deny_iframe' => true,
    ),
    'filemanager' => 
    array (
      'disk' => 'public',
      'types' => 
      array (
        'file' => 
        array (
          'max_size' => 1024,
          'valid_mime' => 
          array (
            0 => 'image/jpeg',
            1 => 'image/pjpeg',
            2 => 'image/png',
            3 => 'image/gif',
            4 => 'image/svg+xml',
            5 => 'application/pdf',
            6 => 'text/plain',
          ),
        ),
        'image' => 
        array (
          'max_size' => 5,
          'valid_mime' => 
          array (
            0 => 'image/jpeg',
            1 => 'image/pjpeg',
            2 => 'image/png',
            3 => 'image/gif',
            4 => 'image/svg+xml',
          ),
        ),
      ),
    ),
  ),
  'locales' => 
  array (
    'ace' => 
    array (
      'code' => 'ace',
      'name' => 'Achinese',
      'script' => 'Latn',
      'native' => 'Aceh',
      'regional' => '',
    ),
    'af' => 
    array (
      'code' => 'af',
      'name' => 'Afrikaans',
      'script' => 'Latn',
      'native' => 'Afrikaans',
      'regional' => 'af_ZA',
    ),
    'agq' => 
    array (
      'name' => 'Aghem',
      'script' => 'Latn',
      'native' => 'Aghem',
      'regional' => '',
      'code' => 'agq',
    ),
    'ak' => 
    array (
      'name' => 'Akan',
      'script' => 'Latn',
      'native' => 'Akan',
      'regional' => 'ak_GH',
      'code' => 'ak',
    ),
    'an' => 
    array (
      'name' => 'Aragonese',
      'script' => 'Latn',
      'native' => 'aragonés',
      'regional' => 'an_ES',
      'code' => 'an',
    ),
    'cch' => 
    array (
      'name' => 'Atsam',
      'script' => 'Latn',
      'native' => 'Atsam',
      'regional' => '',
      'code' => 'cch',
    ),
    'gn' => 
    array (
      'name' => 'Guaraní',
      'script' => 'Latn',
      'native' => 'Avañe’ẽ',
      'regional' => '',
      'code' => 'gn',
    ),
    'ae' => 
    array (
      'name' => 'Avestan',
      'script' => 'Latn',
      'native' => 'avesta',
      'regional' => '',
      'code' => 'ae',
    ),
    'ay' => 
    array (
      'name' => 'Aymara',
      'script' => 'Latn',
      'native' => 'aymar aru',
      'regional' => 'ay_PE',
      'code' => 'ay',
    ),
    'az' => 
    array (
      'name' => 'Azerbaijani (Latin]',
      'script' => 'Latn',
      'native' => 'azərbaycanca',
      'regional' => 'az_AZ',
      'code' => 'az',
    ),
    'id' => 
    array (
      'name' => 'Indonesian',
      'script' => 'Latn',
      'native' => 'Bahasa Indonesia',
      'regional' => 'id_ID',
      'code' => 'id',
    ),
    'ms' => 
    array (
      'name' => 'Malay',
      'script' => 'Latn',
      'native' => 'Bahasa Melayu',
      'regional' => 'ms_MY',
      'code' => 'ms',
    ),
    'bm' => 
    array (
      'name' => 'Bambara',
      'script' => 'Latn',
      'native' => 'bamanakan',
      'regional' => '',
      'code' => 'bm',
    ),
    'jv' => 
    array (
      'name' => 'Javanese (Latin]',
      'script' => 'Latn',
      'native' => 'Basa Jawa',
      'regional' => '',
      'code' => 'jv',
    ),
    'su' => 
    array (
      'name' => 'Sundanese',
      'script' => 'Latn',
      'native' => 'Basa Sunda',
      'regional' => '',
      'code' => 'su',
    ),
    'bh' => 
    array (
      'name' => 'Bihari',
      'script' => 'Latn',
      'native' => 'Bihari',
      'regional' => '',
      'code' => 'bh',
    ),
    'bi' => 
    array (
      'name' => 'Bislama',
      'script' => 'Latn',
      'native' => 'Bislama',
      'regional' => '',
      'code' => 'bi',
    ),
    'nb' => 
    array (
      'name' => 'Norwegian Bokmål',
      'script' => 'Latn',
      'native' => 'Bokmål',
      'regional' => 'nb_NO',
      'code' => 'nb',
    ),
    'bs' => 
    array (
      'name' => 'Bosnian',
      'script' => 'Latn',
      'native' => 'bosanski',
      'regional' => 'bs_BA',
      'code' => 'bs',
    ),
    'br' => 
    array (
      'name' => 'Breton',
      'script' => 'Latn',
      'native' => 'brezhoneg',
      'regional' => 'br_FR',
      'code' => 'br',
    ),
    'ca' => 
    array (
      'name' => 'Catalan',
      'script' => 'Latn',
      'native' => 'català',
      'regional' => 'ca_ES',
      'code' => 'ca',
    ),
    'ch' => 
    array (
      'name' => 'Chamorro',
      'script' => 'Latn',
      'native' => 'Chamoru',
      'regional' => '',
      'code' => 'ch',
    ),
    'ny' => 
    array (
      'name' => 'Chewa',
      'script' => 'Latn',
      'native' => 'chiCheŵa',
      'regional' => '',
      'code' => 'ny',
    ),
    'kde' => 
    array (
      'name' => 'Makonde',
      'script' => 'Latn',
      'native' => 'Chimakonde',
      'regional' => '',
      'code' => 'kde',
    ),
    'sn' => 
    array (
      'name' => 'Shona',
      'script' => 'Latn',
      'native' => 'chiShona',
      'regional' => '',
      'code' => 'sn',
    ),
    'co' => 
    array (
      'name' => 'Corsican',
      'script' => 'Latn',
      'native' => 'corsu',
      'regional' => '',
      'code' => 'co',
    ),
    'cy' => 
    array (
      'name' => 'Welsh',
      'script' => 'Latn',
      'native' => 'Cymraeg',
      'regional' => 'cy_GB',
      'code' => 'cy',
    ),
    'da' => 
    array (
      'name' => 'Danish',
      'script' => 'Latn',
      'native' => 'dansk',
      'regional' => 'da_DK',
      'code' => 'da',
    ),
    'se' => 
    array (
      'name' => 'Northern Sami',
      'script' => 'Latn',
      'native' => 'davvisámegiella',
      'regional' => 'se_NO',
      'code' => 'se',
    ),
    'de' => 
    array (
      'name' => 'German',
      'script' => 'Latn',
      'native' => 'Deutsch',
      'regional' => 'de_DE',
      'code' => 'de',
    ),
    'luo' => 
    array (
      'name' => 'Luo',
      'script' => 'Latn',
      'native' => 'Dholuo',
      'regional' => '',
      'code' => 'luo',
    ),
    'nv' => 
    array (
      'name' => 'Navajo',
      'script' => 'Latn',
      'native' => 'Diné bizaad',
      'regional' => '',
      'code' => 'nv',
    ),
    'dua' => 
    array (
      'name' => 'Duala',
      'script' => 'Latn',
      'native' => 'duálá',
      'regional' => '',
      'code' => 'dua',
    ),
    'et' => 
    array (
      'name' => 'Estonian',
      'script' => 'Latn',
      'native' => 'eesti',
      'regional' => 'et_EE',
      'code' => 'et',
    ),
    'na' => 
    array (
      'name' => 'Nauru',
      'script' => 'Latn',
      'native' => 'Ekakairũ Naoero',
      'regional' => '',
      'code' => 'na',
    ),
    'guz' => 
    array (
      'name' => 'Ekegusii',
      'script' => 'Latn',
      'native' => 'Ekegusii',
      'regional' => '',
      'code' => 'guz',
    ),
    'en' => 
    array (
      'name' => 'English',
      'script' => 'Latn',
      'native' => 'English',
      'regional' => 'en_GB',
      'code' => 'en',
    ),
    'en-AU' => 
    array (
      'name' => 'Australian English',
      'script' => 'Latn',
      'native' => 'Australian English',
      'regional' => 'en_AU',
      'code' => 'en-AU',
    ),
    'en-GB' => 
    array (
      'name' => 'British English',
      'script' => 'Latn',
      'native' => 'British English',
      'regional' => 'en_GB',
      'code' => 'en-GB',
    ),
    'en-CA' => 
    array (
      'name' => 'Canadian English',
      'script' => 'Latn',
      'native' => 'Canadian English',
      'regional' => 'en_CA',
      'code' => 'en-CA',
    ),
    'en-US' => 
    array (
      'name' => 'U.S. English',
      'script' => 'Latn',
      'native' => 'U.S. English',
      'regional' => 'en_US',
      'code' => 'en-US',
    ),
    'es' => 
    array (
      'name' => 'Spanish',
      'script' => 'Latn',
      'native' => 'español',
      'regional' => 'es_ES',
      'code' => 'es',
    ),
    'eo' => 
    array (
      'name' => 'Esperanto',
      'script' => 'Latn',
      'native' => 'esperanto',
      'regional' => '',
      'code' => 'eo',
    ),
    'eu' => 
    array (
      'name' => 'Basque',
      'script' => 'Latn',
      'native' => 'euskara',
      'regional' => 'eu_ES',
      'code' => 'eu',
    ),
    'ewo' => 
    array (
      'name' => 'Ewondo',
      'script' => 'Latn',
      'native' => 'ewondo',
      'regional' => '',
      'code' => 'ewo',
    ),
    'ee' => 
    array (
      'name' => 'Ewe',
      'script' => 'Latn',
      'native' => 'eʋegbe',
      'regional' => '',
      'code' => 'ee',
    ),
    'fil' => 
    array (
      'name' => 'Filipino',
      'script' => 'Latn',
      'native' => 'Filipino',
      'regional' => 'fil_PH',
      'code' => 'fil',
    ),
    'fr' => 
    array (
      'name' => 'French',
      'script' => 'Latn',
      'native' => 'français',
      'regional' => 'fr_FR',
      'code' => 'fr',
    ),
    'fr-CA' => 
    array (
      'name' => 'Canadian French',
      'script' => 'Latn',
      'native' => 'français canadien',
      'regional' => 'fr_CA',
      'code' => 'fr-CA',
    ),
    'fy' => 
    array (
      'name' => 'Western Frisian',
      'script' => 'Latn',
      'native' => 'frysk',
      'regional' => 'fy_DE',
      'code' => 'fy',
    ),
    'fur' => 
    array (
      'name' => 'Friulian',
      'script' => 'Latn',
      'native' => 'furlan',
      'regional' => 'fur_IT',
      'code' => 'fur',
    ),
    'fo' => 
    array (
      'name' => 'Faroese',
      'script' => 'Latn',
      'native' => 'føroyskt',
      'regional' => 'fo_FO',
      'code' => 'fo',
    ),
    'gaa' => 
    array (
      'name' => 'Ga',
      'script' => 'Latn',
      'native' => 'Ga',
      'regional' => '',
      'code' => 'gaa',
    ),
    'ga' => 
    array (
      'name' => 'Irish',
      'script' => 'Latn',
      'native' => 'Gaeilge',
      'regional' => 'ga_IE',
      'code' => 'ga',
    ),
    'gv' => 
    array (
      'name' => 'Manx',
      'script' => 'Latn',
      'native' => 'Gaelg',
      'regional' => 'gv_GB',
      'code' => 'gv',
    ),
    'sm' => 
    array (
      'name' => 'Samoan',
      'script' => 'Latn',
      'native' => 'Gagana fa’a Sāmoa',
      'regional' => '',
      'code' => 'sm',
    ),
    'gl' => 
    array (
      'name' => 'Galician',
      'script' => 'Latn',
      'native' => 'galego',
      'regional' => 'gl_ES',
      'code' => 'gl',
    ),
    'ki' => 
    array (
      'name' => 'Kikuyu',
      'script' => 'Latn',
      'native' => 'Gikuyu',
      'regional' => '',
      'code' => 'ki',
    ),
    'gd' => 
    array (
      'name' => 'Scottish Gaelic',
      'script' => 'Latn',
      'native' => 'Gàidhlig',
      'regional' => 'gd_GB',
      'code' => 'gd',
    ),
    'ha' => 
    array (
      'name' => 'Hausa',
      'script' => 'Latn',
      'native' => 'Hausa',
      'regional' => 'ha_NG',
      'code' => 'ha',
    ),
    'bez' => 
    array (
      'name' => 'Bena',
      'script' => 'Latn',
      'native' => 'Hibena',
      'regional' => '',
      'code' => 'bez',
    ),
    'ho' => 
    array (
      'name' => 'Hiri Motu',
      'script' => 'Latn',
      'native' => 'Hiri Motu',
      'regional' => '',
      'code' => 'ho',
    ),
    'hr' => 
    array (
      'name' => 'Croatian',
      'script' => 'Latn',
      'native' => 'hrvatski',
      'regional' => 'hr_HR',
      'code' => 'hr',
    ),
    'bem' => 
    array (
      'name' => 'Bemba',
      'script' => 'Latn',
      'native' => 'Ichibemba',
      'regional' => 'bem_ZM',
      'code' => 'bem',
    ),
    'io' => 
    array (
      'name' => 'Ido',
      'script' => 'Latn',
      'native' => 'Ido',
      'regional' => '',
      'code' => 'io',
    ),
    'ig' => 
    array (
      'name' => 'Igbo',
      'script' => 'Latn',
      'native' => 'Igbo',
      'regional' => 'ig_NG',
      'code' => 'ig',
    ),
    'rn' => 
    array (
      'name' => 'Rundi',
      'script' => 'Latn',
      'native' => 'Ikirundi',
      'regional' => '',
      'code' => 'rn',
    ),
    'ia' => 
    array (
      'name' => 'Interlingua',
      'script' => 'Latn',
      'native' => 'interlingua',
      'regional' => 'ia_FR',
      'code' => 'ia',
    ),
    'iu-Latn' => 
    array (
      'name' => 'Inuktitut (Latin]',
      'script' => 'Latn',
      'native' => 'Inuktitut',
      'regional' => 'iu_CA',
      'code' => 'iu-Latn',
    ),
    'sbp' => 
    array (
      'name' => 'Sileibi',
      'script' => 'Latn',
      'native' => 'Ishisangu',
      'regional' => '',
      'code' => 'sbp',
    ),
    'nd' => 
    array (
      'name' => 'North Ndebele',
      'script' => 'Latn',
      'native' => 'isiNdebele',
      'regional' => '',
      'code' => 'nd',
    ),
    'nr' => 
    array (
      'name' => 'South Ndebele',
      'script' => 'Latn',
      'native' => 'isiNdebele',
      'regional' => 'nr_ZA',
      'code' => 'nr',
    ),
    'xh' => 
    array (
      'name' => 'Xhosa',
      'script' => 'Latn',
      'native' => 'isiXhosa',
      'regional' => 'xh_ZA',
      'code' => 'xh',
    ),
    'zu' => 
    array (
      'name' => 'Zulu',
      'script' => 'Latn',
      'native' => 'isiZulu',
      'regional' => 'zu_ZA',
      'code' => 'zu',
    ),
    'it' => 
    array (
      'name' => 'Italian',
      'script' => 'Latn',
      'native' => 'italiano',
      'regional' => 'it_IT',
      'code' => 'it',
    ),
    'ik' => 
    array (
      'name' => 'Inupiaq',
      'script' => 'Latn',
      'native' => 'Iñupiaq',
      'regional' => 'ik_CA',
      'code' => 'ik',
    ),
    'dyo' => 
    array (
      'name' => 'Jola-Fonyi',
      'script' => 'Latn',
      'native' => 'joola',
      'regional' => '',
      'code' => 'dyo',
    ),
    'kea' => 
    array (
      'name' => 'Kabuverdianu',
      'script' => 'Latn',
      'native' => 'kabuverdianu',
      'regional' => '',
      'code' => 'kea',
    ),
    'kaj' => 
    array (
      'name' => 'Jju',
      'script' => 'Latn',
      'native' => 'Kaje',
      'regional' => '',
      'code' => 'kaj',
    ),
    'mh' => 
    array (
      'name' => 'Marshallese',
      'script' => 'Latn',
      'native' => 'Kajin M̧ajeļ',
      'regional' => 'mh_MH',
      'code' => 'mh',
    ),
    'kl' => 
    array (
      'name' => 'Kalaallisut',
      'script' => 'Latn',
      'native' => 'kalaallisut',
      'regional' => 'kl_GL',
      'code' => 'kl',
    ),
    'kln' => 
    array (
      'name' => 'Kalenjin',
      'script' => 'Latn',
      'native' => 'Kalenjin',
      'regional' => '',
      'code' => 'kln',
    ),
    'kr' => 
    array (
      'name' => 'Kanuri',
      'script' => 'Latn',
      'native' => 'Kanuri',
      'regional' => '',
      'code' => 'kr',
    ),
    'kcg' => 
    array (
      'name' => 'Tyap',
      'script' => 'Latn',
      'native' => 'Katab',
      'regional' => '',
      'code' => 'kcg',
    ),
    'kw' => 
    array (
      'name' => 'Cornish',
      'script' => 'Latn',
      'native' => 'kernewek',
      'regional' => 'kw_GB',
      'code' => 'kw',
    ),
    'naq' => 
    array (
      'name' => 'Nama',
      'script' => 'Latn',
      'native' => 'Khoekhoegowab',
      'regional' => '',
      'code' => 'naq',
    ),
    'rof' => 
    array (
      'name' => 'Rombo',
      'script' => 'Latn',
      'native' => 'Kihorombo',
      'regional' => '',
      'code' => 'rof',
    ),
    'kam' => 
    array (
      'name' => 'Kamba',
      'script' => 'Latn',
      'native' => 'Kikamba',
      'regional' => '',
      'code' => 'kam',
    ),
    'kg' => 
    array (
      'name' => 'Kongo',
      'script' => 'Latn',
      'native' => 'Kikongo',
      'regional' => '',
      'code' => 'kg',
    ),
    'jmc' => 
    array (
      'name' => 'Machame',
      'script' => 'Latn',
      'native' => 'Kimachame',
      'regional' => '',
      'code' => 'jmc',
    ),
    'rw' => 
    array (
      'name' => 'Kinyarwanda',
      'script' => 'Latn',
      'native' => 'Kinyarwanda',
      'regional' => 'rw_RW',
      'code' => 'rw',
    ),
    'asa' => 
    array (
      'name' => 'Kipare',
      'script' => 'Latn',
      'native' => 'Kipare',
      'regional' => '',
      'code' => 'asa',
    ),
    'rwk' => 
    array (
      'name' => 'Rwa',
      'script' => 'Latn',
      'native' => 'Kiruwa',
      'regional' => '',
      'code' => 'rwk',
    ),
    'saq' => 
    array (
      'name' => 'Samburu',
      'script' => 'Latn',
      'native' => 'Kisampur',
      'regional' => '',
      'code' => 'saq',
    ),
    'ksb' => 
    array (
      'name' => 'Shambala',
      'script' => 'Latn',
      'native' => 'Kishambaa',
      'regional' => '',
      'code' => 'ksb',
    ),
    'swc' => 
    array (
      'name' => 'Congo Swahili',
      'script' => 'Latn',
      'native' => 'Kiswahili ya Kongo',
      'regional' => '',
      'code' => 'swc',
    ),
    'sw' => 
    array (
      'name' => 'Swahili',
      'script' => 'Latn',
      'native' => 'Kiswahili',
      'regional' => 'sw_KE',
      'code' => 'sw',
    ),
    'dav' => 
    array (
      'name' => 'Dawida',
      'script' => 'Latn',
      'native' => 'Kitaita',
      'regional' => '',
      'code' => 'dav',
    ),
    'teo' => 
    array (
      'name' => 'Teso',
      'script' => 'Latn',
      'native' => 'Kiteso',
      'regional' => '',
      'code' => 'teo',
    ),
    'khq' => 
    array (
      'name' => 'Koyra Chiini',
      'script' => 'Latn',
      'native' => 'Koyra ciini',
      'regional' => '',
      'code' => 'khq',
    ),
    'ses' => 
    array (
      'name' => 'Songhay',
      'script' => 'Latn',
      'native' => 'Koyraboro senni',
      'regional' => '',
      'code' => 'ses',
    ),
    'mfe' => 
    array (
      'name' => 'Morisyen',
      'script' => 'Latn',
      'native' => 'kreol morisien',
      'regional' => '',
      'code' => 'mfe',
    ),
    'ht' => 
    array (
      'name' => 'Haitian',
      'script' => 'Latn',
      'native' => 'Kreyòl ayisyen',
      'regional' => 'ht_HT',
      'code' => 'ht',
    ),
    'kj' => 
    array (
      'name' => 'Kuanyama',
      'script' => 'Latn',
      'native' => 'Kwanyama',
      'regional' => '',
      'code' => 'kj',
    ),
    'ksh' => 
    array (
      'name' => 'Kölsch',
      'script' => 'Latn',
      'native' => 'Kölsch',
      'regional' => '',
      'code' => 'ksh',
    ),
    'ebu' => 
    array (
      'name' => 'Kiembu',
      'script' => 'Latn',
      'native' => 'Kĩembu',
      'regional' => '',
      'code' => 'ebu',
    ),
    'mer' => 
    array (
      'name' => 'Kimîîru',
      'script' => 'Latn',
      'native' => 'Kĩmĩrũ',
      'regional' => '',
      'code' => 'mer',
    ),
    'lag' => 
    array (
      'name' => 'Langi',
      'script' => 'Latn',
      'native' => 'Kɨlaangi',
      'regional' => '',
      'code' => 'lag',
    ),
    'lah' => 
    array (
      'name' => 'Lahnda',
      'script' => 'Latn',
      'native' => 'Lahnda',
      'regional' => '',
      'code' => 'lah',
    ),
    'la' => 
    array (
      'name' => 'Latin',
      'script' => 'Latn',
      'native' => 'latine',
      'regional' => '',
      'code' => 'la',
    ),
    'lv' => 
    array (
      'name' => 'Latvian',
      'script' => 'Latn',
      'native' => 'latviešu',
      'regional' => 'lv_LV',
      'code' => 'lv',
    ),
    'to' => 
    array (
      'name' => 'Tongan',
      'script' => 'Latn',
      'native' => 'lea fakatonga',
      'regional' => '',
      'code' => 'to',
    ),
    'lt' => 
    array (
      'name' => 'Lithuanian',
      'script' => 'Latn',
      'native' => 'lietuvių',
      'regional' => 'lt_LT',
      'code' => 'lt',
    ),
    'li' => 
    array (
      'name' => 'Limburgish',
      'script' => 'Latn',
      'native' => 'Limburgs',
      'regional' => 'li_BE',
      'code' => 'li',
    ),
    'ln' => 
    array (
      'name' => 'Lingala',
      'script' => 'Latn',
      'native' => 'lingála',
      'regional' => '',
      'code' => 'ln',
    ),
    'lg' => 
    array (
      'name' => 'Ganda',
      'script' => 'Latn',
      'native' => 'Luganda',
      'regional' => 'lg_UG',
      'code' => 'lg',
    ),
    'luy' => 
    array (
      'name' => 'Oluluyia',
      'script' => 'Latn',
      'native' => 'Luluhia',
      'regional' => '',
      'code' => 'luy',
    ),
    'lb' => 
    array (
      'name' => 'Luxembourgish',
      'script' => 'Latn',
      'native' => 'Lëtzebuergesch',
      'regional' => 'lb_LU',
      'code' => 'lb',
    ),
    'hu' => 
    array (
      'name' => 'Hungarian',
      'script' => 'Latn',
      'native' => 'magyar',
      'regional' => 'hu_HU',
      'code' => 'hu',
    ),
    'mgh' => 
    array (
      'name' => 'Makhuwa-Meetto',
      'script' => 'Latn',
      'native' => 'Makua',
      'regional' => '',
      'code' => 'mgh',
    ),
    'mg' => 
    array (
      'name' => 'Malagasy',
      'script' => 'Latn',
      'native' => 'Malagasy',
      'regional' => 'mg_MG',
      'code' => 'mg',
    ),
    'mt' => 
    array (
      'name' => 'Maltese',
      'script' => 'Latn',
      'native' => 'Malti',
      'regional' => 'mt_MT',
      'code' => 'mt',
    ),
    'mtr' => 
    array (
      'name' => 'Mewari',
      'script' => 'Latn',
      'native' => 'Mewari',
      'regional' => '',
      'code' => 'mtr',
    ),
    'mua' => 
    array (
      'name' => 'Mundang',
      'script' => 'Latn',
      'native' => 'Mundang',
      'regional' => '',
      'code' => 'mua',
    ),
    'mi' => 
    array (
      'name' => 'Māori',
      'script' => 'Latn',
      'native' => 'Māori',
      'regional' => 'mi_NZ',
      'code' => 'mi',
    ),
    'nl' => 
    array (
      'name' => 'Dutch',
      'script' => 'Latn',
      'native' => 'Nederlands',
      'regional' => 'nl_NL',
      'code' => 'nl',
    ),
    'nmg' => 
    array (
      'name' => 'Kwasio',
      'script' => 'Latn',
      'native' => 'ngumba',
      'regional' => '',
      'code' => 'nmg',
    ),
    'yav' => 
    array (
      'name' => 'Yangben',
      'script' => 'Latn',
      'native' => 'nuasue',
      'regional' => '',
      'code' => 'yav',
    ),
    'nn' => 
    array (
      'name' => 'Norwegian Nynorsk',
      'script' => 'Latn',
      'native' => 'nynorsk',
      'regional' => 'nn_NO',
      'code' => 'nn',
    ),
    'oc' => 
    array (
      'name' => 'Occitan',
      'script' => 'Latn',
      'native' => 'occitan',
      'regional' => 'oc_FR',
      'code' => 'oc',
    ),
    'ang' => 
    array (
      'name' => 'Old English',
      'script' => 'Runr',
      'native' => 'Old English',
      'regional' => '',
      'code' => 'ang',
    ),
    'xog' => 
    array (
      'name' => 'Soga',
      'script' => 'Latn',
      'native' => 'Olusoga',
      'regional' => '',
      'code' => 'xog',
    ),
    'om' => 
    array (
      'name' => 'Oromo',
      'script' => 'Latn',
      'native' => 'Oromoo',
      'regional' => 'om_ET',
      'code' => 'om',
    ),
    'ng' => 
    array (
      'name' => 'Ndonga',
      'script' => 'Latn',
      'native' => 'OshiNdonga',
      'regional' => '',
      'code' => 'ng',
    ),
    'hz' => 
    array (
      'name' => 'Herero',
      'script' => 'Latn',
      'native' => 'Otjiherero',
      'regional' => '',
      'code' => 'hz',
    ),
    'uz-Latn' => 
    array (
      'name' => 'Uzbek (Latin]',
      'script' => 'Latn',
      'native' => 'oʼzbekcha',
      'regional' => 'uz_UZ',
      'code' => 'uz-Latn',
    ),
    'nds' => 
    array (
      'name' => 'Low German',
      'script' => 'Latn',
      'native' => 'Plattdüütsch',
      'regional' => 'nds_DE',
      'code' => 'nds',
    ),
    'pl' => 
    array (
      'name' => 'Polish',
      'script' => 'Latn',
      'native' => 'polski',
      'regional' => 'pl_PL',
      'code' => 'pl',
    ),
    'pt' => 
    array (
      'name' => 'Portuguese',
      'script' => 'Latn',
      'native' => 'português',
      'regional' => 'pt_PT',
      'code' => 'pt',
    ),
    'pt-BR' => 
    array (
      'name' => 'Brazilian Portuguese',
      'script' => 'Latn',
      'native' => 'português do Brasil',
      'regional' => 'pt_BR',
      'code' => 'pt-BR',
    ),
    'ff' => 
    array (
      'name' => 'Fulah',
      'script' => 'Latn',
      'native' => 'Pulaar',
      'regional' => 'ff_SN',
      'code' => 'ff',
    ),
    'pi' => 
    array (
      'name' => 'Pahari-Potwari',
      'script' => 'Latn',
      'native' => 'Pāli',
      'regional' => '',
      'code' => 'pi',
    ),
    'aa' => 
    array (
      'name' => 'Afar',
      'script' => 'Latn',
      'native' => 'Qafar',
      'regional' => 'aa_ER',
      'code' => 'aa',
    ),
    'ty' => 
    array (
      'name' => 'Tahitian',
      'script' => 'Latn',
      'native' => 'Reo Māohi',
      'regional' => '',
      'code' => 'ty',
    ),
    'ksf' => 
    array (
      'name' => 'Bafia',
      'script' => 'Latn',
      'native' => 'rikpa',
      'regional' => '',
      'code' => 'ksf',
    ),
    'ro' => 
    array (
      'name' => 'Romanian',
      'script' => 'Latn',
      'native' => 'română',
      'regional' => 'ro_RO',
      'code' => 'ro',
    ),
    'cgg' => 
    array (
      'name' => 'Chiga',
      'script' => 'Latn',
      'native' => 'Rukiga',
      'regional' => '',
      'code' => 'cgg',
    ),
    'rm' => 
    array (
      'name' => 'Romansh',
      'script' => 'Latn',
      'native' => 'rumantsch',
      'regional' => '',
      'code' => 'rm',
    ),
    'qu' => 
    array (
      'name' => 'Quechua',
      'script' => 'Latn',
      'native' => 'Runa Simi',
      'regional' => '',
      'code' => 'qu',
    ),
    'nyn' => 
    array (
      'name' => 'Nyankole',
      'script' => 'Latn',
      'native' => 'Runyankore',
      'regional' => '',
      'code' => 'nyn',
    ),
    'ssy' => 
    array (
      'name' => 'Saho',
      'script' => 'Latn',
      'native' => 'Saho',
      'regional' => '',
      'code' => 'ssy',
    ),
    'sc' => 
    array (
      'name' => 'Sardinian',
      'script' => 'Latn',
      'native' => 'sardu',
      'regional' => 'sc_IT',
      'code' => 'sc',
    ),
    'de-CH' => 
    array (
      'name' => 'Swiss High German',
      'script' => 'Latn',
      'native' => 'Schweizer Hochdeutsch',
      'regional' => 'de_CH',
      'code' => 'de-CH',
    ),
    'gsw' => 
    array (
      'name' => 'Swiss German',
      'script' => 'Latn',
      'native' => 'Schwiizertüütsch',
      'regional' => '',
      'code' => 'gsw',
    ),
    'trv' => 
    array (
      'name' => 'Taroko',
      'script' => 'Latn',
      'native' => 'Seediq',
      'regional' => '',
      'code' => 'trv',
    ),
    'seh' => 
    array (
      'name' => 'Sena',
      'script' => 'Latn',
      'native' => 'sena',
      'regional' => '',
      'code' => 'seh',
    ),
    'nso' => 
    array (
      'name' => 'Northern Sotho',
      'script' => 'Latn',
      'native' => 'Sesotho sa Leboa',
      'regional' => 'nso_ZA',
      'code' => 'nso',
    ),
    'st' => 
    array (
      'name' => 'Southern Sotho',
      'script' => 'Latn',
      'native' => 'Sesotho',
      'regional' => 'st_ZA',
      'code' => 'st',
    ),
    'tn' => 
    array (
      'name' => 'Tswana',
      'script' => 'Latn',
      'native' => 'Setswana',
      'regional' => 'tn_ZA',
      'code' => 'tn',
    ),
    'sq' => 
    array (
      'name' => 'Albanian',
      'script' => 'Latn',
      'native' => 'shqip',
      'regional' => 'sq_AL',
      'code' => 'sq',
    ),
    'sid' => 
    array (
      'name' => 'Sidamo',
      'script' => 'Latn',
      'native' => 'Sidaamu Afo',
      'regional' => 'sid_ET',
      'code' => 'sid',
    ),
    'ss' => 
    array (
      'name' => 'Swati',
      'script' => 'Latn',
      'native' => 'Siswati',
      'regional' => 'ss_ZA',
      'code' => 'ss',
    ),
    'sk' => 
    array (
      'name' => 'Slovak',
      'script' => 'Latn',
      'native' => 'slovenčina',
      'regional' => 'sk_SK',
      'code' => 'sk',
    ),
    'sl' => 
    array (
      'name' => 'Slovene',
      'script' => 'Latn',
      'native' => 'slovenščina',
      'regional' => 'sl_SI',
      'code' => 'sl',
    ),
    'so' => 
    array (
      'name' => 'Somali',
      'script' => 'Latn',
      'native' => 'Soomaali',
      'regional' => 'so_SO',
      'code' => 'so',
    ),
    'sr-Latn' => 
    array (
      'name' => 'Serbian (Latin]',
      'script' => 'Latn',
      'native' => 'Srpski',
      'regional' => 'sr_RS',
      'code' => 'sr-Latn',
    ),
    'sh' => 
    array (
      'name' => 'Serbo-Croatian',
      'script' => 'Latn',
      'native' => 'srpskohrvatski',
      'regional' => '',
      'code' => 'sh',
    ),
    'fi' => 
    array (
      'name' => 'Finnish',
      'script' => 'Latn',
      'native' => 'suomi',
      'regional' => 'fi_FI',
      'code' => 'fi',
    ),
    'sv' => 
    array (
      'name' => 'Swedish',
      'script' => 'Latn',
      'native' => 'svenska',
      'regional' => 'sv_SE',
      'code' => 'sv',
    ),
    'sg' => 
    array (
      'name' => 'Sango',
      'script' => 'Latn',
      'native' => 'Sängö',
      'regional' => '',
      'code' => 'sg',
    ),
    'tl' => 
    array (
      'name' => 'Tagalog',
      'script' => 'Latn',
      'native' => 'Tagalog',
      'regional' => 'tl_PH',
      'code' => 'tl',
    ),
    'tzm-Latn' => 
    array (
      'name' => 'Central Atlas Tamazight (Latin]',
      'script' => 'Latn',
      'native' => 'Tamazight',
      'regional' => '',
      'code' => 'tzm-Latn',
    ),
    'kab' => 
    array (
      'name' => 'Kabyle',
      'script' => 'Latn',
      'native' => 'Taqbaylit',
      'regional' => 'kab_DZ',
      'code' => 'kab',
    ),
    'twq' => 
    array (
      'name' => 'Tasawaq',
      'script' => 'Latn',
      'native' => 'Tasawaq senni',
      'regional' => '',
      'code' => 'twq',
    ),
    'shi' => 
    array (
      'name' => 'Tachelhit (Latin]',
      'script' => 'Latn',
      'native' => 'Tashelhit',
      'regional' => '',
      'code' => 'shi',
    ),
    'nus' => 
    array (
      'name' => 'Nuer',
      'script' => 'Latn',
      'native' => 'Thok Nath',
      'regional' => '',
      'code' => 'nus',
    ),
    'vi' => 
    array (
      'name' => 'Vietnamese',
      'script' => 'Latn',
      'native' => 'Tiếng Việt',
      'regional' => 'vi_VN',
      'code' => 'vi',
    ),
    'tg-Latn' => 
    array (
      'name' => 'Tajik (Latin]',
      'script' => 'Latn',
      'native' => 'tojikī',
      'regional' => 'tg_TJ',
      'code' => 'tg-Latn',
    ),
    'lu' => 
    array (
      'name' => 'Luba-Katanga',
      'script' => 'Latn',
      'native' => 'Tshiluba',
      'regional' => 've_ZA',
      'code' => 'lu',
    ),
    've' => 
    array (
      'name' => 'Venda',
      'script' => 'Latn',
      'native' => 'Tshivenḓa',
      'regional' => '',
      'code' => 've',
    ),
    'tw' => 
    array (
      'name' => 'Twi',
      'script' => 'Latn',
      'native' => 'Twi',
      'regional' => '',
      'code' => 'tw',
    ),
    'tr' => 
    array (
      'name' => 'Turkish',
      'script' => 'Latn',
      'native' => 'Türkçe',
      'regional' => 'tr_TR',
      'code' => 'tr',
    ),
    'ale' => 
    array (
      'name' => 'Aleut',
      'script' => 'Latn',
      'native' => 'Unangax tunuu',
      'regional' => '',
      'code' => 'ale',
    ),
    'ca-valencia' => 
    array (
      'name' => 'Valencian',
      'script' => 'Latn',
      'native' => 'valencià',
      'regional' => '',
      'code' => 'ca-valencia',
    ),
    'vai-Latn' => 
    array (
      'name' => 'Vai (Latin]',
      'script' => 'Latn',
      'native' => 'Viyamíĩ',
      'regional' => '',
      'code' => 'vai-Latn',
    ),
    'vo' => 
    array (
      'name' => 'Volapük',
      'script' => 'Latn',
      'native' => 'Volapük',
      'regional' => '',
      'code' => 'vo',
    ),
    'fj' => 
    array (
      'name' => 'Fijian',
      'script' => 'Latn',
      'native' => 'vosa Vakaviti',
      'regional' => '',
      'code' => 'fj',
    ),
    'wa' => 
    array (
      'name' => 'Walloon',
      'script' => 'Latn',
      'native' => 'Walon',
      'regional' => 'wa_BE',
      'code' => 'wa',
    ),
    'wae' => 
    array (
      'name' => 'Walser',
      'script' => 'Latn',
      'native' => 'Walser',
      'regional' => 'wae_CH',
      'code' => 'wae',
    ),
    'wen' => 
    array (
      'name' => 'Sorbian',
      'script' => 'Latn',
      'native' => 'Wendic',
      'regional' => '',
      'code' => 'wen',
    ),
    'wo' => 
    array (
      'name' => 'Wolof',
      'script' => 'Latn',
      'native' => 'Wolof',
      'regional' => 'wo_SN',
      'code' => 'wo',
    ),
    'ts' => 
    array (
      'name' => 'Tsonga',
      'script' => 'Latn',
      'native' => 'Xitsonga',
      'regional' => 'ts_ZA',
      'code' => 'ts',
    ),
    'dje' => 
    array (
      'name' => 'Zarma',
      'script' => 'Latn',
      'native' => 'Zarmaciine',
      'regional' => '',
      'code' => 'dje',
    ),
    'yo' => 
    array (
      'name' => 'Yoruba',
      'script' => 'Latn',
      'native' => 'Èdè Yorùbá',
      'regional' => 'yo_NG',
      'code' => 'yo',
    ),
    'de-AT' => 
    array (
      'name' => 'Austrian German',
      'script' => 'Latn',
      'native' => 'Österreichisches Deutsch',
      'regional' => 'de_AT',
      'code' => 'de-AT',
    ),
    'is' => 
    array (
      'name' => 'Icelandic',
      'script' => 'Latn',
      'native' => 'íslenska',
      'regional' => 'is_IS',
      'code' => 'is',
    ),
    'cs' => 
    array (
      'name' => 'Czech',
      'script' => 'Latn',
      'native' => 'čeština',
      'regional' => 'cs_CZ',
      'code' => 'cs',
    ),
    'bas' => 
    array (
      'name' => 'Basa',
      'script' => 'Latn',
      'native' => 'Ɓàsàa',
      'regional' => '',
      'code' => 'bas',
    ),
    'mas' => 
    array (
      'name' => 'Masai',
      'script' => 'Latn',
      'native' => 'ɔl-Maa',
      'regional' => '',
      'code' => 'mas',
    ),
    'haw' => 
    array (
      'name' => 'Hawaiian',
      'script' => 'Latn',
      'native' => 'ʻŌlelo Hawaiʻi',
      'regional' => '',
      'code' => 'haw',
    ),
    'el' => 
    array (
      'name' => 'Greek',
      'script' => 'Grek',
      'native' => 'Ελληνικά',
      'regional' => 'el_GR',
      'code' => 'el',
    ),
    'uz' => 
    array (
      'name' => 'Uzbek (Cyrillic]',
      'script' => 'Cyrl',
      'native' => 'Ўзбек',
      'regional' => 'uz_UZ',
      'code' => 'uz',
    ),
    'az-Cyrl' => 
    array (
      'name' => 'Azerbaijani (Cyrillic]',
      'script' => 'Cyrl',
      'native' => 'Азәрбајҹан',
      'regional' => 'uz_UZ',
      'code' => 'az-Cyrl',
    ),
    'ab' => 
    array (
      'name' => 'Abkhazian',
      'script' => 'Cyrl',
      'native' => 'Аҧсуа',
      'regional' => '',
      'code' => 'ab',
    ),
    'os' => 
    array (
      'name' => 'Ossetic',
      'script' => 'Cyrl',
      'native' => 'Ирон',
      'regional' => 'os_RU',
      'code' => 'os',
    ),
    'ky' => 
    array (
      'name' => 'Kyrgyz',
      'script' => 'Cyrl',
      'native' => 'Кыргыз',
      'regional' => 'ky_KG',
      'code' => 'ky',
    ),
    'sr' => 
    array (
      'name' => 'Serbian (Cyrillic]',
      'script' => 'Cyrl',
      'native' => 'Српски',
      'regional' => 'sr_RS',
      'code' => 'sr',
    ),
    'av' => 
    array (
      'name' => 'Avaric',
      'script' => 'Cyrl',
      'native' => 'авар мацӀ',
      'regional' => '',
      'code' => 'av',
    ),
    'ady' => 
    array (
      'name' => 'Adyghe',
      'script' => 'Cyrl',
      'native' => 'адыгэбзэ',
      'regional' => '',
      'code' => 'ady',
    ),
    'ba' => 
    array (
      'name' => 'Bashkir',
      'script' => 'Cyrl',
      'native' => 'башҡорт теле',
      'regional' => '',
      'code' => 'ba',
    ),
    'be' => 
    array (
      'name' => 'Belarusian',
      'script' => 'Cyrl',
      'native' => 'беларуская',
      'regional' => 'be_BY',
      'code' => 'be',
    ),
    'bg' => 
    array (
      'name' => 'Bulgarian',
      'script' => 'Cyrl',
      'native' => 'български',
      'regional' => 'bg_BG',
      'code' => 'bg',
    ),
    'kv' => 
    array (
      'name' => 'Komi',
      'script' => 'Cyrl',
      'native' => 'коми кыв',
      'regional' => '',
      'code' => 'kv',
    ),
    'mk' => 
    array (
      'name' => 'Macedonian',
      'script' => 'Cyrl',
      'native' => 'македонски',
      'regional' => 'mk_MK',
      'code' => 'mk',
    ),
    'mn' => 
    array (
      'name' => 'Mongolian (Cyrillic]',
      'script' => 'Cyrl',
      'native' => 'монгол',
      'regional' => 'mn_MN',
      'code' => 'mn',
    ),
    'ce' => 
    array (
      'name' => 'Chechen',
      'script' => 'Cyrl',
      'native' => 'нохчийн мотт',
      'regional' => 'ce_RU',
      'code' => 'ce',
    ),
    'ru' => 
    array (
      'name' => 'Russian',
      'script' => 'Cyrl',
      'native' => 'русский',
      'regional' => 'ru_RU',
      'code' => 'ru',
    ),
    'sah' => 
    array (
      'name' => 'Yakut',
      'script' => 'Cyrl',
      'native' => 'саха тыла',
      'regional' => '',
      'code' => 'sah',
    ),
    'tt' => 
    array (
      'name' => 'Tatar',
      'script' => 'Cyrl',
      'native' => 'татар теле',
      'regional' => 'tt_RU',
      'code' => 'tt',
    ),
    'tg' => 
    array (
      'name' => 'Tajik (Cyrillic]',
      'script' => 'Cyrl',
      'native' => 'тоҷикӣ',
      'regional' => 'tg_TJ',
      'code' => 'tg',
    ),
    'tk' => 
    array (
      'name' => 'Turkmen',
      'script' => 'Cyrl',
      'native' => 'түркменче',
      'regional' => 'tk_TM',
      'code' => 'tk',
    ),
    'uk' => 
    array (
      'name' => 'Ukrainian',
      'script' => 'Cyrl',
      'native' => 'українська',
      'regional' => 'uk_UA',
      'code' => 'uk',
    ),
    'cv' => 
    array (
      'name' => 'Chuvash',
      'script' => 'Cyrl',
      'native' => 'чӑваш чӗлхи',
      'regional' => 'cv_RU',
      'code' => 'cv',
    ),
    'cu' => 
    array (
      'name' => 'Church Slavic',
      'script' => 'Cyrl',
      'native' => 'ѩзыкъ словѣньскъ',
      'regional' => '',
      'code' => 'cu',
    ),
    'kk' => 
    array (
      'name' => 'Kazakh',
      'script' => 'Cyrl',
      'native' => 'қазақ тілі',
      'regional' => 'kk_KZ',
      'code' => 'kk',
    ),
    'hy' => 
    array (
      'name' => 'Armenian',
      'script' => 'Armn',
      'native' => 'Հայերեն',
      'regional' => 'hy_AM',
      'code' => 'hy',
    ),
    'yi' => 
    array (
      'name' => 'Yiddish',
      'script' => 'Hebr',
      'native' => 'ייִדיש',
      'regional' => 'yi_US',
      'code' => 'yi',
    ),
    'he' => 
    array (
      'name' => 'Hebrew',
      'script' => 'Hebr',
      'native' => 'עברית',
      'regional' => 'he_IL',
      'code' => 'he',
    ),
    'ug' => 
    array (
      'name' => 'Uyghur',
      'script' => 'Arab',
      'native' => 'ئۇيغۇرچە',
      'regional' => 'ug_CN',
      'code' => 'ug',
    ),
    'ur' => 
    array (
      'name' => 'Urdu',
      'script' => 'Arab',
      'native' => 'اردو',
      'regional' => 'ur_PK',
      'code' => 'ur',
    ),
    'ar' => 
    array (
      'name' => 'Arabic',
      'script' => 'Arab',
      'native' => 'العربية',
      'regional' => 'ar_AE',
      'code' => 'ar',
    ),
    'uz-Arab' => 
    array (
      'name' => 'Uzbek (Arabic]',
      'script' => 'Arab',
      'native' => 'اۉزبېک',
      'regional' => '',
      'code' => 'uz-Arab',
    ),
    'tg-Arab' => 
    array (
      'name' => 'Tajik (Arabic]',
      'script' => 'Arab',
      'native' => 'تاجیکی',
      'regional' => 'tg_TJ',
      'code' => 'tg-Arab',
    ),
    'sd' => 
    array (
      'name' => 'Sindhi',
      'script' => 'Arab',
      'native' => 'سنڌي',
      'regional' => 'sd_IN',
      'code' => 'sd',
    ),
    'fa' => 
    array (
      'name' => 'Persian',
      'script' => 'Arab',
      'native' => 'فارسی',
      'regional' => 'fa_IR',
      'code' => 'fa',
    ),
    'pa-Arab' => 
    array (
      'name' => 'Punjabi (Arabic]',
      'script' => 'Arab',
      'native' => 'پنجاب',
      'regional' => 'pa_IN',
      'code' => 'pa-Arab',
    ),
    'ps' => 
    array (
      'name' => 'Pashto',
      'script' => 'Arab',
      'native' => 'پښتو',
      'regional' => 'ps_AF',
      'code' => 'ps',
    ),
    'ks' => 
    array (
      'name' => 'Kashmiri (Arabic]',
      'script' => 'Arab',
      'native' => 'کأشُر',
      'regional' => 'ks_IN',
      'code' => 'ks',
    ),
    'ku' => 
    array (
      'name' => 'Kurdish',
      'script' => 'Arab',
      'native' => 'کوردی',
      'regional' => 'ku_TR',
      'code' => 'ku',
    ),
    'dv' => 
    array (
      'name' => 'Divehi',
      'script' => 'Thaa',
      'native' => 'ދިވެހިބަސް',
      'regional' => 'dv_MV',
      'code' => 'dv',
    ),
    'ks-Deva' => 
    array (
      'name' => 'Kashmiri (Devaganari]',
      'script' => 'Deva',
      'native' => 'कॉशुर',
      'regional' => 'ks_IN',
      'code' => 'ks-Deva',
    ),
    'kok' => 
    array (
      'name' => 'Konkani',
      'script' => 'Deva',
      'native' => 'कोंकणी',
      'regional' => 'kok_IN',
      'code' => 'kok',
    ),
    'doi' => 
    array (
      'name' => 'Dogri',
      'script' => 'Deva',
      'native' => 'डोगरी',
      'regional' => 'doi_IN',
      'code' => 'doi',
    ),
    'ne' => 
    array (
      'name' => 'Nepali',
      'script' => 'Deva',
      'native' => 'नेपाली',
      'regional' => '',
      'code' => 'ne',
    ),
    'pra' => 
    array (
      'name' => 'Prakrit',
      'script' => 'Deva',
      'native' => 'प्राकृत',
      'regional' => '',
      'code' => 'pra',
    ),
    'brx' => 
    array (
      'name' => 'Bodo',
      'script' => 'Deva',
      'native' => 'बड़ो',
      'regional' => 'brx_IN',
      'code' => 'brx',
    ),
    'bra' => 
    array (
      'name' => 'Braj',
      'script' => 'Deva',
      'native' => 'ब्रज भाषा',
      'regional' => '',
      'code' => 'bra',
    ),
    'mr' => 
    array (
      'name' => 'Marathi',
      'script' => 'Deva',
      'native' => 'मराठी',
      'regional' => 'mr_IN',
      'code' => 'mr',
    ),
    'mai' => 
    array (
      'name' => 'Maithili',
      'script' => 'Tirh',
      'native' => 'मैथिली',
      'regional' => 'mai_IN',
      'code' => 'mai',
    ),
    'raj' => 
    array (
      'name' => 'Rajasthani',
      'script' => 'Deva',
      'native' => 'राजस्थानी',
      'regional' => '',
      'code' => 'raj',
    ),
    'sa' => 
    array (
      'name' => 'Sanskrit',
      'script' => 'Deva',
      'native' => 'संस्कृतम्',
      'regional' => 'sa_IN',
      'code' => 'sa',
    ),
    'hi' => 
    array (
      'name' => 'Hindi',
      'script' => 'Deva',
      'native' => 'हिन्दी',
      'regional' => 'hi_IN',
      'code' => 'hi',
    ),
    'as' => 
    array (
      'name' => 'Assamese',
      'script' => 'Beng',
      'native' => 'অসমীয়া',
      'regional' => 'as_IN',
      'code' => 'as',
    ),
    'bn' => 
    array (
      'name' => 'Bengali',
      'script' => 'Beng',
      'native' => 'বাংলা',
      'regional' => 'bn_BD',
      'code' => 'bn',
    ),
    'mni' => 
    array (
      'name' => 'Manipuri',
      'script' => 'Beng',
      'native' => 'মৈতৈ',
      'regional' => 'mni_IN',
      'code' => 'mni',
    ),
    'pa' => 
    array (
      'name' => 'Punjabi (Gurmukhi]',
      'script' => 'Guru',
      'native' => 'ਪੰਜਾਬੀ',
      'regional' => 'pa_IN',
      'code' => 'pa',
    ),
    'gu' => 
    array (
      'name' => 'Gujarati',
      'script' => 'Gujr',
      'native' => 'ગુજરાતી',
      'regional' => 'gu_IN',
      'code' => 'gu',
    ),
    'or' => 
    array (
      'name' => 'Oriya',
      'script' => 'Orya',
      'native' => 'ଓଡ଼ିଆ',
      'regional' => 'or_IN',
      'code' => 'or',
    ),
    'ta' => 
    array (
      'name' => 'Tamil',
      'script' => 'Taml',
      'native' => 'தமிழ்',
      'regional' => 'ta_IN',
      'code' => 'ta',
    ),
    'te' => 
    array (
      'name' => 'Telugu',
      'script' => 'Telu',
      'native' => 'తెలుగు',
      'regional' => 'te_IN',
      'code' => 'te',
    ),
    'kn' => 
    array (
      'name' => 'Kannada',
      'script' => 'Knda',
      'native' => 'ಕನ್ನಡ',
      'regional' => 'kn_IN',
      'code' => 'kn',
    ),
    'ml' => 
    array (
      'name' => 'Malayalam',
      'script' => 'Mlym',
      'native' => 'മലയാളം',
      'regional' => 'ml_IN',
      'code' => 'ml',
    ),
    'si' => 
    array (
      'name' => 'Sinhala',
      'script' => 'Sinh',
      'native' => 'සිංහල',
      'regional' => 'si_LK',
      'code' => 'si',
    ),
    'th' => 
    array (
      'name' => 'Thai',
      'script' => 'Thai',
      'native' => 'ไทย',
      'regional' => 'th_TH',
      'code' => 'th',
    ),
    'lo' => 
    array (
      'name' => 'Lao',
      'script' => 'Laoo',
      'native' => 'ລາວ',
      'regional' => 'lo_LA',
      'code' => 'lo',
    ),
    'bo' => 
    array (
      'name' => 'Tibetan',
      'script' => 'Tibt',
      'native' => 'པོད་སྐད་',
      'regional' => 'bo_IN',
      'code' => 'bo',
    ),
    'dz' => 
    array (
      'name' => 'Dzongkha',
      'script' => 'Tibt',
      'native' => 'རྫོང་ཁ',
      'regional' => 'dz_BT',
      'code' => 'dz',
    ),
    'my' => 
    array (
      'name' => 'Burmese',
      'script' => 'Mymr',
      'native' => 'မြန်မာဘာသာ',
      'regional' => 'my_MM',
      'code' => 'my',
    ),
    'ka' => 
    array (
      'name' => 'Georgian',
      'script' => 'Geor',
      'native' => 'ქართული',
      'regional' => 'ka_GE',
      'code' => 'ka',
    ),
    'byn' => 
    array (
      'name' => 'Blin',
      'script' => 'Ethi',
      'native' => 'ብሊን',
      'regional' => 'byn_ER',
      'code' => 'byn',
    ),
    'tig' => 
    array (
      'name' => 'Tigre',
      'script' => 'Ethi',
      'native' => 'ትግረ',
      'regional' => 'tig_ER',
      'code' => 'tig',
    ),
    'ti' => 
    array (
      'name' => 'Tigrinya',
      'script' => 'Ethi',
      'native' => 'ትግርኛ',
      'regional' => 'ti_ET',
      'code' => 'ti',
    ),
    'am' => 
    array (
      'name' => 'Amharic',
      'script' => 'Ethi',
      'native' => 'አማርኛ',
      'regional' => 'am_ET',
      'code' => 'am',
    ),
    'wal' => 
    array (
      'name' => 'Wolaytta',
      'script' => 'Ethi',
      'native' => 'ወላይታቱ',
      'regional' => 'wal_ET',
      'code' => 'wal',
    ),
    'chr' => 
    array (
      'name' => 'Cherokee',
      'script' => 'Cher',
      'native' => 'ᏣᎳᎩ',
      'regional' => '',
      'code' => 'chr',
    ),
    'iu' => 
    array (
      'name' => 'Inuktitut (Canadian Aboriginal Syllabics]',
      'script' => 'Cans',
      'native' => 'ᐃᓄᒃᑎᑐᑦ',
      'regional' => 'iu_CA',
      'code' => 'iu',
    ),
    'oj' => 
    array (
      'name' => 'Ojibwa',
      'script' => 'Cans',
      'native' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
      'regional' => '',
      'code' => 'oj',
    ),
    'cr' => 
    array (
      'name' => 'Cree',
      'script' => 'Cans',
      'native' => 'ᓀᐦᐃᔭᐍᐏᐣ',
      'regional' => '',
      'code' => 'cr',
    ),
    'km' => 
    array (
      'name' => 'Khmer',
      'script' => 'Khmr',
      'native' => 'ភាសាខ្មែរ',
      'regional' => 'km_KH',
      'code' => 'km',
    ),
    'mn-Mong' => 
    array (
      'name' => 'Mongolian (Mongolian]',
      'script' => 'Mong',
      'native' => 'ᠮᠣᠨᠭᠭᠣᠯ ᠬᠡᠯᠡ',
      'regional' => 'mn_MN',
      'code' => 'mn-Mong',
    ),
    'shi-Tfng' => 
    array (
      'name' => 'Tachelhit (Tifinagh]',
      'script' => 'Tfng',
      'native' => 'ⵜⴰⵎⴰⵣⵉⵖⵜ',
      'regional' => '',
      'code' => 'shi-Tfng',
    ),
    'tzm' => 
    array (
      'name' => 'Central Atlas Tamazight (Tifinagh]',
      'script' => 'Tfng',
      'native' => 'ⵜⴰⵎⴰⵣⵉⵖⵜ',
      'regional' => '',
      'code' => 'tzm',
    ),
    'yue' => 
    array (
      'name' => 'Yue',
      'script' => 'Hant',
      'native' => '廣州話',
      'regional' => 'yue_HK',
      'code' => 'yue',
    ),
    'ja' => 
    array (
      'name' => 'Japanese',
      'script' => 'Jpan',
      'native' => '日本語',
      'regional' => 'ja_JP',
      'code' => 'ja',
    ),
    'zh' => 
    array (
      'name' => 'Chinese (Simplified]',
      'script' => 'Hans',
      'native' => '简体中文',
      'regional' => 'zh_CN',
      'code' => 'zh',
    ),
    'zh-Hant' => 
    array (
      'name' => 'Chinese (Traditional]',
      'script' => 'Hant',
      'native' => '繁體中文',
      'regional' => 'zh_CN',
      'code' => 'zh-Hant',
    ),
    'ii' => 
    array (
      'name' => 'Sichuan Yi',
      'script' => 'Yiii',
      'native' => 'ꆈꌠꉙ',
      'regional' => '',
      'code' => 'ii',
    ),
    'vai' => 
    array (
      'name' => 'Vai (Vai]',
      'script' => 'Vaii',
      'native' => 'ꕙꔤ',
      'regional' => '',
      'code' => 'vai',
    ),
    'jv-Java' => 
    array (
      'name' => 'Javanese (Javanese]',
      'script' => 'Java',
      'native' => 'ꦧꦱꦗꦮ',
      'regional' => '',
      'code' => 'jv-Java',
    ),
    'ko' => 
    array (
      'name' => 'Korean',
      'script' => 'Hang',
      'native' => '한국어',
      'regional' => 'ko_KR',
      'code' => 'ko',
    ),
  ),
  'plugin' => 
  array (
    'stubs' => 
    array (
      'enabled' => true,
      'files' => 
      array (
        'routes/admin' => 'src/routes/admin.php',
        'routes/api' => 'src/routes/api.php',
        'routes/web' => 'src/routes/web.php',
        'views/index' => 'src/resources/views/index.blade.php',
        'lang/en' => 'src/resources/lang/en/content.php',
        'composer' => 'composer.json',
        'webpack' => 'webpack.mix.js',
        'package' => 'package.json',
      ),
      'replacements' => 
      array (
        'routes/admin' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'routes/api' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'routes/web' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'webpack' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'json' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'MODULE_NAMESPACE',
          3 => 'PROVIDER_NAMESPACE',
        ),
        'views/index' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'views/master' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'composer' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'SNAKE_NAME',
          3 => 'VENDOR',
          4 => 'AUTHOR_NAME',
          5 => 'AUTHOR_EMAIL',
          6 => 'MODULE_NAME',
          7 => 'MODULE_NAMESPACE',
          8 => 'PROVIDER_NAMESPACE',
          9 => 'MODULE_DOMAIN',
        ),
      ),
    ),
    'paths' => 
    array (
      'generator' => 
      array (
        'config' => 
        array (
          'path' => 'Config',
          'generate' => false,
        ),
        'command' => 
        array (
          'path' => 'src/Commands',
          'generate' => false,
        ),
        'action' => 
        array (
          'path' => 'src/Actions',
          'generate' => true,
        ),
        'migration' => 
        array (
          'path' => 'database/migrations',
          'generate' => true,
        ),
        'seeder' => 
        array (
          'path' => 'database/seeders',
          'generate' => true,
        ),
        'factory' => 
        array (
          'path' => 'database/factories',
          'generate' => true,
        ),
        'model' => 
        array (
          'path' => 'src/Models',
          'generate' => true,
        ),
        'routes' => 
        array (
          'path' => 'src/routes',
          'generate' => true,
        ),
        'controller' => 
        array (
          'path' => 'src/Http/Controllers',
          'generate' => true,
        ),
        'filter' => 
        array (
          'path' => 'src/Http/Middleware',
          'generate' => false,
        ),
        'request' => 
        array (
          'path' => 'src/Http/Requests',
          'generate' => true,
        ),
        'datatable' => 
        array (
          'path' => 'src/Http/Datatables',
          'generate' => true,
        ),
        'provider' => 
        array (
          'path' => 'src/Providers',
          'generate' => true,
        ),
        'assets' => 
        array (
          'path' => 'src/resources/assets',
          'generate' => true,
        ),
        'assets_js' => 
        array (
          'path' => 'src/resources/assets/js',
          'generate' => true,
        ),
        'assets_css' => 
        array (
          'path' => 'src/resources/assets/css',
          'generate' => true,
        ),
        'lang' => 
        array (
          'path' => 'src/resources/lang',
          'generate' => true,
        ),
        'views' => 
        array (
          'path' => 'src/resources/views',
          'generate' => true,
        ),
        'test' => 
        array (
          'path' => 'tests/Unit',
          'generate' => true,
        ),
        'test-feature' => 
        array (
          'path' => 'tests/Feature',
          'generate' => true,
        ),
        'repository' => 
        array (
          'path' => 'src/Repositories',
          'generate' => false,
        ),
        'event' => 
        array (
          'path' => 'src/Events',
          'generate' => false,
        ),
        'listener' => 
        array (
          'path' => 'src/Listeners',
          'generate' => false,
        ),
        'policies' => 
        array (
          'path' => 'src/Policies',
          'generate' => false,
        ),
        'rules' => 
        array (
          'path' => 'src/Rules',
          'generate' => false,
        ),
        'jobs' => 
        array (
          'path' => 'src/Jobs',
          'generate' => false,
        ),
        'emails' => 
        array (
          'path' => 'src/Emails',
          'generate' => false,
        ),
        'notifications' => 
        array (
          'path' => 'src/Notifications',
          'generate' => false,
        ),
        'resource' => 
        array (
          'path' => 'src/Transformers',
          'generate' => false,
        ),
      ),
    ),
    'cache' => 
    array (
      'enabled' => false,
      'key' => 'juzaweb-plugins',
      'lifetime' => 60,
    ),
  ),
  'theme' => 
  array (
    'stubs' => 
    array (
      'files' => 
      array (
        'css' => 'assets/css/app.css',
        'js' => 'assets/js/app.js',
        'index' => 'views/index.blade.php',
        'post/single' => 'views/template-parts/single.blade.php',
        'page' => 'views/template-parts/single-page.blade.php',
        'taxonomy' => 'views/taxonomy.blade.php',
        'single' => 'views/single.blade.php',
        'profile' => 'views/profile/index.blade.php',
        'content' => 'views/template-parts/content.blade.php',
        'lang' => 'lang/en/content.php',
        'home' => 'templates/home.blade.php',
      ),
      'folders' => 
      array (
        'views' => 'views',
        'views/auth' => 'views/auth',
        'views/profile' => 'views/profile',
        'views/template-parts' => 'views/template-parts',
        'templates' => 'templates',
        'lang' => 'lang',
        'lang/en' => 'lang/en',
        'assets' => 'assets',
        'css' => 'assets/css',
        'js' => 'assets/js',
        'img' => 'assets/images',
      ),
    ),
  ),
  'l5-swagger' => 
  array (
    'api' => 
    array (
      'title' => 'L5 Swagger UI',
    ),
    'routes' => 
    array (
      'api' => 'api/documentation',
      'docs' => 'docs',
      'oauth2_callback' => 'api/oauth2-callback',
      'middleware' => 
      array (
        'api' => 
        array (
        ),
        'asset' => 
        array (
        ),
        'docs' => 
        array (
        ),
        'oauth2_callback' => 
        array (
        ),
      ),
    ),
    'paths' => 
    array (
      'docs' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/api-docs',
      'docs_json' => 'api-docs.json',
      'docs_yaml' => 'api-docs.yaml',
      'annotations' => 
      array (
        0 => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/app',
      ),
      'views' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/resources/views/vendor/l5-swagger',
      'base' => NULL,
      'swagger_ui_assets_path' => 'vendor/swagger-api/swagger-ui/dist/',
      'excludes' => 
      array (
      ),
    ),
    'security' => 
    array (
    ),
    'generate_always' => false,
    'generate_yaml_copy' => false,
    'swagger_version' => '3.0',
    'proxy' => false,
    'additional_config_url' => NULL,
    'operations_sort' => NULL,
    'validator_url' => NULL,
    'constants' => 
    array (
      'L5_SWAGGER_CONST_HOST' => 'http://my-default-host.com',
    ),
  ),
  'chunk-upload' => 
  array (
    'storage' => 
    array (
      'chunks' => 'chunks',
      'disk' => 'local',
    ),
    'clear' => 
    array (
      'timestamp' => '-3 HOURS',
      'schedule' => 
      array (
        'enabled' => true,
        'cron' => '25 * * * *',
      ),
    ),
    'chunk' => 
    array (
      'name' => 
      array (
        'use' => 
        array (
          'session' => true,
          'browser' => false,
        ),
      ),
    ),
    'handlers' => 
    array (
      'custom' => 
      array (
      ),
      'override' => 
      array (
      ),
    ),
  ),
  'log-viewer' => 
  array (
    'storage-path' => '/home/u671249433/domains/createkwservers.com/public_html/CreateBooking/storage/logs',
    'pattern' => 
    array (
      'prefix' => 'laravel-',
      'date' => '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]',
      'extension' => '.log',
    ),
    'locale' => 'auto',
    'theme' => 'bootstrap-4',
    'route' => 
    array (
      'enabled' => false,
      'attributes' => 
      array (
        'prefix' => 'log-viewer',
        'middleware' => NULL,
      ),
    ),
    'per-page' => 30,
    'download' => 
    array (
      'prefix' => 'laravel-',
      'extension' => 'log',
    ),
    'menu' => 
    array (
      'filter-route' => 'log-viewer::logs.filter',
      'icons-enabled' => true,
    ),
    'icons' => 
    array (
      'all' => 'fa fa-fw fa-list',
      'emergency' => 'fa fa-fw fa-bug',
      'alert' => 'fa fa-fw fa-bullhorn',
      'critical' => 'fa fa-fw fa-heartbeat',
      'error' => 'fa fa-fw fa-times-circle',
      'warning' => 'fa fa-fw fa-exclamation-triangle',
      'notice' => 'fa fa-fw fa-exclamation-circle',
      'info' => 'fa fa-fw fa-info-circle',
      'debug' => 'fa fa-fw fa-life-ring',
    ),
    'colors' => 
    array (
      'levels' => 
      array (
        'empty' => '#D1D1D1',
        'all' => '#8A8A8A',
        'emergency' => '#B71C1C',
        'alert' => '#D32F2F',
        'critical' => '#F44336',
        'error' => '#FF5722',
        'warning' => '#FF9100',
        'notice' => '#4CAF50',
        'info' => '#1976D2',
        'debug' => '#90CAF9',
      ),
    ),
    'highlight' => 
    array (
      0 => '^#\\d+',
      1 => '^Stack trace:',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'jwt' => 
  array (
    'secret' => NULL,
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'exp',
      3 => 'nbf',
      4 => 'sub',
      5 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'auth' => 'Tymon\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
