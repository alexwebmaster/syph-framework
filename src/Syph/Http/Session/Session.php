<?php
/**
 * Created by PhpStorm.
 * User: prapa
 * Date: 04/04/2016
 * Time: 12:58
 */

namespace Syph\Http\Session;


use Syph\DependencyInjection\ServiceInterface;
use Syph\Http\Session\Storage\SessionBottle;
use Syph\Http\Session\Storage\SessionStorage;

class Session implements SessionInterface,ServiceInterface
{

    private $id;
    private $start = false;
    private $bottle;
    private $bottleName;
    /**
     * @var SessionStorage
     */
    private $storage;

    /**
     * Session constructor.
     * @param $storage
     */
    public function __construct(SessionStorage $storage = null,SessionBottle $bottle = null)
    {
        $this->storage = $storage ?: new SessionStorage();
        $this->bottle = $bottle ?: new SessionBottle();

        $this->bottleName = $this->bottle->getName();

        $this->register($this->bottle);
    }

    public function start()
    {
        $this->storage->start();
    }


    public function getId()
    {
        $this->storage->getId();
    }

    public function setId($id)
    {
        $this->storage->setId($id);
    }

    public function getSessionName()
    {
        $this->storage->getName();
    }

    public function setSessionName($name)
    {
        $this->storage->setName($name);
    }

    public function set($name, $value)
    {
        $this->storage->getBottle($this->bottleName)->set($name, $value);
    }

    public function get($name)
    {
        return $this->storage->getBottle($this->bottleName)->get($name);
    }

    public function has($name)
    {
        $this->storage->getBottle($this->bottleName)->has($name);
    }

    public function getAll()
    {
        $this->storage->getBottle($this->bottleName)->all();
    }

    public function remove($name){
        $this->storage->getBottle($this->bottleName)->remove($name);
    }

    public function clear()
    {
        $this->storage->clear();
    }

    public function register($bottle)
    {
        $this->storage->registerBottle($bottle);
    }

    public function save()
    {
        $this->storage->save();
    }

    public function getName()
    {
        return 'http.session';
    }

    public function getBottle()
    {
        return $this->storage->getBottle($this->bottleName);
    }
}