<?php

require_once "vendor/autoload.php";
require_once "libssn.php";

use Google\Cloud\Datastore\DatastoreClient;

class DSConnection {
    // @var DatastoreClient $connection
    private static $connection;

    public static function open_or_get() : DatastoreClient
    {
        if (!isset(DSConnection::$connection))
        {
            $keys = LibSSN::getvnd("_keys");
            if ($keys == null)
            {
                $keys = json_decode(file_get_contents("worldofbooks-keys.json"), true);
                LibSSN::setv("_keys", $keys);
            }

            DSConnection::$connection = new DatastoreClient([
                "keyFile" => $keys
            ]);
        }

        return DSConnection::$connection;
    }
}

?>