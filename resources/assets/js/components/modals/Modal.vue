<template>
    <transition name="modal-fade">
        <div class="modal" role="dialog">
            <div class="modal__mask">
                <div class="modal__wrapper">
                    <div class="modal__dialog">
                        <div class="modal__content">
                            <div class="modal__header">
                                <h5 class="modal__title">
                                    {{ headerText }}
                                </h5>
                            </div>

                            <div class="modal__body">
                                <slot>
                                </slot>
                            </div>

                            <div class="modal__footer">
                                <button 
                                    v-if="onClose" 
                                    @click="handleOnClose"
                                    class="modal__btn modal__btn--secondary"
                                >
                                    Close
                                </button>
                                <progress-button 
                                    v-if="onDelete" 
                                    :handleClick="handleOnDelete" 
                                    :working="isWorking" 
                                    buttonText="Delete"
                                    class="modal__btn modal__btn--danger"
                                    v-bind:class=" { 'disabled' : disabled }"
                                />
                                <progress-button 
                                    v-if="onSubmit" 
                                    :handleClick="handleOnSubmit" 
                                    :working="isWorking" 
                                    buttonText="Submit"
                                    class="modal__btn modal__btn--primary"
                                    v-bind:class=" { 'disabled' : disabled }"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

import ProgressButton from '../ProgressButton'

export default {

    components: {
        ProgressButton
    },

    props: {
        headerText: String,
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

<style lang="scss" scoped>

</style>
