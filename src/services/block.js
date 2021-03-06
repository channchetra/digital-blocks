import './style.scss'
import './editor.scss'
const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { InspectorControls  } = wp.blockEditor
const { PanelBody, __experimentalNumberControl : NumberControl, __experimentalInputControl : InputControl } = wp.components
const { Fragment } = wp.element
import MarkText from '../components/MarkText.jsx'
registerBlockType( 'digital-blocks/services', {
	title: __( 'Serivce Container', 'CEGOV' ),
	icon: <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><title>Artboard 16 copy 2</title><path d="M91.92,25l0-.06a1.49,1.49,0,0,0-.28-.46l0,0h0a1.5,1.5,0,0,0-.44-.32l0,0a1.49,1.49,0,0,0-.51-.12H9.4a1.49,1.49,0,0,0-.51.12l0,0a1.5,1.5,0,0,0-.44.32h0l0,0A1.49,1.49,0,0,0,8.1,25l0,.06A1.48,1.48,0,0,0,8,25.5v52A1.5,1.5,0,0,0,9.5,79h81A1.5,1.5,0,0,0,92,77.5v-52A1.48,1.48,0,0,0,91.92,25ZM89,73.6,64.26,51.51,89,28.9ZM11,28.9,35,50.84,11,73.07ZM61,50.38a1.42,1.42,0,0,0-.16.12l0,.06L50,60.47,13.37,27H86.63ZM37.23,52.87,49,63.61a1.5,1.5,0,0,0,2,0L62,53.54,87.19,76H12.25Z"/></svg>,
	category: 'digital-blocks',
	keywords: [
		__( 'egovernment', 'CEGOV' ),
		__( 'egov block', 'CEGOV' )
	],
	attributes: {
		mark_text: {
            type: 'string',
			default: 'Exchange Rate'
		},
		toggle_panel: {
			type: 'boolean',
			default: false
		},
		api: {
			type: 'string',
			default: ''
		},
		item_to_show: {
			type: 'string',
			default: 8
		}
	},
	edit: ( { attributes, setAttributes } ) => {
		const {
			mark_text, 
			toggle_panel,
			api, 
			item_to_show
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
						<NumberControl
							label={ __( 'Item To Show', 'CEGOV' )  }
							isShiftStepEnabled={ true }
							shiftStep={ 10 }
							value={ item_to_show }
							onChange={ ( item ) => setAttributes( { item_to_show: item } ) }
							min={ -1 }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={ 'border p-3' }>
					<small>{ mark_text }</small>
				</div>
			</Fragment>
		)
	},
	
	save: () => {
		return null
	}
} )