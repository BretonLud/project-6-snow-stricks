import {Controller} from "@hotwired/stimulus";
import {BlockQuote, Bold, ClassicEditor, CodeBlock, Essentials, Font, Heading, Italic, Link, List, Paragraph, Undo, WordCount} from "ckeditor5";
import "@ckeditor/ckeditor5-build-classic/build/translations/fr"
export default class extends Controller {

    static targets = ["editor"];

    connect() {
        this.initializeEditor()
    }

    initializeEditor() {
        const maxCharacters = 10000;
        const container = document.querySelector( '.update' );
        const progressCircle = document.querySelector( '.update__chart__circle' );
        const charactersBox = document.querySelector( '.update__chart__characters' );
        const circleCircumference = Math.floor( 2 * Math.PI * progressCircle.getAttribute( 'r' ) );

        let language = 'en';
        let placeholder = "Trick content"
        if (navigator.language === 'fr' || navigator.language === 'fr-FR')
        {
            language = 'fr'
            placeholder = "Description du trick"
        }

        const textarea = this.editorTarget;
        const form = textarea.closest('form');
        const btn = form.querySelector('button[type="submit"]');
        ClassicEditor
            .create(textarea, {
                language: language,
                placeholder: placeholder,
                plugins: [ WordCount, Paragraph, Font, Bold, Essentials, Italic, Undo, Heading, Link, BlockQuote, CodeBlock, List],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'heading',
                        '|',
                        'fontfamily', 'fontsize', 'fontColor',
                        '|',
                        'bold', 'italic',
                        '|',
                        'link', 'blockQuote', 'codeBlock',
                        '|',
                        'bulletedList', 'numberedList'
                    ],
                    shouldNotGroupWhenFull: false
                },
                wordCount: {
                    onUpdate: stats => {
                        const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                        const isLimitExceeded = stats.characters > maxCharacters;
                        const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .8;
                        const circleDashArray = Math.min( charactersProgress, circleCircumference );

                        // Set the stroke of the circle to show how many characters were typed.
                        progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                        // Display the number of characters in the progress chart. When the limit is exceeded,
                        // display how many characters should be removed.
                        if ( isLimitExceeded ) {
                            charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                        } else {
                            charactersBox.textContent = stats.characters;
                        }

                        // If the content length is close to the character limit, add a CSS class to warn the user.
                        container.classList.toggle( 'update__limit-close', isCloseToLimit );

                        // If the character limit is exceeded, add a CSS class that makes the content's background red.
                        container.classList.toggle( 'update__limit-exceeded', isLimitExceeded );

                        // If the character limit is exceeded, disable the send button.
                        btn.toggleAttribute( 'disabled', isLimitExceeded );
                    }
                }
            })
            .then(editor => {

                editor.setData(textarea.value);

                btn.addEventListener('click', (e) => {
                    e.preventDefault();

                    if (!editor.getData()) {
                        const errorContent = document.querySelector('.content-error');
                        errorContent.textContent = "Trick content is required.";

                        if (language === 'fr') {
                            errorContent.textContent = "La description du trick est requis.";
                        }

                        errorContent.style.display = 'block';
                        return;
                    }

                    textarea.value = editor.getData();

                    form.requestSubmit()
                })
            }).catch(error => {
                console.error(error);
        })

    }
}
