/**
 * WordPress dependencies
 */
import { register } from '@wordpress/data';

/**
 * Internal dependencies
 */
import { registerBlocks } from './blocks';
import { store } from './store';

register( store );
registerBlocks();
