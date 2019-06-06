<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

class UserModel implements UserInterface
{
    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var \DateTime
     */
    protected $memberSince;

    /**
     * @var bool
     */
    protected $isOnline = false;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $username
     * @param string $avatar
     * @param \DateTime $memberSince
     * @param bool $isOnline
     * @param string $name
     * @param string $title
     */
    public function __construct($username = '', $avatar = '', $memberSince = null, $isOnline = true, $name = '', $title = '')
    {
        $this->username = $username;
        $this->avatar = $avatar;
        $this->memberSince = $memberSince ?: new \DateTime();
        $this->isOnline = $isOnline;
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return UserModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $avatar
     *
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param bool $isOnline
     *
     * @return $this
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * @param \DateTime $memberSince
     *
     * @return $this
     */
    public function setMemberSince(\DateTime $memberSince)
    {
        $this->memberSince = $memberSince;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isOnline()
    {
        return $this->getIsOnline();
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        if (!empty($this->id)) {
            return $this->id;
        }

        return str_replace(' ', '-', $this->getUsername());
    }
}
