<?php

namespace App\Entity;

use App\Repository\RelationIngredientRecetteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups ;

/**
 * @ORM\Entity(repositoryClass=RelationIngredientRecetteRepository::class)
 */
class RelationIngredientRecette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @Groups("recette:read")
     * @Groups("ingredient:read")
     */
    private $unite;

    /**
     * @ORM\Column(type="integer")
     * @Groups("recette:read")
     * @Groups("ingredient:read")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Recette::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("recette:read")
     * @Groups("ingredient:read")
     */
    private $recettes;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("ingredient:read")
     */
    private $ingredients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getRecettes(): ?Recette
    {
        return $this->recettes;
    }

    public function setRecettes(?Recette $recettes): self
    {
        $this->recettes = $recettes;

        return $this;
    }

    public function getIngredients(): ?Ingredient
    {
        return $this->ingredients;
    }

    public function setIngredients(?Ingredient $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }
}
