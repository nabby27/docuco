<?php

namespace Tests\Unit\Helpers;

use Docuco\Domain\Documents\Collections\TypeCollection;
use Docuco\Domain\Documents\Entities\Document;
use Docuco\Domain\Users\ValueObjects\UserGroupVO;

class DocumentHelper
{

    public static function get_user_group_and_his_document($documents_repository)
    {
        $document = DocumentHelper::get_random_document();
        $user_group = new UserGroupVO(1, 'example_name');
        $documents_repository->add_document($document->id, $document, $user_group->id);

        return [$user_group, $document];
    }

    public static function get_random_document(): Document
    {
        return new Document(
            1,
            'name',
            'description',
            new TypeCollection(),
            2.3,
            'url',
            'date'
        );
    }
}
