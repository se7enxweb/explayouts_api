# explayouts_api FAQ

## How does this differ from netgen/layouts-ibexa?

`netgen/layouts-ibexa` wires Netgen Layouts into Ibexa via Symfony services (content providers, value converters, URL generators, validators). This extension ports those roles to plain PHP classes over the eZ Publish legacy API (`eZContentObject`, `eZContentObjectTreeNode`, `eZContentClass`, `eZSection`) — no service container, no Ibexa Repository API.

## Which database tables does it own?

None. It only reads core content tables through the standard eZ persistence classes.

## What is an expLayoutsContentBrowserItem?

The value object of the `explayouts_content_browser` extension representing a pickable content item (id, name, URL alias, ...). `expLayoutsEzValueConverter::convert()` produces it from a node or object, which is why `explayouts_content_browser` is a dependency.

## When should I use loadContentInfo() instead of loadContent()?

`loadContent()` returns the full `eZContentObject`; `loadContentInfo()` returns a lightweight normalized array for listings and JSON responses where hydrating the whole object is unnecessary.

## How are absolute URLs built?

`generateAbsolute()` prefixes the item's URL alias with `site.ini` `[SiteSettings] SiteURL` of the current siteaccess. If an object has no main node, an empty string is returned.
