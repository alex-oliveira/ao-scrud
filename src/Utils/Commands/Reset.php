<?php

namespace AoScrud\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class Reset extends Command
{

    protected $signature = 'app:reset';

    protected $description = 'Command description';

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
        $this->DBCleaner();
        $this->MigrateCleaner();
        $this->SeedCleaner();
    }

    //------------------------------------------------------------------------------------------------------------------
    // Migrate Cleaner
    //------------------------------------------------------------------------------------------------------------------

    public function MigrateCleaner()
    {

    }

    //------------------------------------------------------------------------------------------------------------------
    // Seed Cleaner
    //------------------------------------------------------------------------------------------------------------------

    public function SeedCleaner()
    {

    }

    //------------------------------------------------------------------------------------------------------------------
    // DB Cleaner
    //------------------------------------------------------------------------------------------------------------------

    public function DBCleaner()
    {
        switch (env('DB_CONNECTION')) {
            case 'mysql':
                $this->MySQLCleaner();
                break;
            case 'sqlite':
                $this->MySQLCleaner();
                break;
            case 'postgres':
                $this->MySQLCleaner();
                break;
            case 'sqlsrv':
                $this->MySQLCleaner();
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