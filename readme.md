# Peasy Admin

An easy-pease API to build custom admin pages

## Motivation

The existing Settings API in WP requires us to write lots of callbacks even for the simplest stuff. The reason behind this plugin is to simplify the way admin pages are being created. The plugins abstracts away all the quirks of Settings API and provides an easy to use API for building admin pages.

## Installation

You can install this plugin in two ways:


1. Install the plugin from [Wordpress Plugins](wp-plugin)
2. To install the plugin using Composer and [wpackagist](wpackagist), add the following line to composer.json:

    "wpackagist-plugin/peasy-admin": "1.0"


[wp-plugin]: https://wordpress.org/plugins/peasy-admin/
[wpackagist]: https://wpackagist.org/search?q=peasy-admin&type=any&search=

## Getting Started

As the Settings API, Peasy Admin consists of the following elements: AdminPage, Section, and Field. First, let's create an admin page. It is recommended to use `peasy_init` action to ensure that the page will be generated without worrying about the order of plugins:

	add_action( 'peasy_init', function() {
    	$admin_page = new PeasyAdmin\AdminPage( 'My Admin Page', 'my-admin-page' );
        $admin_page->setup();
    } );
    
`AdminPage` class requires title and slug parameters to create the admin page. `setup` method is needed to transform Peasy API into settings API. Therefore, all the sections and fields **must** be defined before `setup`.

### Sections
Sections are created in using the `section` function with section title.

	$section = $admin_page->section( 'Section #1' );
    
If you want to add description to section, you can do so using the `description` function:

	$section->description( 'This is section #1' );
    
If you want to have custom view for section content, you can do so using the `callback` function:

	$section->callback( function( $description ) {
    	?>
        <p style="color: red"><?php echo esc_html( $description ); ?></p>
        <?php
    } );
    
### Fields

All the fields in a section are stored in a container called FieldSet. This fieldset can be accesses using the `fields` function.

	$fields = $section->fields();

There are five fields that are baked into Peasy Admin. All the fields have two mandatory parameters: name and label. Label parameter is used to properly label the field in a form table while the name parameter is used to properly save it in the database.

#### Text Field:

	$fields->text( $name, $label, $type = 'text' );
    
This field creates a input HTML element with different types (email, date, datetime, number) related to `text`. The following example creates a text field with type `email`:

	$fields->text( 'email', 'My email', 'email' );

#### Textarea Field

	$fields->textarea( $name, $label );
    
This field creates textarea element. Example:

	$fields->textarea( 'about', 'About me' );

#### Checkbox Field:

	$fields->checkbox( $name, $label, $checkbox_label, $checkbox_value );
    
The last two arguments of these fields provide the value and the label for the checkbox element. Example:

	$fields->checkbox( 'tos', 'Agreeing to TOS?', 'Click to agree', 1 );
    
#### Radio Field:

	$fields->radio( $name, $label, $items );
    
The items parameter accepts array as input and creates the radio items. Example:

	$fields->radio( 'How do you get to work?', 'Bike or Car', [
    	'bike' => 'Bike',
        'car' => 'Car',
        'walk' => 'Walk',
        'subway' => 'Subway',
    ] );
    
In this example, the keys are the radio input value while the values of the array are the labels for the radio.

#### Dropdown Field:

	$fields->dropdown( $name, $label, $items );
    
The items parameter in dropdown field is similar to the items parameter in radio field. In dropdown field, the items array creates the select box items for the dropdown. Example:

	$fields->dropdown( 'fruits', 'Fruits', [
    	'apple' => 'Apple',
        'orange' => 'Orange',
    ] );

#### Custom Field:

	$fields->custom( $name, $label, $callback );
    
Custom field is used to create custom controls. The callback parameter of this field is a function that has name and value parameters. Anything written in a custom field is up to the developer. Here is an example of creating a textare field using custom field:

	$fields->custom( 'big_textarea', 'Big Textarea', function( $name, $value ) {
    	?>
        <textarea name="<?php echo esc_html( $name ); ?>" style="width: 500px; height: 250px"><?php echo esc_html( $value ); ?></textarea>
        <?php
    } );
    
### Wrapping it all together

Here is the resulting code of adding all the fields and sections together:

	add_action( 'peasy_init', function() {
    	$admin_page = new PeasyAdmin\AdminPage( 'My Admin Page', 'my-admin-page' );
        
        $admin_page->section( 'Section #1' )
        		->description( 'This is section #1' )
                ->callback( function( $description ) {
                	?>
                    <p style="color: red"><?php echo esc_html( $description ); ?></p>
                    <?php
                } )
                ->fields()
                	->text( 'email', 'My email', 'email' )
                    ->textarea( 'about', 'About me' )
                    ->checkbox( 'tos', 'Agreeing to TOS?', 'Click to agree', 1 )
                    ->radio( 'How do you get to work?', 'Bike or Car', [
    					'bike' => 'Bike',
				        'car' => 'Car',
				        'walk' => 'Walk',
				        'subway' => 'Subway',
				    ] )
                    ->dropdown( 'fruits', 'Fruits', [
    					'apple' => 'Apple',
				        'orange' => 'Orange',
				    ] )
                    ->custom( 'big_textarea', 'Big Textarea', function( $name, $value ) {
                        ?>
                        <textarea name="<?php echo esc_html( $name ); ?>" style="width: 500px; height: 250px"><?php echo esc_html( $value ); ?></textarea>
                        <?php
                    } );

        $admin_page->setup();
    } );
    
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
