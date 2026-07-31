Exponential Layouts API
=======================

General description
-------------------

Exponential Layouts API (`explayouts_api`) provides the public PHP API adapters bridging Exponential content to Exponential Layouts for Exponential 6. This extension provides the integration-facing helper classes that load, validate, convert and link `eZContentObject` / `eZContentObjectTreeNode` values for the layouts stack — for example turning a node into an `expLayoutsContentBrowserItem` for the content picker, or resolving the content context of the current request for the layout resolver.

It is an Exponential Legacy port inspired by the `netgen/layouts-ibexa` package: it covers the roles of that bundle's content providers, value converters/loaders, URL generators and validators as plain PHP classes without a Symfony service container.

This extension provides the following capabilities:

- Content loading - Load content objects by content id, node id or as a normalized info array.
- Location loading - Load tree nodes by node id, content id (main node) or remote id.
- Value conversion - Convert nodes/objects into `expLayoutsContentBrowserItem` objects for the content picker, or plain arrays.
- URL generation - Generate relative and absolute URLs for items, nodes or objects.
- Request context - Resolve the content context of the current request (siteaccess, node/object id, location, content, content type identifier) for the layout resolver.
- Remote id mapping - Map remote ids to object/node ids and back.
- Validation - Validate content ids, location ids, content type identifiers and section ids.
- Type and section mapping - List content types and sections, resolve their names, identifiers and ids.

Features
--------

The following features are provided by the Exponential Layouts API extension:

- Nine small, stateless adapter classes - Each covers one integration concern and is instantiated directly with `new`; there is no service container and no global state, so any class can be subclassed and used in your own code paths.
- Content provider - `expLayoutsEzContentProvider` loads an `eZContentObject` by content id (`loadContent`), by node id (`loadContentByNodeId`), or as a normalized info array (`loadContentInfo`).
- Value loader - `expLayoutsEzValueLoader` loads an `eZContentObjectTreeNode` by node id (`load`), content id (`loadByContentId`, the object's main node) or remote id (`loadByRemoteId`).
- Value converter - `expLayoutsEzValueConverter` accepts an `eZContentObjectTreeNode` or `eZContentObject` and produces an `expLayoutsContentBrowserItem` (`convert`) or a plain array (`convertToArray`); the `expLayoutsContentBrowserItem` return type is the contract the content browser extensions rely on.
- URL generator - `expLayoutsEzValueUrlGenerator` generates relative (`generate`, url alias) and absolute (`generateAbsolute`, prefixed with `site.ini` `[SiteSettings] SiteURL`) URLs for an item, node or object.
- Context provider - `expLayoutsEzContentContextProvider::getContext( $module, $viewParameters )` reports siteaccess, node_id, object_id, location, content and content_type_identifier for the current request; when `$viewParameters['NodeID']` is absent it falls back to reading a numeric node id from the request URI.
- Remote id converter - `expLayoutsEzRemoteIdConverter` maps remote ids to object/node ids (`toObjectId`, `toNodeId`) and back (`toRemoteId`).
- Content validator - `expLayoutsEzContentValidator` validates content id, location id, content type identifier and section id existence.
- Type and section mappers - `expLayoutsEzContentTypeMapper` lists content types (`getContentTypes`) and resolves names/identifiers (`getName`, `getIdentifierById`); `expLayoutsEzSectionMapper` lists sections (`getSections`) and resolves names and ids (`getName`, `getIdByIdentifier`).
- Zero configuration - The extension ships no INI settings, modules or templates — only the adapter classes plus an `autoloads/explayouts_api_autoload.php` class map; the only settings it reads are core `site.ini` values, which follow the normal INI cascade.

Version
-------

- The current version of Exponential Layouts API is 1.0.0
- Last Major update: July 30, 2026

Copyright
---------

- Exponential Layouts API is copyright 1998 - 2026 7x
- See: [LICENSE.md](LICENSE.md) for more information on the terms of the copyright and license

License
-------

Exponential Layouts API is licensed under the GNU General Public License.

The complete license agreement is included in the [LICENSE.md](LICENSE.md) file.

Exponential Layouts API is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License or at your
option a later version.

Exponential Layouts API is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

The GNU GPL gives you the right to use, modify and redistribute
Exponential Layouts API under certain conditions. The GNU GPL license
is distributed with the software, see the file LICENSE.md.

It is also available at http://www.gnu.org/licenses/gpl.txt

You should have received a copy of the GNU General Public License
along with Exponential Layouts API in LICENSE.md. If not, see http://www.gnu.org/licenses/.

Using Exponential Layouts API under the terms of the GNU GPL is free (as in freedom).

For more information or questions please contact
info@se7enx.com

Requirements
------------

The following requirements exists for using the Exponential Layouts API extension:

Exponential version
- Make sure you use Exponential 6 / eZ Publish Legacy (required) or higher.

PHP version
- Make sure you have PHP 8.1 or higher.

Sibling extensions
- Required: `extension/explayouts_content_browser` — `expLayoutsEzValueConverter` returns `expLayoutsContentBrowserItem` objects defined there.
- Typically used together with `explayouts` (layout engine) and the content browser extensions (`explayouts_content_browser`, `explayouts_content_browser_core`, `explayouts_content_browser_ui`) that consume the converted items.

Installation
------------

In short: place the extension in `extension/explayouts_api`, activate it via `site.ini` `[ExtensionSettings] ActiveExtensions[]` (or per siteaccess via `ActiveAccessExtensions[]`), then regenerate autoloads and clear all caches. The extension ships no INI settings, modules or templates — only the adapter classes plus an `autoloads/explayouts_api_autoload.php` class map. Exponential 6 can also load extensions from additional directories declared via `site.ini` `[ExtensionSettings] AdditionalExtensionDirectories[]`, if you keep suite extensions outside the default `extension/` directory.

See [INSTALL.md](INSTALL.md) for the full step-by-step installation instructions.

Usage
-----

All classes are stateless helpers; instantiate them directly.

| Class | Purpose |
|-------|---------|
| `expLayoutsEzContentProvider` | Load `eZContentObject` by content id (`loadContent`), by node id (`loadContentByNodeId`) or as a normalized info array (`loadContentInfo`) |
| `expLayoutsEzValueLoader` | Load an `eZContentObjectTreeNode` by node id (`load`), content id (`loadByContentId`) or remote id (`loadByRemoteId`) |
| `expLayoutsEzValueConverter` | Convert a node/object into an `expLayoutsContentBrowserItem` (`convert`) or plain array (`convertToArray`) |
| `expLayoutsEzValueUrlGenerator` | Relative (`generate`) and absolute (`generateAbsolute`) URLs for an item, node or object |
| `expLayoutsEzContentContextProvider` | Content context of the current request (`getContext`): siteaccess, node/object id, location, content, content type identifier |
| `expLayoutsEzRemoteIdConverter` | Map remote ids to object/node ids (`toObjectId`, `toNodeId`) and back (`toRemoteId`) |
| `expLayoutsEzContentValidator` | Validate content id, location id, content type identifier and section id |
| `expLayoutsEzContentTypeMapper` | List content types (`getContentTypes`), resolve names and identifiers (`getName`, `getIdentifierById`) |
| `expLayoutsEzSectionMapper` | List sections (`getSections`), resolve names and ids (`getName`, `getIdByIdentifier`) |

A typical picker/integration flow — load a node, convert it and generate its URL:

```php
<?php
$loader    = new expLayoutsEzValueLoader();
$converter = new expLayoutsEzValueConverter();
$generator = new expLayoutsEzValueUrlGenerator();

$node = $loader->load( 456 );                 // eZContentObjectTreeNode
$item = $converter->convert( $node );         // expLayoutsContentBrowserItem
$url  = $generator->generateAbsolute( $node ); // prefixed with SiteSettings/SiteURL
```

Resolving the content context of the current request, useful when deciding which layout applies:

```php
<?php
$contextProvider = new expLayoutsEzContentContextProvider();
$context = $contextProvider->getContext( $module, $viewParameters );
// array: siteaccess, node_id, object_id, location (node or false),
//        content (object or false), content_type_identifier
```

See [doc/USAGE.md](doc/USAGE.md) for exhaustive scenarios covering all nine classes with real signatures — loading content and locations, converting to content browser items, URL generation, remote ids, validation, content type and section mapping — plus the full customization guide covering the settings layer (the core `site.ini` values read through the INI cascade), the template layer (none here by design) and the PHP layer (subclassing the adapters, keeping the `expLayoutsContentBrowserItem` contract).

Documentation
-------------

| Document | Description |
|----------|-------------|
| [INSTALL.md](INSTALL.md) | Step-by-step installation: activation, autoloads, sibling extensions |
| [doc/USAGE.md](doc/USAGE.md) | PHP examples with real signatures for all adapters, customization layers |
| [doc/FAQ.md](doc/FAQ.md) | Answers to the most common questions and problems |
| [doc/TODO.md](doc/TODO.md) | Known gaps and planned improvements |
| [doc/SUPPORT.md](doc/SUPPORT.md) | How and where to get help |
| [LICENSE.md](LICENSE.md) | The complete GNU General Public License agreement |

Troubleshooting
---------------

Read the FAQ
- Some problems are more common than others. The most common ones are listed in [doc/FAQ.md](doc/FAQ.md).

Use our support systems
- If you have questions not handled by this document or the FAQ, you can reach us via [7x : se7enx.com](https://se7enx.com).
- If you find a bug or defect, please report it to the [Exponential Layouts API: Issue Tracker](https://github.com/se7enxweb/explayouts_api/issues).
