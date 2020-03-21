<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $qte01;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    private $ajout;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="paniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function __construct($produit){
        $this->setProduit($produit);
        $this->ajout = new \DateTime();
        $this->setEtat(false);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte01(): ?string
    {
        return $this->qte01;
    }

    public function setQte01(string $qte01): self
    {
        $this->qte01 = $qte01;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getAjout(): ?\DateTimeInterface
    {
        return $this->ajout;
    }

    public function setAjout(\DateTimeInterface $ajout): self
    {
        $this->ajout = $ajout;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
