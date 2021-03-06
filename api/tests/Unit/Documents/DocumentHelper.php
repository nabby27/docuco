<?php

namespace Tests\Unit\Helpers;

use Docuco\Domain\Documents\Entities\Document;
use Docuco\Domain\Users\Entities\UserGroup;

class DocumentHelper
{

    public static function get_user_group_and_his_document($documents_repository)
    {
        $document = DocumentHelper::get_random_document();
        $user_group = new UserGroup(1, 'example_name');
        $documents_repository->add_document($document, $user_group->id);

        return [$user_group, $document];
    }

    public static function get_random_document(): Document
    {
        return new Document(
            1,
            'name',
            'description',
            [],
            'EXPENSE',
            2.3,
            'url',
            'date'
        );
    }
}
