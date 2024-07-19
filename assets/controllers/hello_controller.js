import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.element.textContent = 'je suis la buddy';
        console.log('here')
    }
}
