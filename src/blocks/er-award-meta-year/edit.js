/**
 * WordPress dependencies
 */
import { RadioControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useBlockProps } from '@wordpress/block-editor';

function erAwardMetaYearEdit() {
	const blockProps = useBlockProps();
	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const metaFieldValue = meta[ 'hrswp_er_awards_year' ];

	const updateMetaValue = ( newValue ) => {
		setMeta( { ...meta, hrswp_er_awards_year: Number( newValue ) } );
	};

	return (
		<div { ...blockProps }>
			<RadioControl
				label="ER Award Year"
				selected={ metaFieldValue }
				options={ [
					{ label: 'All Years', value: -1 },
					{ label: '5 Years', value: 5 },
					{ label: '10 Years', value: 10 },
					{ label: '15 Years', value: 15 },
					{ label: '20 Years', value: 20 },
					{ label: '25 Years', value: 25 },
					{ label: '30 Years', value: 30 },
				] }
				onChange={ updateMetaValue }
			/>
		</div>
	);
}

export default erAwardMetaYearEdit;
