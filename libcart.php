<?php

use Google\Cloud\Datastore\Entity;

require_once "libcon.php";
require_once "libssn.php";

class LibCart
{
    public static $con = null;
    /** @var Entity $user */
    public static $user = null;
    public static $ssncart = null;
    public static $islogged = false;

    public static function init()
    {
        LibCart::$islogged = LibSSN::getnd("logged");

        if (LibCart::$islogged) {
            LibCart::$con = DSConnection::open_or_get();
            LibCart::$user = LibCart::$con->lookup(LibCart::$con->key("UserInfo", LibSSN::getvnd("user_key")));
            LibCart::$ssncart = LibSSN::getvnd("cart");
            if (!isset(LibCart::$user["cart"])) {
                if (LibCart::$ssncart != null)
                {
                    LibCart::$user["cart"] = LibCart::$ssncart;
                    LibSSN::setv("user_cart", LibCart::$ssncart);
                }
                else
                {
                    LibCart::$user["cart"] = array();
                    LibSSN::setv("user_cart", array());
                }
                
                LibSSN::unset("cart");
                LibCart::$ssncart = null;

                $user = LibCart::$user;
                /** @var Entity $user */ // dumb intelliphense
                LibCart::$con->update($user);
            } else {
                if (LibCart::$ssncart != null) {
                    $usercart = LibCart::$user["cart"];
                    $scart = LibSSN::getvnd("user_cart");
                    foreach (LibCart::$ssncart as $key => $item)
                        if (!isset($usercart[$key]))
                        {
                            $usercart[$key] = $item;
                            $scart[$key] = $item;
                            LibSSN::setv("user_cart", $scart);
                        }
                    $user = LibCart::$user;
                    $user["cart"] = $usercart;
                    LibSSN::setv("user_cart", $scart);
                    /** @var Entity $user */ // dumb intelliphense
                    LibCart::$con->update($user);
                    LibCart::$ssncart == null; // empty session cart
                    LibSSN::unset("cart");
                }
            }
        }
        else
        {
            if (LibSSN::getvnd("cart") == null)
                LibSSN::setv("cart", array());
        }

        if (LibCart::$ssncart == null)
        {
            LibCart::$ssncart = LibSSN::getvnd("cart");
            if (LibCart::$ssncart == null)
                $cart = array();
        }
    }

    public static function add($book, $count)
    {
        if (LibCart::$islogged)
        {
            if (isset(LibCart::$user["cart"][$book]))
            {
                $cart = LibCart::$user["cart"];
                $cart[$book] += $count;
                $scart = LibSSN::getvnd("user_cart");
                $scart[$book] += $count;
                LibSSN::setv("user_cart", $scart);
                LibCart::$user["cart"] = $cart;
            }
            else
            {
                $cart = LibCart::$user["cart"];
                $cart[$book] = $count;
                $scart = LibSSN::getvnd("user_cart");
                $scart[$book] = $count;
                LibSSN::setv("user_cart", $scart);
                LibCart::$user["cart"] = $cart;
            }
            LibCart::$con->update(LibCart::$user);
        }
        else
        {
            echo $book;
            echo ' ';
            echo $count;
            if (isset(LibCart::$ssncart[$book]))
            {
                LibCart::$ssncart[$book] += $count;
                LibSSN::setv("cart", LibCart::$ssncart);
            }
            else
            {
                LibCart::$ssncart[$book] = $count;
                LibSSN::setv("cart", LibCart::$ssncart);
            }
        }
    }

    public static function remove($book)
    {
        if (LibCart::$islogged)
        {
            if (isset(LibCart::$user["cart"][$book]))
            {
                $cart = LibCart::$user["cart"];
                unset($cart[$book]);
                $scart = LibSSN::getvnd("user_cart");
                unset($scart[$book]);
                LibSSN::setv("user_cart", $scart);
                LibCart::$user["cart"] = $cart;
            }
            LibCart::$con->update(LibCart::$user);
        }
        else
            if (isset(LibCart::$ssncart[$book]))
            {
                unset(LibCart::$ssncart[$book]);
                LibSSN::setv("cart", LibCart::$ssncart);
            }
    }
}