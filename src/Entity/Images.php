<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    

   /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    
    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    /**
     * @ORM\Column(type="boolean")
     */

    private $active;

    /**
     * @ORM\OneToMany(targetEntity=Parametre::class, mappedBy="logo")
     */
    private $parametres;

    /**
     * @ORM\OneToMany(targetEntity=Reference::class, mappedBy="logo")
     */
    private $reference;

    public function __construct()
    {
        $this->parametres = new ArrayCollection();
        $this->reference = new ArrayCollection();
    }

   
    public function __toString()
    {
        return $this->name;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }
    
    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Parametre[]
     */
    public function getParametres(): Collection
    {
        return $this->parametres;
    }

    public function addParametre(Parametre $parametre): self
    {
        if (!$this->parametres->contains($parametre)) {
            $this->parametres[] = $parametre;
            $parametre->setLogo($this);
        }

        return $this;
    }

    public function removeParametre(Parametre $parametre): self
    {
        if ($this->parametres->removeElement($parametre)) {
            // set the owning side to null (unless already changed)
            if ($parametre->getLogo() === $this) {
                $parametre->setLogo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reference[]
     */
    public function getReference(): Collection
    {
        return $this->reference;
    }

    public function addReference(Reference $reference): self
    {
        if (!$this->reference->contains($reference)) {
            $this->reference[] = $reference;
            $reference->setLogo($this);
        }

        return $this;
    }

    public function removeReference(Reference $reference): self
    {
        if ($this->reference->removeElement($reference)) {
            // set the owning side to null (unless already changed)
            if ($reference->getLogo() === $this) {
                $reference->setLogo(null);
            }
        }

        return $this;
    }

  
    
}
