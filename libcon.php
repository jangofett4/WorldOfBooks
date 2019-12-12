<?php

use Google\Cloud\Datastore\DatastoreClient;

class DSConnection {
    // @var DatastoreClient $connection
    private static $connection;

    public static function open_or_get() : DatastoreClient
    {
        if (!isset(DSConnection::$connection))
        {
            DSConnection::$connection = new DatastoreClient([
                "keyFile" => json_decode(file_get_contents("worldofbooks-keys.json"), true)
            ]);
        }

        return DSConnection::$connection;
    }
}

?>