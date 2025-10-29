import './bootstrap';

import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

ClassicEditor
    .create( document.querySelector( '#editor' ), {
        licenseKey: '<YOUR_LICENSE_KEY>',
        plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        ],
        fontSize: {
            options: [ 10, 12, 14, 16, 18, 20, 22 ]
        },
        fontFamily: {
            options: [
                'default',
                'Montserrat, sans-serif',
                'Inter, sans-serif'
            ]
        }
    } )
    .then( editor => {
        console.log( 'Editor ready' );
    } )
    .catch( error => {
        console.error( 'Error:', error );
    } );
