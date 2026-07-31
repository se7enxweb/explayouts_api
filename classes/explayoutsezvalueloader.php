<?php
class expLayoutsEzValueLoader
{
    public function load( $valueId )
    {
        return eZContentObjectTreeNode::fetch( (int)$valueId );
    }

    public function loadByContentId( $contentId )
    {
        $object = eZContentObject::fetch( (int)$contentId );
        if ( !$object instanceof eZContentObject )
            return false;

        $nodeId = (int)$object->attribute( 'main_node_id' );
        if ( $nodeId <= 0 )
            return false;

        return eZContentObjectTreeNode::fetch( $nodeId );
    }

    public function loadByRemoteId( $remoteId )
    {
        $object = eZContentObject::fetchByRemoteID( $remoteId );
        if ( !$object instanceof eZContentObject )
            return false;

        $nodeId = (int)$object->attribute( 'main_node_id' );
        if ( $nodeId <= 0 )
            return false;

        return eZContentObjectTreeNode::fetch( $nodeId );
    }
}
