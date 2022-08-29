<?php

namespace Model\Repository;

use Model\Entity;

class UserIdentityMap
{
    private $identityMap = [];

    public function add(Entity\User $obj)
    {
        $id = $obj->getId();
        $this->identityMap[$id] = $obj;
    }
    public function get(int $id)
    {
        if (isset($this->identityMap[$id])) {
            return $this->identityMap[$id];
        }
        throw new \Exception();
    }
}
