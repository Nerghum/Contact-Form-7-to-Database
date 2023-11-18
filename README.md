# Contact Form 7 to Database Plugin

## Description

This WordPress plugin saves Contact Form 7 form data to a database. It creates a table to store form submissions and provides an admin interface to view the saved data.

## Installation

1. Upload the entire `contact-form-7-to-database` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The plugin will automatically create a database table on activation.

## Usage

1. Create and configure Contact Form 7 forms on your WordPress site.
2. When a Contact Form 7 form is submitted, the plugin saves the form data to the database.
3. Access the 'CF7 Form Data' menu in the WordPress admin to view the stored form submissions.

## Database Structure

The plugin creates a table in the WordPress database to store form submissions:

- Table Name: `wp_cf7_data`
- Columns:
  - `id` (INT): Auto-incremented primary key.
  - `form_id` (INT): Contact Form 7 form ID.
  - `form_data` (TEXT): JSON-encoded form data.

## Changelog

### 1.0
- Initial release.

## License

This plugin is licensed under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Support

For support or issues, please [open an issue](https://github.com/nerghum/Contact-Form-7-to-Database/issues) on GitHub.

## Contribute

Feel free to contribute to the development of this plugin by [forking the repository](https://github.com/nerghum/Contact-Form-7-to-Database) and submitting pull requests.

## Author

Nerghum

## Acknowledgments

- [Contact Form 7](https://contactform7.com/) - The original form plugin for WordPress.

