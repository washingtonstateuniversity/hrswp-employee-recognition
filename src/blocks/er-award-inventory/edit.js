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
import { box, pin } from "@wordpress/icons";

function ERAwardMetaInventoryEdit( { attributes, setAttributes } ) {
	const { isQuantityEditable } = attributes;
	const blockProps = useBlockProps();
	const postType = useSelect( ( select ) =>
		select( 'core/editor' ).getCurrentPostType(),
	[] );

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const quantityMetaFieldValue = meta.hrswp_er_awards_quantity;
	const reserveMetaFieldValue = meta.hrswp_er_awards_reserve;

	const updateQuantityMetaValue = ( newValue ) => {
		setMeta( { ...meta, hrswp_er_awards_quantity: Number( newValue ) } );
	};
	const updateReserveMetaValue = ( newValue ) => {
		setMeta( { ...meta, hrswp_er_awards_reserve: Number( newValue ) } );
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Inventory Management' ) }>
					<ToggleControl
						label={ __( 'Allow editing inventory' ) }
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
					label={ __( 'ER Award Quantity' ) }
					help={ __( 'The number of awards in inventory.' ) }
					beforeIcon={ box }
					value={ quantityMetaFieldValue }
					onChange={ updateQuantityMetaValue }
					min={ 0 }
					max={ 9999 }
					step={ 1 }
					withInputField={ true }
					disabled={ ! isQuantityEditable }
				/>
				<RangeControl
					label={ __( 'ER Award Reserve' ) }
					help={ __( 'The inventory amount at which an admin is notified.' ) }
					beforeIcon={ pin }
					value={ reserveMetaFieldValue }
					onChange={ updateReserveMetaValue }
					min={ 0 }
					max={ 9999 }
					step={ 1 }
					withInputField={ true }
					disabled={ ! isQuantityEditable }
					separatorType={ 'topFullWidth' }
				/>
			</div>
		</>
	);
}

export default ERAwardMetaInventoryEdit;
