<?php
/**
 * File containing the eZ Publish Star Rating data Converter class
 */

namespace MakingWaves\eZStarRatingBundle\eZ\Publish\FieldType\StarRating;

use eZ\Publish\Core\FieldType\GatewayBasedStorage;
use eZ\Publish\SPI\Persistence\Content\VersionInfo;
use eZ\Publish\SPI\Persistence\Content\Field;

class StarRatingStorage extends GatewayBasedStorage
{
    public function storeFieldData( VersionInfo $versionInfo, Field $field, array $context )
    {
        if ( empty( $field->value->externalData ) )
        {
            return;
        }

        $gateway = $this->getGateway( $context );
        return $gateway->storeFieldData( $field );
    }

    public function getFieldData( VersionInfo $versionInfo, Field $field, array $context )
    {
        $gateway = $this->getGateway( $context );
        return $gateway->getFieldData( $field );
    }

    public function deleteFieldData( VersionInfo $versionInfo, array $fieldIds, array $context )
    {
        $gateway = $this->getGateway( $context );
        foreach ( $fieldIds as $fieldId )
        {
            $gateway->deleteFieldData( $fieldId );
        }
    }

    /**
     * Checks if field type has external data to deal with
     *
     * @return boolean
     */
    public function hasFieldData()
    {
        return true;
    }

    /**
     * @param \eZ\Publish\SPI\Persistence\Content\Field $field
     * @param array $context
     */
    public function getIndexData( VersionInfo $versionInfo, Field $field, array $context )
    {
        return null;
    }
}
