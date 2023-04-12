<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use App\Repository\EpisodeRepository;
use App\Repository\GenreRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/index', name: 'home')]
    public function home(GenreRepository $genreRepository): Response
    {
        $genres = $genreRepository->findAll();
        return $this->render('serie/index.html.twig', ['genres' => $genres]);
    }

    #[Route('/serie/{id}', name: 'serie')]
    public function serie(Genre $genre, SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findBy(['genre' => $genre]);
        return $this->render('serie/series.html.twig', ['series' => $series]);
    }

    #[Route('/episode/{id}', name: 'episode')]
    public function episode(Serie $serie, EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findBy(['serie' => $serie]);
        return $this->render('serie/episode.html.twig', ['episodes' => $episodes]);
    }

    #[Route('/insert{id}', name: 'insert')]
    public function insert(){

    }
}
