<template>
    <b-modal v-model="modalOpen" @hidden="onClose">
        <template slot="modal-header">
            <h3>
            {{ headerText }}
            </h3>
        </template>
        <slot>
        </slot>
        <template slot="modal-footer">
            <b-button 
                v-if="onClose" 
                @click="handleOnClose"
                class="modal__btn modal__btn--secondary">
                Close
            </b-button>
            <progress-button 
                v-if="onDelete" 
                :handleClick="handleOnDelete" 
                :working="isWorking" 
                buttonText="Delete"
                variant="danger"
                v-bind:class=" { 'disabled' : disabled }"/>
            <progress-button 
                v-if="onSubmit" 
                :handleClick="handleOnSubmit" 
                :working="isWorking" 
                buttonText="Submit"
                variant="primary"
                v-bind:class=" { 'disabled' : disabled }"/>
        </template>
    </b-modal>
</template>

<script>

import ProgressButton from '../ProgressButton'

export default {

    components: {
        ProgressButton
    },

    props: {
        headerText: String,
        open: Boolean,
        onClose: {
            type: Function,
            default: null
        },
        onDelete: {
            type: Function,
            default: null
        },
        onSubmit: {
            type: Function,
            default: null
        },
        working: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }

    },

    // TODO: data / watch here is ugly; modal should just be reading from open prop

    data: function() {

        return {
            modalOpen: this.open
        }

    },

    watch: {

        open: function(newVal, oldval) {
            this.modalOpen = newVal
        }

    },

    methods: {

        handleOnClose: function() {
            this.onClose()
        },

        handleOnDelete: function() {
            this.onDelete()
        },

        handleOnSubmit: function() {
            this.onSubmit()
        },

    },

    computed: {

        isWorking: function() {
            return this.working
        }

    },


}

</script>