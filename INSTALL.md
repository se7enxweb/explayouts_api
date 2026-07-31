# Installing explayouts_api

## Requirements

- Exponential Legacy / Exponential 6, PHP 8.1+
- `extension/explayouts_content_browser` — `expLayoutsEzValueConverter` returns `expLayoutsContentBrowserItem` objects defined there

## 1. Put the extension in place

```
extension/explayouts_api
```

Exponential 6 can also load extensions from additional directories declared via `site.ini` `[ExtensionSettings] AdditionalExtensionDirectories[]`, if you keep suite extensions outside the default `extension/` directory.

## 2. Activate

Add it to the active extensions in `settings/override/site.ini.append.php`:

```ini
[ExtensionSettings]
ActiveExtensions[]=explayouts_api
```

(or `ActiveAccessExtensions[]` in a siteaccess `site.ini.append.php`).

The extension ships no INI settings, modules or templates — only the adapter classes plus an `autoloads/explayouts_api_autoload.php` class map.

## 3. Regenerate autoloads and clear caches

```bash
php bin/php/ezpgenerateautoloads.php -e
php bin/php/ezcache.php --clear-all --purge --allow-root-user
```

## Sibling extensions

Typically used together with `explayouts` (layout engine) and the content browser extensions (`explayouts_content_browser`, `explayouts_content_browser_core`, `explayouts_content_browser_ui`) that consume the converted items.
