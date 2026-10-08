import { createRoot, useState } from '@wordpress/element';

import {
	Button,
	TextControl,
	TextareaControl,
	Notice,
} from '@wordpress/components';

import {
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';

import {
	useSelect,
	useDispatch,
} from '@wordpress/data';

import '../assets/css/program-admin.css';


/* =========================================================
 * Program Admin
 * ========================================================= */

const ProgramAdmin = () => {

	/*
	 * Get current Program meta from WordPress editor.
	 */

	const meta = useSelect(
		( select ) =>
			select( 'core/editor' ).getEditedPostAttribute(
				'meta'
			) || {},
		[]
	);


	/*
	 * WordPress editor dispatcher.
	 */

	const { editPost } = useDispatch(
		'core/editor'
	);


	/*
	 * Program meta values.
	 */

	const academicYear =
		meta.academic_year || '';

	const duration =
		meta.duration || '';

	const contentSections =
		Array.isArray( meta.content_sections )
			? meta.content_sections
			: [];


	/*
	 * =====================================================
	 * Update Meta
	 * =====================================================
	 */

	const updateMeta = ( key, value ) => {

		editPost(
			{
				meta: {
					...meta,
					[ key ]: value,
				},
			}
		);
	};


	/*
	 * =====================================================
	 * Add Section
	 * =====================================================
	 */

	const addSection = () => {

		const updatedSections = [
			...contentSections,
			{
				title: '',
				description: '',
				image: '',
			},
		];

		updateMeta(
			'content_sections',
			updatedSections
		);
	};


	/*
	 * =====================================================
	 * Remove Section
	 * =====================================================
	 */

	const removeSection = ( index ) => {

		const updatedSections =
			contentSections.filter(
				( section, sectionIndex ) =>
					sectionIndex !== index
			);

		updateMeta(
			'content_sections',
			updatedSections
		);
	};


	/*
	 * =====================================================
	 * Update Section
	 * =====================================================
	 */

	const updateSection = (
		index,
		field,
		value
	) => {

		const updatedSections =
			contentSections.map(
				( section, sectionIndex ) => {

					if (
						sectionIndex !== index
					) {
						return section;
					}

					return {
						...section,
						[ field ]: value,
					};
				}
			);

		updateMeta(
			'content_sections',
			updatedSections
		);
	};


	/*
	 * =====================================================
	 * Move Section Up
	 * =====================================================
	 */

	const moveSectionUp = ( index ) => {

		if ( index === 0 ) {
			return;
		}

		const updatedSections = [
			...contentSections,
		];

		const temp =
			updatedSections[ index - 1 ];

		updatedSections[ index - 1 ] =
			updatedSections[ index ];

		updatedSections[ index ] = temp;

		updateMeta(
			'content_sections',
			updatedSections
		);
	};


	/*
	 * =====================================================
	 * Move Section Down
	 * =====================================================
	 */

	const moveSectionDown = ( index ) => {

		if (
			index ===
			contentSections.length - 1
		) {
			return;
		}

		const updatedSections = [
			...contentSections,
		];

		const temp =
			updatedSections[ index + 1 ];

		updatedSections[ index + 1 ] =
			updatedSections[ index ];

		updatedSections[ index ] = temp;

		updateMeta(
			'content_sections',
			updatedSections
		);
	};


	/*
	 * =====================================================
	 * Render
	 * =====================================================
	 */

	return (
		<div className="university-program-admin">

			<Notice
				status="info"
				isDismissible={ false }
			>
				Program information is saved with the
				Program post.
			</Notice>


			{/* =================================================
			 * Basic Information
			 * ================================================= */}

			<div className="program-admin-card">

				<div className="program-admin-card-header">

					<div>

						<h2>
							Program Information
						</h2>

						<p>
							Add the basic information for
							this program.
						</p>

					</div>

				</div>


				<div className="program-admin-fields">

					<TextControl
						label="Academic Year"
						help="Example: 2025-26"
						value={ academicYear }
						onChange={ ( value ) =>
							updateMeta(
								'academic_year',
								value
							)
						}
					/>


					<TextControl
						label="Duration"
						help="Example: 3 Years"
						value={ duration }
						onChange={ ( value ) =>
							updateMeta(
								'duration',
								value
							)
						}
					/>

				</div>

			</div>


			{/* =================================================
			 * Content Sections
			 * ================================================= */}

			<div className="program-admin-card">

				<div className="program-admin-card-header">

					<div>

						<h2>
							Content Sections
						</h2>

						<p>
							Add content sections for this
							program.
						</p>

					</div>


					<Button
						variant="primary"
						onClick={ addSection }
					>
						Add Section
					</Button>

				</div>


				{ contentSections.length === 0 && (

					<div className="program-admin-empty">

						<p>
							No content sections added yet.
						</p>

						<Button
							variant="secondary"
							onClick={ addSection }
						>
							Add Your First Section
						</Button>

					</div>

				) }


				{ contentSections.map(
					( section, index ) => (

						<SectionRow
							key={ index }
							section={ section }
							index={ index }
							total={
								contentSections.length
							}
							onUpdate={
								updateSection
							}
							onRemove={
								removeSection
							}
							onMoveUp={
								moveSectionUp
							}
							onMoveDown={
								moveSectionDown
							}
						/>

					)
				) }

			</div>

		</div>
	);
};


/* =========================================================
 * Section Row
 * ========================================================= */

const SectionRow = ( {
	section,
	index,
	total,
	onUpdate,
	onRemove,
	onMoveUp,
	onMoveDown,
} ) => {

	const [ isOpen, setIsOpen ] =
		useState( true );


	return (
		<div className="program-section-row">

			<div className="program-section-header">

				<div className="program-section-title">

					<strong>
						Section { index + 1 }
					</strong>

					<span>
						&nbsp;—&nbsp;
						{ section.title ||
							'Untitled Section' }
					</span>

				</div>


				<div className="program-section-actions">

					<Button
						variant="secondary"
						onClick={ () =>
							onMoveUp( index )
						}
						disabled={ index === 0 }
					>
						↑
					</Button>


					<Button
						variant="secondary"
						onClick={ () =>
							onMoveDown( index )
						}
						disabled={
							index === total - 1
						}
					>
						↓
					</Button>


					<Button
						variant="secondary"
						onClick={ () =>
							setIsOpen( ! isOpen )
						}
					>
						{ isOpen
							? 'Collapse'
							: 'Expand' }
					</Button>


					<Button
						variant="tertiary"
						isDestructive
						onClick={ () =>
							onRemove( index )
						}
					>
						Remove
					</Button>

				</div>

			</div>


			{ isOpen && (

				<div className="program-section-body">

					<TextControl
						label="Section Title"
						value={
							section.title || ''
						}
						onChange={ ( value ) =>
							onUpdate(
								index,
								'title',
								value
							)
						}
					/>


					<TextareaControl
						label="Section Description"
						value={
							section.description || ''
						}
						onChange={ ( value ) =>
							onUpdate(
								index,
								'description',
								value
							)
						}
						rows={ 5 }
					/>


					<div className="program-section-image">

						<strong>
							Section Image
						</strong>


						{ section.image && (

							<div className="program-image-preview">

								<img
									src={ section.image }
									alt=""
								/>

							</div>

						) }


						<MediaUploadCheck>

							<MediaUpload
								onSelect={ ( media ) =>
									onUpdate(
										index,
										'image',
										media.url
									)
								}
								allowedTypes={ [
									'image',
								] }
								render={ ( {
									open,
								} ) => (

									<Button
										variant="secondary"
										onClick={ open }
									>
										{ section.image
											? 'Change Image'
											: 'Select Image' }
									</Button>

								) }
							/>

						</MediaUploadCheck>


						{ section.image && (

							<Button
								variant="tertiary"
								isDestructive
								onClick={ () =>
									onUpdate(
										index,
										'image',
										''
									)
								}
							>
								Remove Image
							</Button>

						) }

					</div>

				</div>

			) }

		</div>
	);
};


/* =========================================================
 * Mount React
 * ========================================================= */

const rootElement =
	document.getElementById(
		'university-program-admin'
	);


if ( rootElement ) {

	createRoot(
		rootElement
	).render(
		<ProgramAdmin />
	);
}