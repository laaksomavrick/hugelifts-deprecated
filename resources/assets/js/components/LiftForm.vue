<template>
    <div class="lift-form">
        <div class="lift-form__form">
            <h4 class="lift-form__title">
                {{ title }}
            </h4>
            <div class="lift-form__form-group">
                <label>Name</label>
                <input 
                    class="lift-form__form-control"
                    v-model="name"
                >
                </input>
            </div>
            <div class="lift-form__form-group">
                <label>Max Lift</label>
                <div class="lift-form__form-row">
                    <div class="col">
                        <input 
                            class="lift-form__form-control"
                            placeholder="Reps"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMaxInterval"
                        >
                        </input>
                    </div>
                    <div class="col">
                        <input 
                            class="lift-form__form-control"
                            placeholder="Weight"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMax"
                        >
                        </input>
                    </div>
                </div>
            </div>
            <progress-button
                class="lift-form__button lift-form__button--primary"
                v-bind:class="{ disabled: !valid }"
                :working="submitWorking"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
            />
            <progress-button
                v-if="deleteable"
                class="lift-form__button lift-form__button--danger"
                :working="deleteWorking"
                :handleClick="onDeleteClick"
                buttonText="Delete"
            />
            <div
                class="lift-form__alert"
                v-for="error in errors"
            >
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>

import ProgressButton from '../components/ProgressButton'
import { formatErrors } from '../utils/error'
import { mapActions } from 'vuex'

export default {

    components: {
        ProgressButton
    },

    props: {
        exercise: {
            type: Object,
            default: null
        },
        onSubmit: Function,
        title: String,
        buttonText: String
    },

    data: function() {
        return {
            name: this.exercise ? this.exercise.name : null,
            repMaxInterval: this.exercise ? this.exercise.rep_max_interval : null,
            repMax: this.exercise ? this.exercise.rep_max : null,
            id: this.exercise ? this.exercise.id : null,
            errors: [],
            submitWorking: false,
            deleteWorking: false
        }
    },

    methods: {

        onSubmitClick: async function() {

            try {

                if (!this.valid) { return }

                this.submitWorking = true

                const data = {
                    id: this.id,
                    name: this.name,
                    rep_max_interval: this.repMaxInterval,
                    rep_max: this.repMax
                }

                await this.onSubmit(data)

                this.submitWorking = false
                this.$router.go(-1)

            } catch (e) {
                this.errors = formatErrors(e)
                this.submitWorking = false
            }

        },

        onDeleteClick: function() {
            const data = {
                open: true,
                props: {
                    headerText: `Delete ${this.name}?`,
                    bodyText: `Are you sure you want to delete ${this.name}?`,
                    onDelete: async () => { 
                        await this.destroyExercise(this.id)
                        this.deleteWorking = false
                        this.$router.go(-1)
                    }

                }
            }
            this.deleteWorking = true
            this.toggleConfirmModal(data)
        },

        ...mapActions([
            'toggleConfirmModal',
            'destroyExercise'
        ])

    },

    computed: {

        valid: function() {
            return (
                this.name
                && this.repMax
                && this.repMaxInterval
            )
        },

        deleteable: function() {
            return !!this.exercise
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';

.lift-form {

    @extend .form;
    @include make-container();

    &__title {
        text-align: center;
    }

    &__form {
        @extend .form__form;
        padding-top: 30px;
    }

    &__form-group {
        @extend .form__form-group;
    }

    &__form-control {
        @extend .form__form-control;
    }

    &__button {
        @extend .form__button;

        &--primary {
            @extend .btn-primary;
        }

        &--danger {
            @extend .btn-danger;
        }
    }

    &__form-row {
        @extend .form__form-row;
    }

    &__alert {
        @extend .form__alert;
    }
}

</style>
