import { Controller } from '@hotwired/stimulus';
import {Modal} from 'bootstrap';
/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    modal

    connect() {
        console.log('connect')
        const modal = this.newModalTarget
        this.modal =  new Modal(modal)
        // this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
    static targets = [ "newModal", "newTaskForm" ]

    showNewModal() {
       this.modal.show()
        // const name = element.value
        // this.outputTarget.textContent = `Hello, ${name}!`
    }
    closeNewModal () {
        this.modal.hide()
    }

    submitNewModal() {
        this.newTaskFormTarget.submit()
        this.closeNewModal()
    }

}
