<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\Cache;

/**
 * @Entity
 * @Table("cache_login")
 */
class Login
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id;

    /**
     * @var string
     * @Column
     */
    public $name;

    /**
     * @var Token
     * @ManyToOne(targetEntity="Token", cascade={"persist", "remove"}, inversedBy="logins")
     * @JoinColumn(name="token_id", referencedColumnName="token")
     */
    public $token;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getToken(): Token
    {
        return $this->token;
    }
}
