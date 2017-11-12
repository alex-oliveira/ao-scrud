<?php

namespace AoScrud\Console;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class DBDropCommand extends Command
{

    protected $signature = 'ao-scrud:db-drop';

    protected $description = '';

    /**
     * @var DatabaseManager
     */
    protected $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
        parent::__construct();
    }

    public function handle()
    {
        switch (env('DB_CONNECTION')) {
            case 'mysql':
                $this->MySQLCleaner();
                break;
            case 'sqlite':
                $this->SQLiteCleaner();
                break;
            case 'postgres':
                $this->PostgresCleaner();
                break;
            case 'sqlsrv':
                $this->SQLServerCleaner();
                break;
        }
    }

    public function MySQLCleaner()
    {
        $this->db->select('SET foreign_key_checks = 0');
        $tables = $this->db->select('show tables');
        foreach ($tables as $table) {
            $table = (array)$table;
            $table = array_shift($table);
            $this->db->select('DROP TABLE ' . $table);
        }
        $this->db->select('SET foreign_key_checks = 1');
    }

    public function SQLiteCleaner()
    {
        dd('SQLiteCleaner NOT IMPLEMENTED');
    }

    public function PostgresCleaner()
    {
        dd('PostgresCleaner NOT IMPLEMENTED');
    }

    public function SQLServerCleaner()
    {
        dd('SQLServerCleaner NOT IMPLEMENTED');
    }

}