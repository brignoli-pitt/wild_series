<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;

#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }


    #[Route('/show/{id}', name: 'app_show', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function show(Program $program, SeasonRepository $seasonRepository):Response
    {
        $seasons = $seasonRepository->findOneBy(['program' => $program], ['number'=>'ASC']);

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    #[Route('/{programId}/season/{seasonId}', name: 'app_program_season_show',requirements: ['id'=>'\d+'], methods: ['Get'])]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository):Response
    {
        $program = $programRepository->findOneBy(['id'=>$programId]);
        $season = $seasonRepository->findOneBy(['id'=>$seasonId]);
        $episodes = $episodeRepository->findBy(['season'=>$seasonId]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }
}