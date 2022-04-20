/**
 * Internal dependencies
 */
import { OPTIONS_DEFAULTS } from './defaults';

/**
 * Reducer returns award years option state.
 *
 * @param {string} state  Current state.
 * @param {Object} action Currently dispatching action.
 *
 * @return {string} Updated state.
 */
function options( state = OPTIONS_DEFAULTS, action ) {
	switch ( action.type ) {
		case 'GET_OPTION':
			return {
				...state,
				option: action.option,
			};
	}

	return state;
}

export default options;
