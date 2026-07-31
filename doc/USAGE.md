# Using explayouts_api

All classes are stateless helpers; instantiate them directly.

## Loading content

```php
<?php
$provider = new expLayoutsEzContentProvider();

$object = $provider->loadContent( 123 );          // eZContentObject or false
$object = $provider->loadContentByNodeId( 456 );  // via the node's object
$info   = $provider->loadContentInfo( 123 );      // normalized info array
```

## Loading locations (nodes)

```php
<?php
$loader = new expLayoutsEzValueLoader();

$node = $loader->load( 456 );                 // by node id
$node = $loader->loadByContentId( 123 );      // main node of the object
$node = $loader->loadByRemoteId( 'abc123' );  // by remote id
```

## Converting to content browser items

```php
<?php
$converter = new expLayoutsEzValueConverter();

// Accepts eZContentObjectTreeNode or eZContentObject
$item  = $converter->convert( eZContentObjectTreeNode::fetch( 456 ) ); // expLayoutsContentBrowserItem
$array = $converter->convertToArray( eZContentObject::fetch( 123 ) );
```

## Generating URLs

```php
<?php
$generator = new expLayoutsEzValueUrlGenerator();

// Accepts expLayoutsContentBrowserItem, eZContentObjectTreeNode or eZContentObject
$url      = $generator->generate( $node );          // url alias, relative
$absolute = $generator->generateAbsolute( $node );  // prefixed with SiteSettings/SiteURL
```

## Resolving the current content context

Useful when deciding which layout applies to the current request:

```php
<?php
$contextProvider = new expLayoutsEzContentContextProvider();
$context = $contextProvider->getContext( $module, $viewParameters );
// array: siteaccess, node_id, object_id, location (node or false),
//        content (object or false), content_type_identifier
```

When `$viewParameters['NodeID']` is absent, the provider falls back to reading a numeric node id from the request URI.

## Remote ids

```php
<?php
$remote = new expLayoutsEzRemoteIdConverter();

$objectId = $remote->toObjectId( 'f5c88a...' );
$nodeId   = $remote->toNodeId( 'f5c88a...' );
$remoteId = $remote->toRemoteId( 123 );
```

## Validation

```php
<?php
$validator = new expLayoutsEzContentValidator();

$validator->validateContentId( 123 );        // object exists?
$validator->validateLocationId( 456 );       // node exists?
$validator->validateContentType( 'article' );// class identifier exists?
$validator->validateSectionId( 1 );          // section exists?
```

## Content types and sections

```php
<?php
$typeMapper = new expLayoutsEzContentTypeMapper();
$types = $typeMapper->getContentTypes();               // identifier => name
$name  = $typeMapper->getName( 'article' );
$identifier = $typeMapper->getIdentifierById( 2 );

$sectionMapper = new expLayoutsEzSectionMapper();
$sections = $sectionMapper->getSections();
$name = $sectionMapper->getName( 1 );
$id   = $sectionMapper->getIdByIdentifier( 'standard' );
```

## Customization

### Settings layer (INI cascade)

The extension ships no INI files. The only settings it reads are core ones: `expLayoutsEzValueUrlGenerator::generateAbsolute()` uses `site.ini` `[SiteSettings] SiteURL`, and the context provider reports `[SiteSettings] SiteAccess` — both follow the normal INI cascade (`settings/siteaccess/<siteaccess>/`, extension siteaccess settings, `settings/override/`), so absolute URLs and the reported siteaccess adapt per siteaccess without any change here.

### Template layer

There are no templates or design directories in this extension; nothing to override at the template layer.

### PHP layer (safe extension points)

- The nine adapter classes are the public API surface: write integrations (custom pickers, exporters, resolvers) against them instead of duplicating `eZContentObject`/`eZContentObjectTreeNode` plumbing.
- All classes are small, stateless and instantiated with `new` at the call site, so you can subclass any of them (e.g. a URL generator that adds language prefixes) and use your subclass in your own code paths.
- `convert()` returning `expLayoutsContentBrowserItem` is the contract the content browser extensions rely on; keep that return type if you subclass the converter.
