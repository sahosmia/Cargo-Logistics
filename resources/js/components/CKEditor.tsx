import { useEffect, useRef } from 'react';

interface CKEditorProps {
    value: string;
    onChange: (value: string) => void;
    placeholder?: string;
}

export default function CKEditor({ value, onChange, placeholder }: CKEditorProps) {
    const textareaRef = useRef<HTMLTextAreaElement>(null);
    const editorInstance = useRef<any>(null);

    useEffect(() => {
        if (!textareaRef.current) return;

        const ClassicEditor = (window as any).ClassicEditor;
        if (!ClassicEditor) {
            console.warn('CKEditor 5 ClassicEditor is not defined on window.');
            return;
        }

        ClassicEditor.create(textareaRef.current, {
            placeholder: placeholder || 'Type your content here...',
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                'undo', 'redo'
            ]
        })
        .then((editor: any) => {
            editorInstance.current = editor;

            // Set initial value
            editor.setData(value || '');

            // Listen for changes
            editor.model.document.on('change:data', () => {
                const data = editor.getData();
                onChange(data);
            });
        })
        .catch((error: any) => {
            console.error('Error initializing CKEditor 5:', error);
        });

        // Clean up on unmount
        return () => {
            if (editorInstance.current) {
                editorInstance.current.destroy()
                    .then(() => {
                        editorInstance.current = null;
                    })
                    .catch((err: any) => {
                        console.error('Error destroying CKEditor 5 instance:', err);
                    });
            }
        };
    }, []);

    // Handle updates from parent state (e.g. initial loads, resets) without breaking cursor
    useEffect(() => {
        if (editorInstance.current) {
            const currentData = editorInstance.current.getData();
            if (currentData !== value) {
                editorInstance.current.setData(value || '');
            }
        }
    }, [value]);

    return (
        <div className="ckeditor-wrapper w-full border rounded-md overflow-hidden bg-background">
            <textarea ref={textareaRef} style={{ display: 'none' }} />
        </div>
    );
}
