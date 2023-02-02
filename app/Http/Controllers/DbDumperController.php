<?php

namespace App\Http\Controllers;


use App\DbDumper\Compressors\GzipCompressor;
use App\DbDumper\Databases\MySql;

class DbDumperController extends Controller
{
    public function dump()
    {
        MySql::create()
            ->setDbName(config('database.connections.mysql.database'))
            ->setUserName(config('database.connections.mysql.username'))
            ->setPassword(config('database.connections.mysql.password'))
            ->useCompressor(new GzipCompressor())
            ->dumpToFile(public_path('storage/dump.sql.gz'));
        $file = 'dump.sql.gz';

        $headers = [
            "Content-Type" => "application/gzip",
            "Content-Transfer-Encoding" => "binary",
            "Content-Encoding" => "gzip",
            "Content-Disposition" => "attachment; filename=\"" . $file . "\"",
            "Content-Description" => "File Transfer",
            "Content-Length" => filesize($file)
        ];

        return response()->download(public_path("storage/$file"), $file, $headers)->deleteFileAfterSend(true);
    }
}
