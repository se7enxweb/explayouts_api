<?php
class expLayoutsEzContentProvider
{
    public function loadContent( $contentId )
    {
        return eZContentObject::fetch( (int)$contentId );
    }

    public function loadContentByNodeId( $nodeId )
    {
        $node = eZContentObjectTreeNode::fetch( (int)$nodeId );
        if ( !$node instanceof eZContentObjectTreeNode )
            return false;

        return $node->attribute( 'object' );
    }

    public function loadContentInfo( $contentId )
    {
        $object = $this->loadContent( $contentId );
        if ( !$object instanceof eZContentObject )
            return false;

        return array(
            'id' => (int)$object->attribute( 'id' ),
            'name' => (string)$object->attribute( 'name' ),
            'class_identifier' => (string)$object->attribute( 'class_identifier' ),
            'class_name' => (string)$object->attribute( 'class_name' ),
            'published' => (int)$object->attribute( 'published' ),
            'modified' => (int)$object->attribute( 'modified' ),
            'owner_id' => (int)$object->attribute( 'owner_id' ),
            'main_node_id' => (int)$object->attribute( 'main_node_id' ),
        );
    }
}
