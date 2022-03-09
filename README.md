# Manifest

![License](https://img.shields.io/github/license/laravite/manifest)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/laravite/manifest)
![Packagist Downloads](https://img.shields.io/packagist/dt/laravite/manifest)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/laravite/manifest/CI)

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

## Manifest validation

**Manifest** can optionally validate the Vite manifest against its JSON schema to ensure
that it is valid. To enable validation, installed the suggested `opis/json-schema` package and
pass `true` to the `parse` method.

```php
$manifest = Manifest::parse($json, validate: true);
```

## License

**Manifest** is open-sourced software licensed under the [MIT license].

[Vite]: https://vitejs.org
[Packagist]: https://packagist.org
[Composer]: https://getcomposer.org
[MIT license]: LICENSE.md
