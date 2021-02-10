<?php

namespace App\Entity;

use App\Repository\ParametreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametreRepository::class)
 */
class Parametre
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $header;

    /**
     * @ORM\Column(type="text")
     */
    private $accroche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $footer;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $introTitre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $introText;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $widgetText;

    /**
     * @ORM\ManyToOne(targetEntity=Images::class, inversedBy="parametres")
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerfacebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerTwitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FooterLinkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerTitre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $footerText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerDribbble;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerGithub;

    
    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getAccroche(): ?string
    {
        return $this->accroche;
    }

    public function setAccroche(string $accroche): self
    {
        $this->accroche = $accroche;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    
    public function getIntroTitre(): ?string
    {
        return $this->introTitre;
    }

    public function setIntroTitre(?string $introTitre): self
    {
        $this->introTitre = $introTitre;

        return $this;
    }

    public function getIntroText(): ?string
    {
        return $this->introText;
    }

    public function setIntroText(?string $introText): self
    {
        $this->introText = $introText;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWidgetText(): ?string
    {
        return $this->widgetText;
    }

    public function setWidgetText(?string $widgetText): self
    {
        $this->widgetText = $widgetText;

        return $this;
    }

    public function getLogo(): ?Images
    {
        return $this->logo;
    }

    public function setLogo(?Images $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getFooterfacebook(): ?string
    {
        return $this->footerfacebook;
    }

    public function setFooterfacebook(?string $footerfacebook): self
    {
        $this->footerfacebook = $footerfacebook;

        return $this;
    }

    public function getFooterTwitter(): ?string
    {
        return $this->footerTwitter;
    }

    public function setFooterTwitter(?string $footerTwitter): self
    {
        $this->footerTwitter = $footerTwitter;

        return $this;
    }

    public function getFooterLinkedin(): ?string
    {
        return $this->FooterLinkedin;
    }

    public function setFooterLinkedin(?string $FooterLinkedin): self
    {
        $this->FooterLinkedin = $FooterLinkedin;

        return $this;
    }

    public function getFooterTitre(): ?string
    {
        return $this->footerTitre;
    }

    public function setFooterTitre(?string $footerTitre): self
    {
        $this->footerTitre = $footerTitre;

        return $this;
    }

    public function getFooterText(): ?string
    {
        return $this->footerText;
    }

    public function setFooterText(?string $footerText): self
    {
        $this->footerText = $footerText;

        return $this;
    }

    public function getFooterDribbble(): ?string
    {
        return $this->footerDribbble;
    }

    public function setFooterDribbble(?string $footerDribbble): self
    {
        $this->footerDribbble = $footerDribbble;

        return $this;
    }

    public function getFooterGithub(): ?string
    {
        return $this->footerGithub;
    }

    public function setFooterGithub(?string $footerGithub): self
    {
        $this->footerGithub = $footerGithub;

        return $this;
    }

  
    
}
