import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/dist/css/intlTelInput.css';

document.addEventListener('DOMContentLoaded', () => {

    const phoneInputs = document.querySelectorAll(
        'input[type="tel"][name="phone"]'
    );

    phoneInputs.forEach((phoneInput) => {

        const iti = intlTelInput(phoneInput, {
            initialCountry: 'ae',
            separateDialCode: true,
            countrySearch: true,

            loadUtils: () =>
                import('intl-tel-input/utils'),
        });

        const form = phoneInput.closest('form');

        form?.addEventListener('submit', () => {

            phoneInput.value = iti.getNumber();

        });

    });

});
