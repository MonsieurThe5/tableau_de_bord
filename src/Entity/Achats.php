<?php

namespace App\Entity;

use App\Entity\Categories;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AchatsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AchatsRepository::class)]
class Achats
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lieu_achat;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom_produit;

    #[ORM\ManyToOne(inversedBy: 'achats', targetEntity: Categories::class)]
    private $categorie;

    #[ORM\Column(type: 'date')]
    private $date_achat;

    #[ORM\Column(type: 'date')]
    private $fin_garantie;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'text')]
    private $informations;

    #[ORM\Column(type: 'string', length: 255)]
    private $ticket_achat;

    
    #[ORM\OneToMany(mappedBy: 'achats', targetEntity: PhotoFactures::class, orphanRemoval: true)]
    private $photoFactures;

    #[ORM\OneToMany(mappedBy: 'achats', targetEntity: Images::class, orphanRemoval: true)]
    private $images;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $manuel_utilisation;

    public function __construct()
    {
        $this->photoFactures = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuAchat(): ?string
    {
        return $this->lieu_achat;
    }

    public function setLieuAchat(string $lieu_achat): self
    {
        $this->lieu_achat = $lieu_achat;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTime $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getFinGarantie(): ?\DateTimeInterface
    {
        return $this->fin_garantie;
    }

    public function setFinGarantie(\DateTimeInterface $fin_garantie): self
    {
        $this->fin_garantie = $fin_garantie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getInformations(): ?string
    {
        return $this->informations;
    }

    public function setInformations(string $informations): self
    {
        $this->informations = $informations;

        return $this;
    }

    public function getTicketAchat(): ?string
    {
        return $this->ticket_achat;
    }

    public function setTicketAchat(string $ticket_achat): self
    {
        $this->ticket_achat = $ticket_achat;

        return $this;
    }



    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    /*public function (?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }*/

    /**
     * @return Collection<int, PhotoFactures>
     */
    public function getPhotoFactures(): Collection
    {
        return $this->photoFactures;
    }

    public function addPhotoFacture(PhotoFactures $photoFacture): self
    {
        if (!$this->photoFactures->contains($photoFacture)) {
            $this->photoFactures[] = $photoFacture;
            $photoFacture->setAchats($this);
        }

        return $this;
    }

    public function removePhotoFacture(PhotoFactures $photoFacture): self
    {
        if ($this->photoFactures->removeElement($photoFacture)) {
            // set the owning side to null (unless already changed)
            if ($photoFacture->getAchats() === $this) {
                $photoFacture->setAchats(null);
            }
        }

        return $this;
    }

   /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAchats($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAchats() === $this) {
                $image->setAchats(null);
            }
        }

        return $this;
    }

    public function getManuelUtilisation(): ?string
    {
        return $this->manuel_utilisation;
    }

    public function setManuelUtilisation(?string $manuel_utilisation): self
    {
        $this->manuel_utilisation = $manuel_utilisation;

        return $this;
    }
}