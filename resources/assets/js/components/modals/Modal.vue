<template>
    <transition name="modal-fade">
        <div 
            class="modal"
            role="dialog"
        >
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
                                {{ bodyText }}
                            </div>
                            <div class="modal__footer">
                                <button v-if="onClose" @click="onClose" class="modal__btn modal__btn--secondary">Close</button>
                                <button v-if="onDelete" @click="onDelete" class="modal__btn modal__btn--danger">Delete</button>
                                <button v-if="onSubmit" @click="onSubmit" class="modal__btn modal__btn--primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

export default {

    props: {
        headerText: String,
        bodyText: String,
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
        }
    }

}

</script>

<style lang="scss" scoped>

@import '../../../sass/bscore';
@import '~bootstrap/scss/transitions';
@import '~bootstrap/scss/modal';
@import '~bootstrap/scss/buttons';

.modal {

    @extend .modal;
    @extend .fade;
    @extend .show;
    display: block;
    padding-right: 15px;

    &__mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity .3s ease;
    }

    &__wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    &__dialog {
        @extend .modal-dialog;
    }

    &__content {
        @extend .modal-content;
    }

    &__header {
        @extend .modal-header;
    }

    &__title {
        @extend .modal-title;
    }

    &__body {
        @extend .modal-body;
    }

    &__footer {
        @extend .modal-footer;
    }

    &__btn {
        @extend .btn;

        &--primary {
            @extend .btn-primary;
        }

        &--secondary {
            @extend .btn-secondary;
        }

        &--danger {
            @extend .btn-danger;
        }
    }

}

.modal-fade-enter {
    opacity: 0;
}

.modal-fade-leave-active {
    opacity: 0;
}

.modal-fade-enter .modal__dialog,
.modal-fade-leave-active .modal__dialog {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}


</style>
