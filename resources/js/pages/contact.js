import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/dist/css/intlTelInput.css';

const phoneInput = document.querySelector('#contact_phone');

if (phoneInput) {
    const iti = intlTelInput(phoneInput, {
        initialCountry: 'ae',
        separateDialCode: true,
        countrySearch: true,
        loadUtils: () => import('intl-tel-input/utils'),
    });

    const form = phoneInput.closest('form');

    form?.addEventListener('submit', () => {
        phoneInput.value = iti.getNumber();
    });
}