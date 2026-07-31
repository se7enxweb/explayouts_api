<?php
class expLayoutsEzContentValidator
{
    public function validateContentId( $contentId )
    {
        $object = eZContentObject::fetch( (int)$contentId );
        return $object instanceof eZContentObject;
    }

    public function validateLocationId( $nodeId )
    {
        $node = eZContentObjectTreeNode::fetch( (int)$nodeId );
        return $node instanceof eZContentObjectTreeNode;
    }

    public function validateContentType( $identifier )
    {
        $class = eZContentClass::fetchByIdentifier( (string)$identifier );
        return $class instanceof eZContentClass;
    }

    public function validateSectionId( $sectionId )
    {
        $section = eZSection::fetch( (int)$sectionId );
        return $section instanceof eZSection;
    }
}
