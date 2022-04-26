/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import * as erAwardDescription from './er-award-description';
import * as erAwardMetaYear from './er-award-meta-year';
import * as erAwardInventory from './er-award-inventory';

const erAwardBlocks = [
	erAwardDescription,
	erAwardMetaYear,
	erAwardInventory,
];

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
