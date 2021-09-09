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


class ApiCuisineController extends AbstractController
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
 * @Route("/api/recette/", name="api_recette_add",methods="POST")
 */
 public function ajouterUneRecette(EntityManagerInterface $entityManager, Request $request,
  SerializerInterface $serializer, ValidatorInterface $validator) 
  {
  $disponible = $request->getContent();
  $nouvelleRecette = $serializer->deserialize($disponible, Person::class, 'json');
  $entityManager->persist($nouvelleRecette);
  $entityManager->flush();
  return $this->json($nouvelleRecette, 201, [],
 ['groups' => 'recette:read']);
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
 * @Route("/api/ingredient/", name="api_ingredient_add",methods="POST")
 */
 public function ajouterUnIngredient(EntityManagerInterface $entityManager, Request $request,SerializerInterface $serializer, ValidatorInterface $validator) 
 {
 $ingredientDisponible = $request->getContent();
 $nouvelIngredient = $serializer->deserialize($ingredientDisponible, Ingredient::class, 'json');
 $entityManager->persist($nouvelIngredient);
 $entityManager->flush();
 return $this->json($nouvelIngredient, 201, [],
['groups' => 'ingredient:read']);
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
