<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function getListWhereNotIn(array $ids = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, ?int $offset = null): Collection|LengthAwarePaginator;

    public function getCustomerNameList(object $request, int|string $dataLimit = DEFAULT_DATA_LIMIT): object;

    public function deleteAuthAccessTokens(string|int $id): bool;
}
