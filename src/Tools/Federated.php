<?php

namespace AoScrud\Tools;

use DB;

class Federated
{

    protected $host;
    protected $port;
    protected $db;
    protected $user;
    protected $password;

    public function __construct($host = null, $port = null, $db = null, $user = null, $password = null)
    {
        $host ? $this->host($host) : $this->host(env('DB_HOST', 'localhost'));
        $port ? $this->port($port) : $this->port(env('DB_PORT', '3306'));
        $db ? $this->db($db) : $this->db(env('DB_DATABASE', 'homestead'));
        $user ? $this->user($user) : $this->user(env('DB_USERNAME', 'homestead'));
        $password ? $this->password($password) : $this->password(env('DB_PASSWORD', 'secret'));
    }

    public function host($host = null)
    {
        if (is_null($host))
            return $this->host;

        $this->host = $host;
        return $this;
    }

    public function port($port = null)
    {
        if (is_null($port))
            return $this->port;

        $this->port = $port;
        return $this;
    }

    public function db($db = null)
    {
        if (is_null($db))
            return $this->db;

        $this->db = $db;
        return $this;
    }

    public function user($user = null)
    {
        if (is_null($user))
            return $this->user;

        $this->user = $user;
        return $this;
    }

    public function password($password = null)
    {
        if (is_null($password))
            return $this->password;

        $this->password = $password;
        return $this;
    }

    public function conn()
    {
        return 'mysql://' . $this->user() . ':' . $this->password() . '@' . $this->host() . ':' . $this->port() . '/' . $this->db();
    }

    public function transform($slave, $master = null)
    {
        if (is_null($master))
            $master = $slave;

        $result = DB::select('SHOW CREATE TABLE ' . $slave);

        $sql = $result[0]->{'Create Table'};
        $sql = str_replace('ENGINE=InnoDB', "ENGINE=FEDERATED CONNECTION='{$this->conn()}/$master'", $sql);

        DB::select('SET foreign_key_checks = 0');
        DB::statement('DROP TABLE ' . $slave);
        DB::statement($sql);
        DB::select('SET foreign_key_checks = 1');
    }

}