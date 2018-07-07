<template>
    <b-form 
        class="lift-form"
        @submit="submit">

            <form-header :title="title"/>

            <b-form-group 
                class="lift-form__form-group"
                label="Name">
                <b-form-input 
                    class="lift-form__form-control"
                    v-model="name">
                </b-form-input>
            </b-form-group>

            <b-form-group 
                class="lift-form__form-group"
                label="Max Lift">

                <b-form-row class="lift-form__form-row">
                    <b-col>
                        <b-form-input 
                            class="lift-form__form-control"
                            placeholder="Reps"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMaxInterval"
                        >
                        </b-form-input>
                    </b-col>
                    <b-col>
                        <b-form-input 
                            class="lift-form__form-control"
                            placeholder="Weight"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMax"
                        >
                        </b-form-input>
                    </b-col>
                </b-form-row>

            </b-form-group>

            <b-row class="lift-form__button-row">
                <b-col class="lift-form__button-col--left">
                    <progress-button
                        class="lift-form__button"
                        v-bind:class="{ disabled: !valid }"
                        :working="submitWorking"
                        :handleClick="submit"
                        :buttonText="buttonText"
                        variant="primary"
                    />
                </b-col>
                <b-col class="lift-form__button-col--right">
                    <progress-button
                        v-if="deleteable"
                        class="lift-form__button"
                        :working="deleteWorking"
                        :handleClick="destroy"
                        buttonText="Delete"
                        variant="danger"
                    />
                </b-col>
            </b-row>

            <b-alert
                class="lift-form__alert"
                show
                variant="danger"
                v-for="(error, index) in errors"
                v-bind:key="index"
            >
                {{ error }}
            </b-alert>
    </b-form>
</template>

<script>

import ProgressButton from '../components/ProgressButton';
import FormHeader from '../components/FormHeader';
import { formatErrors } from '../utils/error';
import { mapActions } from 'vuex';

export default {

    components: {
        ProgressButton,
        FormHeader
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

        submit: async function(e) {

            try {

                e.preventDefault()

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

        destroy: function() {
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

.lift-form {

    &__button-row {
        margin-bottom: 1rem;
    }

    &__button-col {

        &--left {
            padding-right: 5px;
        }

        &--right {
            padding-left: 5px;
        }

    }

    &__button {
        width: 100%;
    }

}

</style>
