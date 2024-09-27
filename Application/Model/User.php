<?php

namespace Application\Model;

use Core\Db;
use Core\Session;

class User
{
    const SESSION_CURRENT_USER = 'current_user_id';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var $this|null
     */
    private static $currentUser = null;

    /**
     * @param int $id
     * @param string $name
     * @param int $number
     */
    public function __construct($id, $name, $number)
    {
        $this->id = (int)$id;
        $this->name = $name;
        $this->number = (int)$number;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Increase number by 1
     * @return int
     */
    public function addNumber()
    {
        Db::query("UPDATE user SET number = ? WHERE id = ?", [++$this->number, $this->getId()]);

        return $this->getNumber();
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function login($username, $password)
    {
        if ($row = self::getUserDataByName($username)) {
            if (password_verify($password, $row['password'])) {
                Session::set(self::SESSION_CURRENT_USER, $row['id']);
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $username
     * @return mixed
     */
    public static function getUserDataByName($username)
    {
        return Db::fetch("SELECT * FROM user WHERE name = ?", [$username]);
    }

    /**
     * @param string $username
     * @return bool
     */
    public static function exists($username)
    {
        return !!self::getUserDataByName($username);
    }

    /**
     * @param string $username
     * @param string $password
     * @return void
     */
    public static function create($username, $password)
    {
        Db::query("INSERT INTO user (name, password) VALUES (?,?)", [$username, password_hash($password, PASSWORD_BCRYPT)]);
    }

    /**
     * Get logged in user instance
     * @return self|null
     */
    public static function getCurrentUser()
    {
        if (self::$currentUser === null) {
            if ($id = Session::get(self::SESSION_CURRENT_USER)) {
                if ($row = Db::fetch("SELECT * FROM user WHERE id = ?", [$id])) {
                    self::$currentUser = new self($row['id'], $row['name'], $row['number']);
                }
            }
        }

        return self::$currentUser;
    }

    /**
     * @return void
     */
    public static function logOut()
    {
        self::resetCurrentUser();
        Session::delete(self::SESSION_CURRENT_USER);
    }

    /**
     * @return void
     */
    public static function resetCurrentUser() {
        self::$currentUser = null;
    }
}