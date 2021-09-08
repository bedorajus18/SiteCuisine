<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\OperationRepository;
use App\Repository\RelationIngredientRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class ApiController extends AbstractController
{
    /**
    * @Route("/api/recette", name="api_recette", methods="GET")
    */
public function listeRecette(RecetteRepository $recetteRepository,NormalizerInterface $normalizer): Response
  {
  $recettes = $recetteRepository->findAll();
  $normalized = $normalizer->normalize($recettes,null,['groups'=>'recette:read']);
  $json = json_encode($normalized);
  $reponse = new Response($json, 200, [
  'content-type' => 'application/json'
  ]);
  return $reponse;
  }
  
 /**
 * @Route("/api/recette/{id}", name="api_recette_avec_id", methods="GET")
 */
public function TrouverUneRecette(RecetteRepository $recetteRepository,NormalizerInterface $normalizer,$id): Response
 {
 $recette = $recetteRepository->find($id);
 $normalized = $normalizer->normalize($recette,null,['groups'=>'recette:read']);
 $json = json_encode($normalized);
 $reponse = new Response($json, 200, [
 'content-type' => 'application/json'
 ]);
 return $reponse;
 }
 /**
    * @Route("/api/ingredient", name="api_ingredient", methods="GET")
    */
public function ListeIngredient(IngredientRepository $ingredientRepository,NormalizerInterface $normalizer): Response
  {
  $ingredients = $ingredientRepository->findAll();
  $normalized = $normalizer->normalize($ingredients,null,['groups'=>'ingredient:read']);
  $json = json_encode($normalized);
  $reponse = new Response($json, 200, [
  'content-type' => 'application/json'
  ]);
  return $reponse;
  }
  
 /**
 * @Route("/api/ingredient/{id}", name="api_ingredient_avec_id", methods="GET")
 */
public function TrouverUnIngredient(IngredientRepository $ingredientRepository,NormalizerInterface $normalizer,$id): Response
 {
 $ingredient = $ingredientRepository->find($id);
 $normalized = $normalizer->normalize($ingredient,null,['groups'=>'ingredient:read']);
 $json = json_encode($normalized);
 $reponse = new Response($json, 200, [
 'content-type' => 'application/json'
 ]);
 return $reponse;
 }
}
