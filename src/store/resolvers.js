/**
 * Internal dependencies
 */
import * as actions from './actions';

/**
 * Requests the value of a given option.
 *
 * @param {string} option The option key to retrieve.
 *
 * @return {*} The option value.
 */
export function* getOption( option ) {
	const path = `employee-recognition/v1/option/${ option }`;
	const optionValue = yield actions.fetchFromAPI( path );

	if ( optionValue ) {
		return actions.getOption( optionValue );
	}
}
