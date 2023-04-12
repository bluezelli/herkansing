<?php

namespace App\Controller;

use App\Entity\Genre;
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
    public function movies(Genre $genre, SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findBy(['genre' => $genre]);
        return $this->render('serie/series.html.twig', ['series' => $series]);
    }
}
