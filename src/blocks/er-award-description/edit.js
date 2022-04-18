/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __, _x, isRTL } from '@wordpress/i18n';
import { ToolbarDropdownMenu } from '@wordpress/components';
import {
	AlignmentControl,
	BlockControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { formatLtr } from '@wordpress/icons';

function ErAwardRTLControl( { direction, setDirection } ) {
	return (
		isRTL() && (
			<ToolbarDropdownMenu
				controls={ [
					{
						icon: formatLtr,
						title: _x( 'Left to right', 'editor button' ),
						isActive: direction === 'ltr',
						onClick() {
							setDirection(
								direction === 'ltr' ? undefined : 'ltr'
							);
						},
					},
				] }
			/>
		)
	);
}

function erAwardDescriptionEdit( {
	attributes,
	mergeBlocks,
	onReplace,
	onRemove,
	setAttributes,
} ) {
	const { align, content, direction, placeholder } = attributes;
	const blockProps = useBlockProps( {
		className: classnames( {
			[ `has-text-align-${ align }` ]: align,
		} ),
		style: { direction },
	} );

	return (
		<>
			<BlockControls group="block">
				<AlignmentControl
					value={ align }
					onChange={ ( newAlign ) =>
						setAttributes( { align: newAlign } )
					}
				/>
				<ErAwardRTLControl
					direction={ direction }
					setDirection={ ( newDirection ) =>
						setAttributes( { direction: newDirection } )
					}
				/>
			</BlockControls>
			<RichText
				identifier="content"
				tagName="p"
				{ ...blockProps }
				value={ content }
				onChange={ ( newContent ) =>
					setAttributes( { content: newContent } )
				}
				onMerge={ mergeBlocks }
				onReplace={ onReplace }
				onRemove={ onRemove }
				aria-label={
					content
						? __( 'ER Award Description' )
						: __( 'Describe the award.' )
				}
				data-empty={ content ? false : true }
				placeholder={ placeholder || __( 'Describe the award.' ) }
				__unstableEmbedURLOnPaste
				__unstableAllowPrefixTransformations
			/>
		</>
	);
}

export default erAwardDescriptionEdit;
