import './style.scss'
import './editor.scss'
const { __ } = wp.i18n
import MarkText from '../components/MarkText.jsx'
const { registerBlockType } = wp.blocks
const { InspectorControls  } = wp.blockEditor
const { PanelBody, __experimentalNumberControl : NumberControl, __experimentalInputControl : InputControl } = wp.components
const { Fragment } = wp.element
registerBlockType( 'digital-blocks/sc-detail', {
	title: __( 'Serivce Cambodia Detail', 'CEGOV' ),
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
			default: 'Service Cambodia Detail'
		},
		toggle_panel: {
			type: 'boolean',
			default: false
		}
	},
	edit: ( { attributes, setAttributes } ) => {
		const {
			mark_text
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