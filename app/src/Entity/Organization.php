<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 */
class Organization
{
    /**
     * @ORM\Id()
     * @Groups({"Organization:read"})
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid", unique=true)
     */
    private $id;

    /**
     * @Groups({"Organization:read", "User:read:item"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var Collection $users
     * @Groups({"Organization:read:item"})
     * @ApiSubresource
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    private $users;


    /**
     * Organization constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Organization $organization): self
    {
        if (!$this->users->contains($organization)) {
            $this->users->add($organization);
        }

        return $this;
    }

    public function removeUser(Organization $organization): self
    {
        if ($this->users->contains($organization)) {
            $this->users->removeElement($organization);
        }

        return $this;
    }
}
