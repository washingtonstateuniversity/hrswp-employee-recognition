# HRSWP Employee Recognition

## Overview

A WSU Human Resource Services WordPress plugin that helps to manage the employee recognition progmam.

## Description

- CRUD process for ER length-of-service awards.
- Inventory management for ER length-of-service awards.

## Installation

This plugin is not in the WordPress plugins directory. You have to install it manually either with SFTP or from the WordPress plugins screen:

1. [Download the latest version from GitHub](https://github.com/washingtonstateuniversity/hrswp-employee-recognition/releases/latest) and rename the zip file to: `hrswp-employee-recognition.zip`.
2. From here you can either extract the files into your plugins directory via SFTP or navigate to the Plugins screen in the admin area of your site to upload it through the plugin uploader (steps 3-5).
3. Select Plugins > Add New and then select the "Upload Plugin" button.
4. Select "Browse" and locate the downloaded zip file for the plugin (it **must** be a file in `.zip` format) on your computer. Select "Install Now."
5. You should receive a message that the plugin installed correctly. Select "Activate Plugin" or return to the plugins page to activate later.

### Updates

Please note that this plugin will not update automatically and will not notify of available updates. It is your responsibility to make sure you stay up to date with the latest version. It does include a GitHub repository URL in the Update URI field, so if you have a plugin that can update from GitHub then this plugin should be compatible with that.

### Deactivating and Deleting: Plugin Data


## For Developers

The plugin development environment uses the [WordPress Scripts](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/) package and relies on NPM and Composer. The `package.json` and `composer.json` manage necessary dependencies for testing and building. The scripts in `package.json` interface with the WP Scripts package to do most of the heavy lifting.

### Initial Setup

1. Clone the plugin to a directory on your computer.
2. Change into that directory.
3. Install the NPM and Composer dependencies.
4. Ensure linting and coding standards checks are working -- this should exit with zero (0) errors.
5. Create a new branch for local development.

In a terminal:

~~~bash
git clone https://github.com/washingtonstateuniversity/hrswp-employee-recognition.git
cd hrswp-employee-recognition
npm install
composer install
npm test -s
git checkout -b new-branch-name
~~~

### Build Commands

The following commands will handle basic build functions. (Remove the `-s` flag to show additional debug info.)

- `npm run build`: Transforms source code so it’s consolidated and optimized for production.
- `npm run lint`: Check all PHP, JS, and CSS files for coding style compliance.
- `npm run export`: Creates a zip file of the plugin for installation.

See the scripts section of `package.json` for additional available commands.

## Issues

Please submit bugs, fixes, and feature requests through [GitHub Issues](https://github.com/washingtonstateuniversity/hrswp-plugin-documents/issues). Please read (and adhere to) the guidelines for contributions detailed in the issue templates.

Read the [CHANGELOG.md](https://github.com/washingtonstateuniversity/hrswp-plugin-documents/blob/stable/CHANGELOG.md) to review release and update notes.

## Support Level

**Active:** WSU HRS actively works on this plugin. We plan to continue work for the foreseeable future, adding new features, enhancing existing ones, and maintaining compatability with the latest version of WordPress. Bug reports, feature requests, questions, and pull requests are welcome.

## Changelog

All notable changes are documented in the [CHANGELOG.md](https://github.com/washingtonstateuniversity/hrswp-employee-recognition/blob/develop/CHANGELOG.md), with dates and version numbers.

## Contributing

Please submit bugs and feature requests through [GitHub Issues](https://github.com/washingtonstateuniversity/hrswp-employee-recognition/issues). Refer to [CONTRIBUTING.md](https://github.com/washingtonstateuniversity/hrswp-employee-recognition/blob/develop/CONTRIBUTING.md) for the development workflow and details for submitting pull requests.
