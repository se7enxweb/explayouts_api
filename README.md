# explayouts_api

Public PHP API adapters bridging Exponential content to Exponential Layouts for Exponential 6. This extension provides the integration-facing helper classes that load, validate, convert and link `eZContentObject` / `eZContentObjectTreeNode` values for the layouts stack — for example turning a node into an `expLayoutsContentBrowserItem` for the content picker, or resolving the content context of the current request for the layout resolver.

Exponential Legacy port inspired by the `netgen/layouts-ibexa` package: it covers the roles of that bundle's content providers, value converters/loaders, URL generators and validators as plain PHP classes without a Symfony service container.

## Classes

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

## Documentation

- [INSTALL.md](INSTALL.md) — activation
- [doc/USAGE.md](doc/USAGE.md) — PHP examples with real signatures, customization
- [doc/FAQ.md](doc/FAQ.md) — common questions
- [doc/TODO.md](doc/TODO.md) — known gaps
- [doc/SUPPORT.md](doc/SUPPORT.md) — how to get help
