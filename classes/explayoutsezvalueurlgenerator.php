<?php
class expLayoutsEzValueUrlGenerator
{
    public function generate( $item )
    {
        if ( $item instanceof expLayoutsContentBrowserItem )
            return $item->urlAlias;

        if ( $item instanceof eZContentObjectTreeNode )
            return (string)$item->attribute( 'url_alias' );

        if ( $item instanceof eZContentObject )
        {
            $nodeId = (int)$item->attribute( 'main_node_id' );
            if ( $nodeId <= 0 )
                return '';

            $node = eZContentObjectTreeNode::fetch( $nodeId );
            if ( $node instanceof eZContentObjectTreeNode )
                return (string)$node->attribute( 'url_alias' );
        }

        return '';
    }

    public function generateAbsolute( $item )
    {
        $relativeUrl = $this->generate( $item );
        if ( $relativeUrl === '' )
            return '';

        $ini = eZINI::instance();
        $siteUrl = rtrim( $ini->variable( 'SiteSettings', 'SiteURL' ), '/' );
        return $siteUrl . '/' . ltrim( $relativeUrl, '/' );
    }
}
