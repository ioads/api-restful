<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserController extends Controller
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userRepository->all();

        return response()->json($users);
    }

    /**
     * @throws AuthorizationException
     */
    public function show($id): UserResource
    {
        $user = $this->userRepository->findOrFail($id);

        $this->authorize('view', $user);

        return new UserResource($user);
    }

    public function store(UserStoreRequest $request): UserResource
    {
        $data = $request->validated();

        $team = $this->userRepository->create($data);

        return new UserResource($team);
    }

    public function edit($id): UserResource
    {
        $user = $this->userRepository->findOrFail($id);

        $this->authorize('edit', $user);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, $id): UserResource
    {
        $data = $request->validated();

        $user = $this->userRepository->update($id, $data);

        return new UserResource($user);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        return $this->userRepository->delete($user);
    }

    /**
     * @throws AuthorizationException
     */
    public function search(Request $request): Collection
    {
        $this->authorize('search', User::class);

        return $this->userRepository->search($request);
    }
}
