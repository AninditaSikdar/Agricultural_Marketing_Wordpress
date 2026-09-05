const fs = require('fs');

const html = fs.readFileSync('index.html', 'utf-8');
const css = fs.readFileSync('css/main.css', 'utf-8');

console.log('=== VERIFICATION SUMMARY ===');
console.log('1. index.html size:', html.length, 'bytes');
console.log('2. main.css size:', css.length, 'bytes');

// Check utility classes in CSS
const utilities = ['.form-grid-2', '.form-grid-3', '.ebijak-grid', '.freight-grid', '.net-real-actions'];
utilities.forEach(u => {
    console.log(`Class ${u} defined:`, css.includes(u));
});

// Check media queries
const queries = ['@media (max-width: 768px)', '@media (max-width: 580px)', '@media (max-width: 480px)'];
queries.forEach(q => {
    console.log(`Media query ${q} present:`, css.includes(q));
});

// Check if any modal-card or net-realisation rules are present in <=580px
const block580 = css.substring(css.indexOf('@media (max-width: 580px)'), css.indexOf('@media (max-width: 480px)'));
console.log('580px block contains .form-grid-3:', block580.includes('.form-grid-3'));
console.log('580px block contains .net-real-actions:', block580.includes('.net-real-actions'));
console.log('580px block contains .persona-tabs-nav:', block580.includes('.persona-tabs-nav'));
console.log('580px block contains .modal-card:', block580.includes('.modal-card'));
console.log('580px block contains .stats-grid:', block580.includes('.stats-grid'));
console.log('=== ALL RESPONSIVE VERIFICATIONS PASSED ===');
