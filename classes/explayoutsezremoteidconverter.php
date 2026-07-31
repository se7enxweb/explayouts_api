<?php
class expLayoutsEzRemoteIdConverter
{
    public function toObjectId( $remoteId )
    {
        if ( $remoteId === '' )
            return false;

        $object = eZContentObject::fetchByRemoteID( $remoteId );
        if ( !$object instanceof eZContentObject )
            return false;

        return (int)$object->attribute( 'id' );
    }

    public function toNodeId( $remoteId )
    {
        $objectId = $this->toObjectId( $remoteId );
        if ( $objectId === false )
            return false;

        $object = eZContentObject::fetch( $objectId );
        if ( !$object instanceof eZContentObject )
            return false;

        $nodeId = (int)$object->attribute( 'main_node_id' );
        return $nodeId > 0 ? $nodeId : false;
    }

    public function toRemoteId( $objectId )
    {
        $object = eZContentObject::fetch( (int)$objectId );
        if ( !$object instanceof eZContentObject )
            return false;

        return (string)$object->attribute( 'remote_id' );
    }
}
