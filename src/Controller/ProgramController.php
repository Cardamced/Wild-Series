<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Service\ProgramDuration;
use Symfony\Component\Mime\Email;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController

{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, MailerInterface $mailer, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {

        $program = new Program();

        // Create the form, linked with $category

        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);

        // Was the form submitted ?

        if ($form->isSubmitted() && $form->isValid()) {
            $program->setSlug($slugger->slug($program->getTitle()));
            $programRepository->save($program, true);

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('your_email@example.com')
                ->subject('Une nouvelle série vient d\'être publiée !')
                ->html($this->renderView('Program/newProgramEmail.html.twig', ['program' => $program]));


            $mailer->send($email);

            $this->addFlash('success', 'The new program has been created');

        // Redirect to categories list

        return $this->redirectToRoute('program_index');
        }
        // Render the form


        return $this->render('program/new.html.twig', [
            'program' => $program,
            'form' => $form,

        ]);

    }

    #[Route('/show/{slug}', name: 'show')]
    public function show(Program $program, ProgramDuration $programDuration): Response
    {
        return $this->render('program/show.html.twig', [
            'program' => $program, 'programDuration' => $programDuration->calculate($program)
        ]);
    }

    #[Route('/{program}/seasons/{season}', name : 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {
    
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program . ' found in program\'s table.'
            );
        }
    
        if (!$season) {
            throw $this->createNotFoundException(
                'No program with id : ' . $season . ' found in program\'s table.'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'program' => $program, 'season' => $season
        ]);
    }

    #[Route('/{program}/seasons/{season}/episode/{episode}', name : 'program_episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode)
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program, 'season' => $season, 'episode' => $episode
        ]);
    }
}