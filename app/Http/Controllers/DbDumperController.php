<?php

namespace App\Http\Controllers;

use Spatie\DbDumper\Databases\Mysql;

class DbDumperController extends Controller
{

    public function dump()
    {
        Mysql::create()
            ->setDbName(config('database.connections.mysql.database'))
            ->setUserName(config('database.connections.mysql.username'))
            ->setPassword(config('database.connections.mysql.password'))
            ->dumpToFile('dump.sql');
    }
}
