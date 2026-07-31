# explayouts_api TODO

- `expLayoutsEzContentContextProvider::currentLocation()` only recognizes a leading numeric node id in the request URI; it does not resolve URL aliases — align it with the alias resolution the `explayouts` resolver already does (`expLayoutsResolver::nodeFromPath()`).
- `expLayoutsEzValueUrlGenerator::generateAbsolute()` does not add siteaccess or language prefixes to the URL alias.
- No language/translation parameter on the loaders and converters; they use the current locale context implicitly.
- Upstream roles not ported: content search backend for the browser, layout-aware view matchers.
- No automated tests.
