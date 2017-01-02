# Models

Simple WordPress plugin to create custom post types and taxonomies using JSON files.

## Installation

### Composer:

Recommended method; [Roots Bedrock](https://roots.io/bedrock/) and [WP-CLI](http://wp-cli.org/)
```shell
$ composer require soberwp/models
$ wp plugin activate models
```

### Manual:

* Download the [zip file](https://github.com/soberwp/models/archive.master.zip)
* Unzip to your sites plugin folder
* Activate via WordPress

## Requirements

* [PHP](http://php.net/manual/en/install.php) >= 5.6.x

## Usage

By default, Models will create a folder called `model-json/` within the active theme directory. 

If you'd like to specify a custom path you can use the following filter within your themes `functions.php` file; 
```php

add_filter('sober/models/path', function () {
    return get_stylesheet_directory() . '/your-custom-directory';
});
```

That's it, now all you need to do is add `model-name.json` files within the default or specified folder to register your models.

## Models

The `.json` data structure follows a similar data structure to WordPress taxonomies and post types arrays, so if an config option is missing from the examples below, follow the developers reference and place within `"config": {}`

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

**Bonus:** short-hand `"type": "cpt"` also works.

#### Basic Example:

[post-type-basic.json](.github/post-type-basic.json)

```json
{
  "type": "cpt",
  "name": "book",
  "supports": [
    "title", 
    "editor", 
    "thumbnail"
  ],
  "labels": {
    "one": "Book",
    "many": "Books",
    "text_domain": "sage"
  }
}
```

**Heads up:** In this case, `"labels": {}` are useless because `"Book"` and `"Books"` would have been generated from the name.

#### All Fields:

[post-type-all.json](.github/post-type-all.json)

```json
{
  "active": true,
  "type": "cpt",
  "name": "book",
  "supports": [
    "title", 
    "editor", 
    "comments", 
    "revisions", 
    "trackbacks", 
    "author", 
    "excerpt", 
    "page-attributes", 
    "thumbnail", 
    "custom-fields", 
    "post-formats"
  ],
  "labels": {
    "has_one": "Book",
    "has_many": "Books",
    "text_domain": "sage",
    "overrides": {
      "name": "Books",
      "singular_name": "Book",
      "menu_name": "Books",
      "name_admin_bar": "Book",
      "add_new": "Add New",
      "add_new_item": "Add New Book",
      "edit_item": "Edit Book",
      "new_item": "New Book",
      "view_item": "View Book",
      "view_items": "View Books",
      "search_items": "Search Books",
      "not_found": "No books found.",
      "not_found_in_trash": "No books found in Trash.",
      "parent_item-colon": "Parent Books:",
      "all_items": "All Books",
      "archives": "Book Archives",
      "attributes": "Book Attributes",
      "insert_into_item": "Insert into book",
      "uploaded_to_this_item": "Uploaded to this book",
      "featured_image": "Featured Image",
      "set_featured_image": "Set featured image",
      "remove_featured_image": "Remove featured image",
      "use_featured_image": "Use featured image",
      "filter_items_list": "Filter books list",
      "items_list_navigation": "Books list navigation",
      "items_list": "Books list"
    }
  },
  "config": {
    "public": true,
    "publicly_queryable": true,
    "show_ui": true,
    "show_in_menu": true,
    "query_var": true,
    "has_archive": true,
    "hierarchical": false,
    "menu_position": null,
    "can_export": true,
    "capability_type": "post",
    "rewrite": {
      "slug": "book",
      "with_front": true,
      "feeds": true,
      "pages": true
    }
  }
}
```

**Bonus:** `"active": false` stops the taxonomy from being created. Default is set to true.

### Taxonomies

Create a custom taxonomy.

#### Required:

[taxonomy-required.json](.github/taxonomy-required.json)

```json
{
  "type": "taxonomy",
  "name": "book"
}
```

**Bonus:** short-hand `"type": "tax"` also works.

#### Basic Example:

[taxonomy-basic.json](.github/taxonomy-basic.json)

```json
{
  "type": "tax",
  "name": "genre",
  "links": [
    "post", 
    "book"
  ],
  "labels": {
    "one": "Book Genre",
    "many": "Book Genres",
    "text_domain": "sage"
  }
}
```

**Explanation:** `"links": "(string|array)"` assigns the taxonomy to post types. Defaults to `"links": "post"`

#### All Fields:

[taxonomy-all.json](.github/taxonomy-all.json)

```json
{
  "active": true,
  "type": "tax",
  "name": "genre",
  "links": [
    "post", 
    "book"
  ],
  "labels": {
    "has_one": "Genre",
    "has_many": "Genres",
    "text_domain": "sage",
    "overrides": {
      "name": "Genres",
      "singular_name": "Genre",
      "search_items": "Search Genres",
      "popular_items": "Popular Tags",
      "all_items": "All Tags",
      "parent_item": "Parent Category",
      "parent_item_colon": "Parent Category:",
      "edit_item": "Edit Tag",
      "view_item": "View Tag",
      "update_item": "Update Tag",
      "add_new_item": "Update New Tag",
      "new_item_name": "New Tag Name",
      "separate_items_with_commas": "Separate tags with commass",
      "add_or_remove_items": "Add or remove tags",
      "choose_from_most_used": "Choose from the most used tags",
      "not_found": "No tags found.",
      "no_terms": "No tags",
      "items_list_navigation": "Tags list navigation",
      "items_list": "Tags list"
    }
  },
  "config": {
    "public": true,
    "publicly_queryable": true,
    "show_ui": true,
    "show_in_menu": true,
    "show_in_nav_menus": true,
    "show_in_rest": true,
    "rest_base": "genre",
    "rest_controller_class": "WP_REST_Terms_Controller",
    "show_tagcloud": true,
    "show_in_quick_edit": true,
    "show_admin_column": false,
    "capabilities": {
      "manage_terms": "manage_categories",
      "edit_terms": "manage_categories",
      "delete_terms": "manage_categories",
      "assign_terms": "edit_posts"
    },
    "rewrite": {
      "slug": "genre",
      "hierarchical": false
    }
  }
}
```

**Bonus:** `"active": false` stops the taxonomy from being created.

## Updating

### Composer:

**Change the composer.json version to ^1.0.0**<br>
Please check [CHANGELOG.md](CHANGELOG.md) for any breaking changes before updating.

```shell
$ composer update
```

### WordPress:

Includes support for [github-updater](https://github.com/afragen/github-updater) to keep track on updates through the WordPress backend.
* Download [github-updater](https://github.com/afragen/github-updater)
* Clone [github-updater](https://github.com/afragen/github-updater) to your sites plugins/ folder
* Activate via WordPress

## Social

* Twitter [@withjacoby](https://twitter.com/withjacoby)
