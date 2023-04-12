<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use App\Form\GenreType;
use App\Repository\EpisodeRepository;
use App\Repository\GenreRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
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
        //de id in de Route haalt de id op uit de url dat mee is gegeven via de path. in de path is de genre id meegegeven.
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
    public function insert(Request $request , GenreRepository $genreRepository)
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                $genre = $form->getData();
                $genreRepository->save($genre);

            return $this->redirectToRoute('task_success');
        }
        return $this->render('serie/addgenre.html.twig', [
            'form' => $form,
        ]);
    }}
