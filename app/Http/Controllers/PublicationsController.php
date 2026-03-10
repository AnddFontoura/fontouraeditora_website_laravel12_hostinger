<?php

namespace App\Http\Controllers;

use App\Enums\PublicationsEnum;
use App\Http\Requests\Publication\PublicationCreateOrUpdateRequest;
use App\Http\Requests\Publication\PublicationListRequest;
use App\Repository\Publication\PublicationRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PublicationsController extends Controller
{
    public function __construct(
        protected PublicationRepository $publicationRepository,
    ) {
    }

    public function index(PublicationListRequest $request): Response
    {
        $filters = $request->validated();

        $publications = $this->publicationRepository->paginateOrderById($filters);

        return Inertia::render('Admin/Publication/PublicationList', [
            'publications' => $publications,
        ]);
    }

    public function create(int $id = null): Response
    {
        $publication = null;

        if ($id !== null) {
            $publication = $this->publicationRepository->getById($id);
        }

        return Inertia::render('Admin/Publication/PublicationForm', [
            'publication' => $publication,
            'categories' => PublicationsEnum::PUBLICATION_TYPE,
        ]);
    }

    public function saveOrUpdate(PublicationCreateOrUpdateRequest $request, ?int $id = null): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('publications', 'public');
        }

        if ($id !== null) {
            // remove imagem antiga se trocar
            if (isset($data['image_path'])) {
                $current = $this->publicationRepository->getById($id);
                if (!empty($current->image_path)) {
                    Storage::disk('public')->delete($current->image_path);
                }
            }

            $this->publicationRepository->updateById($id, $data);

            return redirect()->route('control-panel.publications.edit', $id);
        }

        $publication = $this->publicationRepository->create($data);

        return redirect()->route('control-panel.publications.edit', $publication->id);
    }

    public function show(int $id)
    {
        //
    }

    public function delete(int $id): RedirectResponse
    {
        $this->publicationRepository->deleteById($id);

        return redirect()->route('control-panel.publications.index');
    }
}
