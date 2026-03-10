<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Repository\Publication\PublicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class SiteController extends Controller
{
    public function __construct(
        protected PublicationRepository $publicationRepository,
    ) {

    }
    public function home(): Response
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Contact', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function publications($publicationType): Response
    {
        $publicationType = strtoupper($publicationType);

        $publications = $this->publicationRepository->paginatePublicationsByTypeOrderByName($publicationType);

        return Inertia::render('Publications', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'publications' => $publications
        ]);
    }

    public function publication(int $publicationId): Response
    {
        $publication = $this->publicationRepository->getById($publicationId);

        return Inertia::render('Publication', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'publication' => $publication
        ]);
    }

    public function search(Request $request): Response
    {
      $searchParameters = $request->get('search');

      $publications = Publication::whereOr('name', 'like', '%' . $searchParameters . '%')
        ->whereOr('author', 'like', '%' . $searchParameters . '%')
        ->whereOr('description', 'like', '%' . $searchParameters . '%')
        ->paginate(10);

        return Inertia::render('Publications', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'publications' => $publications
        ]);
    }
}
