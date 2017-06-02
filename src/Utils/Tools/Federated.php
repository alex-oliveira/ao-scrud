<?php

namespace AoScrud\Utils\Tools;

use DB;

class Federated
{
    protected $host = 'localhost';
    protected $port = '3306';
    protected $user = 'homestead';
    protected $password = 'secret';
    protected $db = 'homestead';

    public function __construct($host = null, $port = null, $user = null, $password = null, $db = null)
    {
        $this->host($host);
        $this->port($port);
        $this->user($user);
        $this->password($password);
        $this->db($db);
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

    public function db($db = null)
    {
        if (is_null($db))
            return $this->db;

        $this->db = $db;
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