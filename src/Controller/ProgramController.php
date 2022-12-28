<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

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
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    public function showSeason(int $seasonId, Program $program, Season $season, EpisodeRepository $episodeRepository):Response
    {
        $episodes = $episodeRepository->findBy(['season'=>$seasonId]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

    #[Route('/{programId}/season/{seasonId}/episode/{episodeId}', name: 'app_program_episode_show', requirements: ['id'=>'\d+'], methods: ['Get'])]
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeId' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
        
    }
}