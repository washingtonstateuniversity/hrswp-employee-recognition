/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Placeholder, RadioControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import { STORE_NAME } from '../../store/constants';

/**
 * Generates the radio control year options from the string.
 *
 * Adds the "All Years" option to the list of choices.
 *
 * @param {string} awardYearGroups A newline-separated string of award year groups.
 * @return {Object[]} The formatted award years for the radio component.
 */
function formatAwardYearOptions( awardYearGroups ) {
	const awardYears = awardYearGroups
		.split( /\r?\n/ )
		.filter( ( year ) => year )
		.map( ( yearGroup ) => {
			const yearGroupOption =
				'1' !== yearGroup
					? {
							label: `${ yearGroup } Years`,
							value: Number( yearGroup ),
					  }
					: { label: 'All Years', value: Number( yearGroup ) };

			return yearGroupOption;
		} );

	return awardYears;
}

function ERAwardMetaYearEdit() {
	const blockProps = useBlockProps();

	const { postType, erAwardYearGroups, isRequesting } = useSelect(
		( select ) => {
			const { getCurrentPostType } = select( 'core/editor' );
			const { getOption, isResolving } = select( STORE_NAME );

			return {
				postType: getCurrentPostType(),
				erAwardYearGroups: getOption( 'hrswp_er_award_years' ),
				isRequesting: isResolving( 'getOption', [
					'hrswp_er_award_years',
				] ),
			};
		},
		[]
	);

	const erAwardOptions =
		erAwardYearGroups?.length > 0
			? formatAwardYearOptions( erAwardYearGroups )
			: [];

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const metaFieldValue = meta.hrswp_er_awards_year;

	const updateMetaValue = ( newValue ) => {
		setMeta( { ...meta, hrswp_er_awards_year: Number( newValue ) } );
	};

	return (
		<div { ...blockProps }>
			{ isRequesting && (
				<Placeholder icon="admin-post" label={ __( 'ER Award Year' ) }>
					<Spinner />
				</Placeholder>
			) }
			<RadioControl
				label="ER Award Year"
				selected={ metaFieldValue }
				options={ erAwardOptions }
				onChange={ updateMetaValue }
			/>
		</div>
	);
}

export default ERAwardMetaYearEdit;
