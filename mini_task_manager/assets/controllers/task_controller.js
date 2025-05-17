import {Controller} from '@hotwired/stimulus';
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
        this.modal = new Modal( this.newModalTarget)
        this.editModal = new Modal(this.editModalTarget)
        // this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }

    static targets = ["newModal", "newTaskForm", 'editModal','editTaskForm']

    showNewModal() {
        this.modal.show()
        // const name = element.value
        // this.outputTarget.textContent = `Hello, ${name}!`
    }

    closeNewModal() {
        this.modal.hide()
    }

    submitNewModal() {
        this.newTaskFormTarget.requestSubmit()
        this.closeNewModal()
    }

    deleteTask(event) {
        if (confirm('Are you sure you want to delete this task?')) {
            event.target.parentNode.requestSubmit()

        }
    }

    showEditModal(event) {
        event.target.parentNode.requestSubmit()
        this.editModal.show()
    }
    closeEditModal() {
        this.editModal.hide()
    }
    submitEditModal() {
        this.editTaskFormTarget.requestSubmit()
        this.editModal.hide()
    }
}
