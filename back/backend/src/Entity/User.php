<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $surrname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    /**
     * @var Collection<int, Experience>
     */
    #[ORM\OneToMany(targetEntity: Experience::class, mappedBy: 'user', cascade: ['persist'])]
    private Collection $experienceList;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Contact $contact = null;

    public function __construct()
    {
        $this->experienceList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurrname(): ?string
    {
        return $this->surrname;
    }

    public function setSurrname(string $surrname): static
    {
        $this->surrname = $surrname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperienceList(): Collection
    {
        return $this->experienceList;
    }

    public function addExperienceList(Experience $experienceList): static
    {
        if (!$this->experienceList->contains($experienceList)) {
            $this->experienceList->add($experienceList);
            $experienceList->setUser($this);
        }

        return $this;
    }

    public function removeExperienceList(Experience $experienceList): static
    {
        if ($this->experienceList->removeElement($experienceList)) {
            // set the owning side to null (unless already changed)
            if ($experienceList->getUser() === $this) {
                $experienceList->setUser(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        // unset the owning side of the relation if necessary
        if ($contact === null && $this->contact !== null) {
            $this->contact->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($contact !== null && $contact->getUser() !== $this) {
            $contact->setUser($this);
        }

        $this->contact = $contact;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
     return [
    '_id' => $this->id,
         'name' => $this->name,
         'surrname' => $this->surrname,
         'birthDate' => $this->birthDate,
         'experience' => $this->experienceList->toArray(),
         'contact' => $this->contact
     ];
    }


}
