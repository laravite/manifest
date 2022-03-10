# Manifest

[![License][license-badge]][MIT license]
[![Packagist PHP Version Support][version-badge]][Packagist]
[![Packagist Downloads][downloads-badge]][Packagist]
[![GitHub Workflow Status][workflow-status-badge]][workflow-status]

**Manifest** is a _framework-agnostic_ PHP library for parsing [Vite] manifest files.

## Installation

**Manifest** is distributed via [Packagist] and can be installed with [Composer].

```shell
composer require laravite/manifest
```

## Usage

**Manifest** is straightforward to use.

```php
// Parse a JSON-encoded manifest
$manifest = Manifest::parse($json);

// Retrieve entries
$allEntries = $manifest->entries;
$mainEntry = $manifest->entry('main.js');

// Retrieve chunks
$allChunks = $manifest->chunks;
$mainChunk = $manifest->chunk('main.js');
```

`Chunk` objects expose the following properties `file`, `isEntry`, `isDynamicEntry`, 
`src`, `css`, `assets`, `imports`, `dynamicImports`. Most of these properties are actually
optional, and will return `null` if they are not present on the chunk.

If the chunks of the parsed manifest contain additional fields, they will also be exposed
on the `Chunk` object. This make **Manifest** compatible with plugins that extend the original
manifest file.

## Manifest validation

**Manifest** can optionally validate the Vite manifest against its JSON schema to ensure
that it is valid. To enable validation, install the suggested `opis/json-schema` package and
pass `true` to the `validate` parameter.

```php
$manifest = Manifest::parse($json, validate: true);
```

## License

**Manifest** is open-sourced software licensed under the [MIT license].

[Vite]: https://vitejs.org
[Composer]: https://getcomposer.org
[MIT license]: LICENSE.md
[license-badge]: https://img.shields.io/github/license/laravite/manifest
[Packagist]: https://packagist.org/packages/laravite/manifest
[version-badge]: https://img.shields.io/packagist/php-v/laravite/manifest
[downloads-badge]: https://img.shields.io/packagist/dt/laravite/manifest
[workflow-status]: https://github.com/laravite/manifest/actions/workflows/ci.yml
[workflow-status-badge]: https://img.shields.io/github/workflow/status/laravite/manifest/CI
