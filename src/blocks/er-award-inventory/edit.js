/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	PanelBody,
	ToggleControl,
	RangeControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";

function ERAwardMetaInventoryEdit( { attributes, setAttributes } ) {
	const { isQuantityEditable } = attributes;
	const blockProps = useBlockProps();
	const postType = useSelect( ( select ) =>
		select( 'core/editor' ).getCurrentPostType(),
	[] );

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const quantityMetaFieldValue = meta.hrswp_er_awards_quantity;

	const updateQuantityMetaValue = ( newValue ) => {
		setMeta( { ...meta, hrswp_er_awards_quantity: Number( newValue ) } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Inventory Management' ) }>
					<ToggleControl
						label={ __( 'Allow editing quantity' ) }
						checked={ !! isQuantityEditable }
						onChange={ () =>
							setAttributes( {
								isQuantityEditable: ! isQuantityEditable,
							} )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<RangeControl
					label="ER Award Quantity"
					value={ quantityMetaFieldValue }
					onChange={ updateQuantityMetaValue }
					min={ 0 }
					max={ 9999 }
					step={ 1 }
					withInputField={ true }
					disabled={ ! isQuantityEditable }
				/>
			</div>
		</>
	);
}

export default ERAwardMetaInventoryEdit;
