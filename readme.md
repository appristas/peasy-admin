# Peasy Admin

An easy-pease API to build custom admin pages

## Motivation

The existing Settings API in WP requires us to write lots of callbacks even for the simplest stuff. The reason behind this plugin is to simplify the way admin pages are being created. The plugins abstracts away all the quirks of Settings API and provides an easy to use API for building admin pages.

## Installation

You can install this plugin in two ways:


1. Install the plugin from [Wordpress Plugins](wp-plugin)
2. To install the plugin using Composer and [wpackagist](wpackagist), add the following line to composer.json:

	"wpackagist-plugin/peasy-admin": "^1.2.0"


[wp-plugin]: https://wordpress.org/plugins/peasy-admin/
[wpackagist]: https://wpackagist.org/search?q=peasy-admin&type=any&search=

## Getting Started

As the Settings API, Peasy Admin consists of the following elements: AdminPage, Section, and Field. First, let's create an admin page. It is recommended to use `peasy_init` action to ensure that the page will be generated without worrying about the order of plugins:

	add_action( 'peasy_init', function() {
        $admin_page = new PeasyAdmin\AdminPage( 'My Admin Page', 'my-admin-page' );
        $admin_page->setup();
    } );
    
`AdminPage` class requires title and slug parameters to create the admin page. `setup` method is needed to transform Peasy API into settings API. Therefore, all the sections and fields **must** be defined before `setup`.

## Reference

Check out the [Wiki](wiki) for usage, examples, and API reference.

[wiki]: https://github.com/appristas/peasy-admin/wiki

## Contributing

This project adheres to the [Open Code of Conduct][code-of-conduct]. By participating, you are expected to honor this code.

[code-of-conduct]: http://todogroup.org/opencodeofconduct/

### Bugs
If you have encountered a bug, please use [Github Issues][github-issues] to submit a an issue.

[github-issues]: https://github.com/appristas/peasy-admin/issues

### Submitting a Pull Request

Before submitting pull request please conform to [Wordpress PHP Coding Standards][wp-php-coding-standards]. Naming class names and file names are an exception to these guidelines until we can find a better solution.

1. Fork this repository
2. Create a new branch from master
2. Commit your changes
3. Push to the newly created branch
4. Submit a pull request
5. Sit back, relax, and wait for a response :smiley:

[wp-php-coding-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/

## License

This project is licensed under GPLv3. Please read the LICENSE file for details.
