<?php

namespace Docuco\Infrastructure\Repositories\Users;

use Docuco\Models\UserModel;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\Repositories\UsersRepository;
use Docuco\Domain\Users\Collections\UserCollection;

class UsersRepositoryORM implements UsersRepository
{

    private $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function get_one_user_by_user_group_id(int $user_group_id, int $user_id): ?User
    {
        $user_model = $this->user_model
            ->where('user_group_id', $user_group_id)
            ->find($user_id);

        if (isset($user_model)) {
            return User::get_from_model($user_model);
        }

        return null;
    }

    public function get_all_users_by_user_group_id(int $user_group_id): UserCollection
    {
        $user_model_collection = $this->user_model
            ->where('user_group_id', $user_group_id)
            ->get();

        $uder_collection = new UserCollection();
        foreach ($user_model_collection as $user_model) {
            $uder_collection->add(
                User::get_from_model($user_model)
            );
        }

        return $uder_collection;
    }

    // public function create_document_by_user_group_id(int $user_group_id, $document_to_create): ?Document
    // {
    //     $this->document_model->user_group_id = $user_group_id;
    //     foreach ($document_to_create as $property => $value) {
    //         if ($property != 'id') {
    //             $this->document_model->$property = $value;
    //         }
    //     }

    //     $this->document_model->save();

    //     return Document::get_from_model($this->document_model);
    // }

    // public function update_document_by_user_group_id(int $user_group_id, $document): ?Document
    // {
    //     $document_model = $this->get_one_document_model_by_user_group($user_group_id, $document->id);

    //     if (isset($document_model)) {
    //         foreach ($document as $property => $value) {
    //             if ($property != 'id') {
    //                 $document_model->$property = $value;
    //             }
    //         }

    //         $is_updated = $document_model->save();

    //         if ($is_updated) {
    //             return Document::get_from_model($document_model);
    //         }
    //     }

    //     return null;
    // }

    // public function delete_document_by_user_group_id(int $user_group_id, int $document_id): bool
    // {
    //     $document_model = $this->get_one_document_model_by_user_group($user_group_id, $document_id);


    //     if (isset($document_model)) {
    //         $this->delete_relation_with_types_by_document_model($document_model->id);
    //         $is_deleted = $document_model->delete();
    //         return $is_deleted;
    //     }

    //     return false;
    // }

    // private function get_one_document_model_by_user_group(int $user_group_id, int $document_id): ?DocumentModel
    // {
    //     return $this->document_model
    //         ->whereHas('user_group', function ($query) use ($user_group_id, $document_id) {
    //             $query->where('user_group_id', $user_group_id);
    //         })
    //         ->find($document_id);
    // }

    // private function delete_relation_with_types_by_document_model(int $document_id)
    // {
    //     $this->document_type_model->where('document_id', $document_id)->delete();
    // }
}
