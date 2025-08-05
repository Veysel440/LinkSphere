<?php

namespace App\Services\User;


use App\Enums\ActivityType;
use App\Events\EducationCreated;
use App\Models\User;
use App\Models\UserEducation;
use App\Repositories\UserEducationRepository;

class UserEducationService
{
    protected UserEducationRepository $repository;
    protected UserActivityLogService $logService;

    public function __construct(
        UserEducationRepository $repository,
        UserActivityLogService $logService
    ) {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function addEducation(User $user, array $data)
    {
        $education = $this->repository->create($user, $data);

        event(new EducationCreated($user, $education));

        return $education;
    }

    public function list(User $user)
    {
        return $this->repository->getAll($user);
    }

    public function get(User $user, $id)
    {
        return $this->repository->findById($user, $id);
    }

    public function create(User $user, array $data)
    {
        $education = $this->repository->create($user, $data);

        $this->logService->log($user, ActivityType::EDUCATION_ADDED, [
            'education_id' => $education->id,
            'school'       => $education->school ?? null,
        ]);

        return $education;
    }

    public function update(UserEducation $education, array $data)
    {
        $result = $this->repository->update($education, $data);

        $this->logService->log($education->user, ActivityType::EDUCATION_UPDATED, [
            'education_id'   => $education->id,
            'updated_fields' => array_keys($data),
        ]);

        return $result;
    }

    public function delete(UserEducation $education)
    {
        $result = $this->repository->delete($education);

        $this->logService->log($education->user, ActivityType::EDUCATION_DELETED, [
            'education_id' => $education->id,
            'school'       => $education->school ?? null,
        ]);

        return $result;
    }
}
