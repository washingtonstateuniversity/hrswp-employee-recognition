/**
 * Returns the value of the given option key.
 *
 * @param {Object} state Global application state.
 *
 * @return {*} The option value.
 */
export function getOption( state ) {
	const { option } = state;
	return option;
}
