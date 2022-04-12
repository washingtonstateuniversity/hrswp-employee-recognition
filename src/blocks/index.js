/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import * as erAwardDescription from './er-award-description';
import * as erAwardMetaYear from './er-award-meta-year';

const erAwardBlocks = [ erAwardDescription, erAwardMetaYear ];

const registerBlock = ( block ) => {
	if ( ! block ) {
		return;
	}
	const { metadata, settings, name } = block;
	registerBlockType( name, {
		...metadata,
		...settings,
	} );
};

export const registerBlocks = () => {
	erAwardBlocks.forEach( registerBlock );
};
