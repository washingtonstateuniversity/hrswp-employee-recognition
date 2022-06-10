/**
 * External dependencies
 */
import { pickBy } from 'lodash';
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import {
	BaseControl,
	PanelBody,
	Placeholder,
	QueryControls,
	RadioControl,
	RangeControl,
	Spinner,
	ToggleControl,
	ToolbarGroup,
} from '@wordpress/components';
import { Fragment } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { dateI18n, format, __experimentalGetSettings } from '@wordpress/date';
import {
	InspectorControls,
	BlockAlignmentToolbar,
	BlockControls,
	__experimentalImageSizeControl as ImageSizeControl,
	useBlockProps,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { pin, list, grid } from '@wordpress/icons';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Internal dependencies
 */
import { STORE_NAME } from '../../store/constants';

/**
 * Module constants
 */
const MIN_EXCERPT_LENGTH = 10;
const MAX_EXCERPT_LENGTH = 100;
const MAX_POSTS_COLUMNS = 6;

export default function ERAwardsListEdit( { attributes, setAttributes } ) {
	const { awardsLayout, columns } = attributes;

	const {
		erAwards,
		erAwardYearsList,
	} = useSelect(
		( select ) => {
			const { getEntityRecords } = select( coreStore );
			const { getOption } = select( STORE_NAME );
			const erAwardsQuery = {
				per_page: -1,
				_embed: 'wp:featuredmedia',
			};

			return {
				erAwards: getEntityRecords(
					'postType',
					'hrswp_er_awards',
					erAwardsQuery
				),
				erAwardYearsList: getOption( 'hrswp_er_award_years' ),
			};
		},
		[]
	);

	const hasAwards = !! erAwards?.length;
	const hasYears = '' !== erAwardYearsList;
	const blockProps = useBlockProps( {
		className: classnames( {
			'wp-block-hrswp-er-awards-list': true,
			'is-grid': awardsLayout === 'grid',
			[ `columns-${ columns }` ]: awardsLayout === 'grid',
		} ),
	} );

	if ( ! hasAwards ) {
		return (
			<div { ...blockProps }>
				<Placeholder icon={ pin } label={ __( 'ER Awards' ) }>
					{ ! Array.isArray( hasAwards ) ? (
						<Spinner />
					) : (
						__( 'No awards found.' )
					) }
				</Placeholder>
			</div>
		);
	}

	if ( ! hasYears ) {
		return (
			<div { ...blockProps }>
				<Placeholder icon={ pin } label={ __( 'ER Awards' ) }>
					<Spinner />
				</Placeholder>
			</div>
		);
	}

	const erAwardYearsListArray = erAwardYearsList
		.split( /\r?\n/ )
		.filter( ( year ) => year );

	const groupHasAwards = ( group ) =>
		erAwards.some( ( award ) =>
			award.meta.hrswp_er_awards_year === Number( group )
		);

	const layoutControls = [
		{
			icon: grid,
			title: __( 'Grid view' ),
			onClick: () => setAttributes( { awardsLayout: 'grid' } ),
			isActive: awardsLayout === 'grid'
		},
		{
			icon: list,
			title: __( 'List view' ),
			onClick: () => setAttributes( { awardsLayout: 'list' } ),
			isActive: awardsLayout === 'list'
		},
	];

	const renderAwardItemTitle = ( title ) =>
		! title ? __( '(Untitled)' ) : title.trim();

	const renderAwardItem = ( award ) => {
		const {
			title,
			content,
			_embedded: image,
		} = award;

		console.log( content );

		let description = content.rendered;


		return (
			<>
				<figure>
					<img />
				</figure>
				<span>{ renderAwardItemTitle( title.rendered ) }</span>
				<div>
					{ content.rendered }
				</div>
			</>
		);
	};

	const renderAwardsForGroup = ( group, award, key ) => {
		const { hrswp_er_awards_year } = award.meta;

		if ( hrswp_er_awards_year === Number( group ) ) {
			return (
				<li key={ key }>
					{  renderAwardItem( award ) }
				</li>
			);
		}
	}

	const renderAwardGroups = () => {
		return (
			erAwardYearsListArray.map( ( year, key ) => {
				const yearGroupTitle = '-1' !== year
					? `${ year } Years`
					: 'All Years';

				if ( groupHasAwards( year ) ) {
					return (
						<Fragment key={ key }>
							<h2>{ yearGroupTitle }</h2>
							<ul>
								{ erAwards.map(
									( award, key ) =>
										renderAwardsForGroup( year, award, key )
								) }
							</ul>
						</Fragment>
					);
				}
			} )
		);
	};

	return (
		<div { ...blockProps }>
			<BlockControls>
				<ToolbarGroup controls={ layoutControls } />
			</BlockControls>
			{ renderAwardGroups() }
		</div>
	);
}
