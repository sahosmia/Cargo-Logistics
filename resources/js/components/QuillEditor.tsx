import ReactQuill from 'react-quill-new';
import 'react-quill-new/dist/quill.snow.css';

interface QuillEditorProps {
    value: string;
    onChange: (value: string) => void;
    placeholder?: string;
}

export default function QuillEditor({ value, onChange, placeholder }: QuillEditorProps) {
    const modules = {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
            ['link', 'clean']
        ],
    };

    const formats = [
        'header',
        'bold', 'italic', 'underline', 'strike', 'blockquote',
        'list', 'bullet', 'indent',
        'link'
    ];

    return (
        <div className="quill-editor-wrapper w-full border rounded-md overflow-hidden bg-background">
            <ReactQuill
                theme="snow"
                value={value || ''}
                onChange={onChange}
                modules={modules}
                formats={formats}
                placeholder={placeholder || 'Type your content here...'}
                className="bg-background text-foreground"
            />
        </div>
    );
}
