# HRSWP Employee Recognition

Author: Adam Turner  
Author: Washington State University  
URI: <https://github.com/washingtonstateuniversity/hrswp-employee-recognition>

<!--
Changelog formatting (http://semver.org/):

## Major.MinorAddorDeprec.Bugfix YYYY-MM-DD

### Added (for new features.)
### Changed (for changes in existing functionality.)
### Deprecated (for soon-to-be removed features.)
### Removed (for now removed features.)
### Fixed (for any bug fixes.)
### Security (in case of vulnerabilities.)
-->

## 1.0.0-alpha.4 (:construction: TBD)

### Changed

- Organize Changelog.
- Add `CHANGELOG.md` to Markdownlint ignore file. (e55811b)
- Upgrade @wordpress/scripts from 22.5.0 to 23.6.0. (df9e245)
- Upgrade @wordpress/icons from 8.4.0 to 9.5.0. (df9e245)
- Update composer dependencies. (8ea66ed)
- Update npm build tools. (d8a4d37)

### Fixed

- Fix sortable columns with all positive numbers. (e465bb5)
- Update Terser dependency. (99331b4)

## 1.0.0-alpha.3 (:construction: 2022-07-08)

### Added

- [WIP] Make awards year and quantity columns sortable. (cb48f23)
- [WIP] Add custom columns to the awards posts list table. (651dd3a)
- Set up activation and deactivation actions to flush rewrite rules. (fa24608)

### Changed

- Make award post type hierarchical to organize award variants, close #8. (66fb9c5)
- Switch from `-1` to `1` to represent "all years" option group. (8d726f1)

## 1.0.0-alpha.2 (:construction: 2022-06-13)

### Added

- Create GitHub CI actions workflow. (d964171)
- Add styles shared by all award blocks. (b979a2b)
- Create Award Inventory block with quantity and reserve meta controls. (a7d182f)
- Create Stylelint config to load CSS-specific rules and modify exceptions. (5131a39)
- Add Prettier lint config for better editor integration. (2645864)
- Add wp-pretter package. (2645864)

### Changed

- Add status badges to readme. (c4dda1c)
- Add type, prefers-stable and change versions in Composer config.
- Update inventory block with icons and help text. (a7d182f)
- Update PHP linter config to check PHP 7.4+ and be more lean. (77d10d7)
- Replace `phpcompatibility/php-compatibility` with `phpcompatibility/phpcompatibility-wp`. (77d10d7)
- Add `type`, `prefers-stable` and change versions in Composer config. (77d10d7)

## 1.0.0-alpha.1 (:construction: 2022-04-25)

### Added

- Add editor styles for award description block. (fc510cb)
- Create GitHub pull request template. (56bba73)
- Create GitHub enhancement and help forms with general config. (e397e15)
- Create GitHub issue template form. (e397e15)
- Require -1 option value for All Years group and sanitize other negative integers. (218a5c3)
- Use award years settings option for radio component. (e01e4c0)
- Add option store request for year tiers and correct React component naming. (8bdda5f)
- Set up rest route and callback for ER options API. (8bdda5f)
- Create WP REST API route for getting plugin option values. (8bdda5f)
- Create plugin settings with award years option control, close #4. (8bdda5f)
- Hide ER award blocks from the inserter. (947478e)
- Set up award post type template with description and year meta blocks. (947478e)
- Method to replace the title placeholder text for ER Awards custom posts. (502a381)
- Create Award Year meta block. (da7b2c1)
- Create Award Description block. (502a381, 0150b45)
- Add block and block asset registration methods. (502a381)
- Create post meta registration with Group key. (e5403e7)
- Create base Employee Recognition Award post type. (e5403e7)
- Create main script and style entrypoints for WP Scripts build processes. (f96cd49)
- Create main plugin entrypoint with WordPress header content. (f96cd49)
- Create `.npmpackagejsonlintrc.json` to extend WordPress rules to allow GPL 3+ license. (81c9e40)
- Create `.markdownlint` ignore file to ignore the generated license. (643d8a1)
- Create postcss config file to override default from WordPress, adding rules for PostCSS Preset Env and PostCSS Import. (3cfe368)
- Create composer config, install linting packages, and create php linter config. (acd9eed)
- Create `package.json`, `.gitignore`, and `.editorconfig` files. (acd9eed, 81c9e40)
- Create and rename license file.
- Add readme, contributing guidelines, and changelog. (3f4e145) 
- Add cssnano package. (1112a86)
- Add classnames package. (19a07ae)
- Add @wordpress/icons package. (f4cd9ea, 79e6c2a)
- Add postcss-import and postcss-preset-env packages. (3cfe368)
- Add npm-run-all package. (acd9eed)
- Add wp-scripts package. (acd9eed, 4ccbfdc)
