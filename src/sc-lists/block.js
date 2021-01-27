import './style.scss'
import './editor.scss'
const { __ } = wp.i18n
import MarkText from '../components/MarkText.jsx'
const { registerBlockType } = wp.blocks
const { InspectorControls  } = wp.blockEditor
const { PanelBody, __experimentalNumberControl : NumberControl, __experimentalInputControl : InputControl } = wp.components
const { Fragment } = wp.element
registerBlockType( 'digital-blocks/sc-lists', {
	title: __( 'Serivce Cambodia Lists', 'CEGOV' ),
	icon: 'admin-page',
	category: 'digital-blocks',
	keywords: [
		__( 'service', 'CEGOV' ),
		__( 'cambodia', 'CEGOV' ),
		__( 'egov block', 'CEGOV' )
	],
	attributes: {
		mark_text: {
            type: 'string',
			default: 'Service Cambodia Lists'
		},
		toggle_panel: {
			type: 'boolean',
			default: false
		},
		api: {
			type: 'string',
			default: ''
		}
	},
	edit: ( { attributes, setAttributes } ) => {
		const {
			mark_text, 
			toggle_panel,
			api
		} = attributes

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody>
						<MarkText
							attributes={attributes}
							setAttributes={setAttributes}
						/>
					</PanelBody>
					<PanelBody 
						title={ __( 'Block Options', 'CEGOV' ) }
						initialOpen={ toggle_panel }
						onToggle={ () => {
							setAttributes( { toggle_panel: ! toggle_panel } ) 
						} }
					>
						<InputControl
							label={ __( 'Api URL', 'CEGOV' ) }
							value={ api }
							onChange={ ( value ) => setAttributes( { api: value } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={ 'border p-3' }>
					<small>{ mark_text }</small>
				</div>
			</Fragment>
		)
	},
	
	save: ( { attributes } ) => {
		return null
	}
} )