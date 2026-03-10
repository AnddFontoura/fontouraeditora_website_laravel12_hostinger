<?php

namespace App\Repository\Publication;

use App\Models\Publication;
use App\Repository\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

final class PublicationRepository extends BaseRepository
{
    function __construct(Publication $model)
    {
        $this->model = $model;
    }

    public function paginatePublicationsByTypeOrderByName(
        string $publicationType,
        array $filters = []
    ): LengthAwarePaginator {
        $sql = $this->model->with('publicationImage');

        if (isset($filters['name'])) {
            $sql = $sql->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $sql->where('category', $publicationType)->orderBy('name', 'asc')->paginate(10);
    }

    public function paginatePublicationsOrderByName(
        array $filters = []
    ): LengthAwarePaginator {
        $sql = $this->model;

        if (isset($filters['name'])) {
            $sql = $sql->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $sql->orderBy('name', 'asc')->paginate(10);
    }

    public function paginatePublicationsByParameters(string $searchParameters)
    {
        return $this->model->whereOr('name', 'like', '%' . $searchParameters . '%')
            ->whereOr('author', 'like', '%' . $searchParameters . '%')
            ->whereOr('description', 'like', '%' . $searchParameters . '%')
            ->paginate(10);
    }
}
