<?php

use App\Models\Section;
use App\Repositories\SectionsRepository;
use App\Repositories\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\Table;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function database(): Connection
{
    $connectionParams = [
        'dbname' => $_ENV['DB_DATABASE'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host' => $_ENV['DB_HOST'],
        'driver' => 'pdo_mysql',
    ];

    $connection = DriverManager::getConnection($connectionParams);
    $connection->connect();

    return $connection;
}

function query(): QueryBuilder
{
    return database()->createQueryBuilder();
}

$schema = database()->getSchemaManager();

if (!$schema->tablesExist('sections1')) {
    $cvs = new Table('sections1');
    $cvs->addColumn('id', 'integer', array('autoincrement' => true));
    $cvs->setPrimaryKey(array('id'));
    $cvs->addColumn('name', 'text');
    $cvs->addColumn('content', 'text');
    $cvs->addColumn('master_id', 'integer');
    $schema->createTable($cvs);

    echo "sections1 table created\n";

} else {
    echo "sections1 table exists\n";
}

if (!$schema->tablesExist('sections2')) {
    $cvs = new Table('sections2');
    $cvs->addColumn('id', 'integer', array('autoincrement' => true));
    $cvs->setPrimaryKey(array('id'));
    $cvs->addColumn('name', 'text');
    $cvs->addColumn('content', 'text');
    $cvs->addColumn('master_id', 'integer');
    $schema->createTable($cvs);

    echo "sections2 table created\n";

} else {
    echo "sections2 table exists\n";
}

if (!$schema->tablesExist('sections3')) {
    $cvs = new Table('sections3');
    $cvs->addColumn('id', 'integer', array('autoincrement' => true));
    $cvs->setPrimaryKey(array('id'));
    $cvs->addColumn('name', 'text');
    $cvs->addColumn('content', 'text');
    $cvs->addColumn('master_id', 'integer');
    $schema->createTable($cvs);

    echo "sections3 table created\n";

} else {
    echo "sections3 table exists\n";
}

if (!$schema->tablesExist('users')) {
    $cvs = new Table('users');
    $cvs->addColumn('id', 'integer', array('autoincrement' => true));
    $cvs->setPrimaryKey(array('id'));
    $cvs->addColumn('user', 'text');
    $cvs->addColumn('password', 'text');
    $schema->createTable($cvs);

    echo "users table created\n";

} else {
    echo "users table exists\n";
}


$SecRep = new SectionsRepository();
$section1 = new Section('Section1','Example content', null,'999');
$section2 = new Section('Section2','Example content', null,'999');
$section3 = new Section('SubSection1','Example content', null,'1');
$section4 = new Section('SubSection2','Example content', null,'2');
$section5 = new Section('SubSubSection1','Example content', null,'1');
$section6 = new Section('SubSubSection2','Example content', null,'2');
$SecRep->storeOne($section1,'sections1');
$SecRep->storeOne($section2,'sections1');
$SecRep->storeOne($section3,'sections2');
$SecRep->storeOne($section4,'sections2');
$SecRep->storeOne($section5,'sections3');
$SecRep->storeOne($section6,'sections3');

$UserRep = new UserRepository();
$UserRep->addUser('admin','admin');

echo "All done!\n";