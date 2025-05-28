import 'bootstrap';



function updateCharacterCount() {
    const contentTextarea = document.getElementById('content');
    const characterCount = document.getElementById('characterCount');

    if (!contentTextarea || !characterCount) return;

    const currentLength = contentTextarea.value.length;
}

document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('content');
    if (content) {
        updateCharacterCount(); // Initial count
        content.addEventListener('input', updateCharacterCount);
    }
});
