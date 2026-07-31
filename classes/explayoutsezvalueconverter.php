<?php
class expLayoutsEzValueConverter
{
    public function convert( $value )
    {
        if ( $value instanceof eZContentObjectTreeNode )
            return new expLayoutsContentBrowserItem( $value );

        if ( $value instanceof eZContentObject )
        {
            $nodeId = (int)$value->attribute( 'main_node_id' );
            if ( $nodeId <= 0 )
                return false;

            $node = eZContentObjectTreeNode::fetch( $nodeId );
            if ( $node instanceof eZContentObjectTreeNode )
                return new expLayoutsContentBrowserItem( $node );
        }

        return false;
    }

    public function convertToArray( $value )
    {
        $item = $this->convert( $value );
        if ( !$item instanceof expLayoutsContentBrowserItem )
            return false;

        return $item->toArray();
    }
}
