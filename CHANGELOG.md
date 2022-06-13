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

## 1.0.0-alpha.2 (:construction: TBD)

### Added

- Add block and block asset registration methods. (502a381)
- Add editor styles for award description block. (fc510cb)
- Create Award Inventory block with quantity and reserve meta controls. (a7d182f)
- Create Award Year meta block; add to ER Award post type template; and use Award Years settings option to radio component options. (da7b2c1, 947478e, e01e4c0)
- Create Award Description block and add to ER Award post type template. (502a381, 947478e)
- Add option store request for year tiers and correct React component naming. (8bdda5f)
- Create WP REST API route for getting plugin option values. (8bdda5f)
- Set up rest route and callback for ER options API; use `-1` value for "All Years" option. (8bdda5f, 218a5c3)
- Create plugin settings with award years option control, close #4. (8bdda5f)
- Method to replace the title placeholder text for ER Awards custom posts. (502a381)
- Create base Employee Recognition Award post type and create template. (e5403e7, 947478e)
- Create post meta registration with Group key. (e5403e7)
- Create main script and style entrypoints for WP Scripts build processes. (f96cd49)
- Create main plugin entrypoint with WordPress header content. (f96cd49)
- Create GitHub issue template form. (e397e15)
- Create GitHub enhancement and help forms with general config. (e397e15)
- Create GitHub pul request template. (56bba73)
- Create GitHub CI actions workflow. (d964171)
- Add readme, contributing guidelines, and changelog. (3f4e145, c4dda1c)
- Create `.markdownlint` ignore file to ignore the generated license. (643d8a1)
- Create `.npmpackagejsonlintrc.json` to extend WordPress rules to allow GPL 3+ license. (81c9e40)
- Create `package.json`, `.gitignore`, and `.editorconfig` files. (acd9eed)
- Create composer config, install linting packages, and create php linter config. (acd9eed, 77d10d7)
- Create postcss config file to override default from WordPress, adding rules for PostCSS Preset Env and PostCSS Import. (3cfe368)
- Create Stylelint config to load CSS-specific rules and modify exceptions. (5131a39)
- Add cssnano package. (1112a86)
- Add classnames package. (19a07ae)
- Add @wordpress/icons package. (f4cd9ea, 79e6c2a)
- Add postcss-import and postcss-preset-env packages. (3cfe368)
- Add wp-scripts package. (acd9eed, 4ccbfdc)
- Add npm-run-all package. (acd9eed)
