<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use Doctrine\Migrations\Tools\Console\Command;
use Symfony\Component\Console\Application;

if ('cli' !== PHP_SAPI) {
    exit('Access denied');
}

require __DIR__.'/../vendor/autoload.php';

$input = new \Symfony\Component\Console\Input\ArgvInput();

require __DIR__.'/../config/settings.php';

$dbParams = [
    'dbname' => $settings['db']['dbname'],
    'user' => $settings['db']['user'],
    'password' => $settings['db']['password'],
    'host' => $settings['db']['host'],
    'driver' => $settings['db']['driver'],
];

$connection = DriverManager::getConnection($dbParams);

$configuration = new Configuration($connection);

$configuration->addMigrationsDirectory('Migrations', __DIR__.'/../migrations/DoctrineMigrations');

$configuration->setAllOrNothing(true);
$configuration->setCheckDatabasePlatform(false);

$storageConfiguration = new TableMetadataStorageConfiguration();
$storageConfiguration->setTableName('doctrine_migration_versions');

$configuration->setMetadataStorageConfiguration($storageConfiguration);

$dependencyFactory = DependencyFactory::fromConnection(
    new ExistingConfiguration($configuration),
    new ExistingConnection($connection)
);

$cli = new Application('Doctrine Migrations');
$cli->setCatchExceptions(true);

$cli->addCommands(array(
    new Command\DumpSchemaCommand($dependencyFactory),
    new Command\ExecuteCommand($dependencyFactory),
    new Command\GenerateCommand($dependencyFactory),
    new Command\LatestCommand($dependencyFactory),
    new Command\ListCommand($dependencyFactory),
    new Command\MigrateCommand($dependencyFactory),
    new Command\RollupCommand($dependencyFactory),
    new Command\StatusCommand($dependencyFactory),
    new Command\SyncMetadataCommand($dependencyFactory),
    new Command\VersionCommand($dependencyFactory),
));

$cli->run();
