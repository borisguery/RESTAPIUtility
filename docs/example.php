<?php

require_once __DIR__ . '/../vendor/autoload.php';

//
$rb = new \Bgy\Resource\ResourceBuilder();

/* ----------------------- With a stdClass object ------------------------------- */

$user = new stdClass();

$friend = new stdClass();
$friend->username = 'John';
$friend->email = 'john@doe.net';

$user->username = 'Boris';
$user->email = 'guery.b@gmail.com';
$user->friends = array(
    $friend
);

$objects = array();

foreach (array($user, $friend) as $o) {
    $builder = $rb->create()
        ->newField('member_name')
//            ->using($objet)
            ->withValue($o->username)
            ->populateIf(function($value){
                if ('John' !== $value) {
                    return true;
                }

                return false;
            })
            ->transformWith(function($value){
                $value = strtolower($value);

                return $value;
            })
        ->end()
    ;

    $objects[] = $builder->build();
}

print_r($objects);

/* ----------------------- With a custom object ------------------------------- */

class User {

    private $name;

    public function setUsername($username)
    {
        $this->name = $username;

        return $this;
    }
}

$builder = $rb->create()->using(new User())
    ->newField('username')
        ->withValue('Boris Guéry')
    ->end()
;

print_r($builder->build());

/* ----------------------- Factory ------------------------------- */

class UserEntity {

    private $username;
    private $email;
    private $groups = array();

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}

class UserResource {

    private $username;
    private $email;
    private $groups = array();

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
}

class UserResourceFactory {

    static public function create(UserEntity $user)
    {
        $builder = \Bgy\Resource\ResourceBuilder::create()->using(new UserResource())
            ->newField('username')
            ->withValue($user->getUsername())
            ->end()
            ->newField('email')
            ->withValue($user->getEmail())
                ->transformWith(function($email) {
                    if (false !== $pos = strpos($email, '@')) {
                        $email = '...' . substr($email, $pos);
                    }

                    return $email;
                })
            ->end()
        ;

        return $builder->build();
    }
}

// fresh UserEntity from Database

$userEntity = new UserEntity();
$userEntity->setEmail('guery.b@gmail.com');
$userEntity->setUsername('borisguery');

print_r(UserResourceFactory::create($userEntity));

//$userResource = $this->container->get('user_resource.factory')->create($userEntity);
