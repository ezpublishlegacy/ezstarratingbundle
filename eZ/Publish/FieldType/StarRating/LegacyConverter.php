<?php

namespace MakingWaves\eZStarRatingBundle\eZ\Publish\FieldType\StarRating;

use eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;
use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;

class LegacyConverter implements Converter
{
    public function toStorageValue( FieldValue $value, StorageFieldValue $storageFieldValue )
    {
        $storageFieldValue->dataInt = json_encode( $value->data );
        $storageFieldValue->sortKeyString = $value->sortKey;
    }

    public function toFieldValue( StorageFieldValue $value, FieldValue $fieldValue )
    {
        $fieldValue->data = json_decode( $value->dataInt, true );
        $fieldValue->sortKey = $value->sortKeyString;
    }

    public function toStorageFieldDefinition( FieldDefinition $fieldDef, StorageFieldDefinition $storageDef )
    {
        // @todo implement me
    }

    public function toFieldDefinition( StorageFieldDefinition $storageDef, FieldDefinition $fieldDef )
    {
        // @todo implement me
    }

    /**
     * Returns the name of the index column in the attribute table
     *
     * Returns the name of the index column the datatype uses, which is either
     * "sort_key_int" or "sort_key_string". This column is then used for
     * filtering and sorting for this type.
     *
     * If the indexing is not supported, this method must return false.
     *
     * @return string|\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\false
     */
    public function getIndexColumn()
    {
        return 'sort_key_int';
    }
}
