<?php
class expLayoutsEzSectionMapper
{
    public function getSections()
    {
        $sections = array();
        $rows = eZSection::fetchList();
        if ( !is_array( $rows ) )
            return $sections;

        foreach ( $rows as $section )
        {
            if ( !$section instanceof eZSection )
                continue;

            $id = (int)$section->attribute( 'id' );
            $sections[$id] = array(
                'id' => $id,
                'name' => (string)$section->attribute( 'name' ),
                'identifier' => (string)$section->attribute( 'identifier' ),
            );
        }

        return $sections;
    }

    public function getName( $id )
    {
        $section = eZSection::fetch( (int)$id );
        if ( !$section instanceof eZSection )
            return false;

        return (string)$section->attribute( 'name' );
    }

    public function getIdByIdentifier( $identifier )
    {
        $section = eZSection::fetchByIdentifier( (string)$identifier );
        if ( !$section instanceof eZSection )
            return false;

        return (int)$section->attribute( 'id' );
    }
}
