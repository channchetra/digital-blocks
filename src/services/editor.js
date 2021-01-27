import { RichText } from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
export default function Editor( {className} ){
    const rootURL = "https://demo.cambodia.gov.kh/wp-json/";
    apiFetch.use( apiFetch.createRootURLMiddleware( rootURL ) );
    apiFetch( { url: '/wp/v2/service-topic' } ).then( posts => {
        console.log( posts );
    } );
    return(
        <div className={className}>
            <RichText
                tagName= "h4"
                placeholder= "Let's start the services"
                value= ""
            />
        </div>
    );
}
// class ServicePostEdit extends Component {
    
//     render(){
//         console.log(props)
//         return(
//             <h1>Hello From Editor</h1>
//         )
//     }
// }
// export default ServicePostEdit;