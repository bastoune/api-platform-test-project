<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ApiResource()
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ApiProperty(identifier=true)
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid", unique=true)
     */
    private $id;

    /**
     * @Assert\Email()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sampleNullableDate = null;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * We keep using this method Until we stop implementing the UseInterface
     *
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ["ROLE_USER"];
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }



    /**
     * @return DateTimeInterface|null
     */
    public function getSampleNullableDate(): ?DateTimeInterface
    {
        return $this->sampleNullableDate;
    }

    /**
     * @param DateTimeInterface|null $sampleNullableDate
     */
    public function setSampleNullableDate(?DateTimeInterface $sampleNullableDate): void
    {
        $this->sampleNullableDate = $sampleNullableDate;
    }
}
