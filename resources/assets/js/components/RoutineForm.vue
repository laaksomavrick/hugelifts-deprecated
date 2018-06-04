<template>
    <div class="routine-form">
        <div class="routine-form__form">
            <h4 class="routine-form__title">
                {{ title }}
            </h4>
            <div class="routine-form__form-group">
                <label>Name</label>
                <input 
                    class="routine-form__form-control"
                    v-model="name"
                >
                </input>
            </div>
            <div class="routine-form__form-group ">
                <label>Exercises</label>
                <div class="routine-form__exercises">
                    <template 
                        v-if="routine"
                        v-for="exercise in exercises"
                        class=""
                    >
                        <routine-exercise :exercise="exercise" />
                    </template>
                </div>
            </div>
            <progress-button
                class="routine-form__button routine-form__button--primary"
                v-bind:class="{ disabled: !valid }"
                :working="working"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
            />
            <progress-button
                v-if="deleteable"
                class="routine-form__button routine-form__button--danger"
                :working="working"
                :handleClick="onDeleteClick"
                buttonText="Delete"
            />
            <div
                class="routine-form__alert"
                v-for="error in errors"
            >
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>

import ProgressButton from '../components/ProgressButton'
import RoutineExercise from '../components/RoutineExercise'
import { formatErrors } from '../utils/error'
import { mapActions } from 'vuex'

export default {

    /*
        name
        exercises: [
            {
                exercise_id
                routine_id
                sets: [
                    {
                        reps
                        percantage
                    }
                ]
            }
        ]

    */

    components: {
        ProgressButton,
        RoutineExercise
    },

    props: {
        routine: {
            type: Object,
            default: null
        },
        onSubmit: Function,
        buttonText: String
    },

    data: function() {
        return {
            name: this.routine ? this.routine.name : null,
            id: this.routine ? this.routine.id : null,
            errors: [],
            working: false
        }
    },

    methods: {

        onSubmitClick: async function() {

            try {

                if (!this.valid) { return }

                this.working = true

                const data = {
                    id: this.id,
                    name: this.name,
                }

                //await this.onSubmit(data)

                this.working = false
                this.$router.go(-1)

            } catch (e) {
                this.errors = formatErrors(e)
                this.working = false
            }

        },

        onDeleteClick: function() {
            const data = {
                open: true,
                props: {
                    headerText: `Delete ${this.name}?`,
                    bodyText: `Are you sure you want to delete ${this.name}?`,
                    onDelete: async () => { 
                        //await this.destroyExercise(this.id)
                        this.$router.go(-1)
                    }

                }
            }
            this.toggleConfirmModal(data)
        },

        ...mapActions([
            'toggleConfirmModal',
        ])

    },

    computed: {

        valid: function() {
            return (
                this.name
            )
        },

        deleteable: function() {
            return !!this.routine
        },

        title: function() {
            return this.routine ? this.routine.name : 'New Routine'
        },

        exercises: function() {
            return this.routine ? this.routine.exercises : []
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';

.routine-form {

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

    &__exercises {

        & > *:first-child {
            margin-top: 0px!important;
            margin-bottom: 5px!important;
        }
        & > *:last-child {
            margin-top: 5px;
            margin-bottom: 0px;
        }
        & > * {
            margin-top: 5px;
            margin-bottom: 5px;
        }

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
