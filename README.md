# Models

Simple WordPress plugin to create custom post types and taxonomies using JSON files.

## Installation

#### Composer:

Recommended method; [Roots Bedrock](https://roots.io/bedrock/) and [WP-CLI](http://wp-cli.org/)
```shell
$ composer require soberwp/models
$ wp plugin activate models
```

#### Manual:

* Download the [zip file](https://github.com/soberwp/models/archive.master.zip)
* Unzip to your sites plugin folder
* Activate via WordPress

#### Requirements:

* [PHP](http://php.net/manual/en/install.php) >= 5.6.x

## Setup

By default, create folder `model-json/` within the active theme directory. 

Alternatively, you can define a custom path using the filter below within your themes `functions.php` file; 
```php

add_filter('sober/models/path', function () {
    return get_stylesheet_directory() . '/your-custom-folder';
});
```

That's it, now go ahead and add `model-name.json` files in the folder or subfolders to begin creating your models.

## Usage

The JSON data structure follows a similar data structure to WordPress taxonomies and post types arrays, so if an config option is missing from the examples below, follow the developers reference and place within `"config": {}`

If values are not specified, defaults are the same as WordPress defaults.

### Post Types

Create a custom post type.

#### Required:

[post-type-required.json](.github/post-type-required.json)

```json
{
  "type": "post-type",
  "name": "book"
}
```

#### Basic:

[post-type-basic.json](.github/post-type-basic.json)

```json
{
  "type": "cpt",
  "name": "book",
  "supports": [
    "title", "editor", "thumbnail"
  ],
  "labels": {
    "has_one": "Book",
    "has_many": "Books",
    "text_domain": "sage"
  }
}
```

In the above example, `"labels": {}` are redundant because `"Book"` and `"Books"` would have been generated from `"name"`.

#### Multiple:

[post-type-multiple.json](.github/post-type-multiple.json)

```json
[
  {
    "type": "cpt",
    "name": "book",
    "supports": [
      "title", "editor", "thumbnail"
    ]
  },
  {
    "type": "cpt",
    "name": "album",
    "supports": [
      "title", "editor", "comments"
    ]
  }
]
```

#### All Fields:

[post-type-all.json](.github/post-type-all.json)

#### Post Type Tips:

* `"active": false` stops the post type from being created. Default is set to `true`.
* `"type": "post-type"` also accepts a shorthand `"type": "cpt"`;

### Taxonomies

Create a custom taxonomy.

#### Required:

[taxonomy-required.json](.github/taxonomy-required.json)

```json
{
  "type": "taxonomy",
  "name": "genre"
}
```

#### Basic:

[taxonomy-basic.json](.github/taxonomy-basic.json)

```json
{
  "type": "tax",
  "name": "genre",
  "links": [
    "post", "book"
  ],
  "labels": {
    "has_one": "Book Genre",
    "has_many": "Book Genres",
    "text_domain": "sage"
  }
}
```

`"links": (string|array)` assigns the taxonomy to post types. Defaults to `"links": "post"`

#### Multiple:

[taxonomy-multiple.json](.github/taxonomy-multiple.json)

```json
[
  {
    "type": "category",
    "name": "genre",
    "links": "book"
  },
  {
    "type": "tag",
    "name": "author",
    "links": "book"
  }
]
```

`"type": "category"` and `"type": "tag"` shorthands are explained below under Tips.

#### All Fields:

[taxonomy-all.json](.github/taxonomy-all.json)

#### Taxonomy Tips:

* `"active": false` stops the taxonomy from being created. Default is set to `true`.
* `"type": "taxonomy"` also accepts shorthands;
  * `"type": "tax"`
  * `"type": "category"` or `"type": "cat"` creates a category taxonomy.
  * `"type": "tag"` creates a tag taxonomy.

## Updates

#### Composer:

* Change the composer.json version to ^1.0.2**
* Check [CHANGELOG.md](CHANGELOG.md) for any breaking changes before updating.

```shell
$ composer update
```

#### WordPress:

Includes support for [github-updater](https://github.com/afragen/github-updater) to keep track on updates through the WordPress backend.
* Download [github-updater](https://github.com/afragen/github-updater)
* Clone [github-updater](https://github.com/afragen/github-updater) to your sites plugins/ folder
* Activate via WordPress

## Social

* Twitter [@withjacoby](https://twitter.com/withjacoby)
