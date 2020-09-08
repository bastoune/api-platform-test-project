<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"User:read"}},
 *     denormalizationContext={"groups"={"User:write"}},
 *     graphql={
 *         "item_query"={"normalization_context"={"groups"={"User:read"}}},
 *         "collection_query"={"normalization_context"={"groups"={"User:read"}}},
 *     }
 * )
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @Groups({"User:read"})
     * @Assert\Email()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups({"User:read"})
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", nullable=true)
     */
    private $organization;


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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(?Organization $organization): self
    {
        $this->organization = $organization;

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
}
