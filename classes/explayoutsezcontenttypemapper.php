<?php
class expLayoutsEzContentTypeMapper
{
    public function getContentTypes()
    {
        $types = array();
        $classes = eZContentClass::fetchAllClasses();
        if ( !is_array( $classes ) )
            return $types;

        foreach ( $classes as $class )
        {
            if ( !$class instanceof eZContentClass )
                continue;

            $identifier = (string)$class->attribute( 'identifier' );
            $types[$identifier] = array(
                'identifier' => $identifier,
                'name' => (string)$class->attribute( 'name' ),
                'id' => (int)$class->attribute( 'id' ),
            );
        }

        return $types;
    }

    public function getName( $identifier )
    {
        $class = eZContentClass::fetchByIdentifier( (string)$identifier );
        if ( !$class instanceof eZContentClass )
            return false;

        return (string)$class->attribute( 'name' );
    }

    public function getIdentifierById( $id )
    {
        $class = eZContentClass::fetch( (int)$id );
        if ( !$class instanceof eZContentClass )
            return false;

        return (string)$class->attribute( 'identifier' );
    }
}
