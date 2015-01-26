<?php

/* TODO: Check on if current user has rated is not implemented */

namespace MakingWaves\eZStarRatingBundle\eZ\Publish\FieldType\StarRating;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    public $contentobject_id;
    public $contentobject_attribute_id;
    public $rating_average;
    public $rating_count;
    public $rounded_average;
    public $rating;

    public function __construct( $values = array() )
    {
        parent::__construct( $values );

        $this->rounded_average = intval( $this->rating_average * 2 +0.5 ) / 2;
        $this->rating = round( $this->rating_average, 1 );
    }

    public function __toString()
    {
        return implode( ':', array( $this->contentobject_attribute_id,
                                    $this->rating_average,
                                    $this->rating_count ) );
    }

    public function toHash()
    {
        return array(
            'rating_average' => $this->rating_average,
            'rating_count' => $this->rating_count,
            'rounded_average' => $this->rounded_average,
            'rating' => $this->rating
        );
    }
}
