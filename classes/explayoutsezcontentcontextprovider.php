<?php
class expLayoutsEzContentContextProvider
{
    public function getContext( $module = null, $viewParameters = null )
    {
        $context = array(
            'siteaccess' => eZINI::instance()->variable( 'SiteSettings', 'SiteAccess' ),
            'node_id' => 0,
            'object_id' => 0,
            'location' => false,
            'content' => false,
            'content_type_identifier' => '',
        );

        $node = $this->currentLocation( $module, $viewParameters );
        if ( $node instanceof eZContentObjectTreeNode )
        {
            $context['location'] = $node;
            $context['node_id'] = (int)$node->attribute( 'node_id' );
            $context['object_id'] = (int)$node->attribute( 'contentobject_id' );

            $object = $node->attribute( 'object' );
            if ( $object instanceof eZContentObject )
            {
                $context['content'] = $object;
                $context['content_type_identifier'] = (string)$object->attribute( 'class_identifier' );
            }
        }

        return $context;
    }

    protected function currentLocation( $module, $viewParameters )
    {
        if ( !is_array( $viewParameters ) || !isset( $viewParameters['NodeID'] ) || (int)$viewParameters['NodeID'] <= 0 )
        {
            $uri = eZURI::instance();
            $requestedNode = $uri->element( 0 );
            if ( (int)$requestedNode > 0 )
                return eZContentObjectTreeNode::fetch( (int)$requestedNode );
        }
        else
        {
            return eZContentObjectTreeNode::fetch( (int)$viewParameters['NodeID'] );
        }

        return false;
    }
}
