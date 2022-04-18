/**
 * Returns an action object used in fetching data from apiFetch.
 *
 * @param {string} path The WP REST API path.
 *
 * @return {Object} Action object.
 */
export function fetchFromAPI( path ) {
	return {
		type: 'FETCH_FROM_API',
		path,
	};
}

/**
 * Returns an action object used for retrieving an option value.
 *
 * This is essentially a WP REST API alias for `get_option`.
 *
 * @param {string} option Name of the option to retrieve.
 *
 * @return {Object} Action object.
 */
export function getOption( option ) {
	return {
		type: 'GET_OPTION',
		option,
	};
}
