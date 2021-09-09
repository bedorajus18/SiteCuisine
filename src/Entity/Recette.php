<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\RelationIngredientRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups ;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=255)
    * @Groups("recette:read")
    * @Groups("ingredient:read")"
    */
    private $titre;
    
    /**
     * @ORM\Column(type="string")
     * @Groups("recette:read")
     * @Groups("ingredient:read")
     */
    private $resume;


    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="recette")
     * @Groups("recette:read")
     * @Groups("ingredient:read")
     */
    private $operations;

    /**
     * @ORM\OneToMany(targetEntity=RelationIngredientRecette::class, mappedBy="recettes", orphanRemoval=true)
     * @Groups("recette:read")
     */
    private $recetteIngredients;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->recetteIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setRecette($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getRecette() === $this) {
                $operation->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecetteIngredient[]
     */
    public function getRecetteEntities(): Collection
    {
        return $this->recetteIngredients;
    }

    public function addRecetteIngredient(RecetteIngredient $recetteIngredient): self
    {
        if (!$this->recetteIngredients->contains($recetteIngredient)) {
            $this->recetteIngredients[] = $recetteIngredient;
            $recetteIngredient->setRecettes($this);
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): self
    {
        if ($this->recetteIngredients->removeElement($recetteIngredients)) {
            // set the owning side to null (unless already changed)
            if ($recetteIngredient->getRecettes() === $this) {
                $recetteIngredient->setRecettes(null);
            }
        }

        return $this;
    }
}
