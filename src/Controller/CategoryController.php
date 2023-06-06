<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CategoryType;


#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController

{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, CategoryRepository $categoryRepository) : Response

    {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        // Create the form, linked with $category

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        // Was the form submitted ?
    
        if ($form->isSubmitted()) {
            $categoryRepository->save($category, true);            

            // Deal with the submitted data
    
            // For example : persiste & flush the entity
    
            // And redirect to a route that display the result
    
        }

        // Render the form


        return $this->render('category/new.html.twig', [

            'form' => $form,

        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): response
    {

        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException('No program of such : ' . $categoryName . ' found in category\'s table.');
        }

        $programs = $programRepository->findBy(['category' => $category]);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }
}
